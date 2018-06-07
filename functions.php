<?php
@session_start();
$conn = new mysqli('localhost', 'root', 'qwerty123', "coursework");

/* Header Display Start */
function DisplayHeader($title = "Облік книг"){
  $buttons = array("Книги" => "home.php",
                   "Читачі" => "clients.php",
                   "Автори" => "authors.php",
                   "Жанри" => "genres.php",
                   "Видача книг" => "orderbook.php"
                  );
  echo "<html>\n<head>\n";
  echo "<title>".$title."</title>";
  DisplayStyles();
  echo "</head>\n<body>\n";
  DisplayHead();
  DisplayMenu($buttons);
}

function DisplayStyles(){
  ?>
    <link rel="stylesheet" href="styles.css" />
  <?php
}

function DisplayHead(){
  $content = "<img src=\"dog.png\" style=\"width:60px;height:60px;\"/>";
  echo "<table align=\"center\" width=\"1200px\" cellpadding=\"12\" cellspacing=\"0\" border=\"0\">".
  "<tr class=\"emp\">".
    "<td>".
      $content.
      "</td>";
  DisplayButtonBlock();
  echo "</tr>".
  "</table>";
}

function DisplayButtonBlock() {
  ?>
  <td width ="100px" align="center">
      <span class="menu">Привіт, <a href="http://localhost/coursework/editlibrarian.php"><?php echo $_SESSION['user_name'] ?></a></span>
    </td>
  <td width ="100px" align="center">
    <a class="nubex" width="30px" href="logout.php"><span class="menu">logout</span></a>
  </td>
  <?php
}

function IsURLCurrentPage($url) {
  if(strpos($_SERVER['PHP_SELF'], $url)==false) {
    return false;
  } else {
    return true;
  }
}

function DisplayMenu($buttons){
  echo "<table align=\"center\" width=\"1200px\" bgcolor=\"white\"" .
         "cellpadding=\"0\" cellspacing=\"0\">\n";
  echo "<tr class=\"emp\">\n";

  $width = 1200/count($buttons);

  while (list($name, $url) = each($buttons)) {
    DisplayButton($width, $name, $url, !IsURLCurrentPage($url));
  }
  echo "</tr>\n";
  echo "</table>\n";
}

function DisplaySidebar($buttons){
  echo "<div class=\"sidenav\">";
  while (list($name, $url) = each($buttons)) {
    DisplayButtonSidebar($name, $url, !IsURLCurrentPage($url));
  }
  echo "</div>";
  }

function DisplayButton($width, $name, $url, $active = true) {
  if ($active) {
    echo "<td width =\"".$width."px\" align=\"center\">".
      "<a class=\"nubex\" width=".$width."px href=\"".$url."\"><span class=\"menu\">".$name."</span></a>" .
      "</td>";
  } else {
    echo "<td width =\"".$width."px\" align=\"center\"><a class=\"nubex\"  width=".$width." >" .
    "<span class=\"menu\">".$name."</span></td>";
  }
}
/* Header Display End */

/* Footer Display Start */
function DisplayFooter(){
  ?>
  <table align="center" width="1200px" bgcolor="black" cellpadding="12" border="0">
    <tr class="emp">
      <td>
        <p class="foot" color="white">&copy; Віталій Дрозд</p>
      </td>
    </tr>
  </table>
  <?php
}
/* Footer Display End */

