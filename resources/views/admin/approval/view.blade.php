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
             
             $users = explode(',' , $data->requests);
            @endphp
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                        Location
                        </th>
                        <td>
                            {{$venue->location_name}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                         Session Duaration
                        </th>
                        <td>
                            {{$course->course_time}} days
                        </td>
                    </tr>
                    <tr>
                        <th>
                         Session Date
                        </th>
                        <td>
                        {{ \Carbon\Carbon::parse(@$data->Date)->format('j F, Y') }}
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
                           
                       </td>

                        
                    </tr>
                      @foreach($users as $item)
                          @if(!empty($item))
                            @php 
                            $user = \App\User::where('id',$item)->first();

                            @endphp
                     <tr>
                          
                        <th>
                          {{$user->name}}
                        </th>
                       <td>
                              {{$user->email}}
                            <a href="{{route('admin.guru.view',$user->id)}}" class="btn btn-outline-primary btn-xs">View Guru Details</a>
                            <form method="post" action="{{ route('admin.confirm', $data->id) }}">
                              @csrf
                              <input type="hidden" name="type" value="public">
                              <input type="hidden" name="guru_id" value="{{$user->id}}">
                              <button type="submit" class="btn btn-outline-primary btn-xs" onclick="return confirm('Are You Sure')" >Confirm Request </button>
                            </form>
                       </td>
                           
                        </tr>
                      
                            @endif
                          @endforeach
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