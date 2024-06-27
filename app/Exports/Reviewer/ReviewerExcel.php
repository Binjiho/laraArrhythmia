<?php

namespace App\Exports\Reviewer;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;

class ReviewerExcel implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents, WithMapping
{
    private $userConfig;
    private $reviewerConfig;
    private $collection;

    public function __construct(array $data)
    {
        $this->userConfig = config('site.user');
        $this->reviewerConfig = config('site.reviewer.research');
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
            '심사등급',

            '등록일',
        ];
    }

    public function map($data): array
    {
        $userConfig = $this->userConfig;
        $reviewerConfig = $this->reviewerConfig;

        return [
            $data->seq,
            $data->user->name_kr,
            $data->user->sosok_kr,
            $data->user->uid,
            $reviewerConfig['level'][$data->level],

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
