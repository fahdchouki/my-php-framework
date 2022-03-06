<?php include(VIEWS . 'admin' . DS . 'incs' . DS . 'header.view.php'); 
$cities = getCities();
?>
<div class="pin-cities-block my-3 card p-2">
    <form action="<?php url('messages/assign_city') ?>" method="post">
        <select name="subAdmin_id" id="" class="form-control my-3">
            <option hidden >-- Representant --</option>
            <?php foreach($subAdmins as $sa): ?>
                <option value="<?= $sa['id'] ?>"><?= $sa['username'] ?></option>
            <?php endforeach ?>
        </select>
        <select name="city_id" id="" class="form-control my-3">
            <option hidden >-- Ville a assigner --</option>
            <?php foreach($cities as $city): ?>
                <option value="<?= $city['id'] ?>"><?= $city['ville'] ?></option>
            <?php endforeach ?>
        </select>
        <button type="submit" name="submit" class="btn btn-sm btn-primary my-2">Assigner</button>
    </form>
</div>
<?php foreach($subAdmins as $sa): ?>
    <div class="user-block">
        <h4><?= $sa['username'] ?> :</h4>
        <?php foreach($cities as $city): ?>
            <?php if(in_array($city['id'],explode(',',$sa['resp_cities']))) : ?>
                <form action="<?php url('messages/delete_city') ?>" method="post" class="d-inline-block">
                    <input type="hidden" name="city_id" value="<?= $city['id'] ?>">
                    <input type="hidden" name="resp_id" value="<?= $sa['id'] ?>">
                    <span class="btn btn-sm btn-dark m-2 p-2"><?= $city['ville'] ?><button type="submit" name="submit" class="btn btn-sm btn-danger ml-2 py-0 px-2 rounded-circle">&times;</button></span>
                </form>
            <?php endif ?>
        <?php endforeach ?>
    </div>
<?php endforeach ?>
<?php include(VIEWS . 'admin' . DS . 'incs' . DS . 'footer.view.php'); ?>