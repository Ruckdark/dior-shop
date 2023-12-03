<?php
require_once 'header.php';
?>
<div id="body">
  <div id="login-page">
    <button class="method-button" id="register">
      <h2>Đăng Ký</h2>
    </button>

    <button class="method-button" id="login">
      <h2>Đăng Nhập</h2>
    </button>

    <!-- Register -->
    <form action="" method="POST" class="form" id="form-1">
      <h3 class="heading">Đăng Ký</h3>

      <div class="xmark">
        <i class="fa-solid fa-xmark"></i>
      </div>

      <div class="form-group">
        <label for="fullname" class="form-label">Tên đầy đủ</label>
        <input id="fullname" name="fullname" type="text" class="form-control" >
      </div>

      <div class="form-group">
        <label for="email" class="form-label">Email</label>
        <input id="email" name="register-email" type="text" class="form-control" required>
      </div>

      <!--<div class="form-group">
        <label for="phonenumber" class="form-label">Số điện thoại</label>
        <input id="phonenumber" name="phonenumber" type="text" class="form-control" required>
      </div>-->

      <div class="form-group">
        <label for="password" class="form-label">Mật khẩu</label>
        <input id="password" name="register-password" type="password" class="form-control" required>
      </div>

      <div class="form-group">
        <label for="password_confirmation" class="form-label">Nhập lại mật khẩu</label>
        <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" required>
      </div>

      <button class="form-submit" name="register-submit" type="submit">Đăng ký</button>
    </form>

    <!-- Login -->
    <form action="" method="POST" class="form" id="form-2">
      <h3 class="heading">Đăng Nhập</h3>

      <div class="xmark">
        <i class="fa-solid fa-xmark"></i>
      </div>

      <div class="form-group">
        <label for="email" class="form-label">Email</label>
        <input id="login_email" name="login-email" type="text" class="form-control" required>
      </div>

      <div class="form-group">
        <label for="password" class="form-label">Mật khẩu</label>
        <input id="login_password" name="login-password" type="password" class="form-control" required>
      </div>

      <button class="form-submit" name="login-submit" type="submit">Đăng Nhập</button>
    </form>
  </div>
</div>

<?php
// btn register
if (isset($_POST['register-submit'])) {
  $user_name = $_POST['fullname'];
  $email = $_POST['register-email'];
  $password = md5($_POST['register-password']);
  $password_confirmation = md5($_POST['password_confirmation']);
  if ($password == $password_confirmation) {
    $sql_check = "SELECT * FROM users WHERE UserName = '$user_name' OR Email = '$email'";
    $result = mysqli_query($conn, $sql_check);
    // Kiểm tra xem tài khoản đang đăng kí có tồn tại chưa.
    if (mysqli_num_rows($result) > 0) {
      echo "<script>alert('Tài khoản hoặc email đã tồn tại.')</script>";
      header('Location:login.php');
    } else {
      $sql_insert = "INSERT INTO users(UserName, Email, Password) VALUES('$user_name', '$email', '$password')";
      if (mysqli_query($conn, $sql_insert)) {
        $user_id = mysqli_insert_id($conn);
        $_SESSION['user_id'] = $user_id;
        $_SESSION['login-email'] = $email;
        echo "<script>alert('Bạn đã đăng ký thành công')</script>";
        echo "<script>window.open('index.php','_self')</script>";
      } else {
        echo 'Error ' . $sql_insert . '<br>' . mysqli_error($conn);
      }
    }
  } else {
    echo "<script>alert('Mật khẩu không trùng nhau')</script>";
    echo "<script>window.open('login.php','_self')</script>";
  }
}
?>

<?php
// btn login
if (isset($_POST['login-submit'])) {
  $email = $_POST['login-email'];
  $password = md5($_POST['login-password']);
  $sql = "SELECT * FROM `users` WHERE `Email`='$email' AND `Password`='$password'";
  $result = mysqli_query($conn, $sql);
  // Kiểm tra xem tài khoản có tồn tại trong csdl không
  if (mysqli_num_rows($result) == 1) {
    $user = mysqli_fetch_assoc($result);
    $_SESSION['user_id'] = $user['UserID'];  // Lưu UserID vào biến phiên
    $_SESSION['login-email'] = $email;
    echo "<script>alert('Bạn đã đăng nhập thành công')</script>";
    echo "<script>window.open('index.php','_self')</script>";
  }else {
    echo "<script>alert('Email hoặc mật khẩu của bạn sai')</script>";
  }
}
?>

<?php
require_once 'footer.php';
?>
