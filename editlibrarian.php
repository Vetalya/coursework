<?php
require("functions.php");
CheckLogined();

DisplayHeader();
$_SESSION['msg'] = "";
$id = $_SESSION['user_id'];
$data = GetUserInfo($id);

if (!empty($_POST['send'])){
  $_SESSION['msg'] = "";
  $name = $_POST['name'];
  $surname = $_POST['surname'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];
  if (!empty($name) && !empty($surname) && !empty($phone) && !empty($address)){
    if (empty($_SESSION['msg'])){
      SetUser($id, $name, $surname, $phone, $address);
      header("Location: http://localhost/coursework/clients.php");
    }
  } else {
    $_SESSION['msg'] = "Заповність всі поля";
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
        <input type="text" name="name" value="<?php echo $data['lib_name'] ?>" size="20" />
        <span>Ім'я</span>
      </td>
    </tr>
    <tr>
      <td>
        <input type="text" name="surname" value="<?php echo $data['lib_surname'] ?>" size="20" />
        <span>Фамілія</span>
      </td>
    </tr>
    <tr>
      <td>
        <input type="number" name="phone" value="<?php echo $data['lib_phone'] ?>" size="20" />
        <span>Телефон</span>
      </td>
    </tr>
    <tr>
      <td>
        <input type="text" name="address" value="<?php echo $data['lib_address'] ?>" size="20" />
        <span>Адреса</span>
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
