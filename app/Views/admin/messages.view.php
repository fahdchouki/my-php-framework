<?php include(VIEWS . 'admin' . DS . 'incs' . DS . 'header.view.php'); ?>
<?php
if (isset($_COOKIE['errors'])) {
    $errors = unserialize($_COOKIE['errors']);
}
?>
<?php if (isset($errors['error'])) : ?>
        <div class="alert alert-danger"><?= $errors['error'] ?></div>
<?php endif ?>
<?php if(auth()->isAdmin()) : ?>
    <a href="<?php url('messages/resp_messages') ?>" class="btn btn-sm btn-primary">Modifier Les Representants</a>
<?php endif ?>
<div class="text-nowrap table-responsive">
    <table class="table table-bordered table-hover my-3">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Sender</th>
                <th scope="col">Subject</th>
                <th scope="col">City</th>
                <th scope="col">Message</th>
                <th scope="col">Received At</th>
                <th scope="col">Control Options</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($msgs as $msg) : ?>
                <tr>
                    <td><?= $msg['name']; ?></td>
                    <td><?= $msg['subject']; ?></td>
                    <td><?php
                        foreach(getCities() as $city){
                            if($msg['city_id'] == $city['id']){
                                echo $city['ville'];
                            }
                        }
                    ?></td>
                    <td><?= excerpt($msg['message']); ?></td>
                    <td><?= $msg['created_at']; ?></td>
                    <td>
                        <a href="<?php url('messages/show/' . $msg['id']); ?>" class="btn btn-sm btn-secondary">View</a>
                        <form id="del_form_<?= $msg['id'] ?>" style="display: inline-block;" action="<?php url('messages/destroy'); ?>" method="post">
                            <input type="hidden" name="msg_id" value="<?= $msg['id']; ?>">
                        </form>
                        <button class="btn btn-sm btnDel btn-danger" onclick="confirm('Are you sure ?') ? document.getElementById('del_form_<?= $msg['id'] ?>').submit() : ''">Delete</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php include(VIEWS . 'admin' . DS . 'incs' . DS . 'footer.view.php'); ?>