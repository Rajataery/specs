@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-12 mt-5">
        <div class="card">
            <div class="card-body">
                <div class="header-title">
                    <div class="row col-sm-12">
                        <div class="col-sm-6 pull-left">
                            <h4 class="pull-left" >Certificates</h4>
                        </div>
                        <div class=" col-sm-6 pull-right">
                            <a class="btn btn-info pull-right" href="{{route('admin.certificate.create')}}">Add Certificate</a>
                        </div>
                    </div>
                </div>
                <div class="data-tables datatable-primary">
                    <table id="dataTable2">
                        <thead class="text-capitalize">
                            <tr>
                                <th>Sr.</th>
                                <th>Name</th>
                                <th>Course</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($certificates as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->course->course_name}}</td>
                                <td>
                                <a href="{{route('admin.certificate.edit',$item->id)}}" class="btn btn-outline-primary btn-xs">Edit</a>
                                <a href="{{route('admin.certificate.view',$item->id)}}" class="btn btn-outline-primary btn-xs">View</a>
                                <a href="{{route('admin.certificate.delete',$item->id)}}" onclick="return confirm('Are You Sure')" class="btn btn-outline-primary btn-xs">Delete</a>
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