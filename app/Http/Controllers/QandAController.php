<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Statuspost;
use App\Commentpost;
use App\OtherDetail;
use App\DetailProfile;
use App\User;
use Storage;
use File;
use App\Alert_friends;
use App\Alert;
use App\Answer;
use App\Question;

class QandAController extends Controller
{
    public function SaveNewQuestion(){
      $input = Input::all();
      $new = new Question;
      $new->user_id = Auth::user()->id;
      $new->topic = $input['topic'];
      $new->questioned = 	$input['question'];
      $new->save();
      $findid = DB::table('question')
                    ->where('user_id', '=', Auth::user()->id)
                    ->max('id');
      $call = Question::find($findid);
      return redirect('/showQ'.'/'.$call->id);
    }
    public function showQ($id){
      $call = Question::find($id);
      return  view('showQ', ['Q' => $call]);
    }
    public function showQ2($id,$idalert){
      $call = Question::find($id);
      $Alert = Alert::find($idalert);
      $Alert->open = 1;
      $Alert->save();
      return  view('showQ', ['Q' => $call]);
    }
    public function EditQuestion(){
      $input = Input::all();
      $call = Question::find($input['Id']);
      $call->topic = $input['topic'];
      $call->questioned = $input['question'];
      $call->save();
      $call = Question::find($input['Id']);
      return redirect('/showQ'.'/'.$call->id);
    }
    public function toedit($id){
      $call = Question::find($id);
      return  view('EditQ', ['Q' => $call]);
    }
    public function AddAnswer(){
      $input = Input::all();
      $new = new Answer;
      $new->user_id = Auth::user()->id;
      $new->Q_id = $input['Id_Q'];
      $new->answered = 	$input['answered'];
      $new->save();
      if(Auth::user()->id != $input['Id_user']){
        $Alert  = new Alert;
        $Alert->user_id = $input['Id_user'];
        $Alert->friend_id = Auth::user()->id;
        $Alert->type = 'QandA';
        $Alert->data = $input['Id_Q'];
        $Alert->open = 0;
        $Alert->save();
      }
      $call = Question::find($input['Id_Q']);
      return redirect('/showQ'.'/'.$call->id);
    }
    public function editA($id,$idQ){
      $updateA = Answer::find($id);
      $updateQ = Question::find($idQ);
      return  view('EditA', ['A' => $updateA , 'Q' => $updateQ]);
    }
    public function deleteA($id,$idQ){
      $update = Answer::find($id);
      $update->delete();
      $call = Question::find($idQ);
      return redirect('/showQ'.'/'.$call->id);
    }
    public function EditAnswer($id){
      $input = Input::all();
      $update = Answer::find($input['Id']);
      $update->answered = $input['answer'];
      $update->save();
      $call = Question::find($id);
      return redirect('/showQ'.'/'.$call->id);
    }
    public function deleteQ($id){
      $findid = DB::table('answer')
                    ->where('Q_id', '=',$id)
                    ->get();
      if($findid != '[]'){
        foreach ($findid as $findde) {
          $de = Answer::find($findde->id);
          $de->delete();
        }
      }
      $delete = Question::find($id);
      $delete->delete();
      return redirect('/question.and.answer');
    }
}
