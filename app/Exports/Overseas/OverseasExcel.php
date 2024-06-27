<?php

namespace App\Exports\Overseas;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;

class OverseasExcel implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents, WithMapping
{
    private $userConfig;
    private $overseasConfig;
    private $collection;

    public function __construct(array $data)
    {
        $this->userConfig = config('site.user');
        $this->overseasConfig = config('site.overseas');
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
            '아이디',
            '성명',
            '소속',
            '핸드폰번호',

            '참가자격',
            '공동저자여부',
            '심사상태',
            '결과보고서 제출 상태',
            '등록일',
        ];
    }

    public function map($data): array
    {
        $userConfig = $this->userConfig;
        $overseasConfig = $this->overseasConfig;
        $affi = getAffiNm();

        return [
            $data->seq,
            $data->user->uid,
            $data->user->name_kr,
            $affi[$data->user->sosok],
            $data->user->phone[0].'-'.$data->user->phone[1].'-'.$data->user->phone[2],

            $overseasConfig['participant'][$data->participant],
            $data->common_author == 'N' ? 'X':'O',
            $overseasConfig['result'][$data->result],
            $overseasConfig['result_request_state'][$data->result_request_state],
            $data->created_at->format('Y-m-d'),
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
