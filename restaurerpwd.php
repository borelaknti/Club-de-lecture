<!DOCTYPE html>
<html>
<head>
	<?php include_once "layouts/header.php"; ?>
</head>
<body>
	<div class="generalInsc rest">
		<div class="title">
			<i class='fas  fa-angle-left '></i> <a class="back" href="index.php"> Page d'acceuil</a>
		</div>
		<div class="rest">
			<form>
				<fieldset>
					<legend>La lecture d’un roman jette sur la vie une lumière</legend>
					<table class="tab-insc" cellpadding="10" cellspacing="15">
						<tr><td><label for="email">Email:</label></td><td><input type="email" id="email" name="email"></td></tr>
					</table>
					<div class="btn-insc">
						<a href=""> <button  class="btn btn-clean"> restaurer </button> </a> <br> <br>
            			<a href="connexion.php"> <button type="button" class="btn btn-clean"> connexion </button> </a>
					</div>
				</fieldset>
			</form>	
		</div>
		<?php include_once "layouts/footer.php"; ?>
	</div>
</body>
</html>