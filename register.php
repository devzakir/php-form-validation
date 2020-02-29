<?php
include_once('inc/header.php');
include_once('inc/nav.php');
include_once('lib/User.php');
?>
<?php
    $user = new User();
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $usrRegi = $user->userRegistration($_POST);
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
                  Register Here
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
                    if(isset($usrRegi)){
                        echo $usrRegi;
                    }
                ?>
                <form method="POST" action="">
                  <div class="form-group">
                    <input type="text" name="name" class="form-control" placeholder="Enter your name">
                  </div>
                  <div class="form-group">
                    <input type="text" name="email" class="form-control" placeholder="Enter your email">
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control" name="username" placeholder="Choose username">
                  </div>
                  <div class="form-group">
                    <input class="form-control" name="password" placeholder="Enter your Password" type="password">
                  </form>
                  <div class="loginHelp">
                    <div class="row">
                      <div class="col-6">
                        <button type="submit" name="submit" class="btn btn-success">
                        Register  </button>
                      </div>
                      <div class="col-6 text-right">
                        <a href="login" class="btn">Already have account?</a>
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


<?php include_once('inc/footer.php');?>
