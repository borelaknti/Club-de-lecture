<!DOCTYPE html>
<html>
<head>
	<?php include_once "layouts/header.php"; ?>
</head>
<body>
	<div class="generalInsc rest">
		<div class="rest">
			<form>
				<fieldset>
					<legend>Formulaire de reinitialisation du mot de passe</legend>
					<table class="tab-insc" cellpadding="10" cellspacing="15">
						<tr><td><label for="email">Email:</label></td><td><input type="email" id="email" name="email"></td></tr>
						<tr><td><label for="email">Mot de passe:</label></td><td><input type="email" id="email" name="email"></td></tr>
						<tr><td><label for="email">Confirmation de mot de passe:</label></td><td><input type="email" id="email" name="email"></td></tr>
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