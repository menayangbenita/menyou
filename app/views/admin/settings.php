<?php Get::view('templates/header', $data) ?>

<form class="container-md overflow-hidden" action="<?= BASEURL ?>/settings/update" method="post">
    <?= csrf() ?>
    <?php foreach ($data['categories'] as $category) : ?>
        <h2 class="border-bottom py-3 mb-3"><?= $category ?> Settings</h2>

        <?php foreach($data['preferences'] as $preference) : ?>
            <?php if ($preference['category'] != $category) continue; ?>
            <div class="mb-1">
                <label for="<?= $preference['setting'] ?>" class="form-label"><?= str_replace('_', ' ', $preference['setting']) ?></label>
                <input type="text" class="form-control" id="<?= $preference['setting'] ?>" name="<?= $preference['setting'] ?>" value="<?= $preference['value'] ?>">
            </div>
        <?php endforeach; ?>
    <?php endforeach; ?>

    <br>
    <button type="submit" class="btn bg-gradient-primary float-end" onclick="return confirm('Apakah anda yakin ingin menyimpan perubahan?')">
        <i class="fa fa-save me-2"></i>
        Save
    </button>
</form>

<?php Get::view('templates/footer', $data) ?>