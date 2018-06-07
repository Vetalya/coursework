<?php
require("functions.php");
CheckLogined();

DisplayHeader();
$_SESSION['msg'] = "";
$id = $_SESSION['id_client'];
$data = GetClientInfo($id);

if (!empty($_POST['send'])){
  $_SESSION['msg'] = "";
  $name = $_POST['name'];
  $surname = $_POST['surname'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];
  $work = $_POST['work'];

  if (CheckClient($name, $surname, $phone) && $name != $data['cli_name'] && $surname != $data['surname'] && $phone != $data['cli_phone']){
    if (empty($_SESSION['msg'])){
      $_SESSION['msg'] = "Даний читач вже існує";
    } else {
      $_SESSION['msg'] = $_SESSION['msg']."<br/>Даний читач вже існує";
    }
  }
  if (empty($_SESSION['msg'])){
    SetClient($id, $name, $surname, $phone, $address, $work);
    header("Location: http://localhost/coursework/clients.php");
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
        <input type="text" name="name" value="<?php echo $data['cli_name'] ?>" size="20" />
        <span>Ім'я</span>
      </td>
    </tr>
    <tr>
      <td>
        <input type="text" name="surname" value="<?php echo $data['cli_surname'] ?>" size="20" />
        <span>Фамілія</span>
      </td>
    </tr>
    <tr>
      <td>
        <input type="number" name="phone" value="<?php echo $data['cli_phone'] ?>" size="20" />
        <span>Телефон</span>
      </td>
    </tr>
    <tr>
      <td>
        <input type="text" name="address" value="<?php echo $data['cli_address'] ?>" size="20" />
        <span>Адреса</span>
      </td>
    </tr>
    <tr>
      <td>
        <input type="text" name="work" value="<?php echo $data['cli_work'] ?>" size="20" />
        <span>Робота</span>
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
