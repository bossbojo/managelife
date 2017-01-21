<?php
use App\Statuspost;
use App\Commentpost;
use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Support\Facades\Auth;

if(isMobile()){
  print 'mobile';
    // Do something for only mobile users
}else {
  print 'desktop';
    // Do something for only desktop users
}
function isMobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}
print '<br>';
$as = [1,2,2,3,1,1,1,5,4,8,6,2,7,7,10,10,10,10,11];
$new;
for ($i=0; $i < sizeof($as) ; $i++) {
  $new[$as[$i]] = $as[$i];
}
foreach ($new as $news) {
  print $news.'<br>';
}
print sizeof($new);

$check =  DB::table('comment_post')
                    ->where([
                            ['status_id', '=', 12],
                            ['user_id', '=', 2]
                            ])
                    ->get();
print '<br>'.$check;
 ?>
