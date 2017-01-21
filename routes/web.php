<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use App\Statuspost;
use App\Commentpost;
use App\User;
use App\Alert_friends;
use App\Alert;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
Route::get('/test', function () {
    return view('test');
});
Route::get('/test2', function () {
    return view('test2');
});
Route::get('/app_mobile', function () {
    return view('layouts.app_mobile');
});

/*
|--------------------------------------------------------------------------
| login all
|--------------------------------------------------------------------------
*/
Auth::routes();
Route::get('/redirect/{provider}', 'SocialAuthController@redirect');
Route::get('/callback/{provider}', 'SocialAuthController@Callback');
/*
|--------------------------------------------------------------------------
| any route
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    if (Auth::guest()) {
      return view('welcome');
    }else{
      $ohter_users = User::find(Auth::user()->id);
      return  view('main', ['UserView' => $ohter_users]);
    }
});
Route::get('/home', 'HomeController@index');
Route::get('/searchfriends', 'HomeController@searchfriends');
Route::get('/user/{id}', 'HomeController@ohter_users');
Route::get('/readall', 'HomeController@readall');
Route::get('/user/{id}/{idalert}', 'HomeController@ohter_users_status');
Route::get('/searchUser/{name}', 'HomeController@searchUser');
Route::get('/deleteThinkso', 'HomeController@deleteThinkso');
Route::get('/saveThinkso', 'HomeController@saveThinkso');
Route::get('/addfriend', 'HomeController@addfriend');
Route::get('/canceladdfriend', 'HomeController@canceladdfriend');
Route::get('/getalertaddfriends/{id}', 'HomeController@getalertaddfriends');
Route::get('/getaddfriends/{id}', 'HomeController@getaddfriends');
Route::get('/acceptfriend', 'HomeController@acceptfriend');
Route::get('/cancelfriend', 'HomeController@cancelfriend');
Route::get('/close_alertfriends', 'HomeController@close_alertfriends');
Route::get('/removefriend', 'HomeController@removefriend');
Route::get('/getalertall/{id}', 'HomeController@getalertall');
Route::get('/getalert/{id}', 'HomeController@getalert');
Route::get('/openalert/{id}', 'HomeController@openalert');
Route::post('/saveImgPro', 'HomeController@saveImgPro');
Route::get('/yourfriends', function () {
    return view('friend.friends');
});
Route::get('/menubarleft', function () {
    return view('layouts.menubarleft');
});
Route::get('/question.and.answer', function () {
    return view('QandA');
});
Route::get('/show.QA', function () {
    return view('showQA');
});

/*
|--------------------------------------------------------------------------
| status Post
|--------------------------------------------------------------------------
*/
Route::post('/savePost', 'savePostController@savePost');
Route::post('/save_editposturl_text', 'savePostController@save_editposturl_text');
Route::post('/save_editposturl_file', 'savePostController@save_editposturl_file');
Route::get('/deletePost', 'savePostController@deletePost');
Route::get('/delete_comment', 'savePostController@delete_comment');
Route::get('/edit_comment', 'savePostController@edit_comment');
Route::get('/comment_post', 'savePostController@comment_post');
Route::get('/getcoment/{id}', 'savePostController@getcomment');
Route::get('/getcomentUser/{id}', 'savePostController@getcomentUser');
Route::get('/getdatauser/{id}', 'savePostController@getdatauser');
Route::get('/showstatus', function () {
    return view('ShowStatus');
});
Route::get('/showstatusAll', function () {
    return view('ShowStatusAll');
});
Route::get('/showstatusUser/{id}','HomeController@showstatusUser');
Route::get('/showonlystatus/{id}','savePostController@showonlystatus');
Route::get('/showonly/{id}/{idalert}','savePostController@showonly');


/*
|--------------------------------------------------------------------------
| CheckInput
|--------------------------------------------------------------------------
*/
Route::get('/checkemail', 'CheckinputController@checkemail');
Route::get('/checkemailresetpass', 'CheckinputController@checkemailresetpass');
/*
|--------------------------------------------------------------------------
| settings
|--------------------------------------------------------------------------
*/
Route::get('/settings', function () { return view('settings.setting'); });
Route::get('/settings/changepass', function () {
  if (Auth::guest()){
    return redirect('/home');
  }else{
    return view('settings.changepass');
  }
});
Route::get('/settings/editprofile', function () { return view('settings.editprofile'); });
Route::get('/settings/changeimage', function () { return view('settings.changeimage'); });
Route::post('/changepassword', 'SaveSettingController@changepassword');
