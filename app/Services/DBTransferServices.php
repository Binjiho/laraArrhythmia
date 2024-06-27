<?php

namespace App\Services;

use App\Models\User;
use App\Models\Reviewer;
use App\Models\ResearchResult;
use App\Models\Research;
use App\Models\Fee;
use App\Models\Conference;
use App\Models\Abstracts;
use App\Models\Registration;
use App\Models\OverseasConference;
use App\Models\Overseas;
use App\Models\GroupMember;
use App\Models\Surgery;
use App\Models\SurgeryCase;
use App\Models\Career;
use App\Models\SurgeryResult;

use App\Models\Board;
use App\Models\BoardComment;
use App\Models\BoardCounter;
use App\Models\BoardFile;
use App\Models\BoardPopup;
use App\Models\BoardReply;

use App\Models\MailAddress;
use App\Models\MailAddressList;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

/**
 * Class DBTransferServices
 * @package App\Services
 */
class DBTransferServices extends AppServices
{
    public function dbTransferService()
    {
        set_time_limit(0);

        var_dump('################# start Transfer ################# <br> <br> <br> <br>');
//        $this->userTransfer();
//        $this->reviewerTransfer();
//        $this->researchResultTransfer();
//        $this->researchTransfer();
//        $this->feeTransfer();
//        $this->conferenceTransfer();
        $this->conferenceModifyTransfer();
//        $this->registrationTransfer();
//        $this->OverseasConferenceTransfer();
//        $this->overseasRegistrationTransfer();
//        $this->groupMemberTransfer();
//        $this->surgeryTransfer();
//        $this->surgeryCareerTransfer();
//        $this->surgeryCaseTransfer();
//        $this->surgeryReviewerTransfer();
//        $this->surgeryResultTransfer();
//        $this->boardTransfer();

        var_dump('<br> <br> <br> <br> ################# finish Transfer #################');
    }

    public function getAlphaNum($alpha)
    {
        $array = [
            'A'=>1,
            'B'=>2,
            'C'=>3,
            'D'=>4,
            'E'=>5,
            'F'=>6,
            'G'=>7,
            'H'=>8,
            'I'=>9,
            'J'=>10,
            'K'=>11,
            'L'=>12,
            'M'=>13,
            'N'=>14,
            'O'=>15,
            'P'=>16,
            'Q'=>17,
            'R'=>18,
            'S'=>19,
            'T'=>20,
            'U'=>21,
            'V'=>22,
            'W'=>23,
            'X'=>24,
            'Y'=>25,
            'Z'=>26,
            'Others'=>'99',
        ];
        return $array[$alpha];
    }

