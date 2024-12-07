<?php
$page = $pagination['page'] ?? 1; // Current page
$perPage = $pagination['perPage'] ?? 10; // Items per page
$totalItems = $pagination['total'] ?? 0; // Total items from DB
$totalPages = (int) ceil($totalItems / $perPage); // Calculate total pages

// Calculate the page range to display (e.g., 3 pages before and after the current page)
$range = 3;
$start = max(1, $page - $range);
$end = min($totalPages, $page + $range);
?>

<h1>List of Cities</h1>

<ul>
    <?php foreach ($entries as $city) : ?>
        <li>
            <a href="city.php?<?= http_build_query(['id' => e($city->id)]) ?>">
                <?= e($city->getCityWithCountry()) ?>
            </a>
        </li>
    <?php endforeach; ?>
</ul>

<div class="pagination">
    <!-- Previous Page -->
    <?php if ($page > 1) : ?>
        <a href="index.php?<?= http_build_query(['page' => $page - 1]) ?>" class="previous">Prev</a>
    <?php else : ?>
        <span class="disabled previous">Prev</span>
    <?php endif; ?>

    <!-- Page Numbers -->
    <?php if ($start > 1) : ?>
        <a href="index.php?<?= http_build_query(['page' => 1]) ?>">1</a>
        <?php if ($start > 2) : ?>
            <span class="dots">...</span>
        <?php endif; ?>
    <?php endif; ?>

    <?php for ($i = $start; $i <= $end; $i++) : ?>
        <?php if ($i === $page) : ?>
            <span class="active"><?= $i ?></span>
        <?php else : ?>
            <a href="index.php?<?= http_build_query(['page' => $i]) ?>"><?= $i ?></a>
        <?php endif; ?>
    <?php endfor; ?>

    <?php if ($end < $totalPages) : ?>
        <?php if ($end < $totalPages - 1) : ?>
            <span class="dots">...</span>
        <?php endif; ?>
        <a href="index.php?<?= http_build_query(['page' => $totalPages]) ?>"><?= $totalPages ?></a>
    <?php endif; ?>

    <!-- Next Page -->
    <?php if ($page < $totalPages) : ?>
        <a href="index.php?<?= http_build_query(['page' => $page + 1]) ?>" class="next">Next</a>
    <?php else : ?>
        <span class="disabled next">Next</span>
    <?php endif; ?>
</div>
