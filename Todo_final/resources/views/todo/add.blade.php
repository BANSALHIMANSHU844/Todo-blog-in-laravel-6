@extends('todo.layout')
@section('content')
<div class="container">
  <br>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2>Add Todo</h2>
        </div>
        <div class="col-md-6">
            <div class="float-right">
                <a href="{{ route('todo.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
        <br>
        <div class="col-md-12">
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-error" role="alert">
                    {{ session('error') }}
                </div>
            @endif
          @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
            </ul>
          </div><br />
          @endif
      {{-- <form id="post-form" action="{{ route('todo.store') }}" method="POST"> --}}
      <form id="post-form" action="javascript:void(0)" method="POST">
        @csrf
        <div class="row">
          <div class="col-md-12">
             <div class="alert alert-success d-none" id="msg_div">
                     <span id="res_message"></span>
                </div>
          </div>
       </div>
        <div class="form-group">
          <label for="title">Title:</label>
          <input type="text" class="form-control" id="title" name="title">
        </div>
        <div class="form-group">
          <label for="description">Description:</label>
          <textarea name="description" class="form-control" id="description" rows="5"></textarea>
        </div>
        <div class="form-group">
        <label for="status">Select todo status</label>
        <select class="form-control" id="status" name="status">
          <option value="pending">Pending</option>
          <option value="completed">Completed</option>
        </select>
        </div>
        <button id="send_form" type="submit" class="btn btn-default">Submit</button>
      </form>
        </div>
    </div>
</div>

<script>
  if ($("#post-form").length > 0) {
   $("#post-form").validate({
   rules: {
     title: {
       required: true,
       maxlength: 50
     },
     description: {
       required: true
     },
    //  status: {
    //    required: true
    //  }
   },
   messages: {
     title: {
       required: "ajax :Please Enter title",
       maxlength: "ajax :Your title maxlength should be 50 characters long."
     },
     description: {
       required: "ajax : Please Enter description"
     },
    //  status: {
    //    required: "ajax : Please Enter status"
    //  }
   },
   submitHandler: function(form) {
    $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
     });
     $('#send_form').html('Sending..');
     $.ajax({
       url: '/todo' ,
       type: "POST",
       data: $('#post-form').serialize(),
       success: function( response ) {
           $('#send_form').html('Submit');
           $('#res_message').show();
           $('#res_message').html(response.msg);
           $('#msg_div').removeClass('d-none');

           document.getElementById("post-form").reset(); 
           setTimeout(function(){
           $('#res_message').hide();
           $('#msg_div').hide();
           },4000);
          setTimeout(function()
          {
            window.location.href = "{{url('/todo')}}";
          },4000);
       }
     });
   }
 })
  }
</script>
@endsection