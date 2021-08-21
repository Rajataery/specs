@extends('layouts.admin')
@section('content')
 <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <div class="col-12 mt-5">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Create New Certificate</h4>
                <form autocomplete="off" method="post" action="{{route('admin.certificate.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group {{ $errors->has('name') ? ' has-danger' : '' }}">
                        <label for="name" class="col-form-label">Name</label>
                        <input class="form-control" value="{{ old('name') }}" minlength="3" maxlength="256" required="" type="text" name="name" >
                    </div>
                    @if ($errors->has('name'))
                        <span class="text-danger" role="alert" class="alert alert-danger">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                    <div class="form-group {{ $errors->has('course_id') ? ' has-danger' : '' }}">
                        <label for="course_id" class="col-form-label">Course</label>
                        <select class="form-control" required="" name="course_id">
                            <option value="">Select Course</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->course_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if ($errors->has('course_id'))

                        <span class="text-danger" role="alert" class="alert alert-danger">
                            <strong>{{ $errors->first('course_id') }}</strong>
                        </span>
                    @endif
                    
                    <div class="form-group {{ $errors->has('template') ? ' has-danger' : '' }}">
                        <label for="template" class="col-form-label">Template</label>
                        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#variables_model">Variables</button>

                        <textarea class="form-control summernote" required="" minlength="20" name="template">
                            <p>{SITE_LOGO}</p><p><br></p><p>
                            </p><p>Course Certificate</p><p><br></p><p>
                            </p><p>We hereBy Confirm&nbsp; &nbsp;{TRAINEE_NAME}  has successfully achieved all the requirements for {COURSE_NAME}</p> 
                            <h6><span style="color: rgb(34, 34, 34); font-family: consolas, " lucida="" console",="" "courier="" new",="" monospace;="" font-size:="" 12px;="" white-space:="" pre-wrap;"="">Fusce at nisi eget dolor rhoncus facilisis. Mauris ante nisl, consectetur et luctus et, porta ut dolor. Curabitur ultricies ultrices nulla. Morbi blandit nec est vitae dictum.</span></h6>
                            <h3><span style="color: rgb(34, 34, 34); font-family: consolas, " lucida="" console",="" "courier="" new",="" monospace;="" font-size:="" 12px;="" white-space:="" pre-wrap;"=""><br></span></h3>
                            <p>Issue Date: {CERTIFICATE_ISSUE_DATE}</p>
                            <p>Address: {COURSE_ADDRESS}</p>
                        </textarea>
                    </div>
                    
                    @if ($errors->has('template'))
                        <span class="text-danger" role="alert" class="alert alert-danger">
                            <strong>{{ $errors->first('template') }}</strong>
                        </span> <br>
                    @endif
                    
                    <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Submit</button>
                </form>
            </div>
            
        </div>
    </div>
    @include('admin.certificates.certificate-variables')

   <script>
      $('.summernote').summernote({
        placeholder: '',
        tabsize: 2,
        height: 300,
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'picture',]],
          ['view', ['codeview', 'help']]
        ]
      });

    </script>
@endsection