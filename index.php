<?php
echo mb_chr(127482) . mb_chr(127480);

require __DIR__ . '/inc/all.inc.php';
$worldCityRepository = new WorldCityRepository($pdo);
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max($page, 1);

$perPage = 15;
$entries = $worldCityRepository->paginate($page,$perPage);
$count =  $worldCityRepository->count();





render('index.view', [
    'entries' => $entries,
    'pagination' => [
        'page' => $page,
        'perPage' => $perPage,
        'total' => $count
    ],

]);