@extends('layouts.app')
@section('content')
  @if (!Auth::guest())
<link rel="stylesheet" href="{{ asset('public/popelt.css') }}">
<script src="asset('public/popelt-v1.0-source.js')"></script>
<link rel="stylesheet" href="{{ asset('public/css/setting.css') }}">
<div style="height:10px;"></div>
<div class="container">
    <div class="col-md-3" style="background-color:#333; padding:0px; border-top-left-radius: 2em; border-bottom-left-radius: 2em;">
      <div class="btn-group-vertical" style="width:100%;">
        <div class="" align="center" style="padding: 10px;">
          <label for="" style="font-size:20px;"><i class="glyphicon glyphicon-cog"></i> settings</label>
        </div>
        <!-- btnsetting_that -->
        @if(Auth::user()->provider == 'managelife')
        <a href="{{ url('settings\changepass') }}" class="btn btnsetting " style="text-align:left; padding-left: 1cm; "><i class="glyphicon glyphicon-repeat"></i> Change password</a>
        @endif
        <a href="{{ url('settings\editprofile') }}" class="btn btnsetting btnsetting_that" style="text-align:left; padding-left: 1cm;"><i class="glyphicon glyphicon-edit"></i> Edit Profile</a>
      </div>
      <div style="height:60px;"></div>
    </div>
    <div class="col-md-9 solid" style="background-color:#555; height:800px; border-top-right-radius: 2em; border-bottom-right-radius: 2em;">
        <div class="col-md-12">
          <div class="panel-body">
           <label for="" style="color:#fff; font-size:20px;"><img  src="{{ asset('public\icon\editprofile.png') }}" width="25" alt=""> Edit Profile</label>
             <div class="panel-body solid-top">
                <div class="col-md-10 col-md-offset-1" ><br>
                  <div class="panel panel-default"  style="background-color:#000;border-color:#555;">
                    <div class="panel-body">
                      <form id="editprofile">
                          {{ csrf_field() }}
                          <table class="table">
                            <!-- name -->
                            <tr>
                              <th>Name</th>
                              <th>{{ Auth::user()->name }}</th>
                              <th><i class="glyphicon glyphicon-pencil"></i></th>
                            </tr>
                            <!-- Email -->
                            <tr>
                              <th>Email</th>
                              <th>{{ Auth::user()->email }}</th>
                              <th><i class="glyphicon glyphicon-pencil"></i></th>
                            </tr>
                            <!-- gender -->
                            <tr>
                              <th>Gender</th>
                              <th>
                                <input type="radio" name="gender" value="male">Male
                                <input type="radio" name="gender" value="female">Female
                              </th>
                              <th><i class="glyphicon glyphicon-pencil"></i></th>
                            </tr>
                            <!-- Birthday -->
                            <tr>
                              <th>Birthday</th>
                              <th>
                                <div class="col-md-4">
                                        <p align="center">
                                            <select style="width:75px;" class="form-control" s name="Day" id="Day">
                                              <option value="" disabled selected>Day</option>
                                              @for($i=1;$i<=31 ; $i++)
                                                <option value="<?= $i ?>"><?= $i ?></option>
                                              @endfor
                                            </select>
                                        </p>
                                    </div>
                                    <div class="col-md-4">
                                        <p align="center">
                                            <select style="width:100px;" class="form-control" name="Month"  id="Month">
                                              <option value="" disabled selected>Month</option>
                                              <option value="1">January</option>
                                              <option value="2">February</option>
                                              <option value="3">March</option>
                                              <option value="4">April</option>
                                              <option value="5">May</option>
                                              <option value="6">June</option>
                                              <option value="7">July</option>
                                              <option value="8">August</option>
                                              <option value="9">September</option>
                                              <option value="10">October</option>
                                              <option value="11">November</option>
                                              <option value="12">December</option>
                                            </select>
                                        </p>
                                    </div>
                                    <div class="col-md-4">
                                        <p align="center">
                                            <select  style="width:80px;" class="form-control" name="Year" id="Year">
                                              <option value="" disabled selected>Year</option>
                                              @for($i=2017;$i >= 1930 ; $i--)
                                                <option value="<?= $i ?>"><?= $i ?></option>
                                              @endfor
                                            </select>
                                        </p>
                                    </div>
                              </th>
                              <th><i class="glyphicon glyphicon-pencil"></i></th>
                            </tr>
                            <!-- other -->
                            <tr>
                              <th>Other</th>
                              <th>
                                <input type="radio" name="gender" value="male">Male
                                <input type="radio" name="gender" value="female">Female
                              </th>
                              <th><i class="glyphicon glyphicon-pencil"></i></th>
                            </tr>
                          </table>
                          <div class="form-group">
                              <div class="col-md-8 col-md-offset-9">
                                  <button type="submit" class="btn btn-primary" disabled="" id="submitto">
                                      Save
                                  </button>
                                  <label id="Worng" style="color:red; display:none;">**Old Password Worng**</label>
                              </div>
                          </div>
                      </form>
                    </div>
                  </div>
                </div>
             </div>
          </div>
        </div>
    </div>
</div>
<script>

  $("#changepassword").submit(function(e) {
  var url2 = "{{ url('/changepassword') }}"; // the script where you handle the form input.
  $.ajax({
         type: "POST",
         url: url2,
         data: $("#changepassword").serialize(), // serializes the form's elements.
         success: function(result) {
           console.log(result);
           if(result=='no'){
             $( "#oldcheck" ).css("color","red");
             $( "#oldcheck" ).addClass( "glyphicon glyphicon-remove-circle" );
             $('#Worng').fadeIn();
           }else{
            confirmclosebox();
            console.log(result);
             $( "#oldcheck" ).css("color","#5d962b");
             $( "#oldcheck" ).removeClass( "glyphicon glyphicon-remove-circle" ).addClass( "glyphicon glyphicon-ok-circle" );
             $('#Worng').fadeOut();
           }
         },
         error: function(xhr,textStatus){ alert(textStatus);}
       });
  e.preventDefault(); // avoid to execute the actual submit of the form.
});

</script>
@else
<a href="{{ url('login') }}" id="nologin"></a>
<script>
    $('#nologin')[0].click();
</script>
@endif
@endsection
