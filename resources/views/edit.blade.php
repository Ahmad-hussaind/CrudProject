@extends('layouts.app')


@section('content')


<section class="content">
    <!-- Default box -->
    <div class="container-fluid">

        <form action="" method="post" id="departmentForm" name="departmentForm">
            
        <div class="card">
            <div class="card-body">								
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Name" value="{{ $department->name}}">
                            <p></p>	
                            
                        </div>
                    </div>
                   								
                </div>
            </div>							
        </div>
        <div class="pb-5 pt-3">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('department.index')}}" class="btn btn-outline-dark ml-3">Cancel</a>
        </div>
    </form>

    </div>
    <!-- /.card -->
</section>
    
@endsection

@section('customJs')

<script>

$('#departmentForm').submit(function(event){
        event.preventDefault();
        var element = $(this);
        $("button[type=submit]").prop('disabled',true);



        $.ajax({
            url: "{{ route('department.update',$department->id) }}",
            type: 'put',
            data: element.serializeArray(),
            dataType: 'json',
            success: function(response){
                $("button[type=submit]").prop('disabled',false);
                if (response["status"] == true) {


                    window.location.href="{{ route('department.index') }}";


                    $('#name').removeclass('is-invalid')
                    .siblings('p')
                    .addclass('invalid-feedback').html("");

                } else {
                    
                    var errors = response['errors'];
                if (errors['name']) {
                    $('#name').addclass('is-invalid')
                    .siblings('p')
                    .addclass('invalid-feedback').html(errors['name']);

                } else {
                    $('#name').removeclass('is-invalid')
                    .siblings('p')
                    .addclass('invalid-feedback').html("");
                }


                }

            }, error: function(jqXHR,exception){
                console.log("something went wrong");
            }

        })
    }); 
     
</script>
    
@endsection