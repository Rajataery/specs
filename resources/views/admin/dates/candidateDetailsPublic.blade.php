@extends('layouts.admin')
@section('content')
<section class="service content-box pt-5">
  
    <div class="heading">
        <div class="row col-sm-12">
            <div class="col-sm-6 pull-left">
                <h2 class="pull-left">Candidate Details</h2>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="data-tables datatable-primary">
            <div class="mb-2 form-group extra" >
                <table class="dataTable no-footer dtr-inline" role="grid" aria-describedby="dataTable2_info" id="Table">
                    <thead class="text-capitalize ">
                        <tr>
                            <th> Id </th>
                            <th> Add Notes </th>
                            <th> Name </th>
                            <th> Email </th>
                            <th> Phone </th>
                            @for($i=1; $i<=$course_time; $i++)
                            @if($course_time == 1)
                                <th> Attendance</th> 
                            @else
                                <th> Attendance Day {{$i}} </th> 
                            @endif
                            
                            @endfor
                            <th> Upload Certificate</th>
                            <th> Pass Course</th>
                            <th> Send Mail</th>
                        </tr>
                    </thead>

                    <tbody >
                        @php
                            $booking_id = array();
                        @endphp
                        
                        @foreach($booking as $item)
                          
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>
                              <div class="d-flex align-items-center justify-content-between">
                                @if($item->getNotes)
                                <button type="button" onclick="shownote({{$item->id}});" class="btn mr-1" >
                                  <i class="fa fa-eye"></i> View
                                </button>
                                @endif
                                <div class="form-popup form-container" id="showForm_{{$item->id}}" style="width: 50%;">
                                  @if($item->getNotes)

                                    <p id="showdata">{{$item->getNotes->notes}}</p>
                                  @endif                                  <button type="button" class="btn cancel" onclick="closenote({{$item->id}})">Close</button>
                                </div>
                                <button type="button" onclick="openForm({{$item->id}});" class="btn">
                                  @if($item->getNotes)
                                  <i class="fa fa-edit"></i> Edit 
                                  @else
                                  <i class="fa fa-plus-circle"></i> Add 
                                  @endif
                                </button>
                                <input type="hidden" name="booking" id="booking_id" value="{{$item->id}}">
                              </div>
                            </td>
                          
                            <td>{{$item->name}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->phone}}</td>
                            @for($i=1; $i<=$course_time; $i++)
                              @php
                                $check = isset($_POST['attendence'][$item->id][$i]) ? 1 : 0;
                                $flag = false;
                                foreach($item->getAttendance as $atten){
                                  if($atten->day == $i && $atten->attandance == 1){
                                    $flag = true;
                                  }
                                }
                              @endphp
                              <td>
                                  <form method="post" action="{{route('admin.dates.attendance')}}" enctype="multipart/form-data">
                                      @csrf
                                      <input type="hidden" id="status_1_" name="attendence[{{$item->id}}][{{$i}}]" value="0">
                                      @if($flag)
                                        <input type="checkbox" id="attendence"  name="attendence[{{$item->id}}][{{$i}}]" data-dayindex="{{$i}}"  class="attendenceID form-control" value="1" checked>
                                      @else
                                        <input type="checkbox" id="attendence"  name="attendence[{{$item->id}}][{{$i}}]" data-dayindex="{{$i}}"  class="attendenceID form-control" value="1">
                                      @endif
                                      
                              </td>
                            @endfor
                            <td>
                                <input type="file" name="certificate[{{$item->id}}]" style="width: 180px;" >
                                <?php  $certificate = \App\UploadCertificate::where('booking_id',$item->id)->get(); 
                                 ?>
                                @foreach($certificate as $key => $file)
                                    
                                    <a class="m-2" href="{{asset('backend/images/certificate/' . $file->certificate)}}" target="_blank" >  {{$file->certificate}} </a>
                                   
                              @endforeach
                           </td>
                           <td>
                           <?php  $result = \App\Result::where('booking_id',$item->id)->get(); ?>
                                
                                    <select name="pass[{{$item->id}}]" >
                                        <option value="">Please Select</option>
                                    @foreach($result as $val)
                                        <option value="pass"  @if($val->result == "pass")? ' selected="selected"' : ''; @endif >Pass</option>
                                        <option value="fail"  @if($val->result == "fail")? ' selected="selected"' : ''; @endif >Fail</option>
                                    @endforeach     
                                   </select>
                           </td>
                           <td>
                                <input type="checkbox" name="mail[{{$item->id}}]" class="form-control mail" id="{{$item->id}}" >
                                <input type="hidden" name="emailId" value="" id="emailId"> 
                           </td>
                        </tr>
                         @endforeach
                    </tbody>  
                </table>
                                @php
                                    $date_id = request()->segment(4);
                                @endphp  
                                    <input type="hidden" name="date_id" value="{{$date_id}}" id="date_id">  
                                    <input type="hidden" name="booking_id" id="" value=""> 
                                    <input type="submit" name="submit" value="Save Attendance" class="btn">
                                    <div class="error"></div>
                                    <input type="button" name="sendmail[]" value="Send Mail" class="btn" style="float: right;" onclick="sendEmail()">
                                  
                                </form>
                             
            </div>
            </div>
                <a href="/admin/download-report/{{$date_id}}"><input type="buttton" name="export" value="Download Register" class="btn" id="create_excel"> </a>
    </div>

