<?php include(VIEWS . 'admin' . DS . 'incs' . DS . 'header.view.php'); ?>
<?php
if (isset($_COOKIE['errors'])) {
    $errors = unserialize($_COOKIE['errors']);
}
?>
<?php if (isset($errors['error'])) : ?>
        <div class="alert alert-danger"><?= $errors['error'] ?></div>
<?php endif ?>
<div class="text-nowrap table-responsive my-3">
    <table class="table table-bordered table-hover" id="table">
    <thead class="thead-dark">
        <tr>
        <th scope="col"></th>
        <th scope="col">Book</th>
        <th scope="col">Quantity</th>
        <th scope="col">Client Name</th>
        <th scope="col">Status</th>
        <th scope="col">Ordered In</th>
        <th scope="col">Control Options</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($orders as $order) : ?>
            <tr>
                <td>
                    <img src="../../uploads/<?= $order['book_image'] ?>" alt="cover" width="50px">
                </td>
                <td><?= $order['book_name'] ?></td>
                <td><?= $order['quantity']; ?></td>
                <td><?= $order['client_name']; ?></td>
                <td>
                    <?= $order['status'] == 0 ? '<span class="text-danger">Pending</span>' : '<span class="text-success">Confirmed</span>' ?>
                </td>
                <td><?= $order['created_at'] ?></td>
                <td>
                    <a href="<?php url('orders/show/' . $order['id']); ?>" class="btn btn-sm btn-secondary">View</a>
                    <?php if($order['status'] == 0): ?>
                    <form style="display: inline-block;" action="<?php url('orders/confirm'); ?>" method="post">
                        <input type="hidden" name="order_id" value="<?= $order['id']; ?>">
                        <button class="btn btn-sm btn-success" name="accept_order">Accept</button>
                    </form>
                <?php endif; ?>
                    <form id="del_form_<?= $order['id'] ?>" style="display: inline-block;" action="<?php url('orders/destroy'); ?>" method="post">
                        <input type="hidden" name="order_id" value="<?= $order['id']; ?>">
                    </form>
                    <button class="btn btn-sm btnDel btn-danger" onclick="confirm('Are you sure ?') ? document.getElementById('del_form_<?= $order['id'] ?>').submit() : ''">Delete</button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    </table>
</div>
<?php include(VIEWS . 'admin' . DS . 'incs' . DS . 'footer.view.php'); ?>