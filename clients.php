<?php
require("functions.php");
CheckLogined();

DisplayHeader();

?>
<div class="main">
  <input onClick="window.location.href='addclient.php'" type="button" value="Додати Читача">
  <?php DisplayClients(); ?>
</div>
<?php

DisplayFooter();
?>
