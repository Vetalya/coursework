<?php
@session_start();
require("functions.php");
CheckLogined();

DisplayHeader();
$_SESSION['msg'] = "";

if (!empty($_POST['send'])){
  $_SESSION['msg'] = "";
  $name = $_POST['name'];

  if (!empty($name)) {
    if (CheckGenre($name)){
      if (empty($_SESSION['msg'])){
        $_SESSION['msg'] = "Такий жанр вже існує";
      } else {
        $_SESSION['msg'] = $_SESSION['msg']."<br/>Такий жанр вже існує";
      }
    }
  } else {
    $_SESSION['msg'] = "Заповніть всі поля";
  }
  if (empty($_SESSION['msg'])){
    AddGenre($name);
    header("Location: http://localhost/coursework/genres.php");
  }
}


?>
<table width=1200px align=center>
  <form action="" method="post">
    <tr>
      <td>
        <span><?php if(!empty($_SESSION['msg'])) echo $_SESSION['msg']; ?></span>
      </td>
    </tr>
    <tr>
      <td>
        <input type="text" name="name" size="20" />
        <span>Назва</span>
      </td>
    </tr>
    <tr>
      <td>
        <input type="submit" name="send" value="Save" size="5" />
      </td>
    </tr>
  </form>
</table>

<?php

DisplayFooter();
 ?>
