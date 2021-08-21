@extends('layouts.admin')
@section('content')

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>


<div class="row">   
    <div class="col-12 mt-5">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6 pull-left">
                        <p>
                          <button class="btn" type="button" data-toggle="collapse" data-target="#collapseFilter" aria-expanded="false" aria-controls="collapseFilter">
                            <i class="fa fa-filter"></i> Filter
                          </button>
                        </p>
                        <div class="collapse" id="collapseFilter">
                          <div class="card card-body">
                            <form method="get" action="@if($type == 'upcoming') {{route('admin.dates')}} @else {{route('admin.pastDates')}} @endif">
                                <div class="course-vendor-filter">
                                   <select class="form-control pb-filter" name="course_vendor" >
                                        <option value="">Select Vendor</option>
                                        <option value="first_aid" @if($vendor == 'first_aid') selected @endif>First Aid</option>
                                        <option value="british_red_cross" @if($vendor == 'british_red_cross') selected @endif >British Red Cross</option>
                                   </select>
                                </div><br>
                                <div class="course-vendor-filter">
                                   <input type="date" name="datefilter" class="form-control pb-filter" id="datefilter"> 
                                </div><br>
                                <div class="course-vendor-filter">
                                    <select class="form-control pb-filter" name="gurufilter" >
                                        <option value="">Select Guru</option>
                                        @foreach($guru as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                </div><br>
                                
                                <div class="course-vendor-filter">
                                    <select class="form-control pb-filter" name="locationfilter" >
                                        <option value="">Select Location</option>
                                        @foreach($venue  as $location)
                                        <option value="{{$location->id}}">{{$location->location_name}}</option>
                                        @endforeach
                                    </select>
                                
                                </div><br>
                                <div class="course-vendor-filter">
                                    <select class="form-control pb-filter" name="coursefilter" >
                                        <option value="">Select Course</option>
                                        @foreach($course as $item)
                                        <option value="{{$item->id}}">{{$item->course_name}}</option>
                                        @endforeach
                                    </select>
                                </div><br>
                                <input class="btn" type="submit" value="Filter" name="">
                            </form>
                            
                          </div>
                        </div>
                        
                    </div>
                    <div class="pull-right col-sm-6" style="float: right;">
                        <a class="btn btn-info pull-right" href="{{route('admin.dates.create')}}">Add New Event</a>
                        <br>
                        <br>
                        <div class="pb-searchList">
                        
                            <label class="pb-label">Search:
                                <input class="form-control pull-right pb-search"  type="text" placeholder="" name="search" onkeyup="search()">
                            </label>
                     
                        </div>
                    </div>
                </div>
                <div class="header-title">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link @if($type == 'upcoming') active @endif" href="{{route('admin.dates')}}"  role="tab">Upcoming Events</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if($type == 'past') active @endif" href="{{route('admin.pastDates')}}" role="tab">Past Events</a>
                        </li>
                    </ul>                
                        
                </div>

                        
                <div class="data-tables datatable-primary">
                    <table id="dataTable22" class="table table-hove">
                        <thead class="text-capitalize">
                            <tr>
                                <th>ID#</th>
                                <th>Venue Location</th>
                                <th>Vendor</th>
                                <th>Start Date</th>
                                <th>Course</th>
                                <th>Bookings</th>
                                <th>Guru</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody id="myTable">
                        @foreach($data as $item)
                        @php
                            $date_guru = \App\Providers\VenueServiceProvider::getGuru($item->guru_id);
                        @endphp
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{@$item->venue->location_name}}</td>
                                <td>{{ucwords(str_replace("_"," ",$item->course_vendor))}}</td> 
                                <td>{{ \Carbon\Carbon::parse(@$item->Date)->format('j F, Y') }}</td>
                                <td>{{@$item->course->course_name}}</td>
                                <td>{{@$item->seat_booked}}</td>
                                <td> 
                                @forelse($date_guru as $guru)
                                <a target="_blank" href="{{route('admin.guru.view',@$guru->id)}}" > {{@$guru->name}},</a>
                                @empty
                                    No guru assigned
                                @endforelse
                                </td>
                                 <td>
                                    @if($item->course_vendor != 'first_aid')
                                 <input id="dates_{{$item->id}}" type="checkbox" @if($item->status) checked @endif name="status" onchange="allowStatus({{$item->id}})">
                             </td>
                                    @endif                           
                              
                                <td>
                                    @if($type == 'upcoming')
                                        <a href="{{url('admin/dates/edit',$item->id)}}" class="btn btn-outline-primary btn-xs">Edit</a>
                                    @endif
                                    <a href="{{url('admin/dates/view',$item->id)}}" class="btn btn-outline-primary btn-xs">View</a>
                                    <a href="{{url('admin/dates/delete',$item->id)}}" class="btn btn-outline-primary btn-xs" onclick="return confirm('Are You Sure')">Delete</a>
                                </td>
                                
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $data->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    
    function allowStatus(id) {

        $.ajax({
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                id: id
            },
            url: "{{url('admin/allow-status')}}/"+id,
            success:function (response){
                console.log(response);
                alert(response.message);
            },
            error: function(error){
                
                console.log("error", error);
                alert("Event added to First Aid");
            }
        });
    }


$(document).ready(function(){
    $('#myInput').on('keyup',function(){
        var searchTerm = $(this).val().toLowerCase();
        if(searchTerm != '' || searchTerm != null){
            localStorage.setItem('searchItem', searchTerm);
        }
        $('#myTable tr').each(function(){
            var lineStr = $(this).text().toLowerCase();
            if(lineStr.indexOf(searchTerm) === -1){
                $(this).hide();
            }else{
                $(this).show();
            }
        });
        
    });
    if(localStorage.getItem('searchItem')){
           // alert(localStorage.getItem('searchItem'));
            $('#myInput').val(localStorage.getItem('searchItem'));
            $('#myInput').trigger('keyup');

        }
});

function search() {

    $.ajax({
        type: "POST",
        data: {
                "_token": "{{ csrf_token() }}",
            },
        url: "{{url('admin/searchfilter')}}",
        success:function (response){
            
        },
        error: function(error){

        }
    });
}
$('#datefilter').datepicker({ dateFormat: 'YYYY-mm-dd' }).val();

</script>
@endsection