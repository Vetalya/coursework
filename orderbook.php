<?php
require("functions.php");
CheckLogined();

DisplayHeader();

?>
<div class="main">
  <input onClick="window.location.href='addorder.php'" type="button" value="Додати Замовлення">
  <?php DisplayOrders(); ?>
</div>
<?php

DisplayFooter();
?>
