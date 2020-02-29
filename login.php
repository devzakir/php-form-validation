<?php
    include_once('inc/header.php');
    include_once('inc/nav.php');
    include_once('lib/User.php');
    Session::checkLogin();
?>
<?php
    $user = new User();
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $usrLogin = $user->userLogin($_POST);
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
                  Account Login
              </div>
              <div class="col-6 text-right">
                <a href="index.php" class="btn btn-warning">Get Back</a>
              </div>
            </div>
          </h1>
          <div class="card-body">
            <div class="row justify-content-center">
              <div class="col-12 col-md-6">
                  <?php
                      if(isset($usrLogin)){
                          echo $usrLogin;
                      }
                  ?>
                <form method="POST" action="">
                  <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Enter email">
                  </div>
                  <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Enter Password">
                  </form>
                  <div class="loginHelp">
                    <div class="row">
                      <div class="col-6">
                        <button type="submit" name="submit" class="btn btn-success">
                        Submit  </button>
                      </div>
                      <div class="col-6 text-right">
                        <a href="#" class="btn ">Forget password?</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<?php include_once('inc/footer.php') ?>
