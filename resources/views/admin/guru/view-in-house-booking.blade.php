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
                        <td>{{ \Carbon\Carbon::parse($data->date)->format('j F, Y') }}</td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td>{{ $data->address }}</td>
                    </tr>
                    <tr>
                        <th>Participants</th>
                        <td>{{$data->participants}}</td>
                    </tr>
                    <tr>
                        <th>User Name</th>
                        <td>{{$data->name}}</td>
                    </tr>
                    <tr>
                        <th>User Email</th>
                        <td>{{$data->email}}</td>
                    </tr>
                    <tr>
                        <th>User Phone</th>
                        <td>{{$data->phone}}</td>
                    </tr>
                    <tr>
                        <th>Booking type</th>
                        <td>{{ucfirst($data->type)}}</td>
                    </tr>
                    
                </tbody>
            </table>
            <a style="margin-top:20px;" class="btn btn-info" href="{{ url()->previous() }}">
                Back
            </a>
            <a style="margin-top:20px;" class="btn btn-info" href="/candidateDetailsInhouse/{{$data->id}}">
                Candidate Details
            </a>
        </div>


    </div>

</section>
@endsection