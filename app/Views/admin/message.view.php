<?php include(VIEWS . 'admin' . DS . 'incs' . DS . 'header.view.php'); ?>
<?php
if (isset($_COOKIE['errors'])) {
    $errors = unserialize($_COOKIE['errors']);
}
?>
<?php if (isset($errors['error'])) : ?>
        <div class="alert alert-danger"><?= $errors['error'] ?></div>
    <?php endif ?>
<div class="container">
    <div class="card my-3">
        <div class="card-body">
            <p><b>Sender : </b><?= $msg['name'] ?></p>
            <p><b>Phone : </b><?= $msg['phone'] ?></p>
            <p><b>Email : </b><?= $msg['email'] ?></p>
            <p><b>City : </b><?php
                        foreach(getCities() as $city){
                            if($msg['city_id'] == $city['id']){
                                echo $city['ville'];
                            }
                        }
                    ?></p>
            <p><b>Subject : </b><?= $msg['subject'] ?></p>
        </div>
        <div class="card-body">
            <p><?= $msg['message'] ?></p>
            <p class="text-right"><b><?= $msg['created_at'] ?></b></p>
        </div>
        <div class="card-body">
            <?php if(isset($msg['email'])) : ?>
                <a href="mailto:<?= $msg['email'] ?>" target="_blank" class="text-white btn btn-sm btn-warning">Repondre</a>
            <?php endif ?>
            <?php if(isset($msg['phone'])) : ?>
                <a href="tel:<?= $msg['phone'] ?>" target="_blank" class="btn btn-sm btn-secondary">Telephoner</a>
            <?php endif ?>
            <form id="del_form_<?= $msg['id'] ?>" style="display: inline-block;" action="<?php url('messages/destroy'); ?>" method="post">
                <input type="hidden" name="msg_id" value="<?= $msg['id']; ?>">
            </form>
            <button class="btn btn-sm btnDel btn-danger" onclick="confirm('Are you sure ?') ? document.getElementById('del_form_<?= $msg['id'] ?>').submit() : ''">Delete</button>
        </div>
    </div>
</div>
<?php include(VIEWS . 'admin' . DS . 'incs' . DS . 'footer.view.php'); ?>