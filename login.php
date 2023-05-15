<?php
session_start();
?>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST["username"];
  $password = $_POST["password"];

  if ($username == "ayro" && $password == "pass") {
    $_SESSION["logged_in"] = true;
    header("Location: table.php");
    exit();
  } else {
    $error_message = "Invalid username or password.";
  }
}
?>
<!DOCTYPE html>
<html>
<link rel="stylesheet" href="login.css">
<head>
	<title>Portal</title>
</head>
<body>
    <div class="login-box">
        <form method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <input type="submit" value="Login">
        </form>
    </div>
    <div class="error-box">
        <?php if (isset($error_message)) { ?>
        <div class="error-message">
            <p><?php echo $error_message; ?></p>
        </div>
        <?php } ?>
    </div>
</body>
</html>