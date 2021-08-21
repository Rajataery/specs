@extends('layouts.admin')
@section('content')
<style>
.pac-container {
    background-color: #FFF;
    z-index: 20;
    position: fixed;
    display: inline-block;
    float: left;
}
.modal{
    z-index: 20;   
}
.modal-backdrop{
    z-index: 10;        
}
</style>
<div class="row">
    <div class="col-12 mt-5">
        <div class="card">
            <div class="card-body">
                <div class="header-title">
                    <div class="row col-sm-12">
                        <div class="col-sm-6 pull-left">
                            <h4 class="pull-left" >Public Booking Panel</h4>
                        </div>
                    </div>
                </div>
                <div class="data-tables datatable-primary">
                    <table class="table" id="dataTable22">
                        <thead class="text-capitalize">
                            <tr>
                                <th>ID#</th>
                                <th>Session Date</th>
                                <th>Course Vendor</th>
                                <th>Customer Name</th>
                                <th>Customer Email</th>
                                <th>Course Name</th>
                                <th>Venue Location</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $item)
                            <tr>
                                <td>{{$item->id}}
                                    @if($item->notification_status == 1) 
                                      <span>new</span> @endif
                                      <br>
                                      @if($item->approved == 1)
                                      <span style="background-color:green;">Accepted</span>
                                      @elseif($item->approved == 2)
                                       <span style="background-color:red;">Rejected</span>@endif
                                      </td>
                                <td>{{ \Carbon\Carbon::parse(@$item->getDate->Date)->format('j F, Y') }}</td>
                                <td>{{ ucwords(str_replace("_"," ",$item->getDate->course_vendor)) }} </td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->email}}</td>
                               
                                <td>{{@$item->getDate->course->course_name}}</td>
                                <td>{{@$item->getDate->venue->location_name }}</td>
                                <td>
                                <a href="{{route('admin.publicBookingView',$item->id)}}" class="btn btn-outline-primary btn-xs">View</a>
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




@endsection