    private function userTransfer()
    {
        $this->oldDBConnection();

        $old_user = DB::select(DB::raw("select * from KHRS_MemberSystem"));

        $custom_old_user = [];

        foreach ($old_user as $key => $row) {
            /**
             * level
             * 가입대기 1
             * 보류(회원) 2
             * 보류(전문회원) 3
             * 회원 4
             * 전문회원 5
             * 일반회원 6
             * 보류(일반회원) 7
             */
            switch ($row->Member_LV) {
                case '1':
                    $level = 'B';
                    break;
                case '2':
                    $level = 'H';
                    break;
                case '3':
                    $level = 'I';
                    break;
                case '4':
                    $level = 'A';
                    break;
                case '5':
                    $level = 'S';
                    break;
                case '6':
                    $level = 'G';
                    break;
                case '7':
                    $level = 'J';
                    break;

                default:
                    $level = 'T';
                    break;
            }

            //직책(position)
            $pos = array();
            $pos_etc = null;
            if($row->Member_Position_A=='Y') $pos[] = '1';
            if($row->Member_Position_B=='Y') $pos[] = '2';
            if($row->Member_Position_C=='Y') $pos[] = '3';
            if($row->Member_Position_D=='Y') $pos[] = '4';
            if($row->Member_Position_E=='Y') $pos[] = '5';
            if($row->Member_Position_F=='Y') $pos[] = '6';
            if($row->Member_Position_G=='Y') $pos[] = '7';
            if($row->Member_Position_H=='Y') {
                $pos[] = '99';
                $pos_etc=$row->Member_Position_Etc;
            }

            //집번호(tel)
            $tel = array();
            if($row->Member_Tel2) $tel[] = $row->Member_Tel2;
            if($row->Member_Tel3) $tel[] = $row->Member_Tel3;
            if($row->Member_Tel4) $tel[] = $row->Member_Tel4;

            //phone
            $phone = array();
            if($row->Member_Mobile2) $phone[] = $row->Member_Mobile2;
            if($row->Member_Mobile3) $phone[] = $row->Member_Mobile3;
            if($row->Member_Mobile4) $phone[] = $row->Member_Mobile4;

            // 근무처정보
            $office_etc = null;
            switch ($row->Member_Place) {
                case 'A':
                    $office = '1';
                    break;

                case 'B':
                    $office = '2';
                    break;

                case 'C':
                    $office = '3';
                    break;

                case 'Others':
                    $office = '99';
                    $office_etc = $row->Member_Place_Etc;
                    break;

                default:
                    break;
            }

            // 가입구분
            $category_etc = null;
            if($row->Reg_Category=='Others' || !$row->Reg_Category){
                $category_etc = $row->Reg_Category_Etc ?? '';
                $category=99;
            }else{
                $category=$this->getAlphaNum($row->Reg_Category) ?? '';
            }

            // 전공구분
            $major = null;
            $major_field = null;
            $major_etc = null;
            switch ($row->Reg_Category2) {
                case 'A':
                    $major = '1';
                    if(!$row->Reg_Category3 ){
                        $major_etc = null;
                    }else{
                        if($row->Reg_Category3=='Others' ){
                            $major_field = $row->Reg_Category_Etc;
                        }
                        $major_etc=$this->getAlphaNum($row->Reg_Category3) ?? '';
                    }
                    break;
                case 'B':
                    $major = '2';
                    if(!$row->Reg_Category4 ){
                        $major_etc = null;
                    }else {
                        if ($row->Reg_Category4 == 'Others') {
                            $major_field = $row->Reg_Category_Etc;
                        }
                        $major_etc = $this->getAlphaNum($row->Reg_Category4) ?? '';
                    }
                    break;
                case 'C':
                    $major = '99';
                    if(!$row->Reg_Category5 ){
                        $major_etc = null;
                    }else {
                        if ($row->Reg_Category5 == 'Others') {
                            $major_field = $row->Reg_Category_Etc;
                        }
                        $major_etc = $this->getAlphaNum($row->Reg_Category5) ?? '';
                    }
                    break;

                default:
                    break;
            }

            //진료분야
            $field = array();
            $field_etc = null;
            if($row->Member_DT_Type1=='Y') $field[] = '1';
            if($row->Member_DT_Type2=='Y') $field[] = '2';
            if($row->Member_DT_Type3=='Y') $field[] = '3';
            if($row->Member_DT_Type4=='Y') $field[] = '4';
            if($row->Member_DT_Type5=='Y') $field[] = '5';
            if($row->Member_DT_Type6=='Y') $field[] = '6';
            if($row->Member_DT_Type7=='Y') $field[] = '7';
            if($row->Member_DT_Type8=='Y') $field[] = '8';
            if($row->Member_DT_Type9=='Y') $field[] = '9';
            if($row->Member_DT_Type10=='Y') $field[] = '10';
            if($row->Member_DT_Type11=='Y') $field[] = '11';
            if($row->Member_DT_Type12=='Y') $field[] = '12';
            if($row->Member_DT_Etc) $field_etc = $row->Member_DT_Etc;
            if(empty($field)) $field=null;

            //비밀번호
            $phone3 = $row->Member_Mobile3 ?? '0000';
            $phone4 = $row->Member_Mobile4 ?? '0000';
            $newPw = 'khrs'.$phone3.$phone4;

            array_push($custom_old_user, (object)[
                'member_id' => $row->Member_idx,
                'uid' => $row->Member_Email,
                'password' => $newPw,

                'name_kr' => $row->Member_NameK,
                'first_name' => $row->Member_NameF,
                'last_name' => $row->Member_NameL,

                'phone' => $phone,
                'tel' => $tel,

                'image_path' => empty($row->Member_PP_File1) ? null : ('/storage/uploads/user/' . $row->Member_PP_File1),
                'image_name' => $row->Member_PP_File1 ?? null,

                'country_name' => $row->Member_Country ?? null,
                'hospital' => $row->Member_Country == 'Korea' ? $row->Member_OrganisationK : $row->Member_OrganisationK,
                'sosok_kr' => $row->Member_OrganisationK ?? null,
                'sosok_en' => $affi->Member_Organisation ?? null,
                'shool_kr' => $affi->shool_k ?? '',
                'shool_en' => $affi->school_e ?? '',
                'depart_kr' => $row->Member_DepartmentK ?? '',
                'depart_en' => $row->Member_Department ?? '',
                'position' => $pos,

                'position_etc' => $pos_etc,
                'city' => $row->city ?? '',
                'office_zipcode' => $row->Member_PostalCode,
                'office_addr1' => $row->Member_City.' '.$row->Member_Address,
                'office' => $office,

                'office_etc' => $office_etc,
                'category' => $category,
                'category_etc' => $category_etc,
                'major' => $major,
                'major_etc' => $major_etc,

                'major_field' => $major_field,
                'level' => $level,
                'level_etc' => null,
                'university' => $row->Member_UnivName,
                'university_year' => $row->Member_UnivNameY,

                'degree' => $row->Member_Degree,
                'degree_year' => $row->Member_DegreeY,
                'degree_title' => $row->Member_Paper,
                'license_number' => $row->Member_Dcode,
                'license_year' => $row->Member_DcodeY,

                'major1' => $row->Member_ProDt1,
                'major1_year' => $row->Member_ProDt1Y,
                'major2' => $row->Member_ProDt2,
                'major2_year' => $row->Member_ProDt2Y,
                'speciality' => $row->Member_ProDt3,

                'speciality_year' => $row->Member_ProDt3Y,
                'field' => $field,
                'field_etc' => $field_etc,
                'search_yn' => ($row->Member_Open == 'Y') ? 'Y' : 'N',
                'surgery_yn' => ($row->Member_Ch2 == 'Y') ? 'Y' : 'N',

                'adminPassword' => null,
                'confirm' => null,
                'confirm_date' => null,
                'del_confirm' => ($row->Member_Type == 'N') ? 'Y' : 'N',
                'del_confirm_date' => null,
                'password_at' => null,
                'today_at' => null,
                'created_at' => $row->Member_Wdate,

                'updated_at' => null,
                'deleted_at' => null,
            ]);

        }
        $this->activationDBConnection();
        $this->transaction();

        try {
            $totUser = number_format(count($custom_old_user));
            var_dump("INSERT user_binfo START: {{$totUser}} 개 데이터 <br><br>");

            foreach ($custom_old_user as $key => $row) {

                $user_chk = User::where(['member_idx' => $row->member_id])->first();
                if( $user_chk ) continue;

//                if( $key <= 4366 ) continue;

                $user = (new User());



                //국가
                $country = null;
                if(!empty($row->country_name)) {
                    $country = DB::select(DB::raw("select ci from country where cn like '%" . $row->country_name . "%' "));
                    if (!empty($country[0]->cid)) {
                        $country = $country[0];
                    }

                }

                //소속(병원)
                $affi = null;
                if(!empty($row->hospital)) {
                    $affi = DB::select(DB::raw("select * from affiliation_sosok where office_k like '%" . $row->hospital . "%' "));
                    if (!empty($affi[0]->sid)) {
                        $affi = $affi[0];
                    }
                }

                $user->setByData($row);

                $user->country = $country->ci ?? 1;
                $user->sosok = $affi->sid ?? null;
                $user->school_kr = $affi->shool_k ?? null;
                $user->school_en = $affi->school_e ?? null;

//                    $user->confirm = $row->confirm;
//                    $user->confirm_date = $row->confirm_date;
//                    $user->created_at = null;
//                    $user->updated_at = null;
//                    $user->password_at = null;
//                    $user->today_at = null;

                $user->save();

                $cnt = number_format($key + 1);
                var_dump("INSERT user_binfo {$cnt} 번째 <br>");

            }

            DB::commit();
            var_dump("<br><br> INSERT user_binfo FINISH");
        } catch (\Exception $e) {
            DB::rollback();
            dd('ERROR USER', $e);
        }
    }

    private function userModifyTransfer()
    {
        $this->oldDBConnection();

        $old_user = DB::select(DB::raw("select * from KHRS_MemberSystem"));

        $custom_old_user = [];

        foreach ($old_user as $key => $row) {

            array_push($custom_old_user, (object)[
                'Member_idx' => $row->Member_idx,
                'Member_OrganisationK' => $row->Member_OrganisationK,
                'Member_Organisation' => $row->Member_Organisation,
            ]);
        }
        $this->activationDBConnection();
        $this->transaction();

        try {
            $totUser = number_format(count($custom_old_user));
            var_dump("UPDATE user_binfo START: {{$totUser}} 개 데이터 <br><br>");

            foreach ($custom_old_user as $key => $row) {

                $user = User::findOrFail($row->Member_idx);
                $user->sosok_kr = $row->Member_OrganisationK;
                $user->sosok_en = $row->Member_Organisation;

                $user->save();

//                DB::commit();
                $cnt = number_format($key + 1);
                var_dump("INSERT user_binfo {$cnt} 번째 <br>");

            }

            DB::commit();
            var_dump("<br><br> INSERT user_binfo FINISH");
        } catch (\Exception $e) {
            DB::rollback();
            dd('ERROR USER', $e);
        }
    }

    private function reviewerTransfer()
    {
        $this->oldDBConnection();
        $items = DB::select(DB::raw("select * from KHRS_ResearchExMember"));

        $new_items = []; // 지난 학술대회

        foreach ($items as $key => $row) {
            array_push($new_items, (object)[
                'reviewer_idx' => $row->ResearchExMember_Idx,
                'code' => 'research',
                'user_sid' => $row->ResearchExMember_MemberIDX,
                'use_yn' => ($row->ResearchExMember_Type == 'Y') ? 'Y' : 'N',
                'level' => $row->ResearchExMember_Etc2,

                'created_at' => $row->ResearchExMember_Wdate,
                'updated_at' => $row->ResearchExMember_Edate,
            ]);
        }

        $this->activationDBConnection();
        $this->transaction();

        try {
            $totContest = number_format(count($new_items));
            var_dump("INSERT Reviewer START: {$totContest} 개 데이터 <br><br>");

            foreach ($new_items as $key => $row) {
                $reviewer = (new Reviewer());
                $reviewer->setByData($row);
                $reviewer->created_at = $row->created_at;
                $reviewer->updated_at = $row->updated_at;
                $reviewer->save();

                $cnt = number_format($key + 1);
                var_dump("INSERT Reviewer {$cnt} 번째 <br>");
            }

            DB::commit();
            var_dump("<br><br> INSERT Reviewer FINISH");
        } catch (\Exception $e) {
            DB::rollback();
            dd('ERROR Reviewer', $e);
        }
    }

