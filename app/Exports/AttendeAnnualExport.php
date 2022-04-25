<?php

namespace App\Exports;

use App\Exports\Sheets\Annual\HonorerAttendeSheet;
use App\Exports\Sheets\Annual\PnsAttendeSheet;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class AttendeAnnualExport implements FromCollection, WithMultipleSheets
{
    private $date;
    private $type;
    private $users;

    public function __construct($date, $users, $type)
    {
        $this->date = $date;
        $this->type = $type;
        $this->users = $users;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        //
    }

    public function sheets(): array
    {
        $sheets = [];
        for ($i = 1; $i <= 12; $i++) {
            $sheets[] = new PnsAttendeSheet($this->users, $i, $this->date);
        }
        return $sheets;
    }
}
