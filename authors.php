<?php
@session_start();
require("functions.php");
CheckLogined();

DisplayHeader();

?>
<div class="main">
  <input onClick="window.location.href='addauthor.php'" type="button" value="Додати Автора">
  <?php DisplayAuthors();?>
</div>
<?php

DisplayFooter();
?>