    private function researchResultTransfer()
    {
        $this->oldDBConnection();
        $items = DB::select(DB::raw("select * from KHRS_ResearchExamination"));

        $new_items = [];

        foreach ($items as $key => $row) {

            $score1 = $row->ResearchExamination_Q1 ?? 0;
            $score2 = $row->ResearchExamination_Q2 ?? 0;
            $score3 = $row->ResearchExamination_Q3 ?? 0;
            $score4 = $row->ResearchExamination_Q4 ?? 0;
            $score5 = $row->ResearchExamination_Q5 ?? 0;
            $tot_score = $score1+$score2+$score3+$score4+$score5;
            $tot_avg = $tot_score/5;

            array_push($new_items, (object)[
                'result_idx' => $row->ResearchExamination_Idx,
                'research_sid' => $row->ResearchExamination_RCostIDX,
                'user_sid' => $row->ResearchExamination_RCostIDX,
                'reviewer_sid' => $row->ResearchExamination_RExMemberIDX,

                'score1' => $score1,
                'score2' => $score2,
                'score3' => $score3,
                'score4' => $score4,
                'score5' => $score5,
                'tot_score' => $tot_score,
                'tot_avg' => $tot_avg,
                'memo' => $row->ResearchExamination_Note1,


                'del' => ($row->ResearchExamination_Type == 'Y') ? 'N' : 'Y',
                'created_at' => $row->ResearchExamination_Wdate,
                'updated_at' => null,
//                'updated_at' => $row->ResearchExamination_Edate,
            ]);
        }

        $this->activationDBConnection();
        $this->transaction();

        try {
            $totContest = number_format(count($new_items));
            var_dump("INSERT ResearchResult START: {$totContest} 개 데이터 <br><br>");

            foreach ($new_items as $key => $row) {
                $reviewer = (new ResearchResult());
                $reviewer->setByData($row);
                $reviewer->created_at = $row->created_at;
                $reviewer->updated_at = $row->updated_at;
                $reviewer->save();

                $cnt = number_format($key + 1);
                var_dump("INSERT ResearchResult {$cnt} 번째 <br>");
            }

            DB::commit();
            var_dump("<br><br> INSERT ResearchResult FINISH");
        } catch (\Exception $e) {
            DB::rollback();
            dd('ERROR Reviewer', $e);
        }
    }

    private function researchTransfer()
    {
        $this->oldDBConnection();
        $items = DB::select(DB::raw("select * from KHRS_ResearchCost"));

        $new_items = [];

        foreach ($items as $key => $row) {
            array_push($new_items, (object)[
                'research_idx' => $row->ResearchCost_Idx,
                'user_sid' => $row->ResearchCost_MemberIDX,
                'runtype' => $row->ResearchCost_RunType,

                'subject' => $row->ResearchCost_Title,
                'name' => $row->ResearchCost_Name,
                'date_type' => 'D',
                'year' => '2024',
                'category' => null,
                'gubun' => null,

                'sdate' => $row->ResearchCost_RunDate1,
                'edate' => $row->ResearchCost_RunDate2,
                'tot_price' => $row->ResearchCost_Fee,
                'content' => $row->ResearchCost_Note,

                'file_name1' => $row->ResearchCost_File1,
                'file_path1' => empty($row->ResearchCost_File1) ? null : ('/storage/uploads/research/' . $row->ResearchCost_File1),
                'file_name2' => $row->ResearchCost_File2,
                'file_path2' => empty($row->ResearchCost_File2) ? null : ('/storage/uploads/research/' . $row->ResearchCost_File2),
                'file_name3' => $row->ResearchCost_File3,
                'file_path3' => empty($row->ResearchCost_File3) ? null : ('/storage/uploads/research/' . $row->ResearchCost_File3),
                'file_name4' => $row->ResearchCost_File4,
                'file_path4' => empty($row->ResearchCost_File4) ? null : ('/storage/uploads/research/' . $row->ResearchCost_File4),
                'file_name5' => $row->ResearchCost_File5,
                'file_path5' => empty($row->ResearchCost_File5) ? null : ('/storage/uploads/research/' . $row->ResearchCost_File5),
                'file_name6' => $row->ResearchCost_File6,
                'file_path6' => empty($row->ResearchCost_File6) ? null : ('/storage/uploads/research/' . $row->ResearchCost_File6),
                'file_name7' => $row->ResearchCost_File7,
                'file_path7' => empty($row->ResearchCost_File7) ? null : ('/storage/uploads/research/' . $row->ResearchCost_File7),

                'del' => ($row->ResearchCost_Type == 'Y') ? 'N' : 'Y',
                'created_at' => $row->ResearchCost_Wdate,
                'updated_at' => null,
//                'updated_at' => $row->ResearchExamination_Edate,
            ]);
        }

        $this->activationDBConnection();
        $this->transaction();

        try {
            $totContest = number_format(count($new_items));
            var_dump("INSERT ResearchResult START: {$totContest} 개 데이터 <br><br>");

            foreach ($new_items as $key => $row) {

                $research_chk = Research::where(['research_idx'=>$row->research_idx])->first();
                if($research_chk) continue;

                $research = (new Research());
                $research->setByData($row);
                $research->created_at = $row->created_at;
                $research->updated_at = $row->updated_at;
                $research->save();

                $cnt = number_format($key + 1);
                var_dump("INSERT ResearchResult {$cnt} 번째 <br>");
            }

            DB::commit();
            var_dump("<br><br> INSERT ResearchResult FINISH");
        } catch (\Exception $e) {
            DB::rollback();
            dd('ERROR Reviewer', $e);
        }
    }

