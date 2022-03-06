<?php include(INCS . 'header.php'); ?>

<div class="container">
  <div class="book-info">
    <div class="book-cover">
      <img src="../../uploads/<?= $book['image'] ?>" alt="">
    </div>
    <div class="book-det">
      <h4 class="book-title"><?= $book['title'] ?></h4>
      <p class="book-price"><?= $book['price'] ?> Dhs</p>
      <p class="book-desc"><?= $book['description'] ?></p>
      <button class="addCart <?php
                              if (isset($_COOKIE['prods'])) {
                                foreach (json_decode($_COOKIE['prods']) as $p) {
                                  if ($p[0] == $book['id']) {
                                    echo 'added';
                                    break;
                                  }
                                }
                              }
                              ?>" id="addCart" data-prod-id="<?= $book['id'] ?>">Ajouter au panier</button>

    </div>
  </div>
     <h3 class="posts-title">Propositions :</h3>
      <?php if (auth()->isLogged()) : ?>
            <?php if (auth()->isEns() && $ens_status == 1) : ?>
              <div class="makePost">
                <form action="<?php url('posts/store') ?>" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="book_id" value="<?= $book['id'] ?>">
                  <input type="file" name="attachFile" id="attachFile">
                  <textarea name="post_body" id="post_body"></textarea>
                  <button name="create_post">Publier</button>
                </form>
              </div>
            <div class="posts">
              <?php foreach ($posts as $post) : ?>
                <?php if ($post['book_id'] == $book['id']) : ?>
                  <?php if ($post['approve_status'] == 1) : ?>
                    <div class="post">
                      <h6 class="post-author"><?= $post['author'] ?></h6>
                      <p class="post-date"><?= formatDate($post['created_at']) ?></p>
                      <p class="post-desc"><?= $post['body'] ?></p>
                      <?php if (!empty($post['file_path'])) : ?>
                        <br>
                        <a href="../../uploads/<?= $post['file_path'] ?>" download>Telecharger fichier</a>
                      <?php endif ?>
                    </div>
                  <?php endif ?>
                <?php endif ?>
              <?php endforeach ?>
            </div>
            <?php else: ?>
              <div class="container">
              <div class="alert-alert-warning">You are not approved that s why you couldn't see propositions</div>
              </div>
            <?php endif ?>
      <?php endif ?>
</div>
<?php if (auth()->isEns()) : ?>
  <script src="../../assets/js/ckeditor/ckeditor.js"></script>
  <script>
    CKEDITOR.replace("post_body");
  </script>
<?php endif ?>
<?php include(INCS . 'footer.php'); ?>