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
                            <h4 class="pull-left" >Guru Booking Panel</h4>
                        </div>
                    </div>
                </div>
                <div class="data-tables datatable-primary">
                    <table class="table" id="dataTable22">
                        <thead class="text-capitalize">
                            <tr>
                                <th>ID#</th>
                                <th>Session Date</th>
                                <th>Customer Name</th>
                                <th>Guru</th>
                                <th>Course Name</th>
                                <th>Location</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $item)
                            <tr>
                                <td>{{$item->id}} 
                                    @if($item->notification_status == 1) 
                                      <span>new</span> @endif
                                </td>
                                <td>{{ \Carbon\Carbon::parse($item->date)->format('j F, Y') }}</td>
                                <td>{{$item->name}}</td>
                                <td>                                    
                                    @php
                                        @$guru = \App\User::where('id',$item->guru_id)->first();
                                    @endphp
                                    {{ @$guru->name }} 
                                </td>
                               
                                <td>{{@$item->course->course_name}}</td>
                                <td>{{ @$item->address }}</td>
                                <td>
                                <a href="{{route('admin.guruBookingView',$item->id)}}" class="btn btn-outline-primary btn-xs">View</a>
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