<?php include(INCS . 'header.php'); ?>

<div class="container">
    <div class="book-info">
        <div class="book-cover">
            <img src="../../uploads/<?= $app['apk_image'] ?>" alt="">
        </div>
        <div class="book-det">
            <h4 class="book-title"><?= $app['title'] ?></h4>
            <p class="book-desc"><?= $app['description'] ?></p>
            <?php if (!empty($app['apk_path'])) : ?>
                <a href="../../uploads/<?= $app['apk_path'] ?>" download class="downloadLink"><i class="fa fa-download"></i> Telecharger</a>
            <?php endif; ?>
            <?php if (!empty($app['apk_link'])) : ?>
                <a href="<?= $app['apk_link'] ?>" class="playStoreLink"><i class="fa fa-play"></i> Telecharger de Play Store</a>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php include(INCS . 'footer.php'); ?>