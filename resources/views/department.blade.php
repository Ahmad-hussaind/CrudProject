@extends('layouts.app')


@section('content')
<section class="content">
    <!-- Default box -->
   

        <form action="" method="post" id="departmentForm" name="departmentForm">

            <div class="mb-3 ">
                
                <label class="form-label" for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                 <p></p>	
              </div>
            
        <div class="pb-5 pt-3">
            <button type="submit" class="btn btn-primary">Create</button>
            <a href="" class="btn btn-outline-dark ml-3">Cancel</a>
         
        </div>
    </form>

    
    <!-- /.card -->
</section>
@endsection


@section('customJs')
<script>
    $('#departmentForm').submit(function(event){    
        event.preventDefault();
        $("button[type=submit]").prop('disabled',true);
        var element = $(this);
        $.ajax({
                url: '{{ route("department.store") }}',
                type: 'post',
                data: element.serializeArray(),
                dataType: 'json',
                success: function(response){
                    $("button[type=submit]").prop('disabled',false);
                
                    if (response["status"] == true) {

                        $('#name').removeClass('is-invalid')
                        .siblings('p')
                        .addClass('invalid-feedback').html("");

                        window.location.href="{{ route('department.index') }}";


                    } else {
                        var errors = response['errors'];
                    if (errors['name']) {
                        $('#name').addClass('is-invalid')
                        .siblings('p')
                        .addClass('invalid-feedback').html(errors['name']);

                    } else {
                        $('#name').removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback').html("");
                    }

                    
                    }

                }, error: function(jqXHR,exception){
                    console.log("something went wrong");
                }

            })
    }); 

// $.ajaxSetup({
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         }

//     });
</script>
@endsection