    private function feeTransfer()
    {
        $this->oldDBConnection();
        $items = DB::select(DB::raw("select * from KHRS_RegularMemberPayInfo"));

        $new_items = [];

        foreach ($items as $key => $row) {

            array_push($new_items, (object)[
                'fee_idx' => $row->Regular_idx,
//                'user_sid' => $row->Regular_Members_idx,
                'year' => substr($row->Regular_StateDate,0,4),
                'uid' => $row->Regular_Email,
                'category' => 'A',
                'detail' => 'A',
                'pay_status' => 'C',

                'price' => $row->Regular_amount ?? 0,
                'pay_date' => $row->Regular_StateDate,

                'del' => ($row->Regular_Note == 'Y') ? 'N' : 'Y',
                'created_at' => $row->Regular_Wdate,
                'updated_at' => null,
//                'updated_at' => $row->ResearchExamination_Edate,
            ]);
        }

        $this->activationDBConnection();
        $this->transaction();

        try {
            $totContest = number_format(count($new_items));
            var_dump("INSERT Fee START: {$totContest} 개 데이터 <br><br>");

            foreach ($new_items as $key => $row) {

                $reviewer = (new Fee());
                $reviewer->setByData($row);

                if(!empty($row->uid)) {
                    $user = DB::select(DB::raw("select * from user_binfo where uid LIKE '%".$row->uid."%'"));
                    if (!empty($user[0]->sid)) {
                        $user = $user[0];
                    }
                }
                $reviewer->user_sid = $user->sid ?? 0;

                $reviewer->created_at = $row->created_at;
                $reviewer->updated_at = $row->updated_at;
                $reviewer->save();

                $cnt = number_format($key + 1);
                var_dump("INSERT Fee {$cnt} 번째 <br>");
            }

            DB::commit();
            var_dump("<br><br> INSERT Fee FINISH");
        } catch (\Exception $e) {
            DB::rollback();
            dd('ERROR Reviewer', $e);
        }
    }

//    private function conferenceTransfer()
//    {
//        $this->oldDBConnection();
//        $items = DB::select(DB::raw("select * from KHRS_RegSetupSystem"));
//
//        $new_items = [];
//
//        foreach ($items as $key => $row) {
//
//            $res_fee_arr = array();
//            if($row->RegSet_Pay_PriceTypeA && $row->RegSet_Pay_PriceA){
//                $res_fee_arr[]= [
//                    'gubun'=>$row->RegSet_Pay_PriceTypeA,
//                    'early'=>$row->RegSet_Pay_PriceA,
//                    'onsite'=>$row->RegSet_Pay_PriceA,
//                ];
//            }
//            if($row->RegSet_Pay_PriceTypeB && $row->RegSet_Pay_PriceB){
//                $res_fee_arr[]= [
//                    'gubun'=>$row->RegSet_Pay_PriceTypeB,
//                    'early'=>$row->RegSet_Pay_PriceB,
//                    'onsite'=>$row->RegSet_Pay_PriceB,
//                ];
//            }
//            if($row->RegSet_Pay_PriceTypeC && $row->RegSet_Pay_PriceC){
//                $res_fee_arr[]= [
//                    'gubun'=>$row->RegSet_Pay_PriceTypeC,
//                    'early'=>$row->RegSet_Pay_PriceC,
//                    'onsite'=>$row->RegSet_Pay_PriceC,
//                ];
//            }
//            if($row->RegSet_Pay_PriceTypeD && $row->RegSet_Pay_PriceD){
//                $res_fee_arr[]= [
//                    'gubun'=>$row->RegSet_Pay_PriceTypeD,
//                    'early'=>$row->RegSet_Pay_PriceD,
//                    'onsite'=>$row->RegSet_Pay_PriceD,
//                ];
//            }
//            if($row->RegSet_Pay_PriceTypeE && $row->RegSet_Pay_PriceE){
//                $res_fee_arr[]= [
//                    'gubun'=>$row->RegSet_Pay_PriceTypeE,
//                    'early'=>$row->RegSet_Pay_PriceE,
//                    'onsite'=>$row->RegSet_Pay_PriceE,
//                ];
//            }
//            if($row->RegSet_Pay_PriceTypeF && $row->RegSet_Pay_PriceF){
//                $res_fee_arr[]= [
//                    'gubun'=>$row->RegSet_Pay_PriceTypeF,
//                    'early'=>$row->RegSet_Pay_PriceF,
//                    'onsite'=>$row->RegSet_Pay_PriceF,
//                ];
//            }
//            if($row->RegSet_Pay_PriceTypeG && $row->RegSet_Pay_PriceG){
//                $res_fee_arr[]= [
//                    'gubun'=>$row->RegSet_Pay_PriceTypeG,
//                    'early'=>$row->RegSet_Pay_PriceG,
//                    'onsite'=>$row->RegSet_Pay_PriceG,
//                ];
//            }
//            if($row->RegSet_Pay_PriceTypeH && $row->RegSet_Pay_PriceH){
//                $res_fee_arr[]= [
//                    'gubun'=>$row->RegSet_Pay_PriceTypeH,
//                    'early'=>$row->RegSet_Pay_PriceH,
//                    'onsite'=>$row->RegSet_Pay_PriceH,
//                ];
//            }
//
//
//            array_push($new_items, (object)[
//                'conference_idx' => $row->RegSet_idx,
//                'year' => substr($row->RegSet_Wdate,0,4),
//                'subject' => $row->RegSet_Event_Name,
//                'category' => '1',
//                'code' => $row->RegSet_Event_ID,
//                'hide' => ($row->RegSet_Type == 'Y') ? 'N' : 'Y',
//
//                'regist_sdate' => $row->RegSet_STDate,
//                'regist_edate' => null,
//                'res_fee' => $res_fee_arr,
//
//                'event_date' => $row->RegSet_CompanyName,
//                'event_sdate' => null,
//                'event_edate' => null,
//
//                'contact_name' => $row->RegSet_CompanyP2,
//                'contact_email' => $row->RegSet_CompanyMail,
//
//
//                'place' => $row->RegSet_CompanyP1,
//
//                'account' => $row->RegSet_Pay_BankNum1,
//                'privacy_text' => $row->RegSet_Pay_Note,
//
//                'del' => ($row->RegSet_Type == 'Y') ? 'N' : 'Y',
//                'created_at' => $row->RegSet_Wdate,
//                'updated_at' => null,
////                'updated_at' => $row->ResearchExamination_Edate,
//            ]);
//        }
//
//        $this->activationDBConnection();
//        $this->transaction();
//
//        try {
//            $totContest = number_format(count($new_items));
//            var_dump("INSERT Conference START: {$totContest} 개 데이터 <br><br>");
//
//            foreach ($new_items as $key => $row) {
//
//                $con_chk = Conference::where(['conference_idx'=>$row->conference_idx])->first();
//                if($con_chk) continue;
//
//                $reviewer = (new Conference());
//                $reviewer->setByData($row);
//                $reviewer->created_at = $row->created_at;
//                $reviewer->updated_at = $row->updated_at;
//                $reviewer->save();
//
//                $cnt = number_format($key + 1);
//                var_dump("INSERT Conference {$cnt} 번째 <br>");
//            }
//
//            DB::commit();
//            var_dump("<br><br> INSERT Conference FINISH");
//        } catch (\Exception $e) {
//            DB::rollback();
//            dd('ERROR Reviewer', $e);
//        }
//    }

