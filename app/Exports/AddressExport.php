<?php

namespace App\Exports;

use App\Models\District;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AddressExport implements FromCollection, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return District::all();
    }

    public function map($row): array
    {
        return [
            $row['id'],
            $row['name'],
        ];
    }

    public function headings(): array
    {
        return [
            'id',
            'name',
        ];
    }
}
