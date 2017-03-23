@extends('layouts.app')
<?php
use App\Indexportfolio;
use App\Dataportfolio;

$to;
$nowlogin = indexportfolio::find(Auth::user()->id);
if($nowlogin->phpindex != 'undefined'){
$iddatato = explode(",",$nowlogin->phpindex);
  for($i = 0 ; $i< sizeof($iddatato);$i++){
    $to = dataportfolio::find($iddatato[$i]);
      if($to->id != ''){
    ?>
    {{ $to->idfodata }}

  <?php
      }
   }
}
  ?>
