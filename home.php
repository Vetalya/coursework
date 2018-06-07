<?php
require("functions.php");
CheckLogined();

DisplayHeader();

?>
<div class="main">
  <input onClick="window.location.href='addbook.php'" type="button" value="Додати Книгу">
  <?php DisplayBooks();?>
</div>
<?php

DisplayFooter();
?>
