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
            <h4 class="header-title">Create New Event</h4>
            <form autocomplete="off" method="post" action="{{url('/admin/dates/update',$data->id)}}"    enctype="multipart/form-data">
                @csrf
            
              <div class="form-group">
                <label for="example-text-input" class="col-form-label">Select Date</label>
                <input type="date" class="form-control"  value="{{$data->Date}}" name="date" />
              </div>
              <div class="form-group">
                <label for="example-text-input" class="col-form-label">Select Time</label>
                <input type="time" class="form-control" value="{{$data->time}}" name="time" />
              </div>
            
              <div class="form-group">
                <label for="example-text-input" class="col-form-label">Select Venue</label>
                <select class="selectpicker form-control" data-live-search="true" name="venue_id">
                <option> Select Venue </option>
                @foreach($venue as $item)
                  <option value="{{$item->id}}"  {{ $item->id == $data->venue_id ? 'selected' : '' }}>{{$item->location_name}}</option>
                @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="example-text-input" class="col-form-label">Select Guru</label>
                <select class="selectpicker form-control" data-live-search="true" name="guru_id">
                <option > Select Guru </option>
                @foreach($guru as $item)
                  <option value="{{$item->id}}" {{ $item->id == $data->guru_id ? 'selected' : '' }}>{{$item->name}}</option>
                @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="example-text-input" class="col-form-label">Select Course</label>
              
                  <select class="selectpicker form-control" data-live-search="true" name="course_id">
                
                <option>Selete Course </option>
                  @foreach($course as $item)
                    <option value="{{$item->id}}" {{ $item->id == $data->course_id ? 'selected' : '' }}>{{$item->course_name}}</option>
                  @endforeach
                  </select>
              </div>
              <div class="form-group">
                <label for="example-text-input" class="col-form-label">Price</label>
                 <input type="number" name="price" value="{{$data->price}}" class="form-control" placeholder="Enter Price" />
              </div>
              <div class="form-group">
                <label for="example-text-input" class="col-form-label">Number of Seats</label>
                 <input type="number" name="seat" value="{{$data->seat}}" class="form-control" />
              </div>
              
          </div>
                <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Submit</button>
            </form>
        </div>
    </div>
</div>

@endsection
