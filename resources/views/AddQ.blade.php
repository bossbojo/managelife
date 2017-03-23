@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{ asset('public/css/QandA.css') }}">
<link rel="stylesheet" href="{{ asset('public/css/popup.css') }}">
<div class="container">
  <div>
    <!-- Modal content -->
   <form class="" action="{{ url('SaveNewQuestion') }}" method="post">
    <div class="col-md-12" style="background-color:#333; padding:10px; color:#aaa;">
      <h4 style="color:#aaa;"><b>New question</b></h4>
      <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script> <script type="text/javascript">
         bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
      </script>
      <hr>
      <div class="" align="">
        <div class="col-md-8 col-md-offset-2">
          <div class="col-md-2" align="center">
            Topic
          </div>
          <div class="col-md-10" align="">
            {{ csrf_field() }}
            <input type="text" class="form-control" name="topic" id="topic" value="">
          </div>
          <br>
          <hr>
        </div>
        <div class="" >
          <textarea name="question" id="question" style="width:100%; height: 800px;" style=" background-color:#aaa;" placeholder="">You want add New question.</textarea>
        </div>
      </div>
      <hr>
      <div class="" align="right">
        <button href="#" class="btn btn-success" type="submit">
          Post question
        </button>
      </div>
    </form>
    </div>
  </div>
</div>

<!-- popup add QandA -->

<script type="text/javascript">
  function showAddQ() {
    $('#AddQ').fadeIn();
  }
  function closeAddQ() {
    $('#topic').val('');
    $('#question').val('');
    $('#AddQ').fadeOut();
  }
</script>
@endsection
