<?php
header('Content-Type: Application/json; charset=UTF-8');
$getKg=$_GET["kg"]??null;
$getCm=$_GET["cm"]??null;
$Cm=$getCm/100;
if(!$getKg && !$getCm){
    echo json_encode(["minta"=>"?kg=70&cm=178"],JSON_PRETTY_PRINT,JSON_UNESCAPED_UNICODE);
    return;
}
$BMI = $getKg/pow($Cm,2);
$eredmeny="";
if ($BMI<18) {
    $eredmeny="sovány testalkat";
}
elseif($BMI >18 && $BMI < 25){
    $eredmeny="normál testsúly";

}
else{
    $eredmeny="túlsúlyosság";
}
//súlytöbblet = kg - 25 * (cm/100)2
$tobblet=round($getKg -25*pow(($Cm),2),2);

$array=[
    "kg"=>$getKg,
    "cm"=>$getCm,
    "tti"=>round($BMI,2),
    "minosites"=>$eredmeny,
    "tobblet" =>$tobblet,

];
$json = json_encode($array,JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
echo $json;
?>