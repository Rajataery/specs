@extends('layouts/frontend')
@section('content')
    <section class="page-banner">
		<div class="container">
			<h2>All Guru</h2>
			<!--<ol class="breadcrumb">-->
			<!--	<li><a href="/">Home</a></li>-->
			<!--	<li class="active">Page Name</li>-->
			<!--</ol>-->
		</div>
	</section>
	<div class="section all-guru-page-content">
		<div class="container">
			<div class="">
			@foreach($data as $item)
				<div class="individual-course-card">
					<div class="course-image">
						<img src="{{ url('frontend/images/'.$item['profile']) }}">
					</div>
					<div class="course-information-holder">
						<a href="#" class="link-block w-inline-block">
							<div class="h2 course-title homepage">{{$item->name}}</div>
							<div class="body-text private-courses homepage">{{
							$item->about}}</div>
						</a> <a href="{{route('guru.single',$item->id)}}" class="large-button go-to-course w-button">View More</a>
					</div>
					<div class="course-length-holder">
						<div class="body-text white course-length">{{$item->experience}} year Experienced</div>
					</div>
				</div>
			@endforeach
				
			</div>
		</div>
	</div>
 @endsection