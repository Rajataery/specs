@extends('layouts.customer-main')
@section('content')

<div class="customer-container">
@extends('layouts.customerSidebar')


<section class="service content-box customer-menu-outer">

    <div class="heading">
        <div class="row col-sm-12">
            <div class="col-sm-6 pull-left">
                <h2 class="pull-left">Booking Details</h2>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="mb-2">
            @if($data[0]['type'] == "public")
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                        Booking Type
                        </th>
                        <td>{{$data[0]['type']}}</td>

                    </tr>

                    <tr>
                        <th>
                        Course Name
                        </th>
                        <td>{{$public_course[0]['event_title']}}</td>

                    </tr>

                    <tr>
                        <th>
                        Date
                        </th>
                        @if($data[0]['type'] == 'public')
                            <td>{{@$data[0]->getDate->Date}}</td>
                            @else
                            <td>{{$item->date}} </td>
                            @endif

                    </tr>

                    <tr>
                        <th>
                        Participants
                        </th>
                        <td>{{$data[0]['participants']}}</td>

                    </tr>
                    @if($data[0]['type'] == "in_house")
                    <tr>
                        <th>
                        Business Name
                        </th>
                        <td>{{$data[0]['business_name']}}</td>

                    </tr>
                    @endif

                    <tr>
                        <th>
                        Price
                        </th>
                        <td>{{$data[0]['price']}}</td>

                    </tr>

                    <tr>
                        <th>
                        Payment Status
                        </th>
                        <td>{{$data[0]['payment_status']}}</td>

                    </tr>

                     <tr>
                        <th>
                        Address
                        </th>
                        @if($data[0]['type'] == 'public')
                        <td>{{@$data[0]->getDate->venue->location_name}}</td>
                            @else
                            <td>{{$data[0]['address']}} </td>
                            @endif

                    </tr>
                   

                </tbody>
            </table>
            @else
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                        Booking Type
                        </th>
                        <td>{{$data[0]['type']}}</td>

                    </tr>

                    <tr>
                        <th>
                        Course Name
                        </th>
                        <td>{{$courses[0]['course_name']}}</td>

                    </tr>

                    <tr>
                        <th>
                        Date
                        </th>
                        <td>{{$data[0]['date']}}</td>

                    </tr>

                    <tr>
                        <th>
                        Participants
                        </th>
                        <td>{{$data[0]['participants']}}</td>

                    </tr>

                    <tr>
                        <th>
                        Business Name
                        </th>
                        <td>{{$data[0]['business_name']}}</td>

                    </tr>

                    <tr>
                        <th>
                        Price
                        </th>
                        <td>{{$data[0]['price']}}</td>

                    </tr>

                    <tr>
                        <th>
                        Payment Status
                        </th>
                        <td>{{$data[0]['payment_status']}}</td>

                    </tr>
                   

                </tbody>
            </table>
            @endif
            <!-- <a style="margin-top:20px;" class="btn btn-info" href="{{ url()->previous() }}">
                Back
            </a> -->
        </div>

    </div>

<a href="/customer/invoice/{{$data[0]['id']}}" class="btn btn-info" style="margin-left: 20px;">Download Invoice </a>
</div>
</section>

@endsection