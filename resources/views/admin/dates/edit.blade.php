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

<div class="col-12 mt-5">
    <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-6">
              <h4 class="header-title">Edit Event</h4>
            </div>
            <div class="col-6 text-right">
              <h3 class="mt-2">{{$data->event_title}}</h3>
            </div>
          </div>
            <form autocomplete="off" method="post" action="{{url('/admin/dates/update',$data->id)}}"    enctype="multipart/form-data">
                @csrf
            
              
           
              <div class="row">
                <div class="form-group col-12 col-md-6">
                  <label for="example-text-input" class="col-form-label" required>Select Date</label>
                  <input type="date" class="form-control"  value="{{$data->Date}}" name="date" />
                </div>
                <div class="form-group col-12 col-md-6">
                  <label for="example-text-input" class="col-form-label" required>Select Time</label>
                  <input type="time" class="form-control" value="{{$data->time}}" name="time" />
                </div>
              
                <div class="form-group col-12 col-md-6">
                  <label for="example-text-input" class="col-form-label">Select Location</label>
                  <select class="selectpicker form-control" data-live-search="true" required="" name="venue_id">
                  <option> Select Location</option>
                  @foreach($venue as $item)
                    <option value="{{$item->id}}"  {{ $item->id == $data->venue_id ? 'selected' : '' }}>{{$item->location_name}}</option>
                  @endforeach
                  </select>
                </div>
                <div class="form-group col-12 col-md-6">
                  <label for="example-text-input" class="col-form-label">Select Course</label>
                
                    <select class="selectpicker form-control" data-live-search="true" required name="course_id">
                  
                       <option>Select Course </option>
                       @foreach($course as $item)
                      <option value="{{$item->id}}" {{ $item->id == $data->course_id ? 'selected' : '' }}>{{$item->course_name}}</option>
                    @endforeach
                    </select>
                </div>
                
                <div class="form-group col-12 col-md-6">
                  <label for="example-text-input" class="col-form-label">Number of Seats</label>
                   <input type="number" name="seat" value="{{$data->seat}}" required class="form-control" />
                </div>
                <div class="form-group form-content col-12 col-md-6">
                  <label for="example-text-input" class="col-form-label">Select Guru</label>
                  @php
                      $single = explode(',',$data->guru_id);
                      
                  @endphp
                  <select class="selectpicker form-control" data-live-search="true" name="guru_id[]" required multiple>
                  <option > Select Guru </option>
                  @foreach($guru as $item)
                    <option value="{{$item->id}}" @if(in_array($item->id, $single))selected="selected"@endif>{{$item->name}}</option>
                  @endforeach
                  </select>
                </div>
                
                <div class="form-group col-12 col-md-6">
                  <label for="example-text-input" class="col-form-label">Price</label>
                   <input type="number" name="price" onkeyup="updateVatAmount()" value="{{$data->price}}" class="form-control" required placeholder="Enter Price" id="event_price"/>
                </div>
                <div class="form-group col-12 col-md-6">
                  <label for="example-text-input" class="col-form-label">Price paid to Guru</label>
                   <input type="number" name="price_paid" value="{{$data->price_paid}}" required class="form-control" placeholder="Enter Price Paid To Guru" />
                </div>
                <div class="form-group col-12 col-md-6 d-flex justify-content-between align-items-top">
                  @if($data->course_vendor == "british_red_cross")
                    <div class="col-4 p-0">
                      <input type="checkbox" onclick="updateVatAmount()" name="vat" id="vat" @if($data->vat == 1) checked @endif> Event has VAT
                      <br>
                      <div class="form-group dispalyprice text-primary"> 
                        @if($data->is_display_vat)
                          £{{$data->vatamount}}
                        @else
                          £{{$data->price}}
                        @endif
                      </div>
                    </div>
                    <div class="col-8 p-0">
                      <label>Display price with VAT</label>
                      <select class="selectpicker form-control" name="is_display_vat" onchange="updateVatAmount()" id="displayprice">
                        <option value="1" @if($data->is_display_vat == 1) selected @endif>Yes</option>
                        <option value="0" @if($data->is_display_vat == 0) selected @endif>No</option>
                      </select>
                      <input name="vatamount" id="vatamount" value="0" hidden="" />
                    </div>
                  @endif
                </div>
                <div class="col-12 text-center">
                  <button type="submit" class="btn btn-primary ml-0">Update Event</button>
                </div>                
              </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">

  function updateVatAmount(){
    var selectedPrice = $('#displayprice').val();
    var price = $('#event_price').val();
    var setting = parseInt('{{$setting->value}}');
    var vat = $('#vat').is(":checked");
    console.log(vat);
    if(vat && selectedPrice == 1){
      var vatCalculation = parseFloat(price)+parseFloat(price*setting/100);
      $(".dispalyprice").text("£"+vatCalculation);
      $('#vatamount').val(vatCalculation);
    }else{
      $(".dispalyprice").text("£"+price);
    }
  }

</script>

@endsection
