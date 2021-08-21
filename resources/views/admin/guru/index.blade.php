@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-12 mt-5">
        <div class="card">
            <div class="card-body">
                <div class="header-title">
                    <div class="row col-sm-12">
                        <div class=" pull-left">
                            <!-- <h4 class="pull-left" >Bookings</h4> -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link @if(!isset($type)) active @endif" href="dates"  role="tab">Upcoming</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link @if(isset($type))  @endif" href="#" role="tab">Past</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link @if(!isset($type))  @endif" href="#"  role="tab">Available</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link @if(isset($type))  @endif" href="#" role="tab">Pending requested</a>
                                </li>
                            </ul>
                        </div>
                        
                    </div>
                </div>
                <div class="data-tables datatable-primary">
                    <table id="dataTable2" >
                        <thead class="text-capitalize">
                            <tr>
                                <th>Sr.</th>
                                <th>Venue Place</th>
                                <th>Session Dueration</th>
                                <th>Session Date</th>
                                <th>Session Start Time</th>
                                <th>Session Course</th>
                            
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                        @foreach($data as $item)
                        @php
                            
                            
                            @$course = \App\Course::Where('id', $item->course_id)->first();
                            
                            $venue = \App\Venue::Where('id', $item->venue_id)->first();
                            $guru = \App\User::Where('id', $item->guru_id)->first();
                        @endphp
                            <tr>
                             <td>{{$loop->iteration}}</td>
                             <td>{{$venue->location_name}}</td>
                             <td>{{@$course->course_time}}</td>
                             <td>{{$item->Date}}</td>
                             <td>{{$item->time}}</td>
                             <td>{{@$course->course_name}}</td>
                           
                                <td>
                               
                                <a href="{{url('admin/dates/view',$item->id)}}" class="btn btn-outline-primary btn-xs">View</a>
                               
                                </td>
                                
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection