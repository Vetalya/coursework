<?php
require("functions.php");
DisplayStyles();

$_SESSION['msg'] = "";

if (!empty($_POST['send'])){
  $login = $_POST['login'];
  $password = $_POST['password'];

  if (CheckLoginUser($login, $password)){
    $id = CheckLoginUser($login, $password);
    $_SESSION['user_id'] = $id['id_librarian'];
    $_SESSION['user_name'] = $id['lib_name'];
    $_SESSION['msg'] = "";
    header("Location: http://localhost/coursework/home.php");
    echo isset($_SESSION['user_id']);
  } else {
    $_SESSION['msg'] = "Невірно введений пароль або логін";
  }
}

?>
<html>
<head>
  <title>Login</title>
</head>
</html>
<body>
  <div class="main">
    <table align="center">
      <form action="" method="post">
        <tr>
          <td>
            <span><?php if(!empty($_SESSION['msg'])) echo $_SESSION['msg']; ?></span>
          </td>
        </tr>
        <tr>
          <td>
            <input type="text" name="login" size="20" />
            <span>Login</span>
          </td>
        </tr>
        <tr>
          <td>
            <input type="password" name="password" size="20" />
            <span>Password</span>
          </td>
        </tr>
        <tr>
          <td>
            <input type="submit" name="send" value="Send"/>
          </td>
        </tr>
      </form>
    </table>
  </div>
</body>
<?php
 ?>
