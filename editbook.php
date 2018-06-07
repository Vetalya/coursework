<?php
require("functions.php");
CheckLogined();

DisplayHeader();
$_SESSION['msg'] = "";
$id = $_SESSION['id_book'];
$data = GetBookInfo($id);

if (!empty($_POST['send'])){
  $_SESSION['msg'] = "";
  $book_name = $_POST['book_name'];
  $author_name = $_POST['author_name'];
  $author_surname = $_POST['author_surname'];
  $year = $_POST['year'];
  $genre = $_POST['genre'];
  $quantity = $_POST['quantity'];

  if (CheckBook($book_name, $author_name, $author_surname) && $book_name != $data['book_name'] && $author_name != $data['name'] && $author_surname != $data['surname']) {
    if (empty($_SESSION['msg'])){
      $_SESSION['msg'] = "Така книга вже існує";
    } else {
      $_SESSION['msg'] = $_SESSION['msg']."<br/>Така книга вже існує";
    }
  }
  if (!CheckAuthor($author_name, $author_surname)) {
    if (empty($_SESSION['msg'])){
      $_SESSION['msg'] = "Невідомий автор";
    } else {
      $_SESSION['msg'] = $_SESSION['msg']."<br/>Невідомий автор";
    }
  }
  if (empty($_SESSION['msg'])){
    SetBook($id, $book_name, $author_name, $author_surname, $year, $genre, $quantity);
    header("Location: http://localhost/coursework/home.php");
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
        <input type="text" name="book_name" value="<?php echo $data['book_name'] ?>" size="20" />
        <span>Назва Книги</span>
      </td>
    </tr>
    <tr>
      <td>
        <input type="text" name="author_name" value="<?php echo $data['name'] ?>" size="20" />
        <span>Ім'я Автора</span>
      </td>
    </tr>
    <tr>
      <td>
        <input type="text" name="author_surname" value="<?php echo $data['surname'] ?>" size="20" />
        <span>Фамілія Автора</span>
      </td>
    </tr>
    <tr>
      <td>
        <input type="number" name="year" value="<?php echo $data['year'] ?>" size="20" max="2100"/>
        <span>Рік Видання</span>
      </td>
    </tr>
    <tr>
      <td>
        <select name="genre">
          <option disabled>Виберіть жанр</option>
        <?php
        $result = GetGenres();
        $num_rows = $result -> num_rows;
        for ($i = 0; $i < $num_rows; $i++){
          $row = $result -> fetch_assoc();
          ?>
          <option value="<?php echo $row['genre'] ?>" <?php if ($data['genre'] == $row['genre']) echo "selected" ?>><?php echo $row['genre'] ?></option>
          <?php
        }
        ?>
        </select>
      </td>
    </tr>
    <tr>
      <td>
        <input type="number" name="quantity" value="<?php echo $data['quantity'] ?>" size="20"/>
        <span>Кількість</span>
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
