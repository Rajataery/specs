@extends('layouts.frontend')
@section('content')

<div class="section request-page">
    <div class="container ">
	<div class="request-content">

@if($data->approved == 1)		
	<h3>Request has been Accepted Successfully</h3>
@else
	<h3>Request has been Rejected Successfully</h3>
@endif  
   
	</div> 

	</div> 
</div>
@endsection