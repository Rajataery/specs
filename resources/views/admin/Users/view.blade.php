@extends('layouts.admin')
@section('content')
<section class="service content-box pt-5">
    <div class="heading">
        <div class="row col-sm-12">
            <div class="col-sm-6 pull-left">
                <h2 class="pull-left">View Guru </h2>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="mb-2">
        <div class="user-full-detail">
            <table class="table table-bordered table-striped">
                <tbody>
                    
                    <tr>
                        <th>Name</th>
                        <td>
                            {{$data->name}}
                        </td>
                    </tr>
                    <tr>
                        <th>Profile Image</th>
                        <td>
                        <img src="{{ url('frontend/images/'.$data['profile']) }}" alt="" style="max-width: 150px;"></td>
                        </td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>
                            {{$data->email}}
                        </td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td>
                            {{$data->phone}}
                        </td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            @if($data->status == 1)
                            Activated
                            @else
                            Deactivated
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td>
                           {{$data->address}}
                        </td>
                    </tr>
                    <tr>
                        <th>Guru Title</th>
                        <td>
                           {!!$data->title!!}
                        </td>
                    </tr>
                    <tr>
                        <th>About Guru</th>
                        <td>
                           {!! $data->about !!}
                        </td>
                    </tr>
                    <tr>
                        <th>SEO Title</th>
                        <td>
                            {{$data->seo_title}}
                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-bordered table-striped">
                <tbody>
                    
                      <tr>
                        <th>SEO Discription</th>
                        <td>
                            {{$data->seo_discription}}
                        </td>
                    </tr>
                      <tr>
                        <th>SEO Keywords</th>
                        <td>
                            {{$data->seo_keyword}}
                        </td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td>
                           {{$data->phone}}
                        </td>
                    </tr>
                    <tr>
                        <th>Experience</th>
                        <td>
                           {{$data->experience}}
                        </td>
                    </tr>
                    <tr>
                        <th>Per Day Rate</th>
                        <td>
                           {{$data->rate}}
                        </td>
                    </tr>
                    <tr>
                        <th>Courses</th>
                        <td>
                            @forelse($courses as $course)
                                {{ $course->course_name }},
                            @empty
                                <p class="text-danger">No Course found.</p>
                            @endforelse
                        </td>
                    </tr>

                   
                        <tr>
                            <th>Certificates</th>
                            <td>
                                @if($data->certificates)
                                    @php
                                      $certificates = unserialize($data->certificates);
                                    @endphp
                                    @foreach($certificates as $key=>$item)
                                        @if($item['file_type'] == "image")
                                            <h5 class="@if($key == 0) mt-1 @else mt-4 @endif mb-3"> {{$item['name']}} </h5>
                                            <a class="m-2" href="{{asset('storage/files/' . $item['file'])}}" target="_blank" > <img src="{{asset('storage/files/' . $item['file'])}}" style="max-width: 150px"> </a>
                                        @else
                                            <h5 class="@if($key == 0) mt-1 @else mt-4 @endif mb-3"> {{$item['name']}} </h5>
                                            <a class="m-2" href="{{asset('storage/files/' . $item['file'])}}" target="_blank" >{{$item['file']}}</a>
                                        @endif
                                    @endforeach
                                @else
                                    <p class="text-danger">No certificate available.</p>
                                @endif
                            </td>
                        </tr>
                    
                    <tr>
                        <th>Certificates Expiry</th>
                        <td>
                            {{ \Carbon\Carbon::parse($data->expiry)->format('j F, Y') }}
                        </td>
                    </tr>
                </tbody>
            </table>
            </div>
            <a style="margin-top:20px;" class="btn btn-info" href="{{ url()->previous() }}">
                Back
            </a>
        </div>
    </div>
</section>
@endsection