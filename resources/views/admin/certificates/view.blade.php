@extends('layouts.admin')
@section('content')
<section class="service content-box pt-5">
    <div class="heading">
        <div class="row col-sm-12">
            <div class="col-sm-6 pull-left">
                <h2 class="pull-left">View Certificate </h2>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>Name</th>
                        <td>{{$certificate->name}}</td>
                    </tr>
                    <tr>
                        <th>Course</th>
                        <td>{{ $certificate->course->course_name }}</td>
                    </tr>
                    <tr>
                        @php
                            $template = str_replace("{SITE_LOGO}","<img src='".$logo."' style='width:200px' />",$certificate->template)
                        @endphp
                        <th>Template</th>
                        <td>{!! $template !!}</td>
                    </tr>                    
                </tbody>
            </table>
            <a style="margin-top:20px;" class="btn btn-info" href="{{ url()->previous() }}">
                Back
            </a>
        </div>


    </div>

</section>
@endsection