<?php

require __DIR__ . '/inc/all.inc.php';
$newWorldCityRepository = new WorldCityRepository($pdo);
$city = $newWorldCityRepository->fetchById((int)($_GET['id']) ?? 0);

if (!$city) {
    header('Location: index.php');
    exit;
}

render('city.view', [
    'city' => $city,
]);