/* Content Display Functions Star */
function DisplayBooks(){
  $query = "SELECT * FROM books_info";
  global $conn;
  $result = ($conn) -> query($query);
  $num_results = $result-> num_rows;
  ?>
  <table class="db" width=1200px cellspacing="0">
    <tr>
      <th>ID</th>
      <th>Назва</th>
      <th>Рік</th>
      <th>Кількість</th>
      <th>Автор</th>
      <th>Жанр</th>
    </tr>
    <?php
    for ($i = 0; $i < $num_results; $i++){
      $row = $result -> fetch_assoc();
      ?>
      <tbody class="db" align="center">
        <form action="" method="post">
          <tr>
            <td class="db" width="100"><?php echo $row['id_book'] ?></td>
            <td class="db" width="100"><?php echo $row['book_name'] ?></td>
            <td class="db" width="100"><?php echo $row['year'] ?></td>
            <td class="db" width="100"><?php echo $row['quantity'] ?></td>
            <td class="db" width="100"><?php echo $row['name']." ".$row['surname'] ?></td>
            <td class="db" width="100"><?php echo $row['genre'] ?></td>
            <td class="db" width="100" align=right>
              <input style="width: 120px;" name="<?php echo $row['id_book'] ?>" type="submit" value="Edit"/>
              <input style="width: 120px;" name="<?php echo $row['id_book'] ?>" type="submit" value="Delete"/>
            </td>
          </tr>
        </form>
  <?php
  foreach ($_POST as $key => $value) {
    if ($value == "Edit"){
      $_SESSION['id_book'] = $key;
      header("Location: http://localhost/coursework/editbook.php");
    } else if ($value == "Delete"){
      $_SESSION['id_book'] = $key;
      header("Location: http://localhost/coursework/deletebook.php");
    }
  }?>
  </tbody>
  <?php
  }
  echo "</table>";
}

function DisplayAuthors(){
  $query = "SELECT * FROM coursework.authors;";
  global $conn;
  $result = ($conn) -> query($query);
  $num_results = $result-> num_rows;
  ?>
  <table class="db" width=1200px cellspacing="0">
    <tr>
      <th>ID</th>
      <th>Ім'я</th>
      <th>Фамілія</th>
      <th>Псевдонім</th>
    </tr>
    <?php
    for ($i = 0; $i < $num_results; $i++){
      $row = $result -> fetch_assoc();
      ?>
      <tbody class="db" align="center">
        <form action="" method="post">
          <tr>
            <td class="db" width="100"><?php echo $row['id_author'] ?></td>
            <td class="db" width="100"><?php echo $row['name'] ?></td>
            <td class="db" width="100"><?php echo $row['surname'] ?></td>
            <td class="db" width="100"><?php echo $row['patronymic'] ?></td>
            <td class="db" width="100" align=right>
              <input style="width: 120px;" name="<?php echo $row['id_author'] ?>" type="submit" value="Edit"/>
              <input style="width: 120px;" name="<?php echo $row['id_author'] ?>" type="submit" value="Delete"/>
            </td>
          </tr>
        </form>
  <?php
  foreach ($_POST as $key => $value) {
    if ($value == "Edit"){
      $_SESSION['id_author'] = $key;
      header("Location: http://localhost/coursework/editauthor.php");
    } else if ($value == "Delete"){
      $_SESSION['id_author'] = $key;
      header("Location: http://localhost/coursework/deleteauthor.php");
    }
  }?>
  </tbody>
  <?php
  }
  echo "</table>";
}

function DisplayGenres(){
  $query = "SELECT * FROM coursework.genre;";
  global $conn;
  $result = ($conn) -> query($query);
  $num_results = $result -> num_rows;
  ?>
  <table class="db" width=1200px cellspacing="0">
    <tr>
      <th>ID</th>
      <th>Назва</th>
    </tr>
    <?php
    for ($i = 0; $i < $num_results; $i++){
      $row = $result -> fetch_assoc();
      ?>
      <tbody class="db" align="center">
        <form action="" method="post">
          <tr>
            <td class="db" width="100"><?php echo $row['id_genre'] ?></td>
            <td class="db" width="100"><?php echo $row['genre'] ?></td>
            <td class="db" width="100" align=right>
              <input style="width: 120px;" name="<?php echo $row['id_genre'] ?>" type="submit" value="Edit"/>
              <input style="width: 120px;" name="<?php echo $row['id_genre'] ?>" type="submit" value="Delete"/>
            </td>
          </tr>
        </form>
  <?php
  foreach ($_POST as $key => $value) {
    if ($value == "Edit"){
      $_SESSION['id_genre'] = $key;
      header("Location: http://localhost/coursework/editgenre.php");
    } else if ($value == "Delete"){
      $_SESSION['id_genre'] = $key;
      header("Location: http://localhost/coursework/deletegenre.php");
    }
  }?>
  </tbody>
  <?php
  }
  echo "</table>";
}

