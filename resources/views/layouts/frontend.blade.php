<!DOCTYPE html>
<html data-wf-page="5fc630b56e50de19247691c5" data-wf-site="5fbe76f73f90a0308481f25c">
<head>
  <meta charset="utf-8">
  <title>First aid guru v3</title>
  <meta content="Guru page" property="og:title">
  <meta content="Guru page" property="twitter:title">
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <meta content="Webflow" name="generator">
  <link href="{{ url('frontend/css/normalize.css')}}" rel="stylesheet" type="text/css">
  <link href="{{ url('frontend/css/webflow.css')}}" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js" type="text/javascript"></script>
  
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCi50HL9BDpUeex4rEWooDZ9EF34my_J7o&libraries=places&callback=initAutocomplete" defer></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link href="{{ url('frontend/css/first-aid-guru-v2.webflow.css')}}" rel="stylesheet" type="text/css">
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
  <script src="{{ url('frontend/js/custom.js') }}"></script>
  <script src="{{ url('frontend/js/jquery_form.min.js') }}"></script>
  <script type="text/javascript">
      WebFont.load({
        google: {
          families: ["Lato:100,100italic,300,300italic,400,400italic,700,700italic,900,900italic"]
        }
      });
    </script>
  <script src="https://use.typekit.net/kde5sqc.js" type="text/javascript"></script>
  <script type="text/javascript">
      try {
        Typekit.load();
      } catch (e) {}
    </script>
  <!-- [if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js" type="text/javascript"></script><![endif] -->
  <script type="text/javascript">
      ! function(o, c) {
        var n = c.documentElement,
          t = " w-mod-";
        n.className += t + "js", ("ontouchstart" in o || o.DocumentTouch && c instanceof DocumentTouch) && (n.className += t + "touch")
      }(window, document);
    </script>
  <link href="{{ url('frontend/images/favicon.ico')}}" rel="shortcut icon" type="image/x-icon">
  <link href="{{ url('frontend/images/webclip.png')}}" rel="apple-touch-icon">
</head>
<body data-w-id="5fbb90d7cacbf073b63f48a2" class="body">
    
  <!-- header section here -->
    
      @include('layouts.frontend-header')
   

	@yield('content')
  @include('layouts.frontend-footer')
  <script src="{{url('frontend/js/webflow.js')}}" type="text/javascript"></script>
  <script>
      $(document).ready(function() {
        $(".w-webflow-badge").removeClass("w-webflow-badge").empty();
      });
    </script>
</body>
</html>