    private function conferenceModifyTransfer()
    {
        $this->oldDBConnection();
        $items = DB::select(DB::raw("select * from KHRS_RegSetupSystem"));

        $new_items = [];

        foreach ($items as $key => $row) {
            array_push($new_items, (object)[
                'conference_idx' => $row->RegSet_idx,

                'regist_sdate' => $row->RegSet_STDate,
                'regist_edate' => $row->RegSet_ENDate,
            ]);
        }

        $this->activationDBConnection();
        $this->transaction();

        try {
            $totContest = number_format(count($new_items));
            var_dump("INSERT Conference START: {$totContest} 개 데이터 <br><br>");

            foreach ($new_items as $key => $row) {

                $con_chk = Conference::where(['conference_idx'=>$row->conference_idx])->first();

                $con_chk->regist_sdate = $row->regist_sdate;
                $con_chk->regist_edate = $row->regist_edate;
                $con_chk->update();

                $cnt = number_format($key + 1);
                var_dump("INSERT Conference {$cnt} 번째 <br>");
            }

            DB::commit();
            var_dump("<br><br> INSERT Conference FINISH");
        } catch (\Exception $e) {
            DB::rollback();
            dd('ERROR Reviewer', $e);
        }
    }
    private function registrationTransfer()
    {
        $this->oldDBConnection();
        $items = DB::select(DB::raw("select * from KHRS_RegistrationSystem"));
//        $items = DB::select(DB::raw("select * from KHRS_RegistrationSystemOverseas"));

        $new_items = [];

        foreach ($items as $key => $row) {

            //직책(position)
            $pos = null;
            $pos_etc = null;
            if($row->Reg_Position_A=='Y') $pos[] = '1';
            if($row->Reg_Position_B=='Y') $pos[] = '2';
            if($row->Reg_Position_C=='Y') $pos[] = '3';
            if($row->Reg_Position_D=='Y') $pos[] = '4';
            if($row->Reg_Position_E=='Y') $pos[] = '5';
            if($row->Reg_Position_F=='Y') $pos[] = '6';
            if($row->Reg_Position_G=='Y') $pos[] = '7';
            if($row->Reg_Position_H=='Y') {
                $pos[] = '99';
                $pos_etc=$row->Reg_Position_Etc ?? '';
            }

            //phone
            $phone = array();
            if($row->Reg_Mobile2) $phone[] = $row->Reg_Mobile2;
            if($row->Reg_Mobile3) $phone[] = $row->Reg_Mobile3;
            if($row->Reg_Mobile4) $phone[] = $row->Reg_Mobile4;

            //결제구분
            $res_gubun = null;
            if($row->Reg_Pay_PriceTypeA && $row->Reg_Pay_PriceType == 'A'){
                $res_gubun = $row->Reg_Pay_PriceTypeA;
            }
            if($row->Reg_Pay_PriceTypeB && $row->Reg_Pay_PriceType == 'B'){
                $res_gubun = $row->Reg_Pay_PriceTypeB;
            }
            if($row->Reg_Pay_PriceTypeC && $row->Reg_Pay_PriceType == 'C'){
                $res_gubun = $row->Reg_Pay_PriceTypeC;
            }
            if($row->Reg_Pay_PriceTypeD && $row->Reg_Pay_PriceType == 'D'){
                $res_gubun = $row->Reg_Pay_PriceTypeD;
            }
            if($row->Reg_Pay_PriceTypeE && $row->Reg_Pay_PriceType == 'E'){
                $res_gubun = $row->Reg_Pay_PriceTypeE;
            }
            if($row->Reg_Pay_PriceTypeF && $row->Reg_Pay_PriceType == 'F'){
                $res_gubun = $row->Reg_Pay_PriceTypeF;
            }
            if($row->Reg_Pay_PriceTypeG && $row->Reg_Pay_PriceType == 'G'){
                $res_gubun = $row->Reg_Pay_PriceTypeG;
            }
            if($row->Reg_Pay_PriceTypeH && $row->Reg_Pay_PriceType == 'H'){
                $res_gubun = $row->Reg_Pay_PriceTypeH;
            }

            //결제상태
            $pay_status = null;
            switch ($row->Reg_Pay_RunType) {
                case 'Y':
                    $pay_status = 'C';
                    break;
                case 'N':
                    $pay_status = 'N';
                    break;
                case 'A':
                    $pay_status = 'F';
                    break;
                case 'B':
                    $pay_status = 'B';
                    break;
                default:
                    $pay_status = 'D';
                    break;
            }

            array_push($new_items, (object)[
                'sid' => $row->Reg_idx,
                'reg_idx' => $row->Reg_idx,
                'event_id' => $row->Reg_Event_ID,
                'user_sid' => $row->Reg_Member_Idx,
                'year' => '2024',
                'uid' => $row->Reg_Email,

                'first_name' => $row->Reg_NameF ?? null,
                'last_name' => $row->Reg_NameL ?? null,
                'name_kr' => $row->Reg_NameK ?? null,
                'sosok' => null,
                'sosok_kr' => $row->Reg_OrganisationK ?? null,
                'sosok_en' => $row->Reg_Organisation ?? null,
                'depart_kr' => $row->Reg_DepartmentK ?? null,
                'depart_en' => $row->Reg_Department ?? null,

                'position' => $pos,
                'position_etc' => $pos_etc,
                'license_number' => $row->Reg_Dcode ?? null,
                'country_name' => $row->Reg_Country ?? null,
                'phone' => $phone,

                'method' => $row->Reg_Pay_Type == 'Bank' ? 'B' : 'C',
                'gubun' => $res_gubun,
                'pay_status' => $pay_status,
                'tot_pay' => $row->Reg_Pay_TotalAmount ?? 0,
                'sender' => $row->Reg_Pay_Name ?? null,
                'sender_date' => null,
                'send_complete_date' => null,
                'agree' => 'Y',

                'del' => ($row->Reg_Type == 'Y') ? 'N' : 'Y',
                'created_at' => $row->Reg_Wdate,
                'updated_at' => null,
            ]);

        }

        $this->activationDBConnection();
        $this->transaction();

        try {
            $totContest = number_format(count($new_items));
//            var_dump("INSERT Registration START: {$totContest} 개 데이터 <br><br>");

            foreach ($new_items as $key => $row) {
//                $registration_chk = Registration::where(['reg_idx'=>$row->reg_idx])->first();
//                if($registration_chk) continue;

                $registration_chk = Registration::where(['reg_idx'=>$row->reg_idx])->first();
                if(!empty($row->event_id)) {
                    $csid = DB::select(DB::raw("select sid from conference where code like '%" . $row->event_id . "%' "));
                    if (!empty($csid[0]->sid)) {
                        $csid = $csid[0];
                    }
                }
                $registration_chk->update();

//                $new_item = (new Registration());
//                $new_item->setByData($row);
//
//                if(!empty($row->event_id)) {
//                    $csid = DB::select(DB::raw("select sid from conference where code like '%" . $row->event_id . "%' "));
//                    if (!empty($csid[0]->sid)) {
//                        $csid = $csid[0];
//                    }
//                }
//                $new_item->csid = $csid->sid ?? 0;
//
//                $new_item->country = 1;
//                if(!empty($row->country_name)) {
//                    $country = DB::select(DB::raw("select ci from country where cn like '%" . $row->country_name . "%' "));
//                    if (!empty($country[0]->cid)) {
//                        $country = $country[0];
//                    }
//                }
//                $new_item->country = $country->ci ?? 1;
//
//                $new_item->created_at = $row->created_at;
//                $new_item->updated_at = $row->updated_at;
//                $new_item->save();

                $cnt = number_format($key + 1);
//                var_dump("INSERT Registration {$cnt} 번째 <br>");
            }

            DB::commit();
//            var_dump("<br><br> INSERT Registration FINISH");
        } catch (\Exception $e) {
            DB::rollback();
            dd('ERROR Reviewer', $e);
        }
    }

