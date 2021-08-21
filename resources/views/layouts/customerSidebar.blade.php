<link rel="stylesheet" href="{{ asset('backend/css/themify-icons.css') }}">

<div class="customer-sidebar">            
            <div class="main-menu">
                <div class="menu-inner" >
                    <nav>
                        <!--h4 style="color: white;text-align:center ">
                            <i class="ti-dashboard"></i></h4><hr-->
                        <ul class="metismenu"  class="menu">
                           
                                <li  id="user_details" class="active" >
                                    <a  href="{{route('customer.dashboard')}}" aria-expanded="true"><i class="ti-dashboard"></i><span style="font: all;">Dashboard</span></a>
                                </li>    
                                
                                <li id="condetails" >
                                    <a href="{{route('customer.home')}}" aria-expanded="true"><i
                                            class="ti-layout-grid3"></i><span>Your Bookings</span></a>
                                    
                                </li>
                                <!--li  id="user_details">
                                    <a  href="{{route('customer.dashboard')}}" aria-expanded="true"><i class="ti-export rorate-90"></i><span style="font: all;">Log out</span></a>
                                </li--> 
                        </ul>
                    </nav>
                </div>

                

            </div>

</div>

<script type="text/javascript">
    
   var make_button_active = function()
{
  //Get item siblings
  var siblings =($(this).siblings());

  //Remove active class on all buttons
  siblings.each(function (index)
    {
      $(this).removeClass('active');
    }
  )


  //Add the clicked button class
  $(this).addClass('active');
}

//Attach events to menu
$(document).ready(
  function()
  {
    $(".menu li").click(make_button_active);
  }  
)

</script>