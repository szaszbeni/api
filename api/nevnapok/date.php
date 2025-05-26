<?php
$date = explode('-', $getDate);

if (count($date) === 2) {
    $month = (int)$date[0];
    $day = (int)$date[1];

    $sql = "SELECT nev1, nev2 FROM nevnap WHERE ho = $month AND nap = $day";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $array = [
            "datum" => date("F", mktime(0, 0, 0, $month, $day)) . " " . $day . ".",
            "nevnap1" => $row['nev1'],
            "nevnap2" => $row['nev2'] ?? "nincs második név",
        ];
        echo json_encode($array, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    } else {
        echo json_encode(["hiba" => "nincs találat"], JSON_UNESCAPED_UNICODE);
    }
} else {
    echo json_encode(["hiba" => "nincs találat"], JSON_UNESCAPED_UNICODE);
}
?>
