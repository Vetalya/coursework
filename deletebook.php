<?php
@session_start();
require("functions.php");
CheckLogined();

DisplayHeader();

$id = $_SESSION['id_book'];
 ?>
 <!-- Page content -->
 <div class="main">
   <?php
   if (!empty($_POST['confirm'])){
      if ($_POST['confirm'] == 'YES'){
        DeleteBook($id);
        header ("Location: http://localhost/coursework/home.php");
      } else if ($_POST['confirm'] == 'NO'){
        header ("Location: http://localhost/coursework/home.php");
      }
    }
    ?>
    <form action="" method="post">
      <p>Ви впевнені, що хочете видалити книгу?</p>
      <input name="confirm" type="submit" value="YES">
      <input name="confirm" type="submit" value="NO">
    </form>
 </div>
<?php
DisplayFooter();
?>
