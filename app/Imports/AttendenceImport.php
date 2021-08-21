<?php

namespace App\Imports;

use App\Inhouse;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class AttendenceImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        $booking = new Inhouse;
        dd($booking);
    }
}
