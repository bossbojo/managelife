<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Statuspost;
use App\Commentpost;
use App\User;
use App\Alert_friends;
use App\Alert;
use App\Indexportfolio;
use App\Dataportfolio;
use App\Listpresent;
use App\Fileupload;

class FileuploadController extends Controller
{
   public function uploadfiletosave(){
     $input = Input::all();
     $new = new Fileupload;
     $file;
     if(Input::hasFile('file')) {
       $file = Input::file('file');
       $url = 'public/upload'.'/'.Auth::user()->id.'@'.Auth::user()->email.'/fileupload';
       if( !is_dir($url)){ //create folder crop
         mkdir($url, 0700,true);
       }
       $path = $url;
       $file->move($path,$file->getClientOriginalName());
       $new->user_id = Auth::user()->id;
       $new->namefile = $file->getClientOriginalName();
       $new->file = $path.'/'.$file->getClientOriginalName();
       $new->type = $file->getClientMimeType();
       $new->sizefile = number_format($file->getClientSize()/1024/1024, 2, '.', '');
       $new->save();
     }
     return 'success';
   }
   public function delectfile($id){
     $delectfile = Fileupload::find($id);
     $delectfile->delete();
     return redirect('/fileupload');
   }
}
