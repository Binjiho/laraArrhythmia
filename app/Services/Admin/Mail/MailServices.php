<?php

namespace App\Services\Admin\Mail;

use App\Exports\MailDetail;
use App\Models\MailAddress;
use App\Models\MailAddressList;
use App\Models\MailList;
use App\Models\MailSend;
use App\Models\User;
use App\Models\WiseUMailBody;
use App\Models\WiseUMailInterface;
use App\Models\WiseUMailLog;
use App\Services\CommonServices;
use App\Services\AppServices;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use function Symfony\Component\Translation\t;

/**
 * Class MailServices
 * @package App\Services
 */
class MailServices extends AppServices
{
    public function findMail(int $sid = 0)
    {
        return MailList::findOrFail($sid);
    }

    // 메일 발송 상태 업데이트
    public function mailSendStatusUpdate()
    {
        $mailConfig = config('site.mail');

        if (env('APP_ENV') !== 'local') {
            $whereIn = MailSend::select('wiseu_seq')->where('status', 'R')->whereRaw('DATE(created_at) >= DATE_SUB(CURDATE(), INTERVAL 1 WEEK)')->limit(1000)->get();

            if (count($whereIn) > 0) {
                $wiseuLog = WiseUMailLog::where('ECARE_NO', $mailConfig['eCareNo'])->whereIn('CUSTOMER_KEY', $whereIn)->get();

                foreach ($wiseuLog as $row) {
                    $code = $row->ERROR_CD;

                    if (!empty($mailConfig['code'][$code])) {
                        $mail_send = MailSend::where('wiseu_seq', $row->CUSTOMER_KEY)->first();

                        if ($code === '250' || $code === '000') {
                            $mail_send->status = 'S';
                        } else {
                            $mail_send->status = 'F';
                        }

                        $mail_send->status_msg = $mailConfig['code'][$code];
                        $mail_send->update();
                    }
                }
            }
        }
    }

    public function indexService(Request $request)
    {
        //메일 상태 최신화
        $this->mailSendStatusUpdate();

        $query = MailList::orderByDesc('created_at');

        if ($request->subject) {
            $query->where('subject', 'LIKE', ('%' . $request->subject . '%'));
        }

        if ($request->sender_name) {
            $query->where('sender_name', 'LIKE', ('%' . $request->sender_name . '%'));
        }

        if ($request->sDate || $request->eDate) {
            $query->whereBetween(DB::raw("DATE_FORMAT(send_date, '%Y-%m-%d')"), [$request->sDate ?? '0001-01-01', $request->eDate ?? date('Y-m-d')]);
        }

        if ($request->create_sDate || $request->create_eDate) {
            $query->whereBetween('created_at', [$request->create_sDate ?? '0001-01-01', $request->create_eDate ? $request->create_eDate.' 23:59:59' : date('Y-m-d H:i:s')]);
        }

        $mail = $query->paginate(20)->appends(request()->except(['page']));

        $this->data['mail'] = setListSeq($mail);
        $this->data['mailConfig'] = config('site.mail');

        return $this->data;
    }

    public function detailService(Request $request)
    {
        $this->mailSendStatusUpdate();

        $this->data['mail'] = $this->findMail($request->ml_sid);
        $query = $this->data['mail']->totMail()->orderByDesc('created_at');

        // 엑셀 다운로드 일경우
        if ($request->excel) {
            $this->data['collection']= setSeq($query->get());
            return Excel::download(new MailDetail($this->data), '메일 발송내역 상세.xlsx');
        }


        $list = $query->paginate(20)->appends(request()->except(['page']));
        $this->data['list'] = setListSeq($list);

        return $this->data;
    }

    public function mailEditService(Request $request)
    {
        $sid = $request->sid;
        $this->data['mail'] = empty($sid) ? [] : $this->findMail($sid);
        $this->data['address'] = MailAddress::all();
        $this->data['mailConfig'] = config('site.mail');

        return $this->data;
    }

