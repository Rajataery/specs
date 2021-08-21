@extends('layouts.admin')
@section('content')
<section class="service content-box pt-5">
    <div class="heading">
        <div class="row col-sm-12">
            <div class="col-sm-6 pull-left">
                <h2 class="pull-left">Event Details</h2>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="mb-2">
            @php 
             $date_guru = \App\Providers\VenueServiceProvider::getGuru($data->guru_id);
            
            @endphp
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>Venue Location</th>
                        <td>{{@$data->venue->location_name}}</td>
                    </tr>
                    <tr>
                        <th>Event Title</th>
                        <td>{{@$data->event_title}}</td>
                    </tr>
                    <tr>
                        <th>Event Code</th>
                        <td>{{$data->event_code}}</td>
                    </tr>
                    <tr>
                        <th>Course Vendor</th>
                        <td>{{ucwords(str_replace("_"," ",$data->course_vendor))}}</td>
                    </tr>
                    <tr>
                        <th>Session Date</th>
                        <td>{{ \Carbon\Carbon::parse(@$data->Date)->format('j F, Y') }}</td>
                    </tr>
                    <tr>
                        <th>Session Start Time</th>
                        <td>{{$data->time}}</td>
                    </tr>
                    <tr>
                        <th>Course Name</th>
                        <td>{{@$data->course->course_name}}</td>
                    </tr>
                    <tr>
                        <th> Course Duration</th>
                        <td>{{@$data->course->course_time}} days</td>
                    </tr>
                    <tr>
                        <th>Assigned Guru</th>
                        <td>
                            @forelse($date_guru as $guru)
                                <a target="_blank" href="{{route('admin.guru.view',@$guru->id)}}" > {{@$guru->name}},</a>
                            @empty
                                No guru assigned
                            @endforelse
                        </td>
                    </tr>
                    <tr>
                        <th>Total Seats</th>
                        <td> {{$data->seat}}</td>
                    </tr>
                    <tr>
                        <th>Booked Seats</th>
                        <td> {{$data->seat_booked}}</td>
                    </tr>
                    <tr>
                        <th>Price</th>
                        <td>{{$data->price}}</td>
                    </tr>
                    <tr>
                        <th>Guru Price</th>
                        <td>{{$data->price_paid}}</td>
                    </tr>
                    
                </tbody>
            </table>
            <a style="margin-top:20px;" class="btn btn-info" href="{{ url()->previous() }}">
                Back
            </a>

            <a style="margin-top:20px;" class="btn btn-info" href="/admin/dates/candidateDetailsPublic/{{$data->id}}">
                Candidate Details
            </a>
        </div>


    </div>

</section>
@endsection