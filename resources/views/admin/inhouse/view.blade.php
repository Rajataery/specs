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
                <h2 class="pull-left">View InHouse Booking</h2>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        
                        <th>
                         Booking Date
                        </th>
                        <td>
                            {{ \Carbon\Carbon::parse($data->date)->format('j F, Y') }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Guru Details
                        </th>
                        <td>
                        @forelse($data->guru as $guru)
                         @php
                            $guru_assigned = "yes";
                         @endphp
                            {{@$guru->name}},
                        @empty
                            No guru assigned
                        @endforelse

                        @if(isset($guru_assigned))
                            <a href="#" class="btn btn-outline-primary btn-xs" data-toggle="modal" data-target="#exampleModal">Change Guru</a>
                        @endif

                        </td>
                        
                    </tr>
                    <tr>
                        <th>
                            Customer Name
                        </th>
                        <td>
                            {{$data->name}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Approve Status
                        </th>
                        <td>
                            @if($data->approved == 1)
                            Approved
                            @else
                            Not Approved
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                           Customer Address
                        </th>
                        <td>
                           {{$data->address}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Customer Email
                        </th>
                        <td>
                           {{$data->email}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Phone Number
                        </th>
                        <td>
                           {{$data->phone}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Customer Business Name
                        </th>
                        <td>
                           {{$data->business_name}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                        	Participants
                        </th>
                        <td>
                           {{$data->participants}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Price
                        </th>
                        <td>
                           {{$data->price}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Payment Status
                        </th>
                        <td>
                           {{ucfirst($data->payment_status)}}
                        </td>
                    </tr>
                   
                   
                </tbody>
            </table>
            <a style="margin-top:20px;" class="btn btn-info" href="{{ url()->previous() }}">
                Back
            </a>
        </div>


    </div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Select Guru</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
          <div class="modal-body">          
             <form action="{{route('admin.assignGuru',$data->id)}}" method="post"> @csrf
              <div class="form-group">
                      <div class="form-group">
                <label for="example-text-input" class="col-form-label">Select Guru</label>
                <select class="selectpicker form-control" data-live-search="true" name="guru_id[]" multiple>
                <option > Select Guru </option>
                @foreach($gurus as $guru)
                  <option value="{{$guru->id}}">{{$guru->name}}</option>
                @endforeach
                </select>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              
        <button type="submit" class="btn btn-primary">Assign</button>
                 </form>
          </div>
     
    </div>
  </div>
</div>

</section>
@endsection