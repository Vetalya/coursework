<?php
@session_start();
require("functions.php");
CheckLogined();

DisplayHeader();
$_SESSION['msg'] = "";
$id_librarian = $_SESSION['user_id'];

if (!empty($_POST['send'])){
  $_SESSION['msg'] = "";
  $name = $_POST['name'];
  $surname = $_POST['surname'];
  $book_name = $_POST['book_name'];


  if (!empty($name) && !empty($surname) && !empty($book_name)) {
    if (!CheckClient($name, $surname)){
      if (empty($_SESSION['msg'])){
        $_SESSION['msg'] = "Даний читач не існує";
      } else {
        $_SESSION['msg'] = $_SESSION['msg']."<br/>Даний читач не існує";
      }
    }
  } else {
    $_SESSION['msg'] = "Заповніть всі поля";
  }
  if (empty($_SESSION['msg'])){
    AddOrder($name, $surname, $book_name, $id_librarian);
    header("Location: http://localhost/coursework/orderbook.php");
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
        <span>Ім'я Читача</span>
      </td>
    </tr>
    <tr>
      <td>
        <input type="text" name="surname" size="20" />
        <span>Фамілія Читача</span>
      </td>
    </tr>
    <tr>
      <td>
        <select name="book_name">
          <option disabled selected>Виберіть книгу</option>
          <?php
          $result = GetBooks();
          $num_rows = $result -> num_rows;
          for ($i = 0; $i < $num_rows; $i++){
            $row = $result -> fetch_assoc();
            ?>
            <option value="<?php echo $row['book_name'] ?>"><?php echo $row['book_name'] ?></option>
            <?php
          }
          ?>
        </select>
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
