@extends('layouts.admin')
@section('content')
<section class="service content-box pt-5">
    <div class="heading">
        <div class="row col-sm-12">
            <div class="col-sm-6 pull-left">
                <h2 class="pull-left">View Location </h2>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                         Name
                        </th>
                        <td>
                            {{$data->location_name}}
                        </td>
                    </tr>
                    <tr>
                        <th>Location Code</th>
                        <td> {{$data->location_code}}</td>
                    </tr>
                    <tr>
                        <th>Vendor</th>
                        <td> {{ucwords(str_replace("_"," ",$data->vendor))}}</td>
                    </tr>
                    <tr>
                        <th>
                         Address
                        </th>
                        <td>
                            {{$data->address}}
                        </td>
                    </tr>

                     <tr>
                        <th>Address2</th>
                        <td>{{$data->address2}}</td>
                    </tr>

                    <tr>
                        <th>Town</th>
                        <td>{{$data->town}}</td>
                    </tr>
                    <tr>
                        <th>County</th>
                        <td>{{$data->county}}</td>
                    </tr>
                    <tr>
                        <th>Country</th>
                        <td>{{$data->country}}</td>
                    </tr>
                    <tr>
                        <th>Post Code</th>
                        <td>{{$data->post_code}}</td>
                    </tr>
                    @if($data->vendor != "first_aid")
                        <tr>
                            <th>Added to First Aid</th>
                            <td>{{($data->is_site_allow == 1)? "Yes" : "No"}}</td>
                        </tr> 

                    @endif
                    
                  
                    @php
                      $froms = explode(',',$data->form);
                      $floorPlan = explode(',',$data->floorPlan);
                      $images = explode(',',$data->images);
                      @endphp
                    <tr>
                        <th>
                         Forms
                        </th>
                        <td>
                             @foreach($froms as $item)
                        <a href="{{asset('storage/files/' . $item)}}" >{{$item}}</a>
                        
                    @endforeach
                        </td>
                    </tr>
                   
                    <tr>
                        <th>
                         Images
                        </th>
                        <td>
                           @foreach($floorPlan as $item)
                        <a href="{{asset('storage/files/' . $item)}}" >{{$item}}</a>
                        
                    @endforeach
                        </td>
                    </tr>
                  
                    <tr>
                        <th>
                         Floor Plan
                        </th>
                        <td>
                             @foreach($images as $item)
                        <a href="{{asset('storage/files/' . $item)}}" >{{$item}}</a>
                        
                    @endforeach
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