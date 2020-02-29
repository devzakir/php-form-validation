<header class="bg-primary">
  <div class="container">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary text-white">
      <a class="navbar-brand" href="index">Login Register System</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse d-flex flex-row-reverse" id="navbarSupportedContent">
        <ul class="navbar-nav">
              <?php
                $id = Session::get("id");
                $userLogin = Session::get("login");
                if($userLogin == true){
              ?>
              <li class="nav-item active">
                <li class="nav-item">
                  <a class="nav-link" href="index">Home</a>
                </li>
                <a class="nav-link" href="profile?id=<?php echo $id; ?>">Profile <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="?action=logout">Logout</a>
              </li>
          <?php } else{ ?>
          <li class="nav-item">
            <a class="nav-link" href="login">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="register">Register</a>
          </li>
        <?php }?>
        </ul>
      </div>
    </nav>
  </div>
</header>
