<?php
session_start();
require_once __DIR__ . "/../lib/database.php";
require_once __DIR__ . "/../lib/funtion.php";
$db = new Database;

$data = [
    'email' => postInput("email"),
    'password' => postInput("password"),
];

$error = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if ($data['email'] == '') {
        $error['email'] = "Vui lòng nhập email ! ";
    }

    if ($data['password'] == '') {
        $error['password'] = "Vui lòng nhập mật khẩu ! ";
    }

    if (empty($error)) {
        $is_check = $db->fetchOne("admin", "email = '" . $data['email'] . "' and password = '" . MD5($data['password']) . "' ");

        if ($is_check != null) {
            $_SESSION['admin_name'] = $is_check['name'];
            $_SESSION['admin_id'] = $is_check['id'];
            header("location: /cuoiky/admin/");
        } else {
            //that bai
            $_SESSION['error'] = "Tên đăng nhập hoặc mật khẩu không đúng !";
        }
    }
}

?>




<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Login</title>
  <link href="/cuoiky/public/admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="/cuoiky/public/admin/css/sb-admin.css" rel="stylesheet">
  <link href="/cuoiky/public/admin/css/login.css" rel="stylesheet">

</head>



<div class="login-page">
  <div class="form">
    <form class="register-form">
      <input type="text" placeholder="name"/>
      <input type="password" placeholder="password"/>
      <input type="text" placeholder="email address"/>
      <button>create</button>
      <p class="message">Already registered? <a href="#">Sign In</a></p>
    </form>
    <form action="" method="POST" class="login-form">
      <input type="text" placeholder="username" name="email"/>
      <input type="password" placeholder="password" name="password"/>
      <button type="submit">login</button>
      <div class="form-label-group">
      <div class="form-group">
            <div class="form-label-group">
                <?php if (isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger">
                        <p><?php echo $_SESSION['error'];unset($_SESSION['error']) ?></p>
                    </div>
                <?php endif?>
           </div>
          </div>
    </form>
  </div>

</div>
  <script src="/cuoiky/public/admin/vendor/jquery/jquery.min.js"></script>
  <script src="/cuoiky/public/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/cuoiky/public/admin/vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="/cuoiky/public/admin/vendor/jquery/login.js"></script>

</body>

</html>
