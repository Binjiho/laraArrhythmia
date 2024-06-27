<?php

namespace App\Exports\Surgery;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;

class SurgeryExcel implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents, WithMapping
{
    private $userConfig;
    private $researchConfig;
    private $collection;

    public function __construct(array $data)
    {
        $this->userConfig = config('site.user');
        $this->surgeryConfig = config('site.surgery');
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
            '구분',
            '신청코드',
            '전문의코드',
            '이메일',
            '이름',

            '소속',
            '심사현황',
            '등록일',
        ];
    }

    public function map($data): array
    {
        $userConfig = $this->userConfig;
        $surgeryConfig = $this->surgeryConfig;

        return [
            $data->seq,
            $data->renewal == 'Y' ? '갱신':'신규',
            $data->regnum ?? '',
            $data->mregnum ?? '',
            $data->user->uid ?? '',
            $data->user->name_kr ?? '',

            $data->user->sosok_kr ?? '',
            $surgeryConfig['result'][$data->result],
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