function DisplayClients(){
  $query = "SELECT * FROM coursework.client;";
  global $conn;
  $result = ($conn) -> query($query);
  $num_results = $result-> num_rows;
  ?>
  <table class="db" width=1200px cellspacing="0">
    <tr>
      <th>ID</th>
      <th>Ім'я</th>
      <th>Фамілія</th>
      <th>Телефон</th>
      <th>Адреса</th>
      <th>Робота</th>
    </tr>
    <?php
    for ($i = 0; $i < $num_results; $i++){
      $row = $result -> fetch_assoc();
      ?>
      <tbody class="db" align="center">
        <form action="" method="post">
          <tr>
            <td class="db" width="100"><?php echo $row['id_client'] ?></td>
            <td class="db" width="100"><?php echo $row['cli_name'] ?></td>
            <td class="db" width="100"><?php echo $row['cli_surname'] ?></td>
            <td class="db" width="100"><?php echo "+380".$row['cli_phone'] ?></td>
            <td class="db" width="100"><?php echo $row['cli_address'] ?></td>
            <td class="db" width="100"><?php echo $row['cli_work'] ?></td>
            <td class="db" width="100" align=right>
              <input style="width: 120px;" name="<?php echo $row['id_client'] ?>" type="submit" value="Edit"/>
              <input style="width: 120px;" name="<?php echo $row['id_client'] ?>" type="submit" value="Delete"/>
            </td>
          </tr>
        </form>
  <?php
  foreach ($_POST as $key => $value) {
    if ($value == "Edit"){
      $_SESSION['id_client'] = $key;
      header("Location: http://localhost/coursework/editclient.php");
    } else if ($value == "Delete"){
      $_SESSION['id_client'] = $key;
      header("Location: http://localhost/coursework/deleteclient.php");
    }
  }?>
  </tbody>
  <?php
  }
  echo "</table>";
}

function DisplayOrders(){
  $query = "SELECT * FROM orders_info;";
  global $conn;
  $result = ($conn) -> query($query);
  $num_results = $result-> num_rows;
  ?>
  <table class="db" width=1200px cellspacing="0">
    <tr>
      <th>Читач</th>
      <th>ID книги</th>
      <th>Книга</th>
      <th>Бібліотекар</th>
    </tr>
    <?php
    for ($i = 0; $i < $num_results; $i++){
      $row = $result -> fetch_assoc();
      ?>
      <tbody class="db" align="center">
        <form action="" method="post">
          <tr>
            <td class="db" width="100"><?php echo $row['cli_name']." ".$row['cli_surname'] ?></td>
            <td class="db" width="100"><?php echo $row['id_book'] ?></td>
            <td class="db" width="100"><?php echo $row['book_name'] ?></td>
            <td class="db" width="100"><?php echo $row['lib_name']." ".$row['lib_surname'] ?></td>
            <td class="db" width="100" align=right>
              <input style="width: 120px;" name="<?php echo $row['book_name'].":".$row['id_client'] ?>" type="submit" value="Delete"/>
            </td>
          </tr>
        </form>
  <?php
  foreach ($_POST as $key => $value) {
    if ($value == "Delete"){
      list($_SESSION['book_name'], $_SESSION['id_client']) = preg_split("/:/", $key);
      header("Location: http://localhost/coursework/deleteorder.php");
    }
  }?>
  </tbody>
  <?php
  }
  echo "</table>";
}
/* Content Display Functions End */

/* DB Functions Start */
function AddAuthor($name, $surname){
  global $conn;

  $query = "INSERT INTO coursework.authors (surname, name, patronymic) VALUES ('$surname', '$name', '$patronymic');";
  $result = $conn -> query($query);
}

function AddGenre($name){
  global $conn;

  $query = "INSERT INTO coursework.genre (genre) VALUES ('$name');";
  $result = $conn -> query($query);
}