    private function OverseasConferenceTransfer()
    {
        $this->oldDBConnection();
        $items = DB::select(DB::raw("select * from KHRS_OverseasSupportSetup"));

        $new_items = [];

        foreach ($items as $key => $row) {

            array_push($new_items, (object)[
                'sid' => $row->OSSet_Idx,
                'osc_idx' => $row->OSSet_Idx,
                'event_code' => $row->OSSet_ID,
                'year' => substr($row->OSSet_Dateheld,0,4),
                'subject' => $row->OSSet_Title,

                'limit_person' => null,
                'place' => $row->OSSet_Country ?? null.''.$row->OSSet_City ?? null,
                'event_sdate' => substr($row->OSSet_Dateheld,0,10) ?? null,
                'event_edate' => null,

                'regist_sdate' => $row->OSSet_OpenStartDate ?? null,
                'regist_edate' => $row->OSSet_OpenStopDate ?? null,
                'result_sdate' => null,
                'result_edate' => null,
                'memo' => $row->OSSet_Note1 ?? null,

                'del' => ($row->OSSet_Type == 'Y') ? 'N' : 'Y',
                'created_at' => $row->OSSet_Wdate,
                'updated_at' => $row->OSSet_Edate,
            ]);
        }

        $this->activationDBConnection();
        $this->transaction();

        try {
            $totContest = number_format(count($new_items));
            var_dump("INSERT OverseasConference START: {$totContest} 개 데이터 <br><br>");

            foreach ($new_items as $key => $row) {
                $new_item = (new OverseasConference());
                $new_item->setByData($row);

                //국가
                if(!empty($row->country_name)) {
                    $new_item->country = DB::select(DB::raw("select ci from country where cn like '%" . $row->country_name . "%' "));
                    if (!empty($country[0]->cid)) {
                        $country = $country[0];
                    }
                }

                $new_item->created_at = $row->created_at;
                $new_item->updated_at = $row->updated_at;
                $new_item->save();

                $cnt = number_format($key + 1);
//                var_dump("INSERT OverseasConference {$cnt} 번째 <br>");
            }

            DB::commit();
            var_dump("INSERT OverseasConference {$cnt} 번째 <br>");
//            var_dump("<br><br> INSERT OverseasConference FINISH");
        } catch (\Exception $e) {
            DB::rollback();
            dd('ERROR Reviewer', $e);
        }
    }
    private function overseasRegistrationTransfer()
    {
        $this->oldDBConnection();
        $items = DB::select(DB::raw("select * from KHRS_OverseasSupportRegData"));

        $new_items = [];

        foreach ($items as $key => $row) {

            //자격(qualification)
            $qualification = null;
            if($row->OSupport_InputData1=='Y') $qualification[] = '1';
            if($row->OSupport_InputData2=='Y') $qualification[] = '2';
            //최우선순위
            $top = null;
            if($row->OSupport_InputData14=='Y') $top[] = '1';
            //저자정보
            $author = null;
            if($row->OSupport_InputData14=='제1저자') $author[] = '1';
            if($row->OSupport_InputData14=='교신저자') $author[] = '2';

            //1순위
            $first = null;
            switch ($row->OSupport_InputData3) {
                case 'B':
                    $first = '2';
                    break;
                case 'C':
                    $first = '3';
                    break;
                case 'N':
                    $first = '4';
                    break;
                default:
                    $first = '99';
                    break;
            }
            //2순위
            $second = '99';
            if($row->OSupport_InputData7 == 'Y') $second = '1';
            //3순위
            $third = '99';
            if($row->OSupport_InputData8 == 'Y') $third = '1';
            //최근 3년간 대한부정맥학회 정기학술대회(KHRS) 등록여부
            $registration_status = null;
            if($row->OSupport_InputData10 == 'Y'){
                $registration_status[] = '1';
            }
            if($row->OSupport_InputData9 == 'Y'){
                $registration_status[] = '2';
            }
            if($row->OSupport_InputData11 == 'Y'){
                $registration_status[] = '3';
            }
            if($row->OSupport_InputData18 == 'Y'){
                $registration_status[] = '4';
            }
            if($row->OSupport_InputData12 == 'Y'){
                $registration_status[] = '99';
            }

            //참가자격
            $participant = null;
            switch ($row->OSupport_EligibilityType) {
                case 'B':
                    $participant = '2';
                    break;
                case 'C':
                    $participant = '3';
                    break;
                case 'D':
                    $participant = '4';
                    break;
                case 'E':
                    $participant = '5';
                    break;
                case 'F':
                    $participant = '6';
                    break;
                default:
                    $participant = '1';
                    break;
            }

            //심사결과
            $result = null;
            switch ($row->OSupport_AdminProcess1) {
                case 'B':
                    $result = 'I';
                    break;
                case 'C':
                    $result = 'S';
                    break;
                case 'D':
                    $result = 'D';
                    break;
                default:
                    $result = 'U';
                    break;
            }

            //지원협회
            $assistant = null;
            switch ($row->OSupport_AdminProcess3) {
                case '의료기기협회':
                    $assistant = '2';
                    break;
                case '한국제약바이오협회':
                    $assistant = '3';
                    break;
                default:
                    $assistant = '1';
                    break;
            }


            array_push($new_items, (object)[
                'sid' => $row->OSupport_Idx,
                'os_idx' => $row->OSupport_Idx,
                'csid' => $row->Osupport_OsupportSetIdx,
                'event_id' => $row->Osupport_OsupportSetID,
                'user_sid' => $row->OSupport_MemberIDX,
//                'uid' => $row->Reg_Email,

                'qualification' => $qualification ?? null,
                'top' => $top ?? null,
                'title' => $row->OSupport_InputData15 ?? null,
                'author' => $author,
                'submission_date' => $row->OSupport_InputData17 ?? null,

                'first' => $first ?? null,
                'second' => $second ?? null,
                'third' => $third ?? null,
                'registration_status' => $registration_status,
                'participant' => $participant,

                'common_author' => $row->OSupport_InputData4 ?? 'N',
                'mail_date' => $row->OSupport_SelectionMailInputDate ?? null,
                'mail_title' => $row->OSupport_SelectionMailTitle ?? null,
                'mail_from' => $row->OSupport_SelectionMailSndCaller ?? null,
                'mail_to' => $row->OSupport_SelectionMailSndReceiver ?? null,
                'mail_content' => $row->OSupport_Note1 ?? null,

                'abs_title' => $row->OSupport_AbstractTitle ?? null,
                'presenter' => $row->OSupport_Author ?? null,

                'thumb_file' => $row->OSupport_File1 ?? null,
                'thumb_realfile' =>empty($row->OSupport_File1) ? null : ('/storage/uploads/overseas/' . $row->OSupport_File1),
                'bank_name' => $row->OSupport_BankName ?? null,
                'account_num' => $row->OSupport_BankNumber ?? null,
                'account_name' => $row->OSupport_AccountHolder ?? null,

                'pay1' =>  null,
                'pay2' =>  null,
                'pay3' =>  null,
                'pay4' =>  null,
                'pay5' =>  null,
                'tot_pay' =>  null,
                'assistant' =>  $assistant,
                'result' =>  $result,
                'result_request_state' =>  null,
                'pay_result' =>  null,


//                'file1' => $row->Reg_Pay_Name ?? null,
//                'realfile1' => null,
//                'file2' => $row->Reg_Pay_Name ?? null,
//                'realfile2' => null,
//                'file3' => $row->Reg_Pay_Name ?? null,
//                'realfile3' => null,
//                'file4' => $row->Reg_Pay_Name ?? null,
//                'realfile4' => null,
//                'file5' => $row->Reg_Pay_Name ?? null,
//                'realfile5' => null,
//                'file6' => $row->Reg_Pay_Name ?? null,
//                'realfile6' => null,
//                'file7' => $row->Reg_Pay_Name ?? null,
//                'realfile7' => null,
//                'file8' => $row->Reg_Pay_Name ?? null,
//                'realfile8' => null,
//                'file9' => $row->Reg_Pay_Name ?? null,
//                'realfile9' => null,
//                'file10' => $row->Reg_Pay_Name ?? null,
//                'realfile10' => null,
//
//                'pay1' => $row->Reg_Pay_Name ?? null,
//                'pay2' => $row->Reg_Pay_Name ?? null,
//                'pay3' => $row->Reg_Pay_Name ?? null,
//                'pay4' => $row->Reg_Pay_Name ?? null,
//                'pay5' => $row->Reg_Pay_Name ?? null,
//                'tot_pay' => $row->Reg_Pay_Name ?? null,

//                'assistant' => $row->Reg_Pay_Name ?? null,
//                'result' => $row->Reg_Pay_Name ?? null,
//                'result_request_state' => $row->Reg_Pay_Name ?? null,
//                'pay_result' => $row->Reg_Pay_Name ?? null,


                'del' => ($row->OSupport_Type == 'Y') ? 'N' : 'Y',
                'created_at' => $row->OSupport_Wdate,
                'updated_at' => null,
            ]);

        }

        $this->activationDBConnection();
        $this->transaction();

        try {
            $totContest = number_format(count($new_items));
//            var_dump("INSERT Registration START: {$totContest} 개 데이터 <br><br>");

            foreach ($new_items as $key => $row) {

                $over_chk = Overseas::where(['os_idx'=>$row->os_idx])->first();
                if($over_chk) continue;

                $new_item = (new Overseas());
                $new_item->setByData($row);

                $new_item->created_at = $row->created_at;
                $new_item->updated_at = $row->updated_at;
                $new_item->save();

                $cnt = number_format($key + 1);
//                var_dump("INSERT Registration {$cnt} 번째 <br>");
            }

            DB::commit();
//            var_dump("<br><br> INSERT Registration FINISH");
        } catch (\Exception $e) {
            DB::rollback();
            dd('ERROR Reviewer', $e);
        }
    }

