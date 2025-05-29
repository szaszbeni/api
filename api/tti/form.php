<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bmi</title>
</head>

<body>
    <?php
    $getCm = $_POST["cm"] ?? null;
    $getKg = $_POST["kg"] ?? null;
    $url = null;
    $json = null;
    $data = null;
    if ($getCm && $getKg) {
        $url = "http://localhost/api/tti/?kg=$getKg&cm=$getCm";
        $json = file_get_contents($url);
        $data = json_decode($json);
    }


    ?>
    <!-- bmi szoveg toblet -->
    <form method="post">
        <label for="">Kg</label>
        <input type="number" id="kg" name="kg"><br><br>
        <label for="">Cm</label>
        <input type="number" id="cm" name="cm">
        <input type="submit" value="Kuldes">
        <div>
         TTI:   <?= $data->tti ?? null  ?><br>
           MINOSITES: <?= $data->minosites ?? null  ?><br>
           TOBBLET: <?= $data->tobblet ?? null  ?><br>

        </div>

    </form>
</body>

</html>