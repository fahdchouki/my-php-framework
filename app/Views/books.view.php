<?php include(INCS . 'header.php'); ?>
<div class="search-box">
    <div class="container">
        <form action="<?php url('books') ?>" method="get">
            <input type="text" name="query_search" value="<?= isset($_GET['query_search']) && !empty($_GET['query_search']) ? filterString($_GET['query_search']) : '' ?>" placeholder="tapez..">
            <button><i class="fa fa-search"></i></button>
        </form>
    </div>
</div>
<!-- books cards -->
<div class="container books">
    <div class="cards row justify-content-start">
        <?= isset($result) ? '<div class="alert alert-secondary">Aucun Resultat</div>': '' ?>
        <?php foreach ($books_cats_null as $book) : ?>
            <?php if ($book['pub_status'] == 1) : ?>
                <div class="col-md-4 col-lg-3 col-sm-6">
                    <div class="card" data-prod-id="<?= $book['id'] ?>" data-tilt data-tilt-perspective="1100" style="width: 14rem;">
                        <div class="book-cover">
                            <a href="<?php url('books/' . $book['slug']) ?>"><img src="../../uploads/<?= $book['image'] ?>" class="card-img-top" alt="book cover"></a>
                        </div>
                        <div class="card-body">
                            <h6 class="book-title"><a href="<?php url('books/' . $book['slug']) ?>"><?= $book['title'] ?></a></h6>
                        </div>
                        <span class="bk-price"><?= $book['price'] ?> Dhs</span>
                        <span class="addCart <?php
                                                    if (isset($_COOKIE['prods'])) {
                                                        foreach (json_decode($_COOKIE['prods']) as $p) {
                                                            if ($p[0] == $book['id']) {
                                                                echo 'added';
                                                                break;
                                                            }
                                                        }
                                                    }
                                                    ?>">Ajouter au panier</span>
                    </div>
                </div>
            <?php endif ?>
        <?php endforeach; ?>
    </div>
    <?php foreach ($cats as $cat) : ?>
        <h5 class="category-title mt-5"><?= $cat['name'] ?> :</h5>
        <span class="line"></span>
        <div class="cards row justify-content-start">
            <?php foreach ($books as $book) : ?>
                <?php if ($book['pub_status'] == 1 && $book['category_id'] == $cat['id']) : ?>
                    <div class="col-md-4 col-lg-3 col-sm-6">
                        <div class="card" data-prod-id="<?= $book['id'] ?>" data-tilt data-tilt-perspective="1100" style="width: 14rem;">
                            <div class="book-cover">
                                <a href="<?php url('books/' . $book['slug']) ?>"><img src="../../uploads/<?= $book['image'] ?>" class="card-img-top" alt="book cover"></a>
                            </div>
                            <div class="card-body">
                                <h6 class="book-title"><a href="<?php url('books/' . $book['slug']) ?>"><?= $book['title'] ?></a></h6>
                            </div>
                            <span class="bk-price"><?= $book['price'] ?> Dhs</span>
                            <span class="addCart <?php
                                                    if (isset($_COOKIE['prods'])) {
                                                        foreach (json_decode($_COOKIE['prods']) as $p) {
                                                            if ($p[0] == $book['id']) {
                                                                echo 'added';
                                                                break;
                                                            }
                                                        }
                                                    }
                                                    ?>">Ajouter au panier</span>
                        </div>
                    </div>
                <?php endif ?>
            <?php endforeach; ?>
        </div>
    <?php endforeach; ?>

</div>
<!-- end books cards -->
<?php include(INCS . 'footer.php'); ?>