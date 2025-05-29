<?php
header("Content-Type: application/json; charset=utf-8");
$T=$_GET["ev"]??null;

if (!$T) {
    echo json_encode(["?ev=2021"],JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    return;
}

$month="";
$A = $T % 19;
$B = $T % 4 ;
$C = $T % 7 ;
$D = (19*$A+24) % 30 ;
$E = (2*$B+4*$C+6*$D+5) % 7 ;
$H=22+$D+$E;
if ($H<=31) {
    $month="Márciús";
}
elseif($E==6 && $D==29){
    $H=50;
    $month="Április";

}
elseif($E==6 && $D==28 && $A>10){
    $H=49;
    $month="Április";

}
else{
    $month="Április";
    $H -=31;
}
if ($H >30) {
    $month="Május";
   
}

$nagypentek = $month . " " . ($H - 2);
$husvetvasarnap = $month . " " . $H;
$husvethetfo = $month . " " . ($H + 1);
$punkosdvasarnap = $month . " " . ($H + 14);
$punkosdhetfo = $month . " " . ($H + 15);
$array=[
    "ev" => $T, 
    "nagypentek" => $nagypentek,
    "husvetvasarnap" => $husvetvasarnap,
    "husvethetfo" => $husvethetfo,
    "punkosdvasarnap" => $punkosdvasarnap,
    "punkosdhetfo" => $punkosdhetfo
];
$json = json_encode($array, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
echo $json;
?>