<body>
	<?php include '_topbar.php'; ?>
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
				<form action="envoie.php" method="post" enctype="application/x-www-form-urlencoded" name="formulaire">
				<tr> 
				<td colspan="3"><strong>Envoyer un message</strong></td>
				</tr>
				<tr> 
				<td><div align="left">Votre nom :</div></td>
				<td colspan="2"><input type="text" name="nom" size="45" maxlength="100"></td>
				</tr>
				<tr> 
				<td width="17%"><div align="left">Votre mail :</div></td>
				<td colspan="2"><input type="text" name="mail" size="45" maxlength="100"></td>
				</tr>
				<tr> 
				<td><div align="left">Sujet : </div></td>
				<td colspan="2"><input type="text" name="objet" size="45" maxlength="120"></td>
				</tr>
				<tr> 
				<td><div align="left">Message : </div></td>
				<td colspan="2"><textarea name="message" cols="50" rows="10"></textarea></td>
				</tr>
				<tr> 
				<td></td>
				<td width="42%"><center>
				<input type="reset" name="Submit" value="Réinitialiser le formulaire">
				</center></td>
				<td width="41%"><center>
				<input type="submit" name="Submit" value="Envoyer">
				</center></td>
				</tr>
				</form>
				</table>
			</div>
		</div>
	</div>
</body>