    public function mailGetPreview(Request $request)
    {
        $sid = $request->sid;
        $mail = $this->findMail($sid);
        $mail->preview = true;

        $this->data['view'] = config('site.mail')['templateFile'][$mail->template];
        $this->data['data'] = $mail;
        $this->data['infoConfig'] = config('site.default')['info'];

        return $this->data;
    }

    public function mailGetResend(Request $request)
    {
        $search = $request->search;
        $regnum = $request->regnum;

        $mail = MailSend::where(['etc' => $regnum, 'status'=>'S'])->where('subject', 'like', "%{$search}%")->orderByDesc('created_at')->first();
//        $mail->preview = true;

        switch ($request->search)
        {
            case '사전등록':
                $this->data['view'] = 'resend_popup';
                $this->data['template'] = 'registration-create';
                break;
            case '초록등록':
                $this->data['view'] = 'resend_popup';
                $this->data['template'] = 'abstract-create';
                break;
            default:
                break;
        }

        $this->data['data'] = $mail;
        $this->data['infoConfig'] = config('site.default')['info'];

        return $this->data;
    }

    public function dataAction(Request $request)
    {
        switch ($request->case) {
            case 'mail-create':
                return $this->mailCreateService($request);

            case 'mail-update':
                return $this->mailUpdateService($request);

            case 'mail-delete':
                return $this->mailDeleteService($request);

            case 'mail-preview':
                return $this->mailPriviewService($request);

            case 'mail-resend': // 메일 전체 재발송 or 발송
                return $this->mailResendService($request);

            case 'mail-targetResend': // 메일 특정대상 재발송 or 발송
                return $this->mailTargetResendService($request);

            case 'mail-customResend': // 메일 재발송 Custom
                return $this->mailCustomResendService($request);

            case 'tinymceUpload':
                return (new CommonServices())->tinymceImageUploadService($request);

            default:
                return NotFoundRedirect();
        }
    }

