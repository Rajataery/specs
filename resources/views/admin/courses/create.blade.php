@extends('layouts.admin')
@section('content')
 <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<div class="col-12 mt-5">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title">Create New Course</h4>
            <form autocomplete="off" method="post" action="{{url('/admin/course/store')}}" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    @csrf
                    <div class="form-group {{ $errors->has('course_name') ? ' has-danger' : '' }}">
                    <label for="course_name" class="col-form-label">Course Name</label>
                    <input class="form-control" value="{{ old('course_name') }}" required="" type="text" name="course_name" >
                    </div>
                    @if ($errors->has('course_name'))
                    <span class="invalid-feedback" role="alert" class="alert alert-danger">
                    <strong>{{ $errors->first('course_name') }}</strong>
                    </span>
                    @endif
                    <div class="form-group {{ $errors->has('course_title') ? ' has-danger' : '' }}">
                    <label for="title" class="col-form-label">Course Title</label>
                    <input class="form-control" type="text" value="{{ old('course_title') }}" required=""  name="course_title">
                    </div>
                    <div class="form-group {{ $errors->has('short_discription') ? ' has-danger' : '' }}">
                    <label for="short_description" class="col-form-label">Course Short Description</label>
                    <input class="form-control" type="text" value="{{ old('short_discription') }}" required="" name="short_discription">
                    </div>
                    <div class="form-group {{ $errors->has('course_discription') ? ' has-danger' : '' }}">
                    <label for="description" class="col-form-label">Course Description</label>
                    <input class="form-control" type="text" value="{{ old('course_discription') }}" required="" name="course_discription">
                    </div>
                    <div class="form-group {{ $errors->has('course_time') ? ' has-danger' : '' }}">
                    <label for="duaration" class="col-form-label">Course Duaration</label>
                    <select class="form-control" required="" name="course_time">
                        @for($i=1; $i<= 30; $i++)
                        <option value="{{$i}}">{{$i}} Day</option>
                        @endfor
                    </select>
                    
                    </div>
                    <div class="form-group {{ $errors->has('about_individuals_description') ? ' has-danger' : '' }}">
                    <label for="individuals_description" class="col-form-label">For individuals Description</label>
                    <textarea class="form-control summernote" required id="basic-example"  name="about_individuals_description"></textarea>
                    </div>
                    <div class="form-group {{ $errors->has('about_organisations_description') ? ' has-danger' : '' }}">
                    <label for="organisations_description" class="col-form-label">For Organisations Description</label>
                   
                 <textarea class="form-control summernote" required name="about_organisations_description"></textarea>

                    </div>

                    <div class="input-group mb-3 {{ $errors->has('course_image') ? ' has-danger' : '' }}">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Banner Image</span>
                    </div>
                    <div class="custom-file">
                        <input type="file" name="course_image" required="" class="custom-file-input" id="inputGroupFile01" >
                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                    </div>
                    </div>

                    <div class="input-group mb-3 {{ $errors->has('course_image') ? ' has-danger' : '' }}">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Fact Sheet</span>
                    </div>
                    <div class="custom-file">
                        <input type="file" name="course_file" class="custom-file-input" id="inputGroupFile02" >
                        <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
                    </div>
                    </div>
                </div>




                 <div class="col-md-6">
                     <div class="form-group {{ $errors->has('price_1_12') ? ' has-danger' : '' }}">
                         <label for="example-text-input" class="col-form-label">Inhouse Price 1-12</label>
                         <input class="form-control" required type="text" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" name="price_1_12">
                     </div>
                     <div class="form-group {{ $errors->has('price_12_24') ? ' has-danger' : '' }}">
                         <label for="example-text-input" class="col-form-label">Inhouse Price 12-24</label>
                         <input class="form-control" required type="text" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" name="price_12_24">
                     </div>
                     <div class="form-group {{ $errors->has('price_24_36') ? ' has-danger' : '' }}">
                         <label for="example-text-input" class="col-form-label">Inhouse Price 24-36</label>
                         <input class="form-control" required type="text" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" name="price_24_36">
                     </div>

                     <h5 style="margin-top: 53px;">Add Preview Info.</h5>
                     <hr>

                     <div class="form-group {{ $errors->has('price_public') ? ' has-danger' : '' }}">

                         <label for="example-text-input" class="col-form-label">Public Price</label>

                         <input class="form-control" required type="text" name="public_price">
                     </div>

                     <div class="form-group {{ $errors->has('duration') ? ' has-danger' : '' }}">

                         <label for="example-text-input" class="col-form-label">Duration</label>

                         <input class="form-control" required type="text"  name="duration">
                     </div>

                     <div class="form-group {{ $errors->has('description') ? ' has-danger' : '' }}">

                         <label for="example-text-input" class="col-form-label">Description</label>

                         <input class="form-control" required type="text"   name="description">
                     </div>

                     <div class="form-group {{ $errors->has('others') ? ' has-danger' : '' }}">

                         <label for="example-text-input" class="col-form-label">others</label>

                         <input class="form-control" required type="text"   name="other">
                     </div>


                     <div class="course-units" id="course_units"></div>
                     <div>
                         <button type="button" onclick="addUnit()" class="btn btn-success btn-sm">Add Unit</button>
                     </div>
                     <div id="course_units_limit"></div>

                     @if ($errors->any())
                         <div class="alert alert-danger alert-dismissible mt-2">
                             <button type="button" class="close" data-dismiss="alert">&times;</button>
                             @foreach ($errors->all() as $error)
                             {{ $error }}<br>
                             @endforeach
                         </div>
                    @endif

                </div>
        </div>

                <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Submit</button>
            </form>
        </div>
    </div>
</div>
   <script>
      $('.summernote').summernote({
        // placeholder: 'Hello stand alone ui',
        tabsize: 2,
        height: 120,
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'picture', 'video']],
          ['view', ['fullscreen', 'codeview', 'help']]
        ]
      });

      let i = 0;
      function addUnit(){
        if (i < 10) {
            let html = `<div class="form-group" id="course_unit_`+(i+1)+`">
                <label for="unit" class="col-form-label">Course Unit `+(i+1)+`</label>
                <input class="form-control" type="text" name="course_unit[`+i+`]">
            </div>`;

            $("#course_units").append(html);
            i++;
        }else{
            $("#course_units_limit").html(`<p class="text-danger mb-2"> Course units limit exceeded</p>`);
        }
      }

    </script>
@endsection