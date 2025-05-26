<?php
include("conn.php");
header("Content-type: application/json; charset=latin2");
$getDate = $_GET["nap"]??null;
$nev=$_GET["nev"]??null;
if($getDate){
    include("date.php");
}
elseif($nev){
    include("name.php");
}



else{
    echo json_encode(["minta1"=>"/?nap=12-31","minta2"=>"/?nev=Szilveszter"], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

}

?>
