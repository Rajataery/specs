@extends('layouts.customer-main')
@section('content')



<div class="customer-container">
@extends('layouts.customerSidebar')

        <div class="customer-menu-outer">
                   
          
            <div id="details">
                <div class="data-tables datatable-primary">
                    <table id="customer" class="table table-striped">
                        <thead class="text-capitalize">
                            <tr>
                                <th>Sr.</th>
                                <th>Course Name</th>
                                <th>Address</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        @foreach($data as $item)
                        <tbody>
              
                            <tr>
                                <td>{{$item->id}}</td>
                                @if($item->type == 'public')
                                <td>{{@$item->getDate->course->course_name}}</td>
                                @else
                                <td>{{@$item->course->course_name}}</td>
                                @endif

                                 @if($item->type == 'public')
                                <td>{{@$item->getDate->venue->location_name}}</td>
                                @else
                                <td>{{$item->address}} </td>
                                @endif

                                @if($item->type == 'public')
                                <td>{{@$item->getDate->Date}}</td>
                                @else
                                <td>{{$item->date}} </td>
                                @endif
                                
                               
                        <td>
                        <a href="{{url('customer/customer_details',$item->id)}}"  class="btn btn-outline-primary btn-xs">View</a></td>
                                
                                
                            </tr>
                    
                        </tbody>
                         @endforeach
                    </table>
                </div>
            </div>
            </div>       

                                   </div>

        
    <style>

    </style>
    
       
    <!-- start highcharts js -->
    

        <script type="text/javascript">

    $(document).ready(function() {
    $('#customer').DataTable();
    } );

    
   ;

    



        </script>



@endsection