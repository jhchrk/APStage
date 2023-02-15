<?php
session_start();
?>
<?php

      if (isset($_POST['deco']))
            {
              session_destroy();
              //détruit la session après clique sur bouton deconnexion
              echo " vous êtes deconnectée";
            } 
?>
<html>
<center>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
    <br>
    
	<form method="POST" action="accueil.php">
    login : <input type="text" name="login">
    <br> <br>
    mot de passe : <input type="password" name="mdp"><br>
    <br>

    <input type="submit" name="envoi" value="OK">
</form>
	
