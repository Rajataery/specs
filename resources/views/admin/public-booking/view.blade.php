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
                <h2 class="pull-left">View Public Booking</h2>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                         Session Date
                        </th>
                        <td>
                            {{ \Carbon\Carbon::parse($data->getDate->Date)->format('j F, Y') }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                           Venue Location 
                        </th>
                        <td>
                        <a href="{{url('admin/venue/view',@$data->getDate->venue_id)}}" class="btn btn-outline-primary btn-xs">{{ @$data->getDate->venue->location_name }}</a>
                        </td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td>
                            {{ @$data->getDate->venue->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>Course Name</th>
                        <td>
                            {{@$data->getDate->course->course_name}}
                        </td>
                    </tr>
                    <tr>
                        <th>Course Vendor</th>
                        <td>
                            {{ ucwords(@$data->getDate->course_vendor) }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Assigned Guru
                        </th>
                        <td>

                        @forelse($data->guru as $guru)
                        <a target="_blank" href="{{route('admin.guru.view',@$guru->id)}}" class="btn btn-outline-primary btn-xs"> {{@$guru->name}}</a>
                        @empty
                            No guru assigned
                        @endforelse

                        </td>
                    </tr>
             <form method="post" action="{{route('admin.publicBookingUpdate',$data->id)}}">
                    <tr>
                        <th>
                            Customer Name
                        </th>
                        <td>
                            @csrf
                            <input type="text" name="cust_name" class="form-control" value="{{$data->name}}">
                            
                        </td>
                    </tr>
                   
                    <tr>
                        <th>
                            Customer Email
                        </th>
                        <td>
                            <input type="text" name="cust_email" class="form-control" value="{{$data->email}}">                           
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Phone Number
                        </th>
                        <td>
                            <input type="text" name="cust_phone" class="form-control" value="{{$data->phone}}">
                           
                        </td>
                    </tr>
                    <!-- <tr>
                        <th>
                            Customer Business Name
                        </th>
                        <td>
                           {{$data->business_name}}
                        </td>
                    </tr> -->
                    <!-- <tr>
                        <th>
                        	Participants
                        </th>
                        <td>
                           {{$data->participants}}
                        </td>
                    </tr> -->
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
            <input type="submit" name="update" class="btn btn-info" value="Update"> <br>
            </form>
            


            @if($data->approved == null)
            <a style="margin-top:20px;" class="btn btn-info"  href="{{route('mailAccept_admin',$data->id)}}">
                Accept
            </a>
            <a style="margin-top:20px;" class="btn btn-info"  href="{{route('mailReject_admin',$data->id)}}">
                Reject
            </a>
            @endif<br>

            <a style="margin-top:20px;" class="btn btn-info" href="{{ url()->previous() }}">
                Back
            </a>
            @if($data->approved == 1 || $data->approved == 2)
            <a style="margin-top:20px;" class="btn btn-info" id="sendmail">
                Send Email
            </a>
           @endif
           
        </div>

<!-- ------------------------------ Email Model ------------------------------------------>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="
    height: 100%;">
        <div class="modal-content" style="position: absolute;bottom:150px;left:50px;transform:inherit;margin:auto;">
             <form method="post" action="{{route('sendemail',$data->id)}}">
            <div class="modal-header">
               @csrf
                
            </div>
            <div class="modal-body">
                
                <span class="col-sm-4"> To </span>
                <input class="col-sm-8" type="text" name="email" placeholder="email" value="{{$data->email}}" id="email">      
                              
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              
                <button type="submit" class="btn btn-default" >Send Email</button>
         
            
            </div>
            </form>
        </div>
    </div>
</div>

<!-- ------------------------------------------------------------------------- -->
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
               
                </select>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              
        <button type="submit" class="btn btn-primary">Search</button>
                 </form>
          </div>
     
    </div>
  </div>
</div>



<script type="text/javascript">
    
$(document).ready(function () {

    $("#sendmail").click(function(){

         $('#myModal').modal('show');
    });
}); 

var comment = $("#email").val();


console.log(comment);
</script>
<style type="text/css">
    element.style {
    position: absolute;
    bottom: 73px;
    height: 427px;
}

.table-striped td input {
    border: none !important;
    background: none;
    padding-left: 0;
    box-shadow: none;
}
</style>
</section>
@endsection