    private function groupMemberTransfer()
    {
        $this->oldDBConnection();
        $items = DB::select(DB::raw("select * from KHRS_MicorHomeMember"));
        $new_items = [];

        foreach ($items as $key => $row) {

            $gsid = null;
            switch ($row->MHMember_HomeIdx) {
                case '1':
                    $gsid = '5';
                    break;
                case '2':
                    $gsid = '7';
                    break;
                case '3':
                    $gsid = '6';
                    break;
                case '4':
                    $gsid = '8';
                    break;
                case '5':
                    $gsid = '11';
                    break;
                case '6':
                    $gsid = '9';
                    break;
                case '7':
                    $gsid = '10';
                    break;
                default:
                    $gsid = '12';
                    break;
            }

            $glevel = null;
            switch ($row->MHMember_LV) {
                case 'A':
                    $glevel = '준회원';
                    break;
                case 'B':
                    $glevel = '정회원';
                    break;
                case 'admin':
                    $glevel = '관리자';
                    break;
                default:
                    break;
            }

            array_push($new_items, (object)[
//                'sid' => $row->MHMember_Idx,
                'group_idx' => $row->MHMember_Idx,
                'g_sid' => $gsid,
                'user_sid' => $row->MHMember_CmemberIdx ?? null,
                'uid' => $row->MHMember_CmemberID ?? null,

                'position' => $glevel ?? null,

                'del' => ($row->MHMember_Type == 'Y') ? 'N' : 'Y',
                'created_at' => $row->MHMember_Wdate,
                'updated_at' => null,
            ]);

        }

        $this->activationDBConnection();
        $this->transaction();

        try {
            $totContest = number_format(count($new_items));
//            var_dump("INSERT Registration START: {$totContest} 개 데이터 <br><br>");

            foreach ($new_items as $key => $row) {
                $new_item = (new GroupMember());
                $new_item->setByData($row);

                if(!empty($row->user_sid)) {
                    $user = DB::select(DB::raw("select * from user_binfo where sid = ".$row->user_sid));
                    if (!empty($user[0]->sid)) {
                        $user = $user[0];
                    }
                }
                $new_item->name_kr = $user->name_kr ?? null;

                $new_item->created_at = $row->created_at;
                $new_item->updated_at = $row->updated_at;
                $new_item->save();

                $cnt = number_format($key + 1);
//                var_dump("INSERT Registration {$cnt} 번째 <br>");
            }

            DB::commit();
//            var_dump("<br><br> INSERT Registration FINISH");
        } catch (\Exception $e) {
            DB::rollback();
            dd('ERROR Reviewer', $e);
        }
    }

    private function surgeryTransfer()
    {
        $this->oldDBConnection();
        $items = DB::select(DB::raw("select * from KHRS_Intervention"));
        $new_items = [];

        foreach ($items as $key => $row) {

            array_push($new_items, (object)[
                'sid' => $row->Intervention_Idx,
                'surgery_idx' => $row->Intervention_Idx,
                'user_sid' => $row->Intervention_MemberIDX ?? null,
                'uid' => $row->Intervention_MemberID ?? null,

                'name1' => $row->Intervention_RecommendationName1 ?? null,
                'file1' => $row->Intervention_RecommendationFile1 ?? null,
                'realfile1' => empty($row->Intervention_RecommendationFile1) ? null : ('/storage/uploads/surgery/' . $row->Intervention_RecommendationFile1),
                'name2' => $row->Intervention_RecommendationName2 ?? null,
                'file2' => $row->Intervention_RecommendationFile2 ?? null,
                'realfile2' => empty($row->Intervention_RecommendationFile2) ? null : ('/storage/uploads/surgery/' . $row->Intervention_RecommendationFile2),
                'file3' => $row->Intervention_Info9 ?? null,
                'realfile3' => empty($row->Intervention_Info9) ? null : ('/storage/uploads/surgery/' . $row->Intervention_Info9),

                'detail1' => $row->Intervention_Info1 ?? null,
                'detail2' => $row->Intervention_Info2 ?? null,
                'detail3' => $row->Intervention_Info3 ?? null,
                'detail4' => $row->Intervention_Info4 ?? null,
                'detail5' => $row->Intervention_Info5 ?? null,
                'etc1' => $row->Intervention_Info6 ?? null,
                'etc2' => $row->Intervention_Info7 ?? null,

                'year' => substr($row->Intervention_Wdate,0,4),
                'result' => $row->Intervention_Status == 'B' ? 'S' : 'U',
                'certi' => $row->Intervention_Status == 'B' ? 'Y' : 'N',
                'certi_date' => $row->Intervention_Info8 ?? null,
                'mregnum' => $row->Intervention_Info10 ? 'I-'.$row->Intervention_Info10 :  null,

                'del' => ($row->Intervention_Type == 'Y') ? 'N' : 'Y',
                'created_at' => $row->Intervention_Wdate,
                'updated_at' => null,
            ]);

        }

        $this->activationDBConnection();
        $this->transaction();

        try {
            $totContest = number_format(count($new_items));
//            var_dump("INSERT Registration START: {$totContest} 개 데이터 <br><br>");

            foreach ($new_items as $key => $row) {
                $new_item = (new Surgery());
                $new_item->setByData($row);

                $new_item->renewal = 'N';
                if(!empty($row->mregnum)) {
                    $new_item->renewal = 'Y';
                }


                $new_item->created_at = $row->created_at;
                $new_item->updated_at = $row->updated_at;
                $new_item->save();

                $cnt = number_format($key + 1);
//                var_dump("INSERT Registration {$cnt} 번째 <br>");
            }

            DB::commit();
//            var_dump("<br><br> INSERT Registration FINISH");
        } catch (\Exception $e) {
            DB::rollback();
            dd('ERROR Reviewer', $e);
        }
    }

