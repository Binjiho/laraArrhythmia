<?php

namespace App\Services;

use App\Models\Board;
use App\Models\Research;
use App\Models\Overseas;
use App\Models\Surgery;
use App\Models\BoardFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Class DefaultServices
 * @package App\Services
 */
class CommonServices extends AppServices
{
    private function filenameRegx(string $filename): string
    {
        // 파일명에 허용되지않는 특수문자 제거
        return preg_replace("/[ #\&\+\-%@=\/\\\:;,\'\"\^`~\_|\!\?\*$#<>()\[\]\{\}]/i", ' ', $filename);
    }

    public function fileUploadService($file, string $folder)
    {
        $directory = "uploads/" . $folder;

        $time = now()->timestamp; // 현재 타임스탬프
        $ext = $file->getClientOriginalExtension();
        $save_name = ($time . '_' . Str::random(10) . '.' . $ext);
        
        return [
            'filename' => $this->filenameRegx($file->getClientOriginalName()),
            'realfile' => '/storage/' . $file->storeAs($directory, $save_name, 'public')
        ];
    }

    public function fileDownloadService(Request $request)
    {
        $tbl = $request->tbl;
        $sid = deCryptString($request->sid);


        switch ($tbl) {
            case 'board':
                $file = Board::findOrFail($sid);
                $this->data = ['realfile' => $file->{$request->file}, 'filename' => $file->{$request->name}];
                break;

            case 'boardFile':
                $file = BoardFile::findOrFail($sid);
                $file->update(['download' => ($file->download + 1)]);
                $this->data = ['realfile' => $file->realfile, 'filename' => $file->filename];
                break;

            case 'research':
                $file = Research::findOrFail($sid);
                $this->data = ['realfile' => $file->{$request->file}, 'filename' => $file->{$request->name}];
                break;

            case 'overseas':
                $file = Overseas::findOrFail($sid);
                $this->data = ['realfile' => $file->{$request->file}, 'filename' => $file->{$request->name}];
                break;

            case 'surgery':
                $file = Surgery::findOrFail($sid);
                $this->data = ['realfile' => $file->{$request->file}, 'filename' => $file->{$request->name}];
                break;

            case 'mail_list':
                $this->data = ['realfile' => $request->file, 'filename' => $request->name];
                break;
                
            default:
                return notFoundRedirect();
        }

        /**
         * 파일 인코딩문제
         */
        if(!File::exists(public_path($this->data['realfile']))){
            $this->data['realfile'] = iconv( "UTF-8", "EUC-KR", $this->data['realfile'] );
        }

        return (File::exists(public_path($this->data['realfile'])))
            ? response()->download(public_path($this->data['realfile']), $this->data['filename'])
            : errorRedirect('back', errorMsg('nFile')); // 파일 데이터가 없을경우
    }

    public function zipDownloadService(Request $request)
    {
        $tbl = $request->tbl;
        $sid = deCryptString($request->sid);

        switch ($tbl) {
            case 'board':
                $board = Board::findOrFail($sid);
                $fileData = $board->files;
                $filename = ($board->subject . '.zip');
                break;

            default:
                return notFoundRedirect();
        }

        $filename = $this->filenameRegx($filename);

        // Zip 파일을 저장할 디렉터리 경로
        $zipDirectory = storage_path('app/zipArchive');

        // 폴더가 없을경우 생성
        if (!File::exists($zipDirectory)) {
            File::makeDirectory($zipDirectory, 0755, true);
        }

        // 압축 파일 경로
        $this->data['realfile'] = "{$zipDirectory}/{$filename}";

        // ZipArchive 인스턴스 생성
        $zip = new \ZipArchive();

        // zip 아카이브 생성 여부 확인
        if ($zip->open($this->data['realfile'], \ZipArchive::CREATE) !== true) {
            return serverRedirect();
        }

        // addFile ( 파일이 존재하는 경로, 저장될 이름 )
        foreach ($fileData ?? [] as $row) {
            $path = public_path($row->realfile);

            if (File::exists($path)) {
                if (!is_null($row->download)) { // 파일다운로드 카운트 필드가 있다면 update
                    $row->update(['download' => ($row->download + 1)]);
                }

                // 파일 추가
                $zip->addFile($path, $row->filename);
            }
        }

        $zip->close();

        return (File::exists($this->data['realfile']))
            ? response()->download($this->data['realfile'], $filename)->deleteFileAfterSend(true)
            : errorRedirect('back', errorMsg('nFile')); // 파일 데이터가 없을경우
    }

    public function fileDeleteService(string $realfile)
    {
        if (File::exists(public_path($realfile))) {
            File::delete(public_path($realfile));
        }
    }

    public function excelDownload($object, $filename)
    {
        return Excel::download($object, "{$filename}.xlsx");
    }

    public function staticDownloadService(Request $request)
    {
        return (File::exists(public_path($request->file_path)))
            ? response()->download(public_path($request->file_path), $request->file_name)
            : errorRedirect('back', errorMsg('nFile')); // 파일 데이터가 없을경우
    }

    public function check_captcha(Request $request)
    {
        if($request->captcha_input === session('str')){
            $this->setJsonData('log', 'suc');

            $this->setJsonData('data', [
                $this->ajaxActionData('#captcha_input', 'chk', 'Y'),
                'log' => 'suc',
            ]);

            return $this->returnJson();
        }

//        $this->setJsonData('log', 'fail');

        $this->setJsonData('data', [
            $this->ajaxActionData('#captcha_input', 'chk', 'N'),
            'log' => 'fail',
        ]);

        return $this->returnJson();
    }

    public function refresh_captcha()
    {
        //이미지 크기
        $img = imagecreate(115,40);

        //캡챠 폰트 크기
        $size = 25;
        //캡챠 폰트 기울기
        $angle = 0;
        //캡챠 폰트 x,y위치
        $x = 10;
        $y = 30;
        //이미지의 바탕화면은 흰색
        $background = imagefill($img,0,0,imagecolorallocatealpha($img,255, 255, 255, 100));
        //폰트 색상
        $text_color = imagecolorallocate($img, 233, 14, 91);
        //폰트 위치
        $font = public_path('assets/css/fonts/Roboto-Black.ttf');
        //캡챠 텍스트
        $str = substr(md5(rand(1,10000)),0,5);
        // 생성된 캡챠 문자열을 세션에 저장
        session()->put('str', $str);

        //글자를 이미지로 만들기
        imagettftext($img,$size,$angle,$x,$y,$text_color,$font,$str);

        Header("Content-type: image/jpeg");
        imagejpeg($img,null,100);
        imagedestroy($img);
    }
}
