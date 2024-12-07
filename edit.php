<?php

require __DIR__ . '/inc/all.inc.php';
$worldCityRepository = new WorldCityRepository($pdo);
$id = (int)($_GET['id']) ?? 0;
$loadedCity = $worldCityRepository->fetchById($id);

if (!$loadedCity) {
    header('Location: index.php');
    exit;
}
if (!empty($_POST)) {
    $city = (string)$_POST['city'] ?? '';
    $cityAscii = (string)$_POST['cityAscii'] ?? '';
    $country = (string)$_POST['country'] ?? '';
    $iso2 = (string)$_POST['iso2'] ?? '';
    $population = (int)$_POST['population'] ?? '';

    if (empty($city) || empty($cityAscii) || empty($country) || empty($iso2)) {
        header('Location: index.php');
        exit;
    }
    $loadedCity = $worldCityRepository->update($id, [
        'city' => $city,
        'cityAscii' => $cityAscii,
        'country' => $country,
        'iso2' => $iso2,
        'population' => $population
    ]);

}


render('edit.view', [
    'city' => $loadedCity,
]);