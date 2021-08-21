@extends('layouts.admin')
@section('content')
 <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <div class="col-12 mt-5">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Issue Certificate</h4>
                <form autocomplete="off" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="course" class="col-form-label">Course</label>
                        <select class="form-control" id="selected_course" required onchange="selectCourse(this)" name="course">
                            <option value="">Select Course</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->course_name }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="certificate" class="col-form-label">Certificate</label>
                        <select class="form-control" disabled required onchange="selectCertificate(this)" id="course_certificates" name="certificate">
                            <option value="">Select Certificate</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="course_type" class="col-form-label">Course Booking Type</label>
                        <select class="form-control" required onchange="selectBookingType(this)" id="booking_type" name="booking_type">
                            <option value="">Select Booking Type</option>
                            <option value="public">Public Booking</option>
                            <option value="in_house">In House Booking</option>
                            <option value="guru">Guru Booking</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="completed_courses" class="col-form-label">Completed Courses</label>
                        <select class="form-control" required id="completed_courses" name="completed_courses">
                            <option value="">Select Course</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->course_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <strong>
                        <div class="text-danger" id="error_message">
                        </div>
                     </strong>
                    <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Issue Certificate</button>
                </form>
            </div>
            
        </div>
    </div>

    <script>
         
        function selectCourse(data) {
            let course = $(data).children('option:selected').val();
            $("#course_certificates").attr('disabled', true);
            $("#course_certificates").children('option:selected').removeAttr('selected');
            $("#completed_courses").attr('disabled', true);
            $("#completed_courses").html(`<option value="">Select Course</option>`);
            $("#error_message").html("");

            if (course) {
                $.ajax({
                    type: "get",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "/admin/get-certificate/"+course,
                    success:function (response){
                        let options = `<option value="">Select Certificate</option>`;

                        if (response.certificates.length > 0) {
                            response.certificates.forEach(certificate => {
                                options += "<option value='"+certificate.id+"'>"+certificate.name+"</option>";
                            });

                            $("#course_certificates").html(options);

                            $("#course_certificates").attr('disabled', false);
                            getCompletedCourses();
                        }else{
                            $("#error_message").html("No certificate found for your selected course.");
                        }
                    },
                    error: function(error){
                        alert(error.responseJSON.message);
                        console.log("error",error);
                        $("#error_message").html(error.responseJSON.message);
                        $("#course_certificates").attr('disabled', true);
                        return false;
                    }
                });
            }else{
                $("#error_message").html("Please select a course.");
                $("#course_certificates").attr('disabled', true);
                $("#course_certificates").children('option:selected').removeAttr('selected');
                $("#booking_type").children('option:selected').removeAttr('selected');
            }
        }

        function selectCertificate(data) {
            // console.log(data);
            // let certificate = $(data).children('option:selected').val();

            // if (certificate) {
            //     $("#booking_type").attr('disabled', false);
            // }else{
            //     $("#booking_type").attr('disabled', true);
            // }
        }


        function selectBookingType(data) {
            getCompletedCourses();
            // let course_type = $(data).children('option:selected').val();
            // console.log("course_type##", course_type);
            // $("#completed_courses").attr('disabled', true);
            // $("#completed_courses").html(`<option value="">Select Course</option>`);
            // $("#selected_course").children('option:selected').removeAttr('selected');
            // $("#course_certificates").children('option:selected').removeAttr('selected');
            // $("#course_certificates").html(`<option value="">Select Course</option>`);
        }

        function getCompletedCourses() {
            var course = $("#selected_course").children('option:selected').val();
            var booking_type = $("#booking_type").children('option:selected').val();
            console.log("course", course);
            console.log("booking_type", booking_type);
        }

    </script>
@endsection