</section>

<div class="form-popup" id="myForm">
  <form action="{{route('admin.dates.notes')}}" class="form-container" method="post">
    <h1>Add Notes</h1>

    @csrf
    <input type="hidden" name="date_id" value="{{$date_id}}" id="date_id">  

        <textarea id="notes" name="notes" rows="10" cols="50"></textarea>

    <input type="hidden" name="bookingid" id="bookingID" value="">
    <button type="submit" class="btn">Submit</button>
    <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
  </form>
</div>


<style type="text/css">
    select {
      margin: 50px;
      width: 150px;
      padding: 5px 5px 5px 5px;
      font-size: 16px;
      border: 1px solid #ccc;
      height: 34px;
    }
    .extra{
      width: 100%;
    }

    .open-button {
  background-color: #555;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position: fixed;
  bottom: 23px;
  right: 28px;
  width: 280px;
}

textarea {
    overflow: auto;
    resize: vertical;
    width: -webkit-fill-available;
}

.form-popup {
  display: none;
  position: fixed;
  left: 30%;
  top: 10%;
  border: 3px solid #f1f1f1;
  z-index: 9;
  width: 70%;
}

/* Add styles to the form container */
.form-container {
  max-width: 70%;
  padding: 10px;
  background-color: white;
}

/* Full-width input fields */
.form-container #notes input[type=text], .form-container input[type=password] {
  width: 100%;
  padding: 29px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
}

/* When the inputs get focus, do something */
.form-container #notes input[type=text]:focus, .form-container input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit/login button */
.form-container .btn {
  background-color: #04AA6D;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}
</style>
<script type="text/javascript">
var values = [];
var sList = "";
function sendEmail() {
    
  $('.mail').each(function () {
    if(this.checked){
        sList += "" + $(this).attr('id') + ",";
    }
  });
  
  $.ajax({
    type:'POST',
    url:'/admin/sendMail',
    data:{
    "_token": "{{ csrf_token() }}",
    emailId:sList,
    },
    success:function(data) {
      if ((data.errors)) {
        $('.error').removeClass('hidden');
        $('.error').text(data.errors.name);
      }else{
        $('.error').remove();
        $('#table').append("");
      }
  }
});
}

function openForm(id) {
  //id
  $("#bookingID").val(id);
  document.getElementById("myForm").style.display = "block";

}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}

function shownote(id) {

  $("#bookingID").val(id);
  document.getElementById("showForm_"+id).style.display = "block";

}

function closenote(id) {
  document.getElementById("showForm_"+id).style.display = "none";
}




var booking_id = "";
function notes() {
var booking_id =  $("#booking_id").val();
var date_id =  $("#date_id").val();
$.ajax({
    type:'POST',
    url:'/admin/notes',
    data:{
    "_token": "{{ csrf_token() }}",
    booking_id:booking_id,
    date_id:date_id,
    },
    success:function(data) {
      if ((data.errors)) {
        $('.error').removeClass('hidden');
        $('.error').text(data.errors.name);
      }else{
        $('.error').remove();
        $('#table').append("");
      }
  }
});
}

$(document).ready(function(){  
      $('#create_excel').click(function(){  
           var excel_data = $('#employee_table').html();  
           var page = "excel.php?data=" + excel_data;  
           window.location = page;  
      });  
 });  
 </script>  
</script>
 
@endsection