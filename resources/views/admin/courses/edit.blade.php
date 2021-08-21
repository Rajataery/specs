@extends('layouts.admin')
@section('content')
 <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<div class="col-12 mt-5">
    
    <div class="card">
        <div class="card-body">
            <h4 class="header-title">Update Course Information</h4>
            <form autocomplete="off" method="post" action="{{url('/admin/course/update',$data->id)}}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group {{ $errors->has('course_name') ? ' has-danger' : '' }}">
                    <label for="example-text-input" class="col-form-label">Course Name</label>
                    <input class="form-control" value="{{ $data['course_name'] }}" type="text" required="" name="course_name">
                </div>

                <div class="form-group {{ $errors->has('course_title') ? ' has-danger' : '' }}">
                    <label for="example-text-input" class="col-form-label">Course Title</label>
                    <input class="form-control" type="text" value="{{ $data['course_title'] }}" required=""  name="course_title">
                </div>
                <div class="form-group {{ $errors->has('short_discription') ? ' has-danger' : '' }}">
                    <label for="example-text-input" class="col-form-label">Course Short Discription</label>
                    <input class="form-control" type="text" value="{{ $data['short_discription'] }}" required="" name="short_discription" >
                </div>
                <div class="form-group {{ $errors->has('course_discription') ? ' has-danger' : '' }}">
                    <label for="example-text-input" class="col-form-label">Course Description</label>
                    <input class="form-control"  type="text" value="{{ $data['course_discription'] }}" required="" name="course_discription" >
                </div>
               <div class="form-group {{ $errors->has('course_time') ? ' has-danger' : '' }}">
                    <label for="example-text-input" class="col-form-label">Course Duaration</label>
                    <select class="form-control" name="course_time" required="">
                        @for($i=1; $i<= 30; $i++)
                        <option value="{{$i}}" {{ $i == $data->course_time ? 'selected' : '' }}>{{$i}} Day</option>
                        @endfor
                    </select>
                    
                </div>
                <div class="form-group {{ $errors->has('about_individuals_description') ? ' has-danger' : '' }}">
                    <label for="example-text-input" class="col-form-label">For individuals Description</label>
                    <textarea class="form-control summernote" id="basic-example" required="" name="about_individuals_description"> {{$data['about_individuals_description']}}</textarea>
                </div>
                <div class="form-group {{ $errors->has('about_organisations_description') ? ' has-danger' : '' }}">
                    <label for="example-text-input" class="col-form-label">For Organisations Description</label>
                   
                 <textarea class="form-control summernote" id="basic" name="about_organisations_description"> {{$data['about_organisations_description']}}</textarea>

                </div>
                <div class="input-group mb-3 {{ $errors->has('course_image') ? ' has-danger' : '' }}">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Banner Image</span>
                    </div>
                    <div class="custom-file">
                        <input type="file" name="course_image" class="custom-file-input" id="inputGroupFile01" >
                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                    </div>
                    
                    <img src="{{ url("frontend/images/".$data['course_image']) }}" style="height:100px" alt="">
                </div>
                
                 <div class="input-group mb-3 {{ $errors->has('course_image') ? ' has-danger' : '' }}">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Fact Sheet</span>
                    </div>
                    <div class="custom-file">
                        <input type="file" name="course_file" class="custom-file-input" id="inputGroupFile02" >
                        <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
                    </div>
                    
                    <a href="{{asset('storage/files/' . @$data->course_file)}}" class="btn btn-info" target="blank"> See File</a> 
                </div>

                <div class="form-group {{ $errors->has('price_1_12') ? ' has-danger' : '' }}">
                    <label for="example-text-input" class="col-form-label">Inhouse Price 1-12</label>
                    <input class="form-control" required type="text" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" value="{{ $data['price_1_12'] }}" name="price_1_12">
                </div>
                <div class="form-group {{ $errors->has('price_12_24') ? ' has-danger' : '' }}">
                    <label for="example-text-input" class="col-form-label">Inhouse Price 12-24</label>
                    <input class="form-control" required type="text" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" value="{{ $data['price_12_24'] }}" name="price_12_24">
                </div>
                <div class="form-group {{ $errors->has('price_24_36') ? ' has-danger' : '' }}">
                    <label for="example-text-input" class="col-form-label">Inhouse Price 24-36</label>
                    <input class="form-control" required type="text" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" value="{{ $data['price_24_36'] }}" name="price_24_36">
                </div>

                

                <div class="course-units" id="course_units">
                    @if($data->units->count())
                        @foreach($data->units as $key => $unit)
                            <div class="form-group" id="course_unit_{{ $key + 1 }}">
                                <label for="unit" class="col-form-label">Course Unit {{ $key + 1 }}</label>
                                <input class="form-control" type="text" value="{{$unit->name}}" name="course_unit[{{$key}}]">
                            </div>
                        
                        @endforeach

                    @endif
                </div>
                <div>
                    <button type="button" onclick="addUnit()" class="btn btn-success btn-sm">Add Unit</button>
                </div>
                <div id="course_units_limit"></div>

                <h5>Preview Info.</h5>
                <hr>
                <div class="form-group {{ $errors->has('price_public') ? ' has-danger' : '' }}">

                    <label for="example-text-input" class="col-form-label">Public Price</label>

                    <input class="form-control" required type="text"  value="{{ $data['public_price'] }}" name="public_price">
                </div>

                <div class="form-group {{ $errors->has('duration') ? ' has-danger' : '' }}">

                    <label for="example-text-input" class="col-form-label">Duration</label>

                    <input class="form-control" required type="text"  value="{{ $data['duration'] }}" name="duration">
                </div>

                <div class="form-group {{ $errors->has('description') ? ' has-danger' : '' }}">

                    <label for="example-text-input" class="col-form-label">Description</label>

                    <input class="form-control" required type="text"  value="{{ $data['description'] }}" name="description">
                </div>

                <div class="form-group {{ $errors->has('others') ? ' has-danger' : '' }}">

                    <label for="example-text-input" class="col-form-label">others</label>

                    <input class="form-control" required type="text"  value="{{ $data['other'] }}" name="other">
                </div>
                

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible mt-2">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        @foreach ($errors->all() as $error)
                        {{ $error }}<br>
                        @endforeach
                    </div>
                @endif
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

      let i = {{$data->units->count()}};
        
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