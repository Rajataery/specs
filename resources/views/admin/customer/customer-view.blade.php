@extends('layouts.admin')
@section('content')



<section class="service content-box pt-5">

    <div class="heading">
        <div class="row col-sm-12">
            <div class="col-sm-6 pull-left">
                <h2 class="pull-left">Customer Details</h2>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="mb-2">
           
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                        Customer Name
                        </th>
                        <td>{{$data[0]['name']}}</td>
                    </tr>

                    <tr>
                        <th>
                        Customer Email
                        </th>
                        <td>{{$data[0]['email']}}</td>

                    </tr>

                    <tr>
                        <th>
                        Created at 
                        </th>
                        <td>{{$data[0]['created_at']}}</td>

                    </tr>
                </tbody>
            </table>
           
           
        </div>
        <a href="{{ route('admin.customer_bookings',$data[0]['id']) }}" target=_blank><input type="button"  name="View All" value="View Bookings" class="btn" > </a>

    </div>

</section>
</section>

@endsection