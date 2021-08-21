@extends('layouts.frontend')
@section('content')

@if ($errors->any())
  <div class="alert alert-danger">
     <ul>
        @foreach ($errors->all() as $error)
           <li>{{ $error }}</li>
        @endforeach
     </ul>
     @if ($errors->has('email'))
     @endif
  </div>
@endif

<div class="section request-page">
    <div class="container ">
	<div class="request-content">
		<form method="post"  action="{{url('/quiz_store')}}">
			    @csrf
	<input type="text" name="question1" placeholder="Main Question1" value="{{$quiz_data[0]['mainquestion_1']}}">
	
	<input type="text" name="question1_1" placeholder="Question1_1" value="{{$quiz_data[0]['question1_1']}}">
	<input type="text" name="question2_1" placeholder="Question2_1" value="{{$quiz_data[0]['question2_1']}}">
	<input type="text" name="question1_1_1" placeholder="Question1_1_1" value="{{$quiz_data[0]['question2_2_1']}}">
	<input type="text" name="lastquestion1_1" placeholder="last question1_1" value="{{$quiz_data[0]['lastquestion1_1']}}">
	<input type="text" name="lastquestion2_1" placeholder="last question2_1" value="{{$quiz_data[0]['lastquestion2_1']}}">
    <input type="text" name="answer_1" placeholder="answer_1" value="{{$quiz_data[0]['answer1_1']}}">
    <input type="text" name="answer_1_1" placeholder="answer_1_1" value="{{$quiz_data[0]['answer1_1_2']}}">
    <input type="text" name="answer_1_2" placeholder="answer_1_2" value="{{$quiz_data[0]['answer2_1_2']}}">

	<input type="text" name="question2" placeholder="Main Question2" value="{{$quiz_data[0]['mainquestion_2']}}">
	<input type="text" name="question1_2" placeholder="Question1_2" value="{{$quiz_data[0]['question1_2']}}"> 
	<input type="text" name="question2_2" placeholder="Question2_2" value="{{$quiz_data[0]['question2_2']}}">
	<input type="text" name="question1_2_1" placeholder="Question1_2_1" value="{{$quiz_data[0]['question1_2_1']}}">
	<input type="text" name="lastquestion1_2" placeholder="last question1_2" value="{{$quiz_data[0]['lastquestion1_2']}}">
	<input type="text" name="lastquestion2_2" placeholder="last question2_2" value="{{$quiz_data[0]['lastquestion2_2']}}">
    <input type="text" name="answer_2" placeholder="answer_2" value="{{$quiz_data[0]['answer1_2']}}">
    <input type="text" name="answer_2_1" placeholder="answer_2_1" value="{{$quiz_data[0]['answer2_2']}}">
    <input type="text" name="answer_2_2" placeholder="answer_2_2" value="{{$quiz_data[0]['answer1_2_2']}}">

	<input type="submit" name="submit" value="Submit">  
	</form>
	</div> 

	</div>
</div>

@endsection