function AddClient($name, $surname, $phone, $address, $work){
  global $conn;

  $query = "INSERT INTO coursework.client (cli_name, cli_surname, cli_phone, cli_address, cli_work) VALUES ('$name', '$surname', '$phone', '$address', '$work');";
  $result = $conn -> query($query);
}

function AddBook($book_name, $author_name, $author_surname, $year, $genre, $quantity){
  global $conn;

  $query = "SELECT * FROM coursework.authors WHERE name='$author_name' AND surname='$author_surname';";
  $result = $conn -> query($query);
  $author = $result -> fetch_assoc();
  $id_author = $author['id_author'];

  $query = "SELECT * FROM coursework.genre WHERE genre='$genre';";
  $result = $conn -> query($query);
  $genre = $result -> fetch_assoc();
  $id_genre = $genre['id_genre'];

  $query = "INSERT INTO coursework.books (year, quantity, book_name, id_author, id_genre) VALUES ('$year', '$quantity', '$book_name', '$id_author', '$id_genre');";
  $result = $conn -> query($query);
}

function AddOrder($name, $surname, $book_name, $id_librarian){
  global $conn;

  $query = "SELECT * FROM coursework.books WHERE book_name='$book_name';";
  $result = $conn -> query($query);
  $book = $result -> fetch_assoc();
  $id_book = $book['id_book'];

  $query = "SELECT * FROM coursework.client WHERE cli_name='$name' AND cli_surname='$surname';";
  $result = $conn -> query($query);
  $client = $result -> fetch_assoc();
  $id_client = $client['id_client'];

  $query = "INSERT INTO coursework.client_books (id_client, id_book, id_librarian) VALUES ('$id_client', '$id_book', '$id_librarian');";
  $result = $conn -> query($query);
}

function GetGenres(){
  global $conn;

  $query = "SELECT * FROM coursework.genre;";
  return $result = $conn -> query($query);
}

function GetBooks(){
  global $conn;

  $query = "SELECT * FROM coursework.books;";
  return $result = $conn -> query($query);
}

function GetBookInfo($id){
  global $conn;

  $query = "SELECT * FROM books_info WHERE id_book=$id;";
  $result = $conn -> query($query);
  $data = $result -> fetch_assoc();

  return $data;
}

function GetAuthorInfo($id){
  global $conn;

  $query = "SELECT * FROM coursework.authors WHERE id_author=$id;";
  $result = $conn -> query($query);
  $data = $result -> fetch_assoc();

  return $data;
}

function GetGenreInfo($id){
  global $conn;

  $query = "SELECT * FROM coursework.genre WHERE id_genre=$id;";
  $result = $conn -> query($query);
  $data = $result -> fetch_assoc();

  return $data;
}

function GetClientInfo($id){
  global $conn;

  $query = "SELECT * FROM coursework.client WHERE id_client=$id;";
  $result = $conn -> query($query);
  $data = $result -> fetch_assoc();

  return $data;
}

function GetUserInfo($id){
  global $conn;

  $query = "SELECT * FROM coursework.librarian WHERE id_librarian=$id;";
  $result = $conn -> query($query);
  $data = $result -> fetch_assoc();

  return $data;
}

function SetBook($id, $book_name, $author_name, $author_surname, $year, $genre, $quantity){
  global $conn;

  $query = "SELECT * FROM coursework.authors WHERE name='$author_name' AND surname='$author_surname';";
  $result = $conn -> query($query);
  $author = $result -> fetch_assoc();
  $id_author = $author['id_author'];

  $query = "SELECT * FROM coursework.genre WHERE genre='$genre';";
  $result = $conn -> query($query);
  $genre = $result -> fetch_assoc();
  $id_genre = $genre['id_genre'];

  $query = "UPDATE coursework.books SET book_name='$book_name', id_author='$id_author', year='$year', id_genre='$id_genre', quantity='$quantity' WHERE id_book='$id';";
  $result = $conn -> query($query);
}

