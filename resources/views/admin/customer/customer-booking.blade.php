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
                            <h4 class="pull-left" >Booking Panel</h4>
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
                                <td>{{$item->id}}  @if($item->notification_status == 1) 
                                      <span>new</span> @endif</td>
                                <td>{{ \Carbon\Carbon::parse(@$item->getDate->Date)->format('j F, Y') }}</td>

                               @if($item->type == 'public')
                                <td>{{ ucwords(str_replace("_"," ",@$item->getDate->course_vendor)) }} </td>
                               @else
                               <td>First Aid At Work </td>
                               @endif

                                <td>{{$item->name}}</td>
                                <td>{{$item->email}}</td>
                                @if($item->type == 'public')
                                <td>{{@$item->getDate->course->course_name}}</td>
                                @else
                                <td>{{@$item->course->course_name}} </td>
                                @endif
                                 @if($item->type == 'public')
                                <td>{{@$item->getDate->venue->location_name }}</td>
                                @else
                               <td>{{$item->address}}</td>
                               @endif

                                <td>
                                @if($item->type == 'public')
                                    <a href="{{url('admin/publicBooking/view',$item->id)}}" class="btn btn-outline-primary btn-xs">View</a>
                                 @elseif($item->type == 'in_house')
                                    <a href="{{route('admin.inHouseBookingView',$item->id)}}" class="btn btn-outline-primary btn-xs">View</a>
                                @else
                                <a href="{{route('admin.guruBookingView',$item->id)}}" class="btn btn-outline-primary btn-xs">View</a>
                                @endif
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