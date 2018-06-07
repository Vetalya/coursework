<?php
require("functions.php");
CheckLogined();

DisplayHeader();
$_SESSION['msg'] = "";
$id = $_SESSION['id_genre'];
$data = GetGenreInfo($id);

if (!empty($_POST['send'])){
  $_SESSION['msg'] = "";
  $name = $_POST['name'];

  if (CheckGenre($name) && $name != $data['genre']){
    if (empty($_SESSION['msg'])){
      $_SESSION['msg'] = "Такий жанр вже існує";
    } else {
      $_SESSION['msg'] = $_SESSION['msg']."<br/>Такий жанр вже існує";
    }
  }
  if (empty($_SESSION['msg'])){
    SetGenre($id, $name);
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
        <input type="text" name="name" value="<?php echo $data['genre'] ?>" size="20" />
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
