<?php
$nev = $conn->real_escape_string($nev);
$sql = "SELECT * FROM nevnap WHERE nev1='$nev' OR nev2='$nev' LIMIT 1";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $talaltNev = ($row['nev1'] === $nev) ? $row['nev1'] : $row['nev2'];

    $array = [
        "datum" => date("F", mktime(0, 0, 0, $row['ho'], $row['nap'])) . " " . $row['nap'] . ".",
        "nev" => $talaltNev
    ];
    echo json_encode($array, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
} else {
    echo json_encode(["hiba" => "nincs találat"], JSON_UNESCAPED_UNICODE);
}
?>
