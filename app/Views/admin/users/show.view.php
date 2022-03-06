<?php include(VIEWS . 'admin' . DS . 'incs' . DS . 'header.view.php'); ?>
<div class="container">
    <div class="card">
        <div class="card-body">
            <p><b>fullname : </b><?= $user['fullname'] ?></p>
            <p><b>username : </b><?= $user['username'] ?></p>
            <p><b>email : </b><?= $user['email'] ?></p>
            <p><b>phone : </b><?= $user['phone'] ?></p>
            <p><b>city : </b><?= $user['city'] ?></p>
            <p><b>schools : </b><?= $user['school'] ?></p>
            <p><b>class : </b><?= $user['class'] ?></p>
            <p><b>role : </b>
                <?php
                    if ($user['role'] == 1) echo "Admin";
                    if ($user['role'] == 2) echo "Sous Admin";
                    if ($user['role'] == 3) echo "Enseignant";
                ?>
            </p>
            <p><b>Joined Date : </b><?= $user['created_at'] ?></p>
            <div class="container text-right my-2">
            <?php if($user['approve_status'] == 0): ?>
                    <form style="display: inline-block;" action="<?php url('users/update'); ?>" method="post">
                        <input type="hidden" name="user_id" value="<?= $user['id']; ?>">
                        <button class="btn btn-sm btn-success" name="accept_user">Accept</button>
                    </form>
                <?php endif; ?>
                <?php if(auth()->isAdmin() && $user['role'] != 1) : ?>
                    <form id="del_form_<?= $user['id'] ?>" style="display: inline-block;" action="<?php url('users/destroy'); ?>" method="post">
                        <input type="hidden" name="user_id" value="<?= $user['id']; ?>">
                    </form>
                    <button class="btn btn-sm btnDel btn-danger" onclick="confirm('Are you sure ?') ? document.getElementById('del_form_<?= $user['id'] ?>').submit() : ''">Delete</button>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php include(VIEWS . 'admin' . DS . 'incs' . DS . 'footer.view.php'); ?>