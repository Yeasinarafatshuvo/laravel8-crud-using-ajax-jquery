 @extends('layouts.app')

 @section('content')

    <!-- Add Student model -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal Student</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul id="save_msgList"></ul>
                <form>
                    <div class="form-group mb-3">
                        <label for="">Student Name</label>
                        <input type="text" class="name form-control" >
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Student Email</label>
                        <input type="text" class="email form-control" >
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Student Phone</label>
                        <input type="text" class="phone form-control" >
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Student Course</label>
                        <input type="text" class="course form-control" >
                    </div>
                </form>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary add_student">Save</button>
            </div>
        </div>
        </div>
    </div>
<!-- end Student model -->

    <!-- Edit Student model -->
    <div class="modal fade" id="editStudentModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit & Update Student</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul id="updateform_errList"></ul>
                <form>
                    <input type="hidden" id="edit_stud_id">
                    <div class="form-group mb-3">
                        <label for="">Student Name</label>
                        <input type="text" class="name form-control" id="edit_name">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Student Email</label>
                        <input type="text" class="email form-control" id="edit_email">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Student Phone</label>
                        <input type="text" class="phone form-control" id="edit_phone">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Student Course</label>
                        <input type="text" class="course form-control" id="edit_course">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary update_student">Update</button>
            </div>
        </div>
        </div>
    </div>
<!-- end edit Student model -->

<!-- Delete Student model -->
    <div class="modal fade" id="deleteStudentModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Delete Student</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul id="updateform_errList"></ul>
                
                    <input type="hidden" id="delete_stud_id">
                    <h4>Are you Sure? want to Delete this Data</h4>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary delete_student_btn">Yes Delete</button>
            </div>
        </div>
        </div>
    </div>
<!-- end delete Student model -->


    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div id="success_message"></div>
                <div class="card">
                    <div class="card-header">
                        <h4>
                            Students Data
                            <a href="#" class="btn btn-primary float-end btn-sm"  data-bs-toggle="modal" data-bs-target="#exampleModal">Add Student</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                              <tr>
                                <th >SL</th>
                                <th >Name</th>
                                <th >Email</th>
                                <th >Phone</th>
                                <th >Phone</th>
                                <th>Edit</th>
                                <th>Delete</th>
                              </tr>
                            </thead>
                            <tbody>
                              
                            
                            </tbody>
                          </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
 @endsection

 @section('scripts')
    <script>
         $(document).ready(function (){

            fetchStudent();
            //start function for fetch data
             function fetchStudent()
             {
                 $.ajax({
                    type: "GET",
                    url: "/fetch-students",
                    dataType: "json",
                    success: function(response){
                        // console.log(response);
                        $('tbody').html(""); // first empty the table than loop the data
                        $.each(response.students, function(key, item){
                            $('tbody').append(
                            '<tr>\
                                <td>'+(key+1)+'</td>\
                                <td>'+item.name+'</td>\
                                <td>'+item.email+'</td>\
                                <td>'+item.phone+'</td>\
                                <td>'+item.course+'</td>\
                                <td><button type="button" value="'+item.id+'" class="edit_student btn btn-primary">Edit</button></td>\
                                <td><button type="button" value="'+item.id+'" class="delete_student btn btn-danger">Delete</button></td>\
                              </tr>'
                            );
                        });
                    }
                 });
             }

            //start function for delete data
             $(document).on('click', '.delete_student', function(e){
                e.preventDefault();
                var stud_id = $(this).val();
                // console.log(stud_id);
                $('#delete_stud_id').val(stud_id);
                $('#deleteStudentModel').modal('show');
             });

             $(document).on('click', '.delete_student_btn', function(e){
                e.preventDefault();
                var stud_id = $('#delete_stud_id').val();
                $(this).text('Deleting');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type:"DELETE",
                    url:"/delete/student/"+stud_id,
                    success: function(response){
                        // console.log(response);
                        $('#success_message').addClass('alert alert-danger');
                        $('#success_message').text(response.message);
                        $('#deleteStudentModel').modal('hide');
                        $('.delete_student_btn').text('Yes Delete');
                        fetchStudent();
                    }
                });

             });

            //end function for delete data

             //start function for edit data
             $(document).on('click', '.edit_student', function(e){
                e.preventDefault();
                var std_id = $(this).val();
                // console.log(std_id);
                $('#editStudentModel').modal('show');
                $.ajax({
                    type: "GET",
                    url: "/edit-students/"+std_id,
                    dataType: "json",
                    success: function(response){
                        // console.log(response);
                        if(response.status == 404)
                        {
                            $('#success_message').html("");
                            $('#success_message').addClass('alert alert-danger');
                            $('#success_message').text(response.message);
                            $('#editStudentModel').modal('hide');
                        }
                        else
                        {
                            $('#edit_name').val(response.student.name);
                            $('#edit_email').val(response.student.email);
                            $('#edit_phone').val(response.student.phone);
                            $('#edit_course').val(response.student.course);
                            $('#edit_stud_id').val(response.student.id);
                        }
                    }
                });
                $('.btn-close').find('input').val(''); // after button close empty data from the modal input
             });
            //end function for edit data
            //start update function
            $(document).on('click', '.update_student', function(e){
                e.preventDefault();
                $(this).text('updating');
                var stud_id = $('#edit_stud_id').val();

                var data = {
                    'name' : $('#edit_name').val(),
                    'email' : $('#edit_email').val(),
                    'phone' : $('#edit_phone').val(),
                    'course' : $('#edit_course').val(),
                }
                // console.log(data);
                //for crf token matching 
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "PUT",
                    url: "/update-student/"+stud_id,
                    data: data,
                    dataType: "json",
                    success: function(response){
                        // console.log(response);
                        if(response.status == 400)
                        {
                            $('#updateform_errList').html("");
                            $('#updateform_errList').addClass('alert alert-danger');
                            $.each(response.errors, function (key, err_value) {
                                $('#updateform_errList').append('<li>' + err_value + '</li>');
                            });
                            $('#update_student').text('updating..');
                        }
                        else if(response.status == 404)
                        {
                            $('#updateform_errList').html("");
                            $('#success_message').addClass('alert alert-danger');
                            $('#success_message').text(response.message);
                            $('#update_student').text('updating..');
                            
                        }
                        else
                        {
                            $('#updateform_errList').html("");
                            $('#success_message').addClass('alert alert-success');
                            $('#success_message').text(response.message);
                            $('#editStudentModel').modal('hide');
                            $('#update_student').text('updating..');
                            fetchStudent();
                        }
                    }
                });
            });
             //end update function





             
            //start add student function
            $(document).on('click', '.add_student', function(e){
                e.preventDefault();

                var data = {
                    'name': $('.name').val(),
                    'email': $('.email').val(),
                    'phone': $('.phone').val(),
                    'course': $('.course').val(),
                }
                // console.log(data);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "/addstudents",
                    data: data,
                    dataType: "json",
                    success: function(response){
                        //console.log(response.errors.name);
                        if(response.status == 400)
                        {
                            $('#save_msgList').html("");
                            $('#save_msgList').addClass('alert alert-danger');
                            $.each(response.errors, function (key, err_value) {
                                $('#save_msgList').append('<li>' + err_value + '</li>');
                            });
                        }
                        else
                        {
                            $('#success_message').html("");
                            $('#success_message').addClass('alert alert-success');
                            $('#success_message').text(response.message);
                            $('#exampleModal').modal('hide');
                            $('#exampleModal').find('input').val(""); // after insert data find the model than empty the input field
                            fetchStudent();
                        }
                    }
                });

            });
        });
    </script>
 @endsection