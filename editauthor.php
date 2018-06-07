<?php
require("functions.php");
CheckLogined();

DisplayHeader();
$_SESSION['msg'] = "";
$id = $_SESSION['id_author'];
$data = GetAuthorInfo($id);

if (!empty($_POST['send'])){
  $_SESSION['msg'] = "";
  $name = $_POST['name'];
  $surname = $_POST['surname'];
  $patronymic = $_POST['patronymic'];

  if (CheckAuthor($name, $surname) && $name != $data['name'] && $surname != $data['surnames']){
    if (empty($_SESSION['msg'])){
      $_SESSION['msg'] = "Такий автор вже існує";
    } else {
      $_SESSION['msg'] = $_SESSION['msg']."<br/>Такий автор вже існує";
    }
  }
  if (empty($_SESSION['msg'])){
    SetAuthor($id, $name, $surname, $patronymic);
    header("Location: http://localhost/coursework/authors.php");
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
        <input type="text" name="name" value="<?php echo $data['name'] ?>" size="20" />
        <span>Ім'я</span>
      </td>
    </tr>
    <tr>
      <td>
        <input type="text" name="surname" value="<?php echo $data['surname'] ?>" size="20" />
        <span>Фамілія</span>
      </td>
    </tr>
    <tr>
      <td>
        <input type="text" name="patronymic" value="<?php echo $data['patronymic'] ?>" size="20" />
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
