@extends('layouts.customer-main')
@section('content')


    

<div class="customer-container">
    @extends('layouts.customerSidebar')
    
        <div class="customer-menu-outer">
                   
          <h1>Welcome {{ucwords($customername)}}</h1>
            
                  

               </div>

        </div>

        <style type="text/css">
            .sidebar-menu{
                position: relative;
                height: 100vh;
                overflow: auto;
            }

            .menu-inner {
                overflow-y: auto;
                
            }
        </style>
    
    
    <!-- start highcharts js -->
    

        <script type="text/javascript">

    $(document).ready(function() {
    $('#customer').DataTable();
    } );

    
   ;

    



        </script>



@endsection