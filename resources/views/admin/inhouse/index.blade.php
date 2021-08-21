@extends('layouts.admin')
@section('content')
<style>
.pac-container {
    background-color: #FFF;
    z-index: 20;
    position: fixed;
    display: inline-block;
    float: left;
}
.modal{
    z-index: 20;   
}
.modal-backdrop{
    z-index: 10;        
}
</style>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css"> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/css/bootstrap-select.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script>
    $('select').selectpicker();
</script>

<div class="row">
    <div class="col-12 mt-5">
        <div class="card">
            <div class="card-body">
                <div class="header-title">
                    <div class="row col-sm-12">
                        <div class="col-sm-6 pull-left">
                            <h4 class="pull-left" >In House Booking Panel</h4>
                        </div>
                    </div>
                </div>
                <div class="data-tables datatable-primary">
                    <table class="table" id="dataTable22">
                        <thead class="text-capitalize">
                            <tr>
                                <th>ID#</th>
                                <th>Booking Date</th>
                                <th>Customer Name</th>
                                <th>Customer Email</th>
                                <th>Course Name</th>
                                <th>Guru Assigned </th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $item)
                            <tr>
                                <td>{{$item->id}}
                                    @if($item->notification_status == 1) 
                                      <span>new</span> @endif</td>
                                <td>{{ \Carbon\Carbon::parse($item->date)->format('j F, Y') }}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->email}}</td>
                                <td>{{$item->course->course_name}}</td>
                                <td>@if($item->guru_id == Null)
                                    No
                                  @else
                                    Yes
                                  @endif
                                </td>
                                <td>
                                    @if($item->date > \Carbon\Carbon::now())
                                        @if($item->guru_id == Null)
                                            <button type="button" onclick="assignGuru('{{$item->id}}')" id="booking_id_{{$item->id}}" class="btn btn-outline-primary btn-xs" >Assign guru</button>
                                        @endif

                                        @if($item->approved == 1)
                                            <a href="#" class="btn btn-outline-success btn-xs" disabled>Approved</a>
                                        @else
                                            <a href="{{route('admin.approveBooking',$item->id)}}" class="btn btn-outline-primary btn-xs">Approve</a>
                                        @endif
                                    @endif

                                    <a href="{{route('admin.inHouseBookingView',$item->id)}}" class="btn btn-outline-primary btn-xs">View</a>
                                </td>
                                
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $data->links() }}
                </div>
                <!-- Modal Assign Guru-->
              <div class="modal fade" id="assignGuruModal" tabindex="-1" role="dialog" aria-labelledby="assignGuruModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="guru-modal">Select Guru</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                        <div class="modal-body">
                        
                            <form action="#" method="post" id="assign_guru_form"> @csrf
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
            </div>
        </div>
    </div>
</div>

<!-- Button trigger modal -->
<script type="text/javascript">
  
  function assignGuru(id) {

    $("#assign_guru_form").attr('action', '/admin/assignGuru/'+id);
    
    $('#assignGuruModal').modal({
        backdrop: 'static',
        keyboard: false
    });
  }


  
</script>
@endsection