<h1>
    City : <?= e($city->getCityWithCountry()); ?>
</h1>
<table>
    <tbody>
    <tr>
        <th>City name</th>
        <td><?= e($city->city) ?></td>
    </tr>
    <tr>
        <th>City name (ascii)</th>
        <td><?= e($city->cityAscii) ?></td>
    </tr>
    <tr>
        <th>Flag of the Country</th>
        <td><?= e($city->getFlag()) ?></td>
    </tr>
    <tr>
        <th>Country</th>
        <td><?= e($city->country) ?></td>
    </tr>
    <tr>
        <th>ISC02 code of country</th>
        <td><?= e($city->iso2) ?></td>
    </tr>
    <tr>
        <th>Population</th>
        <td><?= e($city->population) ?></td>
    </tr>
    </tbody>
</table>