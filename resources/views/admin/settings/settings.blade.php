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
            <h4 class="header-title">Settings</h4>
            <div class="row">
              <div class="col-6">
                <div class="border bg-light px-4 pt-2 pb-4 rounded">
                  <div class="d-flex justify-content-between align-items-center">
                    <b>VAT Amount</b>
                    <h3>{{$setting->value}} %</h3>
                  </div>
                  <hr/>
                  <form  method="post" action="{{route('admin.setting.vatamount')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="d-flex justify-content-between align-items-center">
                       <input type="text" name="vatamount" value="" class="form-control percentage-check" placeholder="Enter VAT" onkeypress="return event.charCode >= 48 && event.charCode <= 57"  onkeyup="handleChange(this);" />
                      <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
  
  function handleChange(input) {
        if( input.classList.contains("percentage-check") ){
            if (input.value < 0) input.value = 0;
            if (input.value > 100) input.value = 100;
        }
    }
</script>
<style type="text/css">
 td,th{
  border: 1px solid #ddd;
  padding: 8px;
}
</style>
@endsection
