@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{ asset('public/css/QandA.css') }}">
<link rel="stylesheet" href="{{ asset('public/css/popup.css') }}">
<div class="container">
  <div class="result">
    <div align="center" style="padding-top:20%;">
      <img src="{{ asset('public\icon\loading_spinner.gif') }}" alt="" width="5%">
    </div>
  </div>
</div>

<script type="text/javascript">
  setTimeout(function() { QA(); } , 100);
  setTimeout(function() { QA(); } , 100);
  function QA() {
    $( ".result" ).load( "{{ url('show.QA') }}");
  }
</script>
<div style="position:absolute; position:fixed; bottom:20px; right:10%;">
  <a href="{{ url('/add.Q') }}" class="btnplus">+</a>
</div>
@endsection
