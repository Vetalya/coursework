<?php
@session_start();
unset($_SESSION['user_id']);
unset($_SESSION['user_name']);
unset($_SESSION['msg']);
unset($_SESSION['id_book']);
unset($_SESSION['id_author']);
unset($_SESSION['id_genre']);
unset($_SESSION['id_client']);
unset($_SESSION['book_name']);
header("Location: http://localhost/coursework/login.php");

 ?>