    private function surgeryCareerTransfer()
    {
        $this->oldDBConnection();
        $items = DB::select(DB::raw("select * from KHRS_InterventionCareer"));
        $new_items = [];

        foreach ($items as $key => $row) {

            array_push($new_items, (object)[
                'sid' => $row->InterventionCareer_Idx,
                'user_sid' => $row->InterventionCareer_MemberIDX ?? null,

                'gubun' => $row->InterventionCareer_Type == 'A' ? 'C' : 'O',
                'sdate' => $row->InterventionCareer_DateSY1 ?? null,
                'edate' => $row->InterventionCareer_DateEY1 ?? null,
                'title' => $row->InterventionCareer_CampName ?? null,
                'content' => $row->InterventionCareer_Info1 ?? null,

                'del' => ($row->InterventionCareer_Type == 'Y') ? 'N' : 'Y',
                'created_at' => substr($row->InterventionCareer_Wdate, 0, 10),
                'updated_at' => null,
            ]);

        }

        $this->activationDBConnection();
        $this->transaction();

        try {
            $totContest = number_format(count($new_items));
//            var_dump("INSERT Registration START: {$totContest} 개 데이터 <br><br>");

            foreach ($new_items as $key => $row) {
                $new_item = (new Career());
                $new_item->setByData($row);

                $surgery = null;
                if(!empty($row->user_sid)) {
                    $surgery = DB::select(DB::raw("select sid from surgery WHERE user_sid = '" . $row->user_sid . "' AND del='N' ORDER BY sid DESC "));
                    if (!empty($surgery[0]->sid)) {
                        $surgery = $surgery[0];
                    }
                }
                $new_item->surgery_sid = $surgery->sid ?? 0;

                $new_item->created_at = $row->created_at;
                $new_item->updated_at = $row->updated_at;
                $new_item->save();

                $cnt = number_format($key + 1);
//                var_dump("INSERT Registration {$cnt} 번째 <br>");
            }

            DB::commit();
//            var_dump("<br><br> INSERT Registration FINISH");
        } catch (\Exception $e) {
            DB::rollback();
            dd('ERROR Reviewer', $e);
        }
    }

    private function surgeryCaseTransfer()
    {
        $this->oldDBConnection();
        $items = DB::select(DB::raw("select * from KHRS_InterventionCase"));
        $new_items = [];

        foreach ($items as $key => $row) {

            array_push($new_items, (object)[
                'sid' => $row->InterventionCase_Idx,
                'user_sid' => $row->InterventionCase_MemberIDX ?? null,

                'gubun' => $row->InterventionCase_Type == 'A' ? 'A' : 'B',
                'name' => $row->InterventionCase_Name ?? null,
                'age' => $row->InterventionCase_Age ?? null,
                'gender' => $row->InterventionCase_Gender == '남' ? 'M' : 'F',
                'num' => $row->InterventionCase_MorbidNum ?? null,
                'title' => $row->InterventionCase_Diagnosis ?? null,
                'content' => $row->InterventionCase_Info1 ?? null,
                'date' => $row->InterventionCase_ProcedureDate ?? null,

                'del' => ($row->InterventionCase_Type == 'Y') ? 'N' : 'Y',
                'created_at' => substr($row->InterventionCase_Wdate, 0, 10),
                'updated_at' => null,
            ]);

        }

        $this->activationDBConnection();
        $this->transaction();

        try {
            $totContest = number_format(count($new_items));
//            var_dump("INSERT Registration START: {$totContest} 개 데이터 <br><br>");

            foreach ($new_items as $key => $row) {
                $new_item = (new SurgeryCase());
                $new_item->setByData($row);

                $surgery = null;
                if(!empty($row->user_sid)) {
                    $surgery = DB::select(DB::raw("select sid from surgery WHERE user_sid = '" . $row->user_sid . "' AND del='N' ORDER BY sid DESC "));
                    if (!empty($surgery[0]->sid)) {
                        $surgery = $surgery[0];
                    }
                }
                $new_item->surgery_sid = $surgery->sid ?? 0;

                $new_item->created_at = $row->created_at;
                $new_item->updated_at = $row->updated_at;
                $new_item->save();

                $cnt = number_format($key + 1);
//                var_dump("INSERT Registration {$cnt} 번째 <br>");
            }

            DB::commit();
//            var_dump("<br><br> INSERT Registration FINISH");
        } catch (\Exception $e) {
            DB::rollback();
            dd('ERROR Reviewer', $e);
        }
    }

    private function surgeryResultTransfer()
    {
        $this->oldDBConnection();
        $items = DB::select(DB::raw("select * from KHRS_InterventionJudgeNote"));
        $new_items = [];

        foreach ($items as $key => $row) {

            array_push($new_items, (object)[
                'sid' => $row->InterventionJudgeNote_Idx,
                'user_sid' => $row->InterventionJudgeNote_MemberIDX ?? null,
                'reviewer_sid' => $row->InterventionJudgeNote_JudgeIDX ?? null,

                'state' => 'Y',
                'memo' => $row->InterventionJudgeNote_Info2 ?? null,
                'certi' => ($row->InterventionJudgeNote_Info1 == 'Y') ? 'Y' : 'N',

                'del' => ($row->InterventionJudgeNote_Type == 'Y') ? 'N' : 'Y',
                'created_at' => substr($row->InterventionJudgeNote_Wdate, 0, 10),
                'updated_at' => null,
            ]);

        }

        $this->activationDBConnection();
        $this->transaction();

        try {
            $totContest = number_format(count($new_items));
//            var_dump("INSERT Registration START: {$totContest} 개 데이터 <br><br>");

            foreach ($new_items as $key => $row) {
                $new_item = (new SurgeryResult());
                $new_item->setByData($row);

                $surgery = null;
                if(!empty($row->user_sid)) {
                    $surgery = DB::select(DB::raw("select sid from surgery WHERE user_sid = '" . $row->user_sid . "' AND del='N' ORDER BY sid DESC "));
                    if (!empty($surgery[0]->sid)) {
                        $surgery = $surgery[0];
                    }
                }
                $new_item->surgery_sid = $surgery->sid ?? 0;

                $new_item->created_at = $row->created_at;
                $new_item->updated_at = $row->updated_at;
                $new_item->save();

                $cnt = number_format($key + 1);
//                var_dump("INSERT Registration {$cnt} 번째 <br>");
            }

            DB::commit();
//            var_dump("<br><br> INSERT Registration FINISH");
        } catch (\Exception $e) {
            DB::rollback();
            dd('ERROR Reviewer', $e);
        }
    }

    private function surgeryReviewerTransfer()
    {
        $this->oldDBConnection();
        $items = DB::select(DB::raw("select * from KHRS_InterventionJudge"));
        $new_items = [];

        foreach ($items as $key => $row) {

            array_push($new_items, (object)[
                'reviewer_idx' => $row->InterventionJudge_Idx ?? null,
                'user_sid' => $row->InterventionJudge_MemberIDX ?? null,

                'use_yn' => ($row->InterventionJudge_Type == 'Y') ? 'Y' : 'N',
                'del' => ($row->InterventionJudge_Type == 'Y') ? 'N' : 'Y',
                'created_at' => substr($row->InterventionJudge_Wdate, 0, 10),
                'updated_at' => null,
            ]);

        }

        $this->activationDBConnection();
        $this->transaction();

        try {
            $totContest = number_format(count($new_items));
//            var_dump("INSERT Registration START: {$totContest} 개 데이터 <br><br>");

            foreach ($new_items as $key => $row) {
                $new_item = (new Reviewer());
                $new_item->setByData($row);

                $new_item->created_at = $row->created_at;
                $new_item->updated_at = $row->updated_at;
                $new_item->save();

                $cnt = number_format($key + 1);
//                var_dump("INSERT Registration {$cnt} 번째 <br>");
            }

            DB::commit();
//            var_dump("<br><br> INSERT Registration FINISH");
        } catch (\Exception $e) {
            DB::rollback();
            dd('ERROR Reviewer', $e);
        }
    }
    private function oldDBConnection()
    {
        DB::setDefaultConnection('sqlsrv');
        config()->set('database.connections.sqlsrv.database', env('DB_DATABASE_old') );
        \Illuminate\Support\Facades\DB::purge('sqlsrv');
    }

    private function activationDBConnection()
    {
        DB::setDefaultConnection('mysql');
        config()->set('database.connections.mysql.database', env('DB_DATABASE'));
        \Illuminate\Support\Facades\DB::purge('mysql');
    }
}
