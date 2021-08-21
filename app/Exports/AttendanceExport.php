<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use App\Attendance;
use App\Inhouse;
use App\Course;
use App\Date;

class AttendanceExport implements FromArray, WithTitle
{

    public $date_id;
 
    function __construct(int $date_id)
    {
        $this->date_id = $date_id;
        // dd($this->date_id);
    }

   

    public function array(): array
    {
        try {
          
            $bookingId = $this->date_id;
            $bookings = Inhouse::with('getAttendance','getNotes','getCertificate','getResult')
                      ->where('date_id',$this->date_id)
                      ->get();
            $date_id = Date::where('id',$bookingId)->first();
            $course_id = Course::where('id',$date_id->course_id)->first();
            // dd($course_id->course_time);
            $sheet = [];
            $header= [
                'Name',
                'Email',
                'Phone',
                'Result',
                
            ];
            for ($i=1; $i <=$course_id->course_time; $i++) { 
                array_push($header,'Attendance Day '.$i);
            }
            array_push($sheet,$header);
            foreach ($bookings as $booking) {
                $get_att = "";
                $data = [
                    $booking->name,
                    $booking->email,
                    $booking->phone,
                    $booking->getResult->result,
                ];
                foreach($booking->getAttendance as $attendance){
                    $get_att =   $attendance->attandance == 1 ? "present" : "absent";
                    array_push($data, $get_att);
                }
                array_push($sheet, $data);
            }
            return $sheet;
        } catch (\Exception $e) {
            return false;
        }
    }
    public function title(): string
    {
        return 'Attendance';
    }
    

}
