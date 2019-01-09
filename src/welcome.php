<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);

include 'db.php';
include 'auth_check.php';
include 'header_menu.php';

?>

<!DOCTYPE html>
<body>
    <div class="jumbotron">
      <div class="container">
        <p><h1>Welcome page template</h1></p>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <h2>Test1</h2>
          <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
        </div>
        <div class="col-md-4">
          <h2>Test2</h2>
          <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
       </div>
        <div class="col-md-4">
          <h2>Test3</h2>
          <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
        </div>
      </div>
    </div>
  </div>

<div id="footer">
  <div class="container text-center">
    &copy;2018
  <script>
    new Date().getFullYear()>2018&&document.write("- " + new Date().getFullYear());
  </script>
    VVG/Tomislav Macek
  </div>
</div>

</body>
</html>