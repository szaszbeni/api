<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Névnap kereső</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            margin: 0;
            padding: 0;
            background-color: #f3f4f6;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 2rem;
        }

        h1 {
            margin-bottom: 2rem;
            font-size: 2rem;
            color: #111827;
        }

        .container {
            display: flex;
            flex-direction: column;
            gap: 2rem;
            width: 100%;
            max-width: 500px;
            background: white;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        label {
            font-weight: 600;
            color: #374151;
        }

        input[type="text"] {
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            font-size: 1rem;
        }

        input[type="submit"] {
            background-color: #2563eb;
            color: white;
            padding: 0.75rem;
            border: none;
            border-radius: 0.5rem;
            cursor: pointer;
            font-weight: 600;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #1d4ed8;
        }

        .result {
            padding: 1rem;
            background-color: #e5e7eb;
            border-radius: 0.5rem;
            font-size: 1rem;
            color: #111827;
            white-space: pre-wrap;
        }

        @media (max-width: 600px) {
            body {
                padding: 1rem;
            }

            .container {
                padding: 1.5rem;
            }

            h1 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>

<h1>Névnap kereső</h1>

<?php
$adat = null;
$milyen = null;
$data = null;

// Ellenőrzés és API URL meghatározás
if (isset($_POST["datum"]) && $_POST["datum"] !== "") {
    $adat = $_POST["datum"];
    $milyen = "nap";
} elseif (isset($_POST["nev"]) && $_POST["nev"] !== "") {
    $adat = $_POST["nev"];
    $milyen = "nev";
}

// API hívás
if ($adat) {
    $url = "http://localhost/api/nevnapok/?$milyen=" . urlencode($adat);
} else {
    $url = "http://localhost/api/nevnapok/";
}

$json = @file_get_contents($url);
if ($json !== false) {
    $data = json_decode($json);
}
?>

<div class="container">

    <!-- Dátum alapú keresés -->
    <form method="post" action="main.php">
        <label for="datum">Keresés dátum alapján (pl. 4-20)</label>
        <input name="datum" type="text" placeholder="pl. 4-20">
        <input type="submit" value="Keresés">

        <?php if (isset($_POST["datum"])): ?>
            <?php if ($data && isset($data->nevnap1)): ?>
                <div class="result">
                    <strong><?= $data->datum ?>:</strong> <?= $data->nevnap1 ?><?= isset($data->nevnap2) ? ", " . $data->nevnap2 : "" ?>
                </div>
            <?php elseif ($data && isset($data->hiba)): ?>
                <div class="result">Hiba: <?= $data->hiba ?></div>
            <?php elseif ($data && isset($data->minta1)): ?>
                <div class="result"><?= json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) ?></div>
            <?php endif; ?>
        <?php endif; ?>
    </form>

    <!-- Név alapú keresés -->
    <form method="post" action="main.php">
        <label for="nev">Keresés név alapján (pl. Katalin)</label>
        <input name="nev" type="text" placeholder="pl. Katalin">
        <input type="submit" value="Keresés">

        <?php if (isset($_POST["nev"])): ?>
            <?php if ($data && isset($data->nev)): ?>
                <div class="result">
                    <strong><?= $data->nev ?> névnapja:</strong> <?= $data->datum ?>
                </div>
            <?php elseif ($data && isset($data->hiba)): ?>
                <div class="result">Hiba: <?= $data->hiba ?></div>
            <?php elseif ($data && isset($data->minta1)): ?>
                <div class="result"><?= json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) ?></div>
            <?php endif; ?>
        <?php endif; ?>
    </form>

</div>

</body>
</html>
