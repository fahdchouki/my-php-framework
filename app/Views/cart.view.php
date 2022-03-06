<?php include(INCS . 'header.php'); ?>

<div class="container">
<?php if(!empty($cartProds)) : ?>
    <div class="cart">
        <div class="products" id="productsParent">
            <?php foreach($cartProds as $prod) : ?>
                <?php foreach($books as $book) : ?>
                    <?php if($prod[0] == $book['id']) : ?>
                        <div class="product" data-prodid="<?= $book['id'] ?>">
                            <div class="prod-cover">
                                <img src="../../uploads/<?= $book['image'] ?>" />
                            </div>
                            <div class="product-info">

                                <h5 class="product-name"><?= $book['title'] ?></h5>

                                <h6 class="product-price" data-price="<?= $book['price'] ?>"><?= $book['price'] ?> Dhs</h6>

                                <p class="product-quantity">Quantite : <input type="number" min="1" oninput="getInfo()" value="<?= $prod[1] ?>" name="" class="input prodCount" /></p>

                            </div>
                            <span class="remove fa fa-times" onclick="this.parentElement.classList.add('moved');this.parentElement.remove();"></span>
                        </div>
                <?php endif ?>
                <?php endforeach ?>
            <?php endforeach ?>
        </div>
        <div class="cart-total">
            <p>
                <label>Le total a payer : </label>
                <span id="totalPrice">0</span>
            </p>
            <p>
                <label>Nombre d'elements : </label>
                <span id="totalItems">0</span>
            </p>
            <form action="<?php url('orders/store') ?>" method="post">
                <input type="text" class="input" name="fullname" placeholder="Your name">
                <input type="email" class="input" name="email" placeholder="Your email">
                <input type="text" class="input" name="phone" placeholder="Your phone">
                <input type="text" class="input" name="address" placeholder="Your address">
                <button class="checkoutBtn" name="checkout">Checkout</button>
            </form>
        </div>
    </div>
<?php else : ?>
    <div class="alert alert-secondary" style="margin-top: 110px;">Panier est vide</div>
<?php endif ?>
</div>
<script>
    let x = new MutationObserver(function(e) {
        if (e[0].removedNodes){
            getInfo();
            if(document.getElementById("productsParent").childElementCount < 1){
                window.location.reload();
            }
        }
    });

    x.observe(document.getElementById("productsParent"), {
        childList: true
    });
</script>
<?php include(INCS . 'footer.php'); ?>