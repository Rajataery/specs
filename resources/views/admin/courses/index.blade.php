@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-12 mt-5">
        <div class="card">
            <div class="card-body">
                <div class="header-title">
                    <div class="row col-sm-12">
                        <div class="col-sm-6 pull-left">
                            <h4 class="pull-left" >Course Panel</h4>
                        </div>
                        <div class=" col-sm-6 pull-right">
                            <a class="btn btn-info pull-right" href="{{route('admin.courses.create')}}">Add Course</a>
                        </div>
                    </div>
                </div>
                <div class="data-tables datatable-primary">
                    <table id="dataTable2">
                        <thead class="text-capitalize">
                            <tr>
                                <th>Sr.</th>
                                <th>Name</th>
                                <th>Title</th>
                                <th>Course Time</th>
                                <th>Active/Inactive</th>
                                <th>Feature</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->course_name}}</td>
                                <td>{{$item->course_title}}</td>
                                <td>{{$item->course_time}} days</td>
                                <td> <input id="dates_{{$item->id}}" type="checkbox" @if($item->status) checked @endif name="status" onchange="allowStatus({{$item->id}})">

                                 <td> <input id="dates_{{$item->id}}" type="checkbox" @if($item->featured) checked @endif name="status" onchange="allowfeatured({{$item->id}})">
                                <td>
                                <a href="{{url('admin/course/edit',$item->id)}}" class="btn btn-outline-primary btn-xs">Edit</a>
                                <a href="{{url('admin/course/view',$item->id)}}" class="btn btn-outline-primary btn-xs">View</a>
                                <a href="{{url('admin/course/delete',$item->id)}}" onclick="return confirm('Are You Sure')" class="btn btn-outline-primary btn-xs">Delete</a>
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

<script type="text/javascript">
    
    function allowStatus(id) {

        $.ajax({
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                id: id
            },
            url: "{{url('admin/course_status')}}/"+id,
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


    function allowfeatured(id) {

        $.ajax({
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                id: id
            },
            url: "{{url('admin/course_feature')}}/"+id,
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


</script>
@endsection