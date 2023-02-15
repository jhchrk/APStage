<?php
session_start();
?>
<html>
    <head> <link href="style.css" media="all" rel="stylesheet" type="text/css"/> </head>
    <body>

<?php
include 'conf.php';

if (isset($_SESSION["login"]))
 
    {

        if($_SESSION["type"]==0)
        {
          ?>
         <ul class="nav">
        <li><a href="accueil.php">Accueil</a></li>
        <li><a href="perso.php">Profil</a></li>
        <li><a href="cr.php">Compte rendus</a></li>
        <li><a href="nouveauCR.php">Nouveau compte-rendu</a></li>
        </ul>
 
            <?php
            
        }
        else
        {
?>
              <ul class="nav">
        <li><a href="accueil.php">Accueil</a></li>
        <li><a href="perso.php">Profil</a></li>
        <li><a href="cr.php">Compte rendus</a></li>
        </ul> </html
<?php
            echo "vous êtes un prof<br>";
             echo "Vous êtes connecté en tant que ".$_SESSION["nom"]. $_SESSION["prenom"]."<br> <br>";
            echo "<FORM method='post' action='index.php'> <button type=submit name='deco'> DECONNEXION </button> </form>";
        }
    }


//on récupère la variable GET ID
    $id=$_GET['id'];
    //echo $id;


    if (isset($_POST['update']))
    {
      $description=$_POST['contenu'];
      $requete="UPDATE `CR` SET `description` = '$description' WHERE `CR`.`num` = '$id'; ";
        echo "<br> ma req SQL : $requete <br>";
   $connexion = mysqli_connect($serveurBDD ,$userBDD,$mdpBDD,$nomBDD);
  $resultat = mysqli_query($connexion, $requete);
    }
      









//REQUETE SQL POUR SELECTIONNER CE CR (id)
  //  $requete="SELECT* FROM CR WHERE CR.num= $id ";
   $connexion = mysqli_connect($serveurBDD ,$userBDD,$mdpBDD,$nomBDD);
    $requete="SELECT* FROM CR WHERE CR.num= $id"; //recupere données utilisateur 
    //echo "<br> ma req SQL : $requete <br>";
    $resultat = mysqli_query($connexion, $requete);
    $trouve=0;
    if ($donnees = mysqli_fetch_assoc($resultat))
      {
   
        $trouve=1;   
        $date=$donnees['date'];
        $id=$donnees['num'];
         $description=$donnees['description'];

echo "<FORM method='post' action='modif.php?id=$id'> ";?>


<div> <font size=20 align="center"> Modifier un compte rendu  </font> </div>
<br> 
<div> Date:</div><?php echo $date;     ?>
<div> Contenu <textarea name="contenu" rows=10 cols=40><?php echo $description;     ?></textarea>
<br>
<div> <button type="submit" action="cr.php" name="update"> MODIFIER </button>
</form>

        <?php 
}


//AFFICHAGE DANS UN FORMULAIRE AVEC BOUTON


//qUAND ON CLICK BOUTON ON FAIT UPDATE
    
?>