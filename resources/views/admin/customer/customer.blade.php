@extends('layouts.admin')
@section('content')
<style>
.header-title {
  
    font-weight: 400;
}
</style>
<div class="row">
    <div class="col-12 mt-5">
        <div class="card">
            <div class="card-body">
                <div class="">
                    <div class="row col-sm-12">
                        <div class="col-sm-6 pull-left">
                            <h4 class="pull-left" >Customer Deatils
                    </div>
                </div>
                <div class="data-tables datatable-primary">
                    <table class="table" id="dataTable22">
                        <thead class="text-capitalize">
                            <tr>
                                <th>ID#</th>
                                <th>Customer Name</th>
                                <th>Customer Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $item)
                            <tr>
                                <td>{{$item->id}} </td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->email}}</td>
                                <td>
                                    <a href="{{route('admin.customer_details',$item->id)}}" class="btn btn-outline-primary btn-xs">View</a>
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