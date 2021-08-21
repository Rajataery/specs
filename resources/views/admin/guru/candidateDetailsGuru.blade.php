@extends('layouts.admin')
@section('content')
<section class="service content-box pt-5">
    <div class="heading">
        <div class="row col-sm-12">
            <div class="col-sm-6 pull-left">
                <h2 class="pull-left">Candidate Details</h2>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="data-tables datatable-primary">
            <div class="mb-2">
                <table class="dataTable no-footer dtr-inline" role="grid" aria-describedby="dataTable2_info" style="width: 1156px;">
                    <thead class="text-capitalize ">
                        <tr>
                            <th> Id </th>
                            <th> Name </th>
                            <th> Email </th>
                            <th> Phone </th>
                            @for($i=1; $i<=$course_time; $i++)
                            <th> Attendance Day {{$i}} </th>
                            @endfor
                        </tr>
                    </thead>

                    <tbody >
                        @php
                            $booking_id = array();
                        @endphp
                        
                
                        <tr>
                            <td>{{$guru_bookings->id}}</td>
                            <td>{{$guru_bookings->name}}</td>
                            <td>{{$guru_bookings->email}}</td>
                            <td>{{$guru_bookings->phone}}</td>
                            @for($i=1; $i<=$course_time; $i++)
                            <td>
                                <form method="post" action="{{route('date.attendanceInhouse')}}">
                                <input type="hidden" id="status_1_" name="attendence[{{$guru_bookings->id}}][{{$i}}]" value="0">
                                <input type="checkbox" name="attendence[{{$guru_bookings->id}}][{{$i}}]" data-dayindex="{{$i}}" id="{{$guru_bookings->id}}" class="attendenceID" value="1" @foreach($guru_bookings->getAttendance as $atten)  
                                @if($atten->day == $i && $atten->attandance == 1) checked @endif  @endforeach>
                                @csrf
                            </td>
                            @endfor
                        </tr>
                           
                    </tbody>  
                
                </table>
                @php  $booking_id = request()->segment(2);  @endphp  
                <Input type="hidden" name="booking_id" value="{{$booking_id}}">
                
                
            <input type="submit" name="submit" value="Save Attendance" class="btn">
                 </form>
            </div>
            </div>

    </div>

</section>

@endsection