@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-12 mt-5">
        <div class="card">
            <div class="card-body">
                <div class="header-title">
                    <div class="row col-sm-12">
                        <div class="col-sm-6 pull-left">
                            <h4 class="pull-left" >Location Panel</h4>
                        </div>
                        <div class=" col-sm-6 pull-right">
                            <a class="btn btn-info pull-right" href="{{route('admin.venue.create')}}">Add Location</a>
                        </div>
                    </div>
                </div>
                <div class="data-tables datatable-primary">
                    <table id="dataTable2">
                        <thead class="text-capitalize">
                            <tr>
                                <th>Sr.</th>
                                <th style="width:25%;">Location Name</th>
                                <th>Address</th>
                                <th>Vendor</th>
                                <th>Add to First Aid</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->location_name}}</td>
                                <td>{{$item->address}}</td>
                                <td>{{ucwords(str_replace("_"," ",$item->vendor))}}</td>
                                <td>
                                    @if($item->vendor != 'first_aid')
                            <input id="venue_{{$item->id}}" type="checkbox" @if($item->is_site_allow) checked @endif name="site_allow" onchange="allowLocation({{$item->id}})"></td>
                                    @endif                           
                                <td>
                                    <a href="{{url('admin/venue/edit',$item->id)}}" class="btn btn-outline-primary btn-xs">Edit</a>
                                    <a href="{{url('admin/venue/view',$item->id)}}" class="btn btn-outline-primary btn-xs">View</a>
                                    <a href="{{url('admin/venue/delete',$item->id)}}" class="btn btn-outline-primary btn-xs" onclick="return confirm('Are You Sure')" >Delete</a>
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
    
    function allowLocation(id) {

        $.ajax({
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                id: id
            },
            url: "{{url('admin/venue/allow-site')}}/"+id,
            success:function (response){
                console.log(response);
                alert(response.message);
            },
            error: function(error){
                console.log("error", error);
                alert(error.message);
            }
        });
    }

</script>
@endsection