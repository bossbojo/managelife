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
Route::get('/test3', function () {
    return view('test3');
});
Route::get('/testpresent', function () {
    return view('portfolio.present');
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
      if(Auth::user()->blocking == 'block'){
        return redirect('/contactus.blocking');
      }
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
Route::get('/yourfriends', function () { return view('friend.friends'); });
Route::get('/menubarleft', function () { return view('layouts.menubarleft'); });
/*
|--------------------------------------------------------------------------
| Question and Answer
|--------------------------------------------------------------------------
*/
Route::get('/question.and.answer', function () { return view('QandA'); });
Route::get('/show.QA', function () { return view('showQA'); });
Route::get('/show.Q', function () { return view('showQ'); });
Route::get('/add.Q', function () { return view('AddQ'); });
Route::get('/edit.Q', function () { return view('EditQ'); });
Route::get('/show.success', function () {  return view('QAsaveSuccess'); });
Route::get('/showQ/{id}', 'QandAController@showQ');
Route::get('/showQ/{id}/{idalert}', 'QandAController@showQ2');
Route::get('/toedit/{id}', 'QandAController@toedit');
Route::get('/deleteQ/{id}', 'QandAController@deleteQ');
Route::post('/SaveNewQuestion', 'QandAController@SaveNewQuestion');
Route::post('/AddAnswer', 'QandAController@AddAnswer');
Route::post('/EditQuestion', 'QandAController@EditQuestion');
Route::post('/EditAnswer/{idQ}', 'QandAController@EditAnswer');
Route::get('/deleteA/{id}/{idQ}', 'QandAController@deleteA');
Route::get('/editA/{id}/{idQ}', 'QandAController@editA');


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
Route::post('/saveImgPro', 'HomeController@saveImgPro');
Route::get('/settings/changeimagecover', function () { return view('settings.changeimagecover'); });
Route::post('/saveImgCover', 'HomeController@saveImgCover');
Route::post('/changepassword', 'SaveSettingController@changepassword');

Route::get('/editname', 'EditprofileController@editname');
Route::get('/editgender', 'EditprofileController@editgender');
Route::get('/editbirthday', 'EditprofileController@editbirthday');
Route::get('/addotherTopic', 'EditprofileController@addotherTopic');
Route::get('/deleteOther', 'EditprofileController@deleteOther');
Route::get('/editother', 'EditprofileController@editother');
/*
|--------------------------------------------------------------------------
| portfolio
|--------------------------------------------------------------------------
*/

Route::get('/portfolio', 'SavePortController@showportfolio');
Route::get('/portfolio/{id}', 'SavePortController@showportfolioUser');
Route::get('/feedback/{id}/{user_id}', 'SavePortController@showportfolioUserAlert');
Route::get('/savefeedback', 'SavePortController@savefeedback');
Route::get('/feedback', function () {
    return view('portfolio.feedbackAndFavorite');
});
Route::get('/yourfavouriteto', function () {
    return view('portfolio.yourfavourite');
});
Route::post('/saveportfolioall','SavePortController@saveportfolioall');
Route::post('/saveprofileport','SavePortController@saveprofileport');
Route::post('/savevideotextport','SavePortController@savevideotextport');
Route::post('/savephototextport','SavePortController@savephototextport');
Route::post('/savetextport','SavePortController@savetextport');
Route::post('/savevideoport','SavePortController@savevideoport');
Route::post('/savephotoport','SavePortController@savephotoport');
Route::post('/savecolorport','SavePortController@savecolorport');
Route::post('/savebgportfolio', 'SavePortController@saveBackground');
Route::get('/customportfolio', function () {
    return view('portfolio.customportfolio');
});
Route::get('/enfavorite', 'SavePortController@enfavorite');
Route::get('/defavorite', 'SavePortController@defavorite');

Route::get('/listpresent', 'ListpresentController@showlist');
Route::get('/getdataslide/{id}', 'ListpresentController@getdataslide');
Route::get('/savedataslide', 'ListpresentController@savedataslide');
Route::get('/savedataslide', 'ListpresentController@savedataslide');

Route::get('/presentfull', 'ListpresentController@presentfull');
Route::get('/presentUserfull/{id}', 'ListpresentController@presentUserfull');

/*
|--------------------------------------------------------------------------
| file upload
|--------------------------------------------------------------------------
*/
Route::get('/fileupload', function () {
    return view('fileupload.allfile');
});
Route::post('/uploadfiletosave', 'FileuploadController@uploadfiletosave');
Route::get('/delectfile/{id}', 'FileuploadController@delectfile'); 
/*
|--------------------------------------------------------------------------
| contact and report
|--------------------------------------------------------------------------
*/
Route::get('/contactus', function () {
    return view('contact.contact');
});
Route::get('/contactus.blocking', function () {
    return view('contact.contactBlocking');
});
Route::post('/contacttosave', 'CandRController@contacttosave');


/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/
Route::get('/adminlogin', function () { return view('admin.loginAdmin'); });
Route::get('/adminhome', function () {  return view('admin.Adminhome'); });
Route::get('/Blocking', function () {  return view('admin.blocking'); });
Route::get('/block', 'AdminController@block');
Route::get('/unblock', 'AdminController@unblock');
Route::get('/Contacting', function () {  return view('admin.contacting'); });
Route::get('/Report', function () {  return view('admin.report'); });

Route::post('/checklogin', 'AdminController@checklogin');
Route::get('/logOutadmin', 'AdminController@logOutadmin');
Route::get('/getdatauserto/{id}', 'AdminController@getdatauserto');
Route::get('/getcontact/{id}', 'AdminController@getcontact');
Route::get('/getalluser', 'AdminController@getalluser');
Route::get('/delectcontact', 'AdminController@delectcontact');
