@extends('layouts.admin')
@section('content')
<section class="service content-box pt-5">
    <div class="heading">
        <div class="row col-sm-12">
            <div class="col-sm-6 pull-left">
                <h2 class="pull-left">Venue Details</h2>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="mb-2">
            @php 
             $venue = \App\Venue::where('id',$data->venue_id)->first();
             $course = \App\Course::where('id',$data->course_id)->first();
             $user = \App\User::where('id',$data->guru_id)->first();

            
            @endphp
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                         Venue Place
                        </th>
                        <td>
                            {{$venue->location_name}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                         Session Dueration
                        </th>
                        <td>
                            {{$course->course_time}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                         Session Date
                        </th>
                        <td>
                            {{$data->Date}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                         Session Start Time
                        </th>
                        <td>
                            {{$data->time}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                         Course
                        </th>
                        <td>
                            {{$course->course_name}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                         Guru Details
                        </th>
                        <td>
                            {{$user->name}}
                            <br>
                            {{$user->email}}
                        </td>

                        
                    </tr>
                    <tr>
                        <th>
                         Total Seats
                        </th>
                        <td>
                          
                            {{$data->seat}}
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
                    
                </tbody>
            </table>
            <a style="margin-top:20px;" class="btn btn-info" href="{{ url()->previous() }}">
                Back
            </a>
        </div>


    </div>

</section>
@endsection