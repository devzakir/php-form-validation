<?php
  include_once('Session.php');
  include('Database.php');

  class User{
    private $db;
    public function __construct(){
      $this->db = new Database();
    }

    public function userRegistration($data){
        $name     = $data['name'];
        $username = $data['username'];
        $email    = $data['email'];
        $password = md5($data['password']);
        $chkEmail = $this->emailCheck($email);

        // if(!(isset($name) || isset($username) || isset($email) || isset($password))){
        //   $errors = '<div class="alert alert-danger"><b>Warning!</b> Field must not be empty</div>';
        //   return $errors;
        // }
        if($name == "" || $username == "" || $email == "" || $password == ""){
            $errors = '<div class="alert alert-danger"><b>Warning!</b> Field must not be empty</div>';
            return $errors;
        }


        if(strlen($username) < 3){
            $errors = '<div class="alert alert-danger"><b>Warning!</b> Username is to short</div>';
            return $errors;
        }elseif(preg_match('/[^a-z0-9_-]/i', $username)){
            $errors = '<div class="alert alert-danger"><b>Warning!</b> Username only contain alphanumerical dashed an underscore</div>';
            return $errors;
        }
        if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
            $errors = '<div class="alert alert-danger"><b>Warning!</b> Email address is not valid</div>';
            return $errors;
        }
        // if(count($password) < 8){
        //     $errors = "Password is short. Enter more 8 characters";
        //     return $errors;
        // }
        if($chkEmail == true){
            $errors = '<div class="alert alert-danger"><b>Failed!</b> The email already exsits in Database</div>';
            return $errors;
        }
        $sql = "INSERT INTO table_users (name, email, username, password) VALUES (:name, :email, :username, :password)";
        $query = $this->db->pdo->prepare($sql);
        $query->bindValue(':name', $name);
        $query->bindValue(':email', $email);
        $query->bindValue(':username', $username);
        $query->bindValue(':password', $password);
        $result = $query->execute();
        if($result){
            $msg = '<div class="alert alert-success"><b>Success!</b> Thank you for registration!</div>';
            return $msg;
        }else {
            $errors = '<div class="alert alert-danger"><b>Failed!</b> Problem with inserting data</div>';
            return $erros;
        }
    }

    // Login page start
    public function emailCheck($email){
        $sql = "SELECT email FROM table_users WHERE email = :email";
        $query = $this->db->pdo->prepare($sql);
        $query->bindValue(':email', $email);
        $query->execute();
        if($query->rowCount() > 0){
            return true;
        } else{
            return false;
        }
    }
    public function getLoginUser($email, $password){
        $sql = "SELECT * FROM table_users WHERE email = :email AND password = :password LIMIT 1";
        $query = $this->db->pdo->prepare($sql);
        $query->bindValue(':email', $email);
        $query->bindValue(':password', $password);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_OBJ);
        return $result;
    }

    public function userLogin($data){
        $email = $data['email'];
        $password = md5($data['password']);

        $chkEmail = $this->emailCheck($email);

        if($email == "" || $password == ""){
            $errors = '<div class="alert alert-danger"><b>Warning!</b> Field must not be empty</div>';
            return $errors;
        }

        if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
            $errors = '<div class="alert alert-danger"><b>Warning!</b> Email address is not valid</div>';
            return $errors;
        }
        if($chkEmail == false){
            $errors = '<div class="alert alert-danger"><b>Failed!</b> The email already not exsits in Database</div>';
            return $errors;
        }
        $result = $this->getLoginUser($email, $password);
        if($result){
            Session::init();
            Session::set("login", true);
            Session::set("id", $result->id);
            Session::set("name", $result->name);
            Session::set("username", $result->username);
            Session::set("loginMsg", '<div class="alert alert-success"><b>Success!</b> Your are Logged in! </div>');
            header("Location: index");
        }else{
            $errors = '<div class="alert alert-danger"><b>Failed!</b> User data not found! </div>';
            return $errors;
        }
    }

    public function getUserData(){
      $sql = "SELECT * FROM table_users ORDER BY id DESC";
      $query = $this->db->pdo->prepare($sql);
      $query->execute();
      $result = $query->fetchAll();
      return $result;
    }

    public function getUserById($Id){
      $sql = "SELECT * FROM table_users WHERE id= :id LIMIT 1 ";
      $query = $this->db->pdo->prepare($sql);
      $query->bindValue(':id', $Id);
      $query->execute();
      $result = $query->fetch(PDO::FETCH_OBJ);
      return $result;
    }

    public function updateUser($userId, $data){
        $name     = $data['name'];
        $username = $data['username'];
        $email    = $data['email'];
        $password = md5($data['password']);
        // $chkEmail = $this->emailCheck($email);

        // if(!(isset($name) || isset($username) || isset($email) || isset($password))){
        //   $errors = '<div class="alert alert-danger"><b>Warning!</b> Field must not be empty</div>';
        //   return $errors;
        // }
        if($name == "" || $username == "" || $email == "" || $password == ""){
            $errors = '<div class="alert alert-danger"><b>Warning!</b> Field must not be empty</div>';
            return $errors;
        }


        if(strlen($username) < 3){
            $errors = '<div class="alert alert-danger"><b>Warning!</b> Username is to short</div>';
            return $errors;
        }elseif(preg_match('/[^a-z0-9_-]/i', $username)){
            $errors = '<div class="alert alert-danger"><b>Warning!</b> Username only contain alphanumerical dashed an underscore</div>';
            return $errors;
        }
        if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
            $errors = '<div class="alert alert-danger"><b>Warning!</b> Email address is not valid</div>';
            return $errors;
        }
        // if(count($password) < 8){
        //     $errors = "Password is short. Enter more 8 characters";
        //     return $errors;
        // }
        // if($chkEmail == true){
        //     $errors = '<div class="alert alert-danger"><b>Failed!</b> The email already exsits in Database</div>';
        //     return $errors;
        // }
        $sql = "UPDATE table_users set
          name = :name,
          username = :username,
          email = :email,
          password = :password
          WHERE id = :id";
        $query = $this->db->pdo->prepare($sql);
        $query->bindValue(':name', $name);
        $query->bindValue(':email', $email);
        $query->bindValue(':username', $username);
        $query->bindValue(':password', $password);
        $query->bindValue(':id', $userId);
        $result = $query->execute();
        if($result){
            $msg = '<div class="alert alert-success"><b>Success!</b> User data updated successfully!</div>';
            return $msg;
        }else {
            $errors = '<div class="alert alert-danger"><b>Failed!</b> Problem with updating data</div>';
            return $erros;
        }
    }

  }
 ?>
