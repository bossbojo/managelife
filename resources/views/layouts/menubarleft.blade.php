
<div class="panel panel-default" style="border-radius-: 20px; background-color:#111; border-color:#111;">
    <div class="panel-heading border-radius-top-20px" style=" background-color:#cc9900; border-color:#888; text-align:center;" >
      <a href="{{ url('home') }}" class="btnMenulife" >
        <img  class="img-circle" style="border-color:#000; {{ Auth::user()->filter }} " src="{{ asset(''.Auth::user()->avatar) }}" width="100px">
        <span for="" style="font-size:150%; color:#000;">&nbsp;&nbsp; {{ Auth::user()->name }}</span>
      </a>
    </div>
    <div class=" border-radius-bottom-20px" style="border-color:#111;">
          <div class="nano-content">
            <ul class="gw-nav gw-nav-list">
              <li class="init-arrow-down">
                <a href="javascript:void(0)" style=" font-size:20px; padding-top:10px; padding-left:50px; letter-spacing: 4px;">
                  <img  src="{{ asset('public/icon/portfolio.png') }}" width="35" alt=""> Portfolio <b class="gw-arrow"></b>
                </a>
                <ul class="gw-submenu">
                  <li>
                    <a href="javascript:void(0)" style=" font-size:17px; padding-top:10px; padding-left:120px; " >
                      <img  src="{{ asset('public/icon/preview.png') }}" width="25" alt=""> Preview Portfolio
                    </a>
                  </li>
                  <li>
                    <a href="javascript:void(0)" style=" font-size:17px; padding-top:10px; padding-left:120px;" >
                      <img  src="{{ asset('public/icon/feedback-icon-3.png') }}" width="25" alt=""> Feedback Portfolio
                    </a>
                  </li>
                  <li>
                    <a href="javascript:void(0)" style=" font-size:17px; padding-top:10px; padding-left:120px;" >
                      <img  src="{{ asset('public/icon/edit.png') }}" width="25" alt=""> Edit Portfolio
                    </a>
                  </li>
                </ul>
              </li>
              <li class="init-arrow-down">
                <a href="javascript:void(0)" style=" font-size:20px; padding-top:10px; padding-left:50px; letter-spacing: 4px; ">
                  <img  src="{{ asset('public/icon/uploadpng.png') }}" width="35" alt=""> File Upload <b class="gw-arrow"></b>
                </a>
                <ul class="gw-submenu">
                  <li>
                    <a href="javascript:void(0)" style=" font-size:17px; padding-top:10px; padding-left:120px;" >
                      <img  src="{{ asset('public/icon/uploadfile.png') }}" width="25" alt=""> Upload File
                    </a>
                  </li>
                  <li>
                    <a href="javascript:void(0)" style=" font-size:17px; padding-top:10px; padding-left:120px;" >
                      <img  src="{{ asset('public/icon/folder.png') }}" width="25" alt=""> File in Portfolio
                    </a>
                  </li>
                  <li>
                    <a href="javascript:void(0)" style=" font-size:17px; padding-top:10px; padding-left:120px;" >
                      <img  src="{{ asset('public/icon/card file.ico') }}" width="25" alt=""> All file
                    </a>
                  </li>
                </ul>
              </li>
              <li class="gw-submenu">
                <a href="#" style=" font-size:20px; padding-top:10px; padding-left:50px; letter-spacing: 4px;">
                  <img  src="{{ asset('public/icon/star.png') }}" width="35" alt=""> Your favourite
                </a>
              </li>
              <li class="gw-submenu">
                <a href="{{ url('/yourfriends') }}" style=" font-size:20px; padding-top:10px; padding-left:50px; letter-spacing: 4px;">
                  <img  src="{{ asset('public/icon/friend.png') }}" width="35" alt=""> Friends
                </a>
              </li>
              <li class="init-arrow-down">
                <a href="javascript:void(0)" style=" font-size:20px; padding-top:10px; padding-left:50px; letter-spacing: 4px; ">
                  <img  src="{{ asset('public/icon/settings.png') }}" width="35" alt=""> Setting <b class="gw-arrow"></b>
                </a>
                <ul class="gw-submenu">
                  <li>
                    <a href="{{ url('settings') }}" style=" font-size:17px; padding-top:10px; padding-left:120px;" >
                      <img  src="{{ asset('public/icon/settings.png') }}" width="25" alt=""> Setting
                    </a>
                  </li>
                  @if(Auth::user()->provider == 'managelife')
                  <li>
                    <a href="{{ url('settings/changepass') }}" style=" font-size:17px; padding-top:10px; padding-left:120px;" >
                      <img  src="{{ asset('public/icon/changepass.ico') }}" width="25" alt=""> Change Password
                    </a>
                  </li>
                  @endif
                  <li>
                    <a href="{{ url('settings/editprofile') }}" style=" font-size:17px; padding-top:10px; padding-left:120px;" >
                      <img  src="{{ asset('public/icon/editprofile.png') }}" width="25" alt=""> Edit Profile
                    </a>
                  </li>
                </ul>
              </li>
              <li class="gw-submenu">
                <a href="#" style=" font-size:20px; padding-top:10px; padding-left:50px; letter-spacing: 4px; ">
                  <img  src="{{ asset('public/icon/contact-us.png') }}" width="35" alt=""> contact us
                </a>
              </li>
              <li class="gw-submenu">
                <a href="#" onclick="confirmclosebox()" style=" font-size:20px; padding-top:10px; padding-left:50px; letter-spacing: 4px; ">
                  <img  src="{{ asset('public/icon/logout.png') }}" width="35" alt=""> Logout
                </a>
              </li>
              <br><br>
              <li class="gw-submenu" style="text-align:center;">
                  <button href="#" class="btnMenulife"><img style="margin:-16px ;" src="{{ asset('favicon.ico') }}" width="200" alt=""></button>
              </li>
          </div>
          <br><br><br><br><br>
    </div>
</div>
