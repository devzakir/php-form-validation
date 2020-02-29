<?php
  include_once('inc/header.php');
  include_once('inc/nav.php');
  include_once('lib/User.php');
  Session::checkSession();
?>
<?php
  if (isset($_GET['id'])){
      $userId = (int)$_GET['id'];
  }
  $user = new User();
  $user = new User();
  if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])){
      $updateusr = $user->updateUser($userId, $_POST);
  };
?>
<div class="container">
  <div class="row">
    <div class="col-12">
      <div class="well">
        <div class="card">
          <h1 class="card-header">
            <div class="row">
              <div class="col-6">
                  User Profile
              </div>
              <div class="col-6 text-right">
                <a href="index.php" class="btn btn-warning">Get Back</a>
              </div>
            </div>
          </h1>
          <div class="card-body profile">
            <div class="row justify-content-center">
              <div class="col-12 col-md-6">
                <?php
                  if(isset($updateusr)){
                    echo $updateusr;
                  }
                  $userdata = $user->getUserById($userId);
                  if ($userdata) {  ?>
                <form method="POST" action="">
                  <div class="form-group">
                    <label for="yourName">Your Name</label>
                    <input type="text" class="form-control" id="yourName" name="name" value="<?php echo $userdata->name; ?>" placeholder="Enter your name" <?php $sesID = Session::get("id"); if(!($userId == $sesID)) {?> readonly <?php } ?> >
                  </div>
                  <div class="form-group">
                    <label for="yourEmail">Your Email</label>
                    <input type="email" class="form-control" id="yourEmail" name="email" value="<?php echo $userdata->email; ?>" placeholder="Enter your email" <?php $sesID = Session::get("id"); if(!($userId == $sesID)) {?> readonly <?php } ?> >
                  </div>
                  <div class="form-group">
                    <label for="yourUsername">Your Username</label>
                    <input type="text" class="form-control" id="yourUsername" name="username" value="<?php echo $userdata->username; ?>" placeholder="Choose username" <?php $sesID = Session::get("id"); if(!($userId == $sesID)) {?> readonly <?php } ?> >
                  </div>
                  <div class="form-group">
                    <label for="yourPassword">Your Password</label>
                    <input class="form-control" id="yourPassword" name="password" placeholder="Enter your Password"  value="<?php echo $userdata->password; ?>" type="password" <?php $sesID = Session::get("id"); if(!($userId == $sesID)) {?> readonly <?php } ?> >
                  </div>
                  </form>
                  <?php
                    $sesID = Session::get("id");
                    if($userId == $sesID){?>
                    <div class="loginHelp">
                      <div class="row">
                        <div class="col-12 text-right">
                          <button type="submit" name="update" class="btn btn-success">
                          Update profile  </button>
                          <a href="changepass?id="></a>
                        </div>
                      </div>
                    </div>
                  <?php } ?>
                </div>
              <?php }?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include_once('inc/footer.php');?>
