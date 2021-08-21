@extends('layouts.admin')
@section('content')
<section class="service content-box pt-5">
    <div class="heading">
        <div class="row col-sm-12">
            <div class="col-sm-6 pull-left">
                <h2 class="pull-left">Booking Details</h2>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>Course Name</th>
                        <td>{{$data->course->course_name}}</td>
                    </tr>
                    <tr>
                        <th>Session Duaration</th>
                        <td>{{$data->course->course_time}} days</td>
                    </tr>
                    <tr>
                        <th>Session Date</th>
                        <td>{{ \Carbon\Carbon::parse($data->Date)->format('j F, Y') }}</td>
                    </tr>
                    <tr>
                        <th>Location</th>
                        <td>{{ $data->venue->location_name }}</td>
                    </tr>
                     <tr>
                        <th>Address</th>
                        <td>{{ $data->venue->address }}</td>
                    </tr>
                    <tr>
                        <th>Total Seats</th>
                        <td>{{$data->seat}}</td>
                    </tr>
                    <tr>
                        <th>Seats Booked</th>
                        <td>{{$data->seat_booked}}</td>
                    </tr>
                    <tr>
                        <th>Booking type</th>
                        <td>Public</td>
                    </tr>
                    
                </tbody>
            </table>
            <a style="margin-top:20px;" class="btn btn-info" href="{{ url()->previous() }}">
                Back
            </a>

            <a style="margin-top:20px;" class="btn btn-info" href="/candidateDetails/{{$data->id}}">
                Candidate Details
            </a>
        </div>


    </div>

</section>
@endsection