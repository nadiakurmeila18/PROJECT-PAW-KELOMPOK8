<?php
  if (isset($_POST["submit"])) {
    $username = htmlentities(strip_tags(trim($_POST["username"])));
    $password = htmlentities(strip_tags(trim($_POST["password"])));

    $error_message = "";

    if (empty($username)) {
      $error_message .= "- Username belum diisi <br>";
    }

    if (empty($password)) {
      $error_message .= "- Password belum diisi <br>";
    }

    include("connection.php");

    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);

    $password_sha1 = sha1($password);
    $query = "
      SELECT * FROM admin 
      WHERE username = '$username' AND password = '$password_sha1'";
    $result = mysqli_query($connection, $query);

    if(mysqli_num_rows($result) == 0 )  {
      $error_message .= "- Username dan/atau Password tidak sesuai";
    }

    mysqli_free_result($result);
    mysqli_close($connection);

    if ($error_message === "") {
      session_start();
      $_SESSION["username"] = $username;
      header("Location: student_view.php");
    }
  }
  else {
    $error_message = "";
    $username = "";
    $password = "";
  }
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Data Mahasiswa</title>
  <!-- Memanggil CSS dari folder assets -->
  <link rel="stylesheet" href="assets/login.css">
</head>
<body>
  <div class="container">
    <h1>Data Mahasiswa</h1>
    <?php
      if ($error_message !== "")
        echo "<div class='error'>$error_message</div>";
    ?>
    <form action="login.php" method="post">
      <fieldset>
        <legend>Login</legend>
        <p>
          <label for="username">Username : </label>
          <input type="text" name="username" id="username" value="<?php echo $username ?>">
        </p>
        <p>
          <label for="password">Password : </label>
          <input type="password" name="password" id="password" value="<?php echo $password ?>">
        </p>
        <p>
          <input type="submit" name="submit" value="Log In">
        </p>
      </fieldset>
    </form>
  </div>
</body>
</html>