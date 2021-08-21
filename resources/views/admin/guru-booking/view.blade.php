@extends('layouts.admin')
@section('content')
<script>
$('select').selectpicker();
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/css/bootstrap-select.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<section class="service content-box pt-5">
    <div class="heading">
        <div class="row col-sm-12">
            <div class="col-sm-6 pull-left">
                <h2 class="pull-left">View Guru Booking</h2>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                         Session Date
                        </th>
                        <td>
                            {{ \Carbon\Carbon::parse($data->date)->format('j F, Y') }}
                        </td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td>
                            {{ @$data->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>Course Name</th>
                        <td>
                            {{@$data->course->course_name}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                           Guru
                        </th>
                        <td>
                             <a target="_blank" href="{{route('admin.guru.view',$guru->id)}}" class="btn btn-outline-primary btn-xs"> {{$guru->name}}</a>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Customer Name
                        </th>
                        <td>
                            {{$data->name}}
                        </td>
                    </tr>
                   
                    <tr>
                        <th>
                            Customer Email
                        </th>
                        <td>
                           {{$data->email}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Phone Number
                        </th>
                        <td>
                           {{$data->phone}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Customer Business Name
                        </th>
                        <td>
                           {{$data->business_name}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                        	Participants
                        </th>
                        <td>
                           {{$data->participants}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Price
                        </th>
                        <td>
                           {{$data->price}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Payment Status
                        </th>
                        <td>
                           {{ucfirst($data->payment_status)}}
                        </td>
                    </tr>
                   
                </tbody>
            </table>
            <a style="margin-top:20px;" class="btn btn-info" href="{{ url()->previous() }}">
                Back
            </a>
        </div>


    </div>

</section>
@endsection