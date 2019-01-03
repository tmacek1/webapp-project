

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href=""><img src="https://logosbynick.com/wp-content/uploads/2018/03/final-logo-example.png" style="width:120px;height:27px;"></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="welcome.php">Home</a></li>
        <li><a href="about_us.php">About</a></li>
        <li><a href="players.php">Players Database</a></li>
        <li><a href="contact_us.php">Contact</a></li>
        <?php
          if ($_SESSION['role'] == 'admin') {
            echo '<li><a href="admin_panel.php">Admin panel</a></li>';
	  }
        ?>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="logout.php"><span class="glyphicon glyphicon glyphicon-log-out"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
