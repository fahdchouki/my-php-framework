<?php include(VIEWS . 'admin' . DS . 'incs' . DS . 'header.view.php'); ?>
<?php
if (isset($_COOKIE['errors'])) {
    $errors = unserialize($_COOKIE['errors']);
}
?>
<?php if (isset($errors['error'])) : ?>
        <div class="alert alert-danger"><?= $errors['error'] ?></div>
    <?php endif ?>
<div class="container text-center">
    <h4 class="my-2 text-center"><?= $order['book_name'] ?></h4>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col col-md-6 col-sm-12">
                    <img src="../../uploads/<?= $order['book_image'] ?>" alt="" height="200px" class="d-block mx-auto">
                </div>
                <div class="col col-md-6 col-sm-12">
                    <p><b>Quantity : </b><?= $order['quantity'] ?></p>
                    <p><b>Client Name : </b><?= $order['client_name'] ?></p>
                    <p><b>Phone : </b><?= $order['client_phone'] ?></p>
                    <p><b>Email : </b><?= $order['client_email'] ?></p>
                    <p><b>Address : </b><?= $order['client_address'] ?></p>
                    <p><b>Date : </b><?= $order['created_at'] ?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="container my-3">
        <?php if ($order['status'] == 0) : ?>
            <form style="display: inline-block;" action="<?php url('orders/confirm'); ?>" method="post">
                <input type="hidden" name="order_id" value="<?= $order['id']; ?>">
                <button class="btn btn-sm btn-success" name="accept_order">Accept</button>
            </form>
        <?php endif; ?>
        <form id="del_form_<?= $order['id'] ?>" style="display: inline-block;" action="<?php url('orders/destroy'); ?>" method="post">
            <input type="hidden" name="order_id" value="<?= $order['id']; ?>">
        </form>
        <button class="btn btn-sm btnDel btn-danger" onclick="confirm('Are you sure ?') ? document.getElementById('del_form_<?= $order['id'] ?>').submit() : ''">Delete</button>
    </div>
</div>
<?php include(VIEWS . 'admin' . DS . 'incs' . DS . 'footer.view.php'); ?>