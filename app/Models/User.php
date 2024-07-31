<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use App\Services\CommonServices;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $primaryKey = 'sid';
    protected $table = 'user_binfo';

    protected $guarded = [
        'sid',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
//        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
//        'email_verified_at' => 'datetime',
        'position' => 'array',
        'tel' => 'array',
        'phone' => 'array',
        'field' => 'array',
    ];

    protected $dates = [
        'confirm_date',
        'del_confirm_date',
        'password_at',
        'today_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function setByData($data)
    {
        if(empty($this->sid)) {
            $this->lang = (CheckUrl() === 'web_en' ? 'en' : 'ko');
            $this->uid = $data->uid;
            $this->password = Hash::make($data->password);
            $this->password_at = date('Y-m-d H:i:s');
        }
        // 관리자가 패스워드 변경시
        if($data->adminPassword === 'Y') {
            $this->password = Hash::make($data->password);
            $this->password_at = date('Y-m-d H:i:s');
        }
        /**
         * DB이전
         */
//        $this->sid = $data->member_id;
//        $this->member_idx = $data->member_id;
//        $this->lang = 'ko';
//        $this->uid = $data->uid;
//        $this->password = Hash::make($data->password);
//        $this->password_at = date('Y-m-d H:i:s');
//        $this->image_name = $data->image_name ?? null;
//        $this->image_path = $data->image_path ?? null;


        $this->country = $data->country ?? null;
        $this->name_kr = $data->name_kr ?? null;
        $this->first_name = $data->first_name ?? null;
        $this->last_name = $data->last_name ?? null;
        $this->phone = $data->phone ?? null;
        $this->tel = $data->tel ?? null;
        
        $this->sosok = $data->sosok ?? null;                            //병원 소속
        $this->sosok_kr = $data->sosok_kr ?? null;                      //병원 소속(국문)
        $this->sosok_en = $data->sosok_en ?? null;
        $this->school_kr = $data->school_kr ?? null;                    //의대(국문)
        $this->school_en = $data->school_en ?? null;
        $this->depart_kr = $data->depart_kr ?? null;                    //부서학과명(국문)
        $this->depart_en = $data->depart_en ?? null;

//        $this->position = jsonUnicode($data->position);
        $this->position = $data->position ?? null;                  //직책(직함)
        $this->position_etc = $data->position_etc ?? null;
        $this->city = $data->city ?? null;
        $this->office_zipcode = $data->office_zipcode?? null;          //우편번호(근무처)
        $this->office_addr1 = $data->office_addr1?? null;              //주소(근무처)
        $this->office_addr2 = $data->office_addr2?? null;              //상세주소(근무처)
        $this->office = $data->office?? null;                          //근무처 구분
        $this->office_etc = $data->office_etc ?? null;

        $this->category = $data->category ?? null;                     //가입구분
        $this->category_etc = $data->category_etc ?? null;
        $this->major = $data->major ?? null;                           //전공구분
        $this->major_etc = $data->major_etc ?? null;            //전공구분(기타)


        if($data->level) {
            $this->level = $data->level;                        //회원등급
            $this->level_etc = $data->level_etc ?? null;
        }

        $this->university = $data->university?? null;                  //출신대학
        $this->university_year = $data->university_year?? null;        //출신대학(졸업연도)
        $this->degree = $data->degree?? null;                          //최종학위
        $this->degree_year = $data->degree_year?? null;                //최종학위(졸업연도)
        $this->degree_title = $data->degree_title?? null;              //최종학위(논문제목)
        $this->license_number = $data->license_number?? null;          //면허번호
        $this->license_year = $data->license_year?? null;              //면허번호(취득연도)
        $this->major1 = $data->major1?? null;                          //전문의1
        $this->major1_year = $data->major1_year?? null;                //전문의1(취득연도)
        $this->major2 = $data->major2?? null;                          //전문의2
        $this->major2_year = $data->major2_year?? null;                //전문의2(취득연도)
        $this->speciality = $data->speciality?? null;                  //분과전문의
        $this->speciality_year = $data->speciality_year?? null;        //분과전문의(취득연도)

        $this->major_field = $data->major_field?? null;                //전공분야
        $this->field = $data->field?? null;                            //진료분야
        $this->field_etc = $data->field_etc ?? null;                   //진료분야(기타)
        $this->search_yn = $data->search_yn ?? 'N';                   //부정맥전문가찾기여부

        /* 첨부파일(단일파일) 업로드 or 삭제 */
        // 파일 업로드 경로
        $directory = config("site.user.directory");

        $file = $data->file("user_image") ?? null;

        //첨부파일 있을경우 업로드후 경로 저장
        if ($file) {
            $uploadFile = (new CommonServices())->fileUploadService($file, $directory);

            $this->image_path = $uploadFile['realfile'];
            $this->image_name = $uploadFile['filename'];
        }else{

            // 파일 삭제이면서 기존 첨부파일 있을경우 경로에 있는 실제 파일 삭제
            if ($data->file_del === 'Y' && !is_null($this->image_path)) {
                (new CommonServices())->fileDeleteService($this->image_path);

                // 첨부파일이 없다면 기존 파일경로 및 파일명 초기화
                if (is_null($file)) {
                    $this->image_path = null;
                    $this->image_name = null;
                }
                // 첨부파일 있을경우 업로드후 경로 저장
                if ($file) {
                    $uploadFile = (new CommonServices())->fileUploadService($file, $directory);
                    $this->image_path = $uploadFile['realfile'];
                    $this->image_name = $uploadFile['filename'];
                }
            }
        }
    }

    public function getUserPositionAttribute(){

        $position = $this->position;
        $position_string = "";

        foreach( $position as $key => $val ){
            if( $val == '99' ){
                $position_string .= ($key>0?', ':'').$this->position_etc;
            }else{
                $position_string .= ($key>0?', ':'').config('site.user')['position'][$val];
            }
            
        }
        return $position_string;

    }

    public function getUserFieldAttribute(){

        $field = $this->field ?? [];
        $field_string = "";

        foreach( $field as $key => $val ){
            if( $val == '99' ){
                $field_string .= ($key>0?', ':'').$this->field_etc;
            }else{
                $field_string .= ($key>0?', ':'').config('site.user')['field'][$val];
            }
            
        }
        return $field_string;

    }

    public function countryUser()
    {
        return $this->hasOne(Country::class, 'ci', 'country');
    }

    public function affiliation()
    {
        return $this->hasOne(Affiliation::class, 'sid', 'sosok');
    }

    public function fee()
    {
        return $this->hasMany(Fee::class, 'user_sid');
    }
    public function overseas()
    {
        return $this->hasMany(Overseas::class, 'user_sid');
    }

    public function regists()
    {
        return $this->hasMany(Registration::class, 'user_sid');
    }

    public function research()
    {
        return $this->hasMany(Research::class, 'user_sid');
    }

    public function reviewer()
    {
        return $this->hasMany(Reviewer::class, 'user_sid');
    }

    public function surgery($user_sid)
    {
        return Surgery::where(['user_sid'=>$user_sid, 'del'=>'N'])->first();
    }
}
