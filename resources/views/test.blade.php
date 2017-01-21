<link rel="stylesheet" href="{{ asset('public/navbarleft/slidebars.css') }}">
<link rel="stylesheet" href="{{ asset('public/navbarleft/style.css') }}">
<script src="{{ asset('public/jquery-3.1.1.min.js') }}" type="text/javascript" ></script>
<div canvas="container">
  <a class="js-toggle-left-slidebar btn btn-info" id="addboxto">
      <i class="glyphicon glyphicon-th"></i> Add Box
    </a>
    <button class="js-toggle-right-slidebar">Toggle right Slidebar</button>
</div>

<div off-canvas="slidebar-1 left shift" style="width:100%;">
  <div align='right'>
    <a class="js-toggle-left-slidebar btn btn-info">Add Box</a>
  </div>
</div>

<div off-canvas="slidebar-2 right shift" style="width:100%;">
  <p>Slidebar with id 'slidebar-2' on the right side and shift style.</p>
  <button class="js-toggle-right-slidebar">Toggle right Slidebar</button>
</div>

<script src="{{ asset('public/navbarleft/slidebars.js') }}"></script>
<script src="{{ asset('public/navbarleft/scripts.js') }}"></script>
