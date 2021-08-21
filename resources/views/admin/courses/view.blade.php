@extends('layouts.admin')
@section('content')
<section class="service content-box pt-5">
    <div class="heading">
        <div class="row col-sm-12">
            <div class="col-sm-6 pull-left">
                <h2 class="pull-left">View Course </h2>
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
                        <td>{{$item['course_name']}}</td>

                    </tr>
                    <tr>
                        <th>
                            Banner Image
                        </th>
                        <td><img src="{{ url('frontend/images/'.$item['course_image']) }}" alt="" style="height: 50px;"></td>

                    </tr>
                    <tr>
                        <th>
                            Title
                        </th>
                        <td>{{$item['course_title']}}</td>

                    </tr>
                    <tr>
                        <th>
                            Description
                        </th>
                        <td>{{$item['course_discription']}}</td>

                    </tr>
                    <tr>
                        <th>
                            Duaration
                        </th>
                        <td>{{$item['course_time']}}</td>

                    </tr>
                    <tr>
                        <th>
                        Individuals Description
                        </th>
                        <td>{!!$item['about_individuals_description']!!}</td>

                    </tr>
                    <tr>
                        <th>
                        Organisations Description
                        </th>
                        <td>{!!$item['about_organisations_description']!!}</td>
                    </tr>

                    <tr>
                        <th>
                            In House Price
                        </th>
                        <td>
                           1 -12 Participants  :      {{$item['price_1_12']}} <br>
                           12 -24 Participants :      {{$item['price_12_24']}} <br>
                           24 -36 Participants :      {{$item['price_24_36']}}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            Course Units
                        </th>
                        <td>
                           @forelse( $item->units as $key => $unit)
                                {{$key +1 }} : {{$unit->name}} <br>
                           @empty
                                No unit found.
                           @endforelse
                        </td>
                    </tr>

                    <tr>
                        <th>
                            Fact Sheet
                        </th>
                        <td>
                            @if($item->course_file)
                                <a href="{{asset('storage/files/' . $item->course_file)}}" class="btn btn-info" target="blank"> See File</a> 
                            @else
                                No sheet.
                            @endif
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