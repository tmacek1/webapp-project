<?php
  include 'auth_check.php';
?>

<!DOCTYPE html>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>


  <?php
  include 'header_menu.php';
  ?>


    <div class="jumbotron">
      <div class="container">
        <p><h1>Contact us page</h1></p>
      </div>
    </div>


                                        <div class="col-md-5">
					<div class="mapouter">
                                                <div class="gmap_canvas">
                                                        <iframe width="582" height="370" id="gmap_canvas" src="https://maps.google.com/maps?q=velika%20gorica%2C%20vvg&t=k&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                                                </div>
                                                <style>.mapouter{text-align:right;height:370px;width:600px;}.gmap_canvas {overflow:hidden;background:none!important;height:370px;width:600px;}</style>
					</div>
					</div>
                                        </div>

                                        <div class="row">
                                                <div class="col-md-4">
                                                      <form>
                                                        <div class="form-group">
                                                                <input type="text" class="form-control" name="" value="" placeholder="Name" required>
                                                                <div class="form-group">
                                                                        <input type="email" class="form-control" name="" value="" placeholder="E-mail" required>
                                                                        <div class="form-group">
                                                                                <div class="form-group">
                                                                                        <textarea class="form-control" name="" rows="3" placeholder="Message" required></textarea>
                                                                                </div>
                                                                                <button class="btn btn-default btn-success" type="submit" name="button">
                                                                                       Submit
                                                                                </button>
                                                                        </div>
                                                                </div>
                                                              </div>
                                                        </form>
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

</html>
