<h1>Edit City: <?= e($city->getCityWithCountry()); ?></h1>

<form action="edit.php?<?= http_build_query(['id' => $city->id]) ?>" method="post" class="city-form">
    <input type="hidden" name="id" value="<?= e($city->id); ?>">

    <div class="form-group">
        <label for="city">City Name</label>
        <input type="text" id="city" name="city" value="<?= e($city->city); ?>" required>
    </div>

    <div class="form-group">
        <label for="cityAscii">City Name (ASCII)</label>
        <input type="text" id="cityAscii" name="cityAscii" value="<?= e($city->cityAscii); ?>">
    </div>

    <div class="form-group">
        <label>Flag of the Country</label>
        <div class="static-field"><?= e($city->getFlag()); ?></div>
    </div>

    <div class="form-group">
        <label for="country">Country</label>
        <input type="text" id="country" name="country" value="<?= e($city->country); ?>" required>
    </div>

    <div class="form-group">
        <label for="iso2">ISO2 Code of Country</label>
        <input type="text" id="iso2" name="iso2" value="<?= e($city->iso2); ?>" maxlength="2" required>
    </div>

    <div class="form-group">
        <label for="population">Population</label>
        <input type="number" id="population" name="population" value="<?= e($city->population); ?>" min="0">
    </div>

    <div class="form-actions">
        <button type="submit">Save</button>
        <button type="reset">Reset</button>
    </div>
</form>
