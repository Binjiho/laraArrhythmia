<?php

namespace App\Exports\Member;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;

class MemberExcel implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents, WithMapping
{
    private $userConfig;
    private $collection;

    public function __construct(array $data)
    {
        $this->userConfig = config('site.user');
        $this->collection = $data['collection'];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->collection;
    }

    public function headings(): array
    {
        return [
            'No',
            '회원등급',
            '거주국가',
            '아이디',
            '성명(영문)',

            '성명(국문)',
//            '소속',
            '소속(국문)',
            '소속(영문)',
            '의대(국문)',
            '의대(영문)',
            '부서(국문)',

            '부서(영문)',
            '직책',
            '연락처',
            '휴대폰',
            '근무지 주소',

            '근무처 구분',
            '가입 구분',
            '전공 구분',
            '출신 대학',
            '출신 대학 졸업연도',

            '최종학위',
            '최종학위 취득연도',
            '최정학위 논문 제목',
            '면허번호',
            '면허번호 취득연도',

            '전문의 1',
            '전문의 1 취득연도',
            '전문의 2',
            '전문의 2 취득연도',
            '분과 전문의',

            '분과 전문의 취득연도',
            '전공 분야',
            '진료 분야',
            '가입일',
            '수정일',

            '마지막로그인',
            '탈퇴 상태',
            '탈퇴 신청일',
            '탈퇴 완료일'            
        ];
    }

    public function map($data): array
    {
        $userConfig = $this->userConfig;

        //DB이전 하면서 없던값들이 들어옴
        $tmp_category = '';
        if($data->category == '99') {
            $tmp_category = $data->category_etc ?? '';
        }else{
            if($data->category && $data->category < 10) $tmp_category = config('site.user.category')[$data->category];
        }

        $tmp_major = '';
        if($data->major == '99') {
            $tmp_major = $data->major_etc ?? '';
        }else{
            if($data->major && $data->major < 3) $tmp_major = config('site.user.major')[$data->major];
        }

        return [
            $data->seq,
            $userConfig['level'][$data->level],
            $data->countryUser->cn,
            $data->uid,
            $data->first_name.' '.$data->last_name,

            $data->name_kr,
            $data->sosok_kr,
            $data->sosok_en,
            $data->school_kr,
            $data->school_en,
            $data->depart_kr,

            $data->depart_en,
            $data->userPosition,
            !empty($data->tel) ? implode('-',$data->tel) : '',
            !empty($data->phone) ? implode('-',$data->phone) : '',
            '['.$data->office_zipcode.'] '.$data->office_addr1.' '.$data->office_addr2,

            $data->office == '99' ? $data->office_etc : config('site.user.office')[$data->office],
            $tmp_category,
            $tmp_major,
            $data->university,
            $data->university_year,

            $data->degree,
            $data->degree_year,
            $data->degree_title,
            $data->license_number,
            $data->license_year,

            $data->major1,
            $data->major1_year,
            $data->major2,
            $data->major2_year,
            $data->speciality,

            $data->speciality_year,
            $data->major_field,
            $data->userField,
            $data->created_at->format('Y-m-d'),
            $data->updated_at ? $data->updated_at->format('Y-m-d') : '',

            $data->today_at ? $data->today_at->format('Y-m-d') : '',
            $data->del_confirm ? config('site.user.del_confirm')[$data->del_confirm] : '',
            $data->del_confirm_date ? $data->del_confirm_date->format('Y-m-d') : '',
            $data->deleted_at ? $data->deleted_at->format('Y-m-d') : '',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getDelegate()->getStyle('A1:ZZ1')->getFont()->setBold(true)->setSize(11);
            },
        ];
    }
}
