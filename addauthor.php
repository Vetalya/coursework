<?php
@session_start();
require("functions.php");
CheckLogined();

DisplayHeader();
$_SESSION['msg'] = "";

if (!empty($_POST['send'])){
  $_SESSION['msg'] = "";
  $name = $_POST['name'];
  $surname = $_POST['surname'];
  $patronymic = $_POST['patronymic'];

  if (empty($name) && empty($surname)){
    $_SESSION['msg'] = "Заповніть Ім'я та Фамілію";
  } else {
    if (CheckAuthor($name, $surname)){
      if (empty($_SESSION['msg'])){
        $_SESSION['msg'] = "Такий автор вже існує";
      } else {
        $_SESSION['msg'] = $_SESSION['msg']."<br/>Такий автор вже існує";
      }
    }
    if (empty($_SESSION['msg'])){
      AddAuthor($name, $surname, $patronymic);
      header("Location: http://localhost/coursework/authors.php");
    }
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
        <span>Ім'я</span>
      </td>
    </tr>
    <tr>
      <td>
        <input type="text" name="surname" size="20" />
        <span>Фамілія</span>
      </td>
    </tr>
    <tr>
      <td>
        <input type="text" name="patronymic" size="20" />
        <span>Псевдонім</span>
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
