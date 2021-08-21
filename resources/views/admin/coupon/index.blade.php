@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-12 mt-5">
        <div class="card">
            <div class="card-body">
                <div class="header-title">
                    <div class="row col-sm-12">
                        
                        <div class="float-right">
                            <a class="btn btn-info float-right" href="{{route('admin.insert')}}">Add New Coupon</a>
                        </div>
                    </div>
                  
                </div>
                <div class="data-tables datatable-primary">
                    <table id="dataTable22" class="table table-hove">
                        <thead class="text-capitalize">
                            <tr>
                                <th>ID#</th>
                                <th>Coupon Code</th>
                                <th>Coupon For</th>
                                <th>Start Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        @foreach($data as $item)

                            <tbody>
                            
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->coupon_code}}</td>
                                    <td>{{$item->coupon_for}}</td>
                                    <td>{{@$item->start_date}}</td>
                                    <td>
                                        <a href="{{route('admin.view',$item->id)}}" class="btn btn-outline-primary btn-xs" target=_blank>View</a>
                                    </td>
                                </tr>   
                                    
                                   
                                                    
                            </tbody>
                        @endforeach    
                        </table>
                         
                </div>
            </div>
        </div>
    </div>
</div>


@endsection