@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-12 mt-5">
        <div class="card">
            <div class="card-body">
                <div class="header-title">
                    <div class="row col-sm-12">
                        <div class=" pull-left">
                            @include('layouts.guru_booking_tabs')                    
                        </div>
                        
                    </div>
                </div>
                <div class="data-tables datatable-primary">
                    <table id="dataTable2" >
                        <thead class="text-capitalize">
                            <tr>
                                <th>Booking Type</th>
                                <th>Address</th>
                                <th>Session Course</th>
                                <th>Duaration</th>
                                <th>You Will Earn</th>
                                <th>Session Date</th>
                                
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                        @forelse($dates as $booking )
                            @php
                                @$date_course = \App\Course::Where('id', $booking->course_id)->first();
                                @$date_venue = \App\Venue::Where('id', $booking->venue_id)->first();
                                $requests = explode(',', $booking->requests);
                            @endphp
                           @if(! in_array(auth()->id(), $requests))
                                <tr>
                                 <td>Public</td>
                                 <td>{{@$date_venue->address}}</td>
                                 <td>{{@$date_course->course_name}}</td>
                                 <td>{{@$date_course->course_time }} Days</td>
                                 <td>£ {{@$booking->price_paid}}</td>
                                 <td>{{ \Carbon\Carbon::parse($booking->Date)->format('j F, Y') }}</td>
                                 
                                    <td>
                                        <a href="{{url('/assignMe/'.$booking->id.'/public')}}" class="btn btn-outline-primary btn-xs">Request</a>
                                        <a href="{{url('/dates/view/'.$booking->id.'/public')}}" class="btn btn-outline-primary btn-xs">View</a>
                                    </td>
                                </tr>
                            @endif
                        @empty
                        @endforelse

                        @forelse($bookings_inhouse as $booking )
                            @php
                                @$course = \App\Course::Where('id', $booking->course_id)->first();
                                 $requests = explode(',', $booking->requests);
                            @endphp
                            @if($booking->guru_id == Null && ! in_array(auth()->id(), $requests))
                                <tr>
                                 <td>In house</td>
                                 <td>{{@$booking->address}}</td>
                                 <td>{{@$course->course_name}}</td>
                                 <td>{{@$course->course_time }} Days</td>
                                 <td></td>
                                 <td>{{ \Carbon\Carbon::parse($booking->date)->format('j F, Y') }}</td>
                                 
                                    <td>
                                        <a href="{{url('/assignMe/'.$booking->id.'/in_house')}}" class="btn btn-outline-primary btn-xs">Request</a>
                                        <a href="{{url('/dates/view/'.$booking->id.'/in_house')}}" class="btn btn-outline-primary btn-xs">View</a>
                                    </td>
                                </tr>
                            @endif
                        @empty
                        @endforelse
                       
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection