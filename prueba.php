

<?php


$str='1789D0Y';
$string='';
//[A-Z]{3}|[0-9]{5}

if(preg_match('/^[A-Z]{1}\d{3}[BCDFGHJKLMNPQRSTVWXYZ]{3}$/',$str) and strlen($str)==7){
  $string='paso con 7';


}

else if(preg_match('/^\d{3}[BCDFGHJKLMNPQRSTVWXYZ]{3}$/', $str) and strlen($str)==6)
{
  $string='paso con 6';

  $str='P'.$str;

}
else{
  $string='no paso';
}

echo $string;
echo "-";
echo $str;


?>



