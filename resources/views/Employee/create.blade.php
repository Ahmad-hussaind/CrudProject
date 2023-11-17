@extends('layouts.app')


@section('content')

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="container-fluid">

        <form action="" method="post" id="employeeForm" name="employeeForm">
            
        <div class="card">
            <div class="card-body">								
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name">First Name</label>
                            <input type="text" name="fname" id="fname" class="form-control" placeholder="First Name">
                            <p></p>	
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name">Last Name</label>
                           
                            <input type="text" name="lname" id="lname" class="form-control" placeholder="Last Name">
                            <p></p>	
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name">Department</label>
                            <select name="department_id" id="department_id" class="form-control">
                                @if($departments->isNotEmpty())
                                @foreach ($departments as $department )
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach  
                            @endif
                            </select>
          
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name">Salary</label>
                            <input type="text" name="salary" id="salary" class="form-control" placeholder="Salary">
                            <p></p>	
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <input type="hidden" id="image_id" name="image_id" value="">
                            <label for="image">Profile_pic</label>
                            <div id="image" class="dropzone dz-clickable">
                                <div class="dz-message needsclick">    
                                    <br>Drop files here or click to upload.<br><br>                                            
                                </div>
                            </div>
                        </div>
                    </div>
								
                </div>
            </div>							
        </div>
        <div class="pb-5 pt-3">
            <button type="submit" class="btn btn-primary">Create</button>
            <a href="" class="btn btn-outline-dark ml-3">Cancel</a>
                    {{-- {{ route('categories.index')}} --}}
                </div>
            </form>

            </div>
            <!-- /.card -->
        </section>
        <!-- /.content -->
            
        @endsection

@section('customJs')



<script>
$('#employeeForm').submit(function(event){
        event.preventDefault();
        var element = $(this);
        $("button[type=submit]").prop('disabled',true);

        $.ajax({
            url: "{{ route('employees.store') }}",
            type: 'post',
            data: element.serializeArray(),
            dataType: 'json',
            success: function(response){
           $("button[type=submit]").prop('disabled',false);
                if (response["status"] == true) {

                    $('#fname').removeClass('is-invalid')
                    .siblings('p')
                    .addClass('invalid-feedback').html("");

                    $('#lname').removeClass('is-invalid')
                    .siblings('p')
                    .addClass('invalid-feedback').html("");

                    $('#department_id').removeClass('is-invalid')
                    .siblings('p')
                    .addClass('invalid-feedback').html("");

                    $('#salary').removeClass('is-invalid')
                    .siblings('p')
                    .addClass('invalid-feedback').html("");

                    window.location.href="{{ route('employees.index') }}";

                    

                } else {
                var errors = response['errors'];
                if (errors['fname']) {
                    $('#fname').addClass('is-invalid')
                    .siblings('p')
                    .addClass('invalid-feedback').html(errors['fname']);

                } else {
                    $('#fname').removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback').html("");
                } 


                if (errors['lname']) {
                    $('#lname').addClass('is-invalid')
                    .siblings('p')
                    .addClass('invalid-feedback').html(errors['lname']);

                } else {
                    $('#lname').removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback').html("");
                }


                if (errors['department_id']) {
                    $('#department_id').addClass('is-invalid')
                    .siblings('p')
                    .addClass('invalid-feedback').html(errors['department_id']);

                } else {
                    $('#department_id').removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback').html("");
                }


                if (errors['salary']) {
                    $('#salary').addClass('is-invalid')
                    .siblings('p')
                    .addClass('invalid-feedback').html(errors['salary']);

                } else {
                    $('#salary').removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback').html("");
                }

                }

            }, error: function(jqXHR,exception){
                console.log("something went wrong");
            }

        });
    });




    Dropzone.autoDiscover = false;    
    const dropzone = $("#image").dropzone({ 
        init: function() {
            this.on('addedfile', function(file) {
                if (this.files.length > 1) {
                    this.removeFile(this.files[0]);
                }
            });
        },

    url:  "{{ route('temp-images.create') }}",
    maxFiles: 1,
    paramName: 'image',
    addRemoveLinks: true,
    acceptedFiles: "image/jpeg,image/png,image/gif",
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }, success: function(file, response){
        $("#image_id").val(response.image_id); 
        // console.log(response)
    }
});

</script>



    
@endsection