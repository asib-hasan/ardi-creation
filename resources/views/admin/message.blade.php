@if(session::has('error'))

<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
    <h4><i class="icon fa-fa-ban"></i>Error!</h4>{{Session::get('error')}}
</div>

@endif

@if(session::has('success'))

<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
    <h4><i class="icon fa-fa-ban"></i>Success!</h4>{{Session::get('error')}}
</div>

@endif