<?php
    include_once('inc/header.php');
    include_once('inc/nav.php');
    include_once('lib/user.php');
    Session::checkSession();
?>
  <div class="">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="well">
              <div class="card">
                <?php
                  $loginMsg = Session::get("loginMsg");
                  if(isset($loginMsg)){
                      echo $loginMsg;
                  }
                  Session::set("loginMsg", NULL);
                ?>
                <h1 class="card-header">
                  <div class="row">
                    <div class="col-6">
                        User List
                    </div>
                    <div class="col-6 text-right">
                      Welcome <span class="text-primary">
                          <?php
                              $name = Session::get("name");
                              if(isset($name)){
                                  echo $name;
                              }else{
                                  echo "to PHP OOP Login Register System";
                              }
                          ?>
                      </span>
                    </div>
                  </div>
                </h1>
                <div class="card-body">
                  <table class="table margin0">
                    <thead class="bg-dark text-white">
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email Address</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $user = new User();
                        $userData = $user->getUserData();
                        if($userData){
                          $i = 0;
                          foreach ($userData as $uData) { $i++; ?>

                      <tr>
                        <th scope="row"><?php echo $i; ?></th>
                        <td><?php echo $uData['name']; ?></td>
                        <td><?php echo $uData['username']; ?></td>
                        <td><?php echo $uData['email']; ?></td>
                        <td><a href="profile?id=<?php echo $uData['id']; ?>" class="btn btn-primary">View</a> </td>
                      </tr>
                      <?php }} else{ ?>
                      <tr>
                        <td colspan="5"> <h2>No User Data Found.....</h2> </td>
                      </tr>
                      <?php }?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

<?php include_once('inc/footer.php');?>
