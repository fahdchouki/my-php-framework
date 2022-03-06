<?php include(INCS . 'header.php'); ?>

<div class="search-box">
    <div class="container">
        <form action="<?php url('apps') ?>" method="get">
            <input type="text" name="query_search" value="<?= isset($_GET['query_search']) && !empty($_GET['query_search']) ? filterString($_GET['query_search']) : '' ?>" placeholder="tapez..">
            <button><i class="fa fa-search"></i></button>
        </form>
    </div>
</div>
<!-- apps cards -->
<div class="container apps">
    <div class="cards row justify-content-start">
        <?= isset($result) ? '<div class="alert alert-secondary">Aucun Resultat</div>' : '' ?>
        <?php foreach ($apps_cats_null as $app) : ?>
            <?php if ($app['status'] == 1) : ?>
                <div class="col-md-4 col-lg-3 col-sm-6">
                    <div class="card" data-tilt data-tilt-perspective="1100" style="width: 11rem">
                        <div class="app-cover">
                            <a href="<?php url('apps/' . $app['slug']) ?>"><img src="../../uploads/<?= $app['apk_image'] ?>" class="card-img-top" alt="..." /></a>
                        </div>
                        <div class="card-body">
                            <h6 class="app-title"><a href="<?php url('apps/' . $app['slug']) ?>"><?= $app['title'] ?></a></h6>
                        </div>
                        <div class="links">
                            <?php if (!empty($app['apk_path'])) : ?>
                                <a href="../../uploads/<?= $app['apk_path'] ?>" download class="downloadLink"><i class="fa fa-download"></i></a>
                            <?php endif; ?>
                            <?php if (!empty($app['apk_link'])) : ?>
                                <a href="<?= $app['apk_link'] ?>" class="playStoreLink"><i class="fa fa-play"></i></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endif ?>
        <?php endforeach; ?>
    </div>
    <?php foreach ($cats as $cat) : ?>
        <h5 class="category-title mt-5"><?= $cat['name'] ?> :</h5>
        <span class="line"></span>
        <div class="cards row justify-content-start">
            <?php foreach ($apps as $app) : ?>
                <?php if ($app['status'] == 1 && $app['category_id'] == $cat['id']) : ?>
                    <div class="col-md-4 col-lg-3 col-sm-6">
                        <div class="card" data-tilt data-tilt-perspective="1100" style="width: 11rem">
                            <div class="app-cover">
                                <a href="<?php url('apps/' . $app['slug']) ?>"><img src="../../uploads/<?= $app['apk_image'] ?>" class="card-img-top" alt="..." /></a>
                            </div>
                            <div class="card-body">
                                <h6 class="app-title"><a href="<?php url('apps/' . $app['slug']) ?>"><?= $app['title'] ?></a></h6>
                            </div>
                            <div class="links">
                                <?php if (!empty($app['apk_path'])) : ?>
                                    <a href="../../uploads/<?= $app['apk_path'] ?>" download class="downloadLink"><i class="fa fa-download"></i></a>
                                <?php endif; ?>
                                <?php if (!empty($app['apk_link'])) : ?>
                                    <a href="<?= $app['apk_link'] ?>" class="playStoreLink"><i class="fa fa-play"></i></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endif ?>
            <?php endforeach; ?>
        </div>
    <?php endforeach; ?>
</div>
<!-- end apps cards -->
<?php include(INCS . 'footer.php'); ?>