function SetAuthor($id, $name, $surname, $patronymic){
  global $conn;

  $query = "UPDATE coursework.authors SET name='$name', surname='$surname', patronymic='$patronymic' WHERE id_author='$id';";
  $result = $conn -> query($query);
}

function SetGenre($id, $name){
  global $conn;

  $query = "UPDATE coursework.genre SET genre='$name' WHERE id_genre='$id';";
  $result = $conn -> query($query);
}

function SetClient($id, $name, $surname, $phone, $address, $work){
  global $conn;

  $query = "UPDATE coursework.client SET cli_name='$name', cli_surname='$surname', cli_phone='$phone', cli_address='$address', cli_work='$work' WHERE id_client='$id';";
  $result = $conn -> query($query);
}

function SetUser($id, $name, $surname, $phone, $address){
  global $conn;

  $query = "UPDATE coursework.librarian SET lib_name='$name', lib_surname='$surname', lib_phone='$phone', lib_address='$address' WHERE id_librarian='$id';";
  $result = $conn -> query($query);
}

function DeleteBook($id){
  global $conn;

  $query = "DELETE FROM coursework.books WHERE id_book=$id;";
  $result = $conn -> query($query);
}

function DeleteAuthor($id){
  global $conn;

  $query = "DELETE FROM coursework.authors WHERE id_author=$id;";
  $result = $conn -> query($query);
}

function DeleteGenre($id){
  global $conn;

  $query = "DELETE FROM coursework.genre WHERE id_genre=$id;";
  $result = $conn -> query($query);
}

function DeleteClient($id){
  global $conn;

  $query = "DELETE FROM coursework.client WHERE id_client=$id;";
  $result = $conn -> query($query);
}

function DeleteOrder($book_name, $id_client){
  global $conn;

  $query = "SELECT * FROM coursework.books WHERE book_name='$book_name';";
  $result = $conn -> query($query);
  $book = $result -> fetch_assoc();
  $id_book = $book['id_book'];

  $query = "DELETE FROM coursework.client_books WHERE id_book=$id_book AND id_client=$id_client;";
  $result = $conn -> query($query);
}
/* DB Functions End */

/* Check Functions Stars */
function CheckLogined(){
  if (!isset($_SESSION['user_id'])){
    header("Location: http://localhost/coursework/login.php");
  }
}

function CheckLoginUser($login, $password){
  global $conn;

  $query = "SELECT * FROM coursework.librarian WHERE lib_login='$login' AND lib_password=password('$password');";
  $result = $conn -> query($query);
  if(!empty($result)){
    $id = $result -> fetch_assoc();
    return $id;
  }
  return false;
}

function CheckAuthor($author_name, $author_surname){
  global $conn;

  $query = "SELECT * FROM coursework.authors WHERE name='$author_name' AND surname='$author_surname';";
  $result = $conn -> query($query);
  $num_rows = $result -> num_rows;

  if ($num_rows > 0){
    return true;
  }
  return false;
}

function CheckGenre($name){
  global $conn;

  $query = "SELECT * FROM coursework.genre WHERE genre='$name';";
  $result = $conn -> query($query);
  $num_rows = $result -> num_rows;

  if ($num_rows > 0){
    return true;
  }
  return false;
}

function CheckClient($name, $surname){
  global $conn;

  $query = "SELECT * FROM coursework.client WHERE cli_name='$name' AND cli_surname='$surname';";
  $result = $conn -> query($query);
  $num_rows = $result -> num_rows;

  if ($num_rows > 0){
    return true;
  }
  return false;
}

function CheckBook($book_name, $author_name, $author_surname){
  global $conn;

  $query = "SELECT * FROM coursework.books LEFT JOIN coursework.authors USING(id_author) WHERE authors.name='$author_name' AND authors.surname='$author_surname' AND books.book_name='$book_name';";
  $result = $conn -> query($query);
  $num_rows = $result -> num_rows;

  if ($num_rows > 0){
    return true;
  }
  return false;
}
/* Check Functions End */


 ?>
