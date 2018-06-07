<?php
require("functions.php");
CheckLogined();

DisplayHeader();

$book_name = $_SESSION['book_name'];
$book_name = str_replace("_", " ", $book_name);
$id_client = $_SESSION['id_client'];
 ?>
 <!-- Page content -->
 <div class="main">
   <?php
   if (!empty($_POST['confirm'])){
      if ($_POST['confirm'] == 'YES'){
        DeleteOrder($book_name, $id_client);
        header ("Location: http://localhost/coursework/orderbook.php");
      } else if ($_POST['confirm'] == 'NO'){
        header ("Location: http://localhost/coursework/orderbook.php");
      }
    }
    ?>
    <form action="" method="post">
      <h5>
        Ви впевнені, що хочете видалити замолення?
        <span><h6>Перед видалення впевнітсья, що клієнт повернув книгу в належному стані.</h6></span>
      </h5>
      <input name="confirm" type="submit" value="YES">
      <input name="confirm" type="submit" value="NO">
    </form>
 </div>
<?php
DisplayFooter();
?>