    private function mailCreateService(Request $request)
    {
        $this->transaction();

        try {
            $use_send = $request->use_send;

            $mail = (new MailList());
            $mail->setByData($request, $this->mailFileUploadService($request));
            $mail->save();

            $sendMail = $this->mailTypeSendService($mail, $use_send);

            if ($sendMail !== true) {
                return $sendMail;
            }

            $this->dbCommit('');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => "메일이 " . (($use_send === 'Y') ? '발송' : '등록') . "되었습니다.",
                'winClose' => $this->ajaxActionWinClose(true)
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function mailUpdateService(Request $request)
    {
        $this->transaction();

        try {
            $mail = $this->findMail($request->sid);
            $mail->setByData($request, $this->mailFileUploadService($request));
            $mail->update();

            $sendMail = $this->mailTypeSendService($mail, $request->use_send);

            if ($sendMail !== true) {
                return $sendMail;
            }

            $this->dbCommit('');

            if($request->del_file) {
                foreach (json_decode($request->del_file) as $row) {
                    (new CommonServices())->fileDeleteService($row);
                }
            }

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => "메일이 수정되었습니다.",
                'winClose' => $this->ajaxActionWinClose(true)
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function mailDeleteService(Request $request)
    {
        $this->transaction();

        try {
            $sid = $request->sid;

            $mail = $this->findMail($sid);
            $mailFile = $mail->file;
            $mail->delete();

            MailSend::where('ml_sid', $sid)->delete();

            $this->dbCommit('');

            if($mailFile) {
                foreach (json_decode($mailFile) as $row) {
                    (new CommonServices())->fileDeleteService($row->file_path);
                }
            }

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => "메일이 삭제되었습니다.",
                'location' => $this->ajaxActionLocation('reload')
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function mailPriviewService(Request $request)
    {
        try {
            $sid = $request->sid;

//            $file_data = [];
//            $file = $request->file('file');
//
//            $i = 0;
//            foreach ($file ?? [] as $row) {
//                $file_data[$i] = (object) [
//                    'file_path' => $row->getRealPath(),
//                    'file_name' => $row->getClientOriginalName(),
//                ];
//                $i++;
//            }

            if(empty($sid)) {
                $mail = (new MailList());
                $mail->setByData($request, $this->mailFileUploadService($request));
            }else {
                $mail = $this->findMail($sid);
                $mail->setByData($request, $this->mailFileUploadService($request));
            }

            $mail->preview = true;

            $this->data['data'] = $mail;
            $this->data['infoConfig'] = config('site.default')['info'];
            $view = config('site.mail')['templateFile'][$mail->template];
            $body = view('common.mail.' . $view, $this->data)->render();

            //원본
//            return ['preview' => $body];

            //시도
//            return $this->returnJsonData('window.open', [
//                'url' => '',
//                'target'=>'mail-preview',
//                'features'=>'width=700,height=900,resizeable,scrollbars',
//            ]);

            //3시도
            $this->setJsonData('trigger', [
                $this->ajaxActionTrigger(".preview-open", 'click'),
            ]);

            $this->setJsonData('input', [
                $this->ajaxActionInput("input[name='preview-data']", $body),
            ]);

            $this->setJsonData('append', [
                $this->ajaxActionHtml('body', view('admin.mail.popup.preview', $this->data)->render()),
            ]);

            return $this->returnJson();

        } catch (\Exception $e) {
            return $e;
        }
    }

    // 메일 재발송 or 미발송메일 발송
    private function mailResendService(Request $request)
    {
        $this->transaction();
        try {
            $mail = $this->findMail($request->sid);
            $thread = $mail->thread;
            $sendType = ($thread == 0 ? '발송' : '재발송');

            $mail->thread = ($thread + 1);
            $mail->update();

            $sendMail = $this->mailTypeSendService($mail);

            if ($sendMail !== true) {
                return $sendMail;
            }

            $this->dbCommit('');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => "메일이 {$sendType}되었습니다.",
                'location' => $this->ajaxActionLocation('reload'),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    // 특정대상 재발송 or 미발송메일 발송
    private function mailTargetResendService(Request $request)
    {
        $this->transaction();

        try {
            $ml_sid = $request->ml_sid;
            $mailList = $this->findMail($ml_sid);
            $mailSend = MailSend::where(['sid' => $request->sid, 'ml_sid' => $ml_sid])->firstOrFail();

            $mail = $mailList;
            $mail->name_kr = $mailSend->recipient_name;
            $mail->email = $mailSend->recipient_email;
            $view = config('site.mail')['templateFile'][$mail->template];

            $sendMail = $this->mailSendService($mail, $mail->subject, $view, $ml_sid);

            if ($sendMail !== true) {
                return $sendMail;
            }

            $this->dbCommit('');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => "메일이 발송되었습니다.",
                'location' => $this->ajaxActionLocation('reload'),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function mailCustomResendService(Request $request)
    {
        $this->transaction();

        try {
            $mailSend = MailSend::where(['sid' => $request->sid])->firstOrFail();

            $mailSend->name_kr = $request->test_email;
            $mailSend->uid = $request->test_email;

            $template = $request->template ?? 'registration-create';
            if($template == 'registration-create'){

            }else if($template == 'abstract-create'){

            }

            $sendMail = $this->mailSendService($mailSend, $mailSend->subject, $template, 0, $mailSend->etc ?? '', $mailSend->contents);

            if ($sendMail !== true) {
                return $sendMail;
            }

            $this->dbCommit('메일 커스텀 재발송');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => "메일이 발송되었습니다.",
                'winClose' => $this->ajaxActionWinClose(true)
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    // 발송 타입별 메일 발송
    private function mailTypeSendService($mail, $use_send = 'Y')
    {
        // 메일 발송여부 확인
        if ($use_send === 'Y') {
            // 메일 발송
            $ml_sid = $mail->sid;
            $view = config('site.mail')['templateFile'][$mail->template];

            // 회원등급별 발송
            if ($mail->send_type == 1) {
                $user = User::whereIn('level', $mail->level)
                    ->where('confirm', 'Y') // 승인회원 대상
//                    ->where('email_yn', 'Y') // 이메일 수신 선택만 발송했는데 조건변경으로 주석
                    ->get();

                foreach ($user as $row) {
                    $mail->name_kr = $row->name_kr;
                    $mail->uid = $row->email;
//                    $mail->email = $row->email;

                    $sendMail = $this->mailSendService($mail, $mail->subject, $view, $ml_sid);

                    if ($sendMail === true) {
                        if(!empty($row->email2)) {
                            $mail->email = $row->email2;

                            $sendMail = $this->mailSendService($mail, $mail->subject, $view, $ml_sid);

                            if ($sendMail !== true) {
                                return $sendMail;
                            }
                        }
                    } else {
                        return $sendMail;
                    }
                }

                return true;
            }

            // 주소록 발송
            if ($mail->send_type == 2) {
                $address = MailAddressList::where('ma_sid', $mail->ma_sid)->get();

                foreach ($address as $row) {
                    $mail->name_kr = $row->name;
                    $mail->uid = $row->email;
//                    $mail->email = $row->email;

                    $sendMail = $this->mailSendService($mail, $mail->subject, $view, $ml_sid);

                    if ($sendMail === true) {
                        continue;
                    } else {
                        return $sendMail;
                    }
                }

                return true;
            }

            // 테스트 전송
            if ($mail->send_type == 9) {
                $mail->name_kr = 'TEST EMAIL';
                $mail->uid = $mail->test_email;
//                $mail->email = $mail->test_email;

                $sendMail = $this->mailSendService($mail, $mail->subject, $view, $ml_sid);

                if ($sendMail === true) {
                    return true;
                } else {
                    return $sendMail;
                }
            }
        }

        return true;
    }

    // 메일 발송 로직
    public function mailSendService($data, $subject, $view, $ml_sid, $etc=null, $rebody=null)
    {
        $infoConfig = config('site.default')['info'];

        $now = Carbon::now();
        $seq = $now->timestamp . $now->micro;

        $receiver_name = $data->name_kr;
        $receiver_email = $data->uid;

        $this->data['data'] = $data;
        $this->data['infoConfig'] = $infoConfig;

        $body = view('common.mail.' . $view, $this->data)->render();
        if($rebody){
            $body = $rebody;
        }
        
        $this->transaction();

        try {
            if (env('APP_ENV') !== 'local') {
                //인터페이스 테이블
                WiseUMailInterface::insert([
                    'ECARE_NO' => config('site.mail')['eCareNo'],
                    'RECEIVER_ID' => $seq,
                    'CHANNEL' => 'M',
                    'SEQ' => $seq,
                    'REQ_DT' => $now->format('Ymd'),
                    'REQ_TM' => $now->format('His'),
                    'TMPL_TYPE' => 'T',
                    'RECEIVER_NM' => $receiver_name,
                    'RECEIVER' => $receiver_email,
                    'SENDER_NM' => env('APP_NAME'),
                    'SENDER' => $infoConfig['email'],
                    'SUBJECT' => $subject,
                    'SEND_FG' => 'R',
                    'DATA_CNT' => 1,
                ]);

                //메일 body
                WiseUMailBody::insert([
                    'SEQ' => $seq,
                    'DATA_SEQ' => 1,
                    'ATTACH_YN' => 'N',
                    'DATA' => $body,
                ]);
            }

            /*
             * $ml_sid => mail_list.sid
             * 회원가입 메일 발송, 임시비밀번호 메일 발송, 회원가입 승인 메일 ml_sid = 0
             */
            $data = [
                'ml_sid' => $ml_sid,
                'wiseu_seq' => $seq,
                'recipient_name' => $receiver_name,
                'recipient_email' => $receiver_email,
                'subject' => $subject,
                'contents' => $body,
                'etc' => $etc,
            ];

            $mailSend = (new MailSend());
            $mailSend->setByData($data);
            $mailSend->save();

            $this->dbCommit('메일발송');
            return true;
        } catch (\Exception $e) {
            return $this->dbRollback($e,true);
        }
    }

    private function mailFileUploadService(Request $request)
    {
        $file_data = [];
        $file_path = 'mail';
        $file = $request->file('file');

        $i = 0;
        foreach ($file ?? [] as $row) {
            $file_data[$i] = (new CommonServices())->fileUploadService($row, $file_path);
            $i++;
        }

        return $file_data;
    }
}
