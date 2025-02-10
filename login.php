<?php
      require_once "services/database.php";
      SESSION_START();
      
      $login_notification = "";
      
      if(isset($_SESSION['isLogin']) && $_SESSION['isLogin']){
        header("location: index.php");
      }
      
      if(isset($_POST['login'])) {
       $username = $_POST['username'];
       $password = $_POST['password'];
       
       $select_admin_query = "select * from admin WHERE username = '$username' AND password = '$password' ";
       
      $select_admin = $db->query($select_admin_query);
      
      if($select_admin->num_rows > 0){
        $admin = $select_admin->fetch_assoc();
        $_SESSION['isLogin'] = true;
        $_SESSION['username'] = $admin['username'];
        header("location: index.php");
      }else{
        $login_notification = "akun admin tidak ditemukan";
      }
       
      }
      
      $db->close();
      
      ?>
      
      <!DOCTYPE html>
<html lang="en">
  <head>
     <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css"/>
    <title>Login</title>
  </head>
  <body>
    
 
    <div class="super-center" >
    <h1>LOGIN</h1>
          <form action="<?php $_SERVER['PHP_SELF']   ?>" method="POST">
              <label>username</label>
            <input name="username" required />
              <label>password</label>
            <input type="password" name="password" required />
            <button type="submit" name="login">login</button>
            <i><?= $login_notification?></i>
          </form>
    </div>
  </body>
</html>