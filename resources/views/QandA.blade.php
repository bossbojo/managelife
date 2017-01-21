@extends('layouts.app')
@section('content')
<style media="screen">
  .btnplus {
  background: #d93434;
  background-image: -webkit-linear-gradient(top, #d93434, #c75757);
  background-image: -moz-linear-gradient(top, #d93434, #c75757);
  background-image: -ms-linear-gradient(top, #d93434, #c75757);
  background-image: -o-linear-gradient(top, #d93434, #c75757);
  background-image: linear-gradient(to bottom, #d93434, #c75757);
  -webkit-border-radius: 28;
  -moz-border-radius: 28;
  border-radius: 28px;
  font-family: Arial;
  color: #ffffff;
  font-size: 34px;
  padding: 10px 20px 10px 20px;
  text-decoration: none !important;
  }

  .btnplus:hover {
  background: #fc3ca3;
  background-image: -webkit-linear-gradient(top, #fc3ca3, #db2e7c);
  background-image: -moz-linear-gradient(top, #fc3ca3, #db2e7c);
  background-image: -ms-linear-gradient(top, #fc3ca3, #db2e7c);
  background-image: -o-linear-gradient(top, #fc3ca3, #db2e7c);
  background-image: linear-gradient(to bottom, #fc3ca3, #db2e7c);
  text-decoration: none !important;
  }
</style>
<div class="container">
  <div class="result">
    <div align="center" style="padding-top:20%;">
      <img src="{{ asset('public\icon\loading_spinner.gif') }}" alt="" width="5%">
    </div>
  </div>
</div>
<script type="text/javascript">
  setTimeout(function() { QA(); } , 1000);
  setTimeout(function() { QA(); } , 1000);
  function QA() {
    $( ".result" ).load( "{{ url('show.QA') }}");
  }
</script>
<div style="position:absolute; position:fixed; bottom:20px; right:10%;">
  <a href="#" class="btnplus">+</a>
</div>
@endsection
