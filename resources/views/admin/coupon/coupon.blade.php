@extends('layouts.admin')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
 <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
    <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
<div class="col-12 mt-5">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title">Create New Coupon</h4>
            <form autocomplete="off" method="post" action="{{url('/admin/store')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group {{ $errors->has('coupon_code') ? ' has-danger' : '' }}">
                    <label for="course_name" class="col-form-label">Coupon Code</label>
                    <input class="form-control" value="{{ old('coupon_code') }}" required="" type="text" name="coupon_code" style="text-transform:uppercase" >

                </div>
               
                

                <div class="form-group {{ $errors->has('coupon_for') ? ' has-danger' : '' }}">
                    <label for="title" class="col-form-label">Coupon For</label>
                    <Select class="form-control" required="" id="coupon" name="coupon_for[]" multiple>
                    <option value="" disabled>Please Select</option>
                    <option value="british_red_cross">British Red Cross</option>
                    <option value="first_aid">First Aid</option>
                    </Select><br>

                    <input type="button" class="btn" id="select_all" name="select_all" value="Select All">
                </div>

                <div class="form-group {{ $errors->has('coupon_for') ? ' has-danger' : '' }}">
                    <label for="title" class="col-form-label">Courses</label>
                    <Select class="form-control"  required="" id="course" name="course_id[]" multiple>
                       
                        <option value="" disabled>Select Course</option>

                        @foreach($data as $item)
                        
                        <option value="{{$item['id']}}">{{$item['course_name']}}</option>
                        @endforeach
                    </Select>
                     <br>

                    <input type="button" class="btn" id="select_course" name="select_all" value="Select All">

                </div>

                <div class="form-group {{ $errors->has('discount_type') ? ' has-danger' : '' }}">
                    <label for="short_description" class="col-form-label label_amount">Discount Type</label>
                    <Select class="form-control" id="type" required="" name="discount_type">
                        <option disabled selected value="">Choose a type</option>
                        <option value="amount">Amount</option>
                        <option value="percentage">percentage</option>

                    </Select>
                </div>

                <div class="form-group {{ $errors->has('amount') ? ' has-danger' : '' }} d-none" id="amountinput">
                    <label for="title" id="discountamount" class="col-form-label label_amount">Amount</label>
                    <input class="form-control" id="discountType" type="text" value="{{ old('amount') }}" required=""  name="amount" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onkeyup="handleChange(this);">
                </div>

                
                <div class="form-group {{ $errors->has('start_date') ? ' has-danger' : '' }} date" >
                    <label for="description" class="col-form-label">Start Date</label>
                    <input class="form-control date_picker"  type="text" value="{{ old('start_date') }}" required="" name="start_date" id="date_picker" data-provide="datepicker">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-th"></span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('end_date') ? ' has-danger' : '' }}">
                    <label for="duaration" class="col-form-label">End Date</label>
                   <input class="form-control date_picker1" type="text" value="{{ old('end_date') }}" required="" name="end_date" data-provide="datepicker">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-th"></span>
                    </div>
                </div>
           
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible mt-2">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        @foreach ($errors->all() as $error)
                        {{ $error }}<br>
                        @endforeach
                    </div>
                @endif

                <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Submit</button>
            </form>
        </div>
    </div>
</div>
   <script>
    
    $('#select_all').click(function() {
        $('#coupon option').prop('selected', true);
    });


    $('#select_course').click(function() {
        $('#course option').prop('selected', true);
    });


    $('#type').on('change', function() {
        var val = $(this).val();
        var selector = $(this).parent().next();
        $('#discountType').removeClass('percentage-check');
        $('#amountinput').removeClass('d-none');
        console.log(val);
        if(val == "")
        {
            selector.hide();
        }
        else {
            if(val == 'percentage')
            {
                selector.find('.discountType').html('Percentage (%)');
               $('#discountamount').text("Percentage (%)");
               $('#discountType').attr("placeholder", "Enter Percentage").next();
                selector.find('input').addClass('percentage-check');
            }
            else if(val == 'amount'){
                selector.find('.discountType').html('Amount ($)');
                $('#discountamount').text("Amount");
                $('#discountType').attr("placeholder", "Enter Amount").next();
                $('#discountType').val("");
                
                
            }
        }
    });

    function handleChange(input) {
        if( input.classList.contains("percentage-check") ){
            if (input.value < 0) input.value = 0;
            if (input.value > 100) input.value = 100;
        }
    }
    $('.date_picker').datepicker({
        format: 'yyyy/mm/dd'
    });

    $('.date_picker1').datepicker({
        format: 'yyyy/mm/dd'
    });
    


    </script>
@endsection

