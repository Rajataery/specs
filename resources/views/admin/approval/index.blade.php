@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-12 mt-5">
        <div class="card">
            <div class="card-body">
                <div class="header-title">
                    <div class="row col-sm-12">
                        <div class="col-sm-6 pull-left">
                            <h4 class="pull-left" >Guru Booking Requests</h4>
                        </div>
                        
                    </div>
                </div>
                <div class="data-tables datatable-primary">
                    <table id="dataTable2">
                        <thead class="text-capitalize">
                            <tr>
                                <th>Booking Type</th>
                                <th>Address</th>
                                <th>Session Date</th>
                                <th>Session Course</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                        @foreach($data as $item)
                           @if($item->requests) 
                                @php
                                    @$course = \App\Course::Where('id', $item->course_id)->first();
                                    $venue = \App\Venue::Where('id', $item->venue_id)->first();
                                    $guru = \App\User::Where('id', $item->guru_id)->first();
                                @endphp
                                <tr>
                                 <td>Public</td>
                                 <td>{{$venue->location_name}}</td>
                                 <td>{{ \Carbon\Carbon::parse(@$item->Date)->format('j F, Y') }}</td>
                                 <!-- <td>{{$item->time}}</td> -->
                                 <td>{{@$course->course_name}}</td>
                               
                                    <td>
                                    <a href="{{url('admin/request/view/'.$item->id.'/public')}}" class="btn btn-outline-primary btn-xs">View</a>
                                  
                                    </td>
                                    
                                </tr>
                            @endif
                        @endforeach

                        @foreach($inhouse_booking as $item)
                             @if($item->requests) 
                                <tr>
                                 <td>In House</td>
                                 <td>{{$item->address}}</td>
                                 <td>{{ \Carbon\Carbon::parse(@$item->date)->format('j F, Y') }}</td>
                                 <!-- <td>{{$item->time}}</td> -->
                                 <td>{{@$item->course->course_name}}</td>
                               
                                    <td>
                                    <a href="{{url('admin/request/view/'.$item->id.'/in_house')}}" class="btn btn-outline-primary btn-xs">View</a>
                                  
                                    </td>
                                    
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection