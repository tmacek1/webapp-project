<?php
  include 'auth_check.php';
  include 'header_menu.php';
?>

<!DOCTYPE html>

<div class="jumbotron">
      <div class="container">
        <p><h1>About us page</h1></p>
					 <h3>This is working example</h3>
					 <p class="about-paddingB">Webapp project</p>
					 <p>Author: Tomislav Maček, ORS - izvanredni</p>
					 <div>
							<a href="https://www.facebook.com/">
							<i id="social-fb" class="fa fa-facebook-square fa-3x social"></i>
							</a>
							<a href="https://twitter.com/">
							<i id="social-tw" class="fa fa-twitter-square fa-3x social"></i>
							</a>
							<a href="https://plus.google.com/">
							<i id="social-gp" class="fa fa-google-plus-square fa-3x social"></i>
							</a>
							<a href="mailto:tmacek2@vvg.hr">
							<i id="social-em" class="fa fa-envelope-square fa-3x social"></i>
							</a>
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

</html>
