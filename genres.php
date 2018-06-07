<?php
@session_start();
require("functions.php");
CheckLogined();

DisplayHeader();

?>
<div class="main">
  <input onClick="window.location.href='addgenre.php'" type="button" value="Додати Жанр">
  <?php DisplayGenres();?>
</div>
<?php

DisplayFooter();
?>
