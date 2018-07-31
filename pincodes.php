<?php require('header.php'); ?>

  <ul class="nav nav-tabs">
    <li class="nav-item">
      <a class="nav-link" href="index.php">Activated Locks</a>
    </li>
    <li class="nav-item">
      <a class="nav-link active" href="">Pin Codes</a>
    </li>
  </ul>

  <div id="lockInfo"><?php require('pincodeInterface.php'); ?></div>

<?php require('footer.php'); ?>
