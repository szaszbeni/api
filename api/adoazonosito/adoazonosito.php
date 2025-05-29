<?php
    header("Content-type: application/json; charset=utf-8");

    $jel  = $_GET["jel"] ?? null;
    $error = "0";
    $birthDate = "";

    if($jel === null) {
        echo json_encode(["minta" => "?jel="], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        return;
    }

    if ($jel[0] !== '8' || strlen($jel) !== 10) {
        $error = "1";
    }else {
        for ($i=1; $i <= 5 ; $i++) { 
            $birthDate .= $jel[$i];
        }
        $birthDate = date("Y.m.d", strtotime("+" . $birthDate . "days", strtotime("1867.01.01")));
        $error = strtotime($birthDate) > strtotime(date("Y.m.d")) ? "1": "0";
    }

    $array = [
        "jel" => $jel,
        "szul_datum" => $birthDate,
        "error" => $error
    ];

    $json = json_encode($array, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    echo $json;

?>