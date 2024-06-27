<?php

namespace App\Exports\Fee;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;

class FeeExcel implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents, WithMapping
{
    private $userConfig;
    private $feeConfig;
    private $collection;

    public function __construct(array $data)
    {
        $this->userConfig = config('site.user');
        $this->feeConfig = config('site.fee');
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
            '회원구분',
            '회비년도',
            '이름',
            '면허번호',

            'E-mail',
            '납부금액',
            '입금상태',
            '결제방법',
            '입금완료일',
        ];
    }

    public function map($data): array
    {
        $userConfig = $this->userConfig;
        $feeConfig = $this->feeConfig;

        return [
            $data->seq,
            $userConfig['level'][$data->user->level],
            $data->year,
            $data->user->name_kr,
            $data->user->license_number,

            $data->user->uid,
            $data->price,
            $feeConfig['pay_status'][$data->pay_status],
            $feeConfig['method'][$data->method],
            $data->pay_date,
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
