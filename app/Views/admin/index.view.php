<?php include(VIEWS . 'admin' . DS . 'incs' . DS . 'header.view.php'); ?>
<div class="row">
  <div class="col-lg-3 col-md-6 col-sm-6">
    <div class="card card-stats">
      <div class="card-header">
        <div class="icon icon-warning">
          <span class="material-icons">equalizer</span>
        </div>
      </div>
      <div class="card-content">
        <p class="category"><strong>Books</strong></p>
        <h3 class="card-title"><?= count($books) ?></h3>
      </div>
      <div class="card-footer">
        <div class="stats">
          <i class="material-icons text-warning">info</i>
          <a href="<?php url('books') ?>">See detailed report</a>
        </div>
      </div>
    </div>
  </div>
  <?php if(auth()->isAdmin()) : ?>
  <div class="col-lg-3 col-md-6 col-sm-6">
    <div class="card card-stats">
      <div class="card-header">
        <div class="icon icon-rose">
          <span class="material-icons">shopping_cart</span>
        </div>
      </div>
      <div class="card-content">
        <p class="category"><strong>Orders</strong></p>
        <h3 class="card-title"><?= count($orders) ?></h3>
      </div>
      <div class="card-footer">
        <div class="stats">
          <i class="material-icons text-danger">local_offer</i>
          <a href="<?php url('orders') ?>">See detailed report</a>
        </div>
      </div>
    </div>
  </div>
  <?php endif ?>
  <div class="col-lg-3 col-md-6 col-sm-6">
    <div class="card card-stats">
      <div class="card-header">
        <div class="icon icon-info">
          <span class="material-icons"> follow_the_signs </span>
        </div>
      </div>
      <div class="card-content">
        <p class="category"><strong>Teachers</strong></p>
        <h3 class="card-title"><?= count($teachers) ?></h3>
      </div>
      <div class="card-footer">
        <div class="stats">
          <i class="material-icons text-info">update</i>
          <a href="<?php url('users') ?>">See detailed report</a>
        </div>
      </div>
    </div>
  </div>
  <?php if(auth()->isAdmin()) : ?>
  <div class="col-lg-3 col-md-6 col-sm-6">
    <div class="card card-stats">
      <div class="card-header">
        <div class="icon icon-success">
          <span class="material-icons"> mail </span>
        </div>
      </div>
      <div class="card-content">
        <p class="category"><strong>Messages</strong></p>
        <h3 class="card-title"><?= count($messages) ?></h3>
      </div>
      <div class="card-footer">
        <div class="stats">
          <i class="material-icons text-success">date_range</i>
          <a href="<?php url('messages') ?>">See detailed report</a>
        </div>
      </div>
    </div>
  </div>
  <?php endif ?>
</div>

<div class="row">
  <div class="col col-md-6 col-sm-12">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title" style="font-weight: bold;">Latest 5 Teachers</h6>
        <div class="table-responsive text-nowrap">
          <table class="table table-hover table-bordered">
            <tr>
              <th>Fullname</th>
              <th>Quick Actions</th>
            </tr>
              <?php 
              $counter = 0;
              foreach ($teachers as $user){
                if($counter < 5){$counter++;}else{break;}
              ?>
                <tr>
                  <td><?= $user['fullname']; ?></td>
                  <td>
                    <a href="<?php url('users/show/' . $user['username']); ?>" class="btn btn-sm btn-secondary">View</a>
                    <?php if ($user['approve_status'] == 0) : ?>
                      <form style="display: inline-block;" action="<?php url('users/update'); ?>" method="post">
                        <input type="hidden" name="user_id" value="<?= $user['id']; ?>">
                        <button class="btn btn-sm btn-success" name="accept_user">Accept</button>
                      </form>
                    <?php endif; ?>
                  </td>
                </tr>
              <?php } ?>
          </table>
        </div>
      </div>
    </div>
  </div>
  <?php if(auth()->isAdmin()) : ?>
  <div class="col col-md-6 col-sm-12">
    <div class="card">
      <div class="card-body">
      <h6 class="card-title" style="font-weight: bold;">Latest 5 Orders</h6>
        <div class="table-responsive text-nowrap">
          <table class="table table-hover table-bordered">
            <th>Book</th>
            <th>Quantity</th>
            <th>Quick Actions</th>
              <?php 
              $counter = 0;
              foreach ($orders as $order){
                if($counter < 5){$counter++;}else{break;}
              ?>
                <tr>
                <td>
                    <img src="../../uploads/<?= $order['book_image'] ?>" alt="cover" width="40px">
                </td>
                <td><?= $order['quantity']; ?></td>
                <td>
                    <a href="<?php url('orders/show/' . $order['id']); ?>" class="btn btn-sm btn-secondary">View</a>
                    <?php if($order['status'] == 0): ?>
                    <form style="display: inline-block;" action="<?php url('orders/confirm'); ?>" method="post">
                        <input type="hidden" name="order_id" value="<?= $order['id']; ?>">
                        <button class="btn btn-sm btn-success" name="accept_order">Accept</button>
                    </form>
                <?php endif; ?>
                </td>
            </tr>
              <?php } ?>
          </table>
        </div>
      </div>
    </div>
  </div>
  <?php endif ?>
</div>

<?php include(VIEWS . 'admin' . DS . 'incs' . DS . 'footer.view.php'); ?>