<?php

namespace App\Exports\Research;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;

class ResearchExcel implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents, WithMapping
{
    private $userConfig;
    private $researchConfig;
    private $collection;

    public function __construct(array $data)
    {
        $this->userConfig = config('site.user');
        $this->researchConfig = config('site.research');
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
            '이름',
            '소속',
            '이메일',
            '책임연구자',

            '연구비용',
            '과제구분',
            '연구기간',
            '심사현황',
            '신청일',
        ];
    }

    public function map($data): array
    {
        $userConfig = $this->userConfig;
        $researchConfig = $this->researchConfig;

        return [
            $data->seq,
            $data->user->name_kr,
            $data->user->sosok_kr,
            $data->user->uid,
            $data->name,

            number_format($data->tot_price),
            $researchConfig['date_type'][$data->date_type],
            $data->sdate.' ~ '.$data->edate,
            $researchConfig['result'][$data->result],
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
