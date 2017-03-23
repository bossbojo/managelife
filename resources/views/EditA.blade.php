@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{ asset('public/css/QandA.css') }}">
<link rel="stylesheet" href="{{ asset('public/css/popup.css') }}">
<div class="container">
  <div>
    <!-- Modal content -->
    <?php
    $url = url('EditAnswer').'/'.$Q->id;
     ?>
   <form class="" action="{{ $url }}" method="post">
    <div class="col-md-12" style="background-color:#333; padding:10px; color:#aaa;">
      <h4 style="color:#aaa;"><b>Edit answer</b></h4>
      <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script> <script type="text/javascript">
         bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
      </script>
      <hr>
      <div class="" align="">
        <div class="col-md-8 col-md-offset-2">
            {{ csrf_field() }}
            <input type="hidden" class="form-control" name="Id" id="Id" value="{{ $A->id }}">
        </div>
        <div class="" >
          <textarea name="answer" id="answer" style="width:100%; height: 800px;" style=" background-color:#aaa;" placeholder="">
            <?php
            print $A->answered;
             ?>
          </textarea>
        </div>
      </div>
      <hr>
      <div class="" align="right">
        <button href="#" class="btn btn-success" type="submit">
          Edit answer
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
