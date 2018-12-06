<?php require('header.php'); ?>

  <ul class="nav nav-tabs">
    <li class="nav-item">
      <a class="nav-link active" href="index.php">Activated Locks</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="gateway.php">Activated Gateways</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="door-events.php">Door Events</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="door-events.php">Bookings</a>
    </li>
  </ul>

  <div id="lockInfo"><?php require('locksInterface-2.php'); ?></div>

<?php require('footer.php'); ?>
