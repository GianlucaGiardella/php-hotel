<?php

$hotels = [

    [
        'name' => 'Hotel Belvedere',
        'description' => 'Hotel Belvedere Descrizione',
        'parking' => true,
        'vote' => 4,
        'distance_to_center' => 10.4
    ],
    [
        'name' => 'Hotel Futuro',
        'description' => 'Hotel Futuro Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 2
    ],
    [
        'name' => 'Hotel Rivamare',
        'description' => 'Hotel Rivamare Descrizione',
        'parking' => false,
        'vote' => 1,
        'distance_to_center' => 1
    ],
    [
        'name' => 'Hotel Bellavista',
        'description' => 'Hotel Bellavista Descrizione',
        'parking' => false,
        'vote' => 5,
        'distance_to_center' => 5.5
    ],
    [
        'name' => 'Hotel Milano',
        'description' => 'Hotel Milano Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 50
    ],

];

$parking = isset($_GET['parking']) ? $_GET['parking'] : "all";

$vote = isset($_GET['vote']) ? intval($_GET['vote']) : 0;

$filtered_hotels = array_filter($hotels, function ($hotel) use ($parking, $vote) {

    if ($parking === "all" && $hotel['vote'] >= $vote) {
        return true;
    } else {
        return ($hotel['parking'] == $parking && $hotel['vote'] >= $vote) ? true : false;
    }
});

$no_hotels = "<h2>Non sono stati trovati hotel</h2>";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>PHP Hotel</title>
</head>

<body class="p-2">

    <form action="" method="get" class="mb-5">

        <select name="parking">
            <option value="all" <?= $parking === "all" ? "selected" : "" ?>>Tutti</option>
            <option value="1" <?= $parking === "1" ? "selected" : "" ?>>Si</option>
            <option value="" <?= $parking === "" ? "selected" : "" ?>>No</option>
        </select>

        <input type="number" min="0" max="5" name="vote" value="<?= $vote ?>">

        <button class="btn btn-primary" type="submit">Cerca</button>
        <a href="/php-hotel" class="btn btn-secondary">Resetta</a>

    </form>
    <?php if ($filtered_hotels) { ?>
    <table class="table">

        <thead>
            <tr>
                <th scope="col">Nome</th>
                <th scope="col">Descrizione</th>
                <th scope="col">Parcheggio</th>
                <th scope="col">Voto</th>
                <th scope="col">Distanza dal centro</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($filtered_hotels as $hotel) { ?>
            <tr>
                <td><?= $hotel['name'] ?></td>
                <td><?= $hotel['description'] ?></td>
                <td><?= $hotel['parking'] ? "Si" : "No" ?></td>
                <td><?= $hotel['vote'] ?></td>
                <td><?= $hotel['distance_to_center'] ?>km</td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <?php } else {
        echo $no_hotels;
    } ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
</body>

</html>