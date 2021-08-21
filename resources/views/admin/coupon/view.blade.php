@extends('layouts.admin')
@section('content')
<script>
$('select').selectpicker();
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/css/bootstrap-select.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<section class="service content-box pt-5">
    <div class="heading">
        <div class="row col-sm-12">
            <div class="col-sm-6 pull-left">
                <h2 class="pull-left">View Coupons</h2>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="mb-2">
        
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            Coupon Code
                        </th>
                        <td>
                            {{$data->coupon_code}}
                        </td>
                    </tr>
                    
                    <tr>
                        <th>
                            Coupon For
                        </th>
                        <td>
                            {{$data->coupon_for}}
                        </td>
                    </tr>
                    
                    <tr>
                        <th>
                           Amount
                        </th>
                        <td>
                           {{$data->amount}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                           Start Date   
                        </th>
                        <td>
                          {{$data->start_date}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            End Date
                        </th>
                        <td>
                          {{$data->end_date}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Course
                        </th>
                        <td class="courseName">
                     
                          @foreach($data->couponCourses as $item)
                          
                            {{$item->course->course_name}}
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

<style type="text/css">
    td.courseName {
    white-space: pre-line;
}

</style>


</section>
@endsection