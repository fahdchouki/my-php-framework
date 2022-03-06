<?php include(VIEWS . 'admin' . DS . 'incs' . DS . 'header.view.php'); ?>
<?php if(auth()->isAdmin()) : ?>
<a href="<?php url('books/create'); ?>" class="btn btn-outline-primary">Create Book</a>
    <?php if (isset($errors['error'])) : ?>
        <div class="alert alert-danger"><?= $errors['error'] ?></div>
    <?php endif ?>
<?php endif; ?>
<div class="text-nowrap table-responsive my-3">
 <table class="table table-bordered table-hover" id="table">
    <thead class="thead-dark">
        <tr>
        <th scope="col"></th>
        <th scope="col">Title</th>
        <th scope="col">Description</th>
        <th scope="col">Status</th>
        <th scope="col">Price</th>
        <th scope="col">Responsable</th>
        <th scope="col">Category</th>
        <th scope="col">Created In</th>
        <?php if(auth()->isAdmin()) : ?>
            <th scope="col">Control Options</th>
        <?php endif; ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach($books as $book) : ?>
            <tr>
                <td>
                    <img src="../../uploads/<?= $book['image'] ?>" alt="cover" width="50px">
                </td>
                <td><?= $book['title'] ?></td>
                <td><?= excerpt($book['description']); ?></td>
                <td>
                    <?= $book['pub_status'] == 0 ? '<span class="text-danger">Draft</span>' : '<span class="text-success">Public</span>'; ?>
                </td>
                <td><?= $book['price']; ?></td>
                <td><?= $book['rep_name']; ?></td>
                <td><?= $book['cat_name']; ?></td>
                <td><?= $book['created_at'] ?></td>
                <?php if(auth()->isAdmin()) : ?>
                <td>
                    <a href="<?php url('books/edit/' . $book['slug']); ?>" class="btn btn-sm btn-success">Edit</a>
                    <form id="del_form_<?= $book['id'] ?>" style="display: inline-block;" action="<?php url('books/destroy'); ?>" method="post">
                        <input type="hidden" name="book_id" value="<?= $book['id']; ?>">
                        <input type="hidden" name="book_img" value="<?= $book['image']; ?>">
                    </form>
                    <button class="btn btn-sm btnDel btn-danger" onclick="confirm('Are you sure ?') ? document.getElementById('del_form_<?= $book['id'] ?>').submit() : ''">Delete</button>
                </td>
                <?php endif ?>
            </tr>
        <?php endforeach; ?>
        <?php foreach($books_cats_null as $book) : ?>
            <tr>
                <td>
                    <img src="../../uploads/<?= $book['image'] ?>" alt="cover" width="50px">
                </td>
                <td><?= $book['title'] ?></td>
                <td><?= excerpt($book['description']); ?></td>
                <td>
                    <?= $book['pub_status'] == 0 ? '<span class="text-danger">Draft</span>' : '<span class="text-success">Public</span>' ?>
                </td>
                <td><?= $book['price']; ?></td>
                <td><?php 
                    foreach($users as $user){
                        if($user['id'] == $book['resp_user_id']){
                            echo $user['fullname'];
                            break;
                        }
                        echo $user['role'] == 1 ? $user['fullname'] :'';
                    }
                ?></td>
                <td>Uncategorized</td>
                <td><?= $book['created_at'] ?></td>
                <?php if(auth()->isAdmin()) : ?>
                <td>
                    <a href="<?php url('books/edit/' . $book['slug']); ?>" class="btn btn-sm btn-success">Edit</a>
                    <form id="del_form_<?= $book['id'] ?>" style="display: inline-block;" action="<?php url('books/destroy'); ?>" method="post">
                        <input type="hidden" name="book_id" value="<?= $book['id']; ?>">
                        <input type="hidden" name="book_img" value="<?= $book['image']; ?>">
                    </form>
                    <button class="btn btn-sm btnDel btn-danger" onclick="confirm('Are you sure ?') ? document.getElementById('del_form_<?= $book['id'] ?>').submit() : ''">Delete</button>
                </td>
                <?php endif ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
    </table>
</div>
<?php include(VIEWS . 'admin' . DS . 'incs' . DS . 'footer.view.php'); ?>