@extends('admin.layout.app')

@section('content')


    <!-- Content Header (Page header) -->
    <section class="content-header">					
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Category</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="categories.html" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <form action="" method="get" id="categoryForm" name="categoryForm">
                <div class="card">
                    <div class="card-body">								
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Name">	
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email">Slug</label>
                                    <input type="text" name="slug" id="slug" class="form-control" placeholder="Slug" readonly>	
                                    <p></p>
                                </div>
                            </div>	
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status">Status</label>
                                    <select id="" class="form-control" name="status">
                                        <option value="1">Active</option>
                                        <option value="0">Block</option>
                                    </select>
                                </div>
                            </div>		
                        </div>
                    </div>							
                </div>
                <div class="pb-5 pt-3">
                    <button type="submit" class="btn btn-primary">Create</button>
                    <a href="#" class="btn btn-outline-dark ml-3">Cancel</a>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->

@endsection

@section('customjs')

<script>
    $("#categoryForm").submit(function(event){
        event.preventDefault();
        var element = $(this);
        $.ajax({
            url: '{{route("categories.store")}}',
            type: 'get',
            data: element.serializeArray(),
            dataType: 'json',
            success: function(response){
                console.log('After response');
                
                var errors = response['errors'];
                if(errors['name']){
                    console.log('Innse ajax');
                    $("#name").addClass('is-invalid').siblings('p').addClass('invalid-feedback')
                    .html(errors['name']);
                }

                else{
                    $("#name").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback')
                    .html("");
                }

                if(errors['slug']){
                    $("#slug").addClass('is-invalid').siblings('p').addClass('invalid-feedback')
                    .html(errors['slug']);
                }

                else{
                    $("#slug").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback')
                    .html("");
                }
            },
            error: function(jqXHR, exception){
                console.log("Something went wrong");
            }
        })
    });

    $("#name").change(function(){
        element = $(this);
        console.log('This ' + element);
        $.ajax({
            url: '{{route("getSlug")}}',
            type: 'get',
            data: {
                title: element.val()
            },
            dataType: 'json',

            success: function(response){
                if(response['status']==true){
                    
                    $("#slug").val(response['slug']);
                }
            }
        });
    });
</script>
@endsection