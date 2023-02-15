<?php
session_start();
?>

<html>
<head> <link href="style.css" media="all" rel="stylesheet" type="text/css"/> </head>
<body> </html>
<?php
include 'conf.php';
if ($_SESSION["type"] ==1) //si connexion en prof
  {
    ?>
    <html>
    <ul class="nav">
    <li><a href="accueil.php">Accueil</a></li>
    <li><a href="perso.php">Profil</a></li>
    <li><a href="cr.php">Compte rendus</a></li>
    <li><a href="eleves.php"> Liste Elèves </a></li>
    </ul> </html> <?php
  }
else
  {
    ?>
    <html>
    <ul class="nav">
    <li><a href="accueil.php">Accueil</a></li>
    <li><a href="perso.php">Profil</a></li>
    <li><a href="cr.php">Compte rendus</a></li>
    <li><a href="nouveauCR.php">Nouveau compte-rendu</a></li>
    </ul> </html> <?php
  }


// AFFICHER LE PROFIL DE L4ELEVE
  if ($connexion = mysqli_connect($serveurBDD,$userBDD,$mdpBDD,$nomBDD) )
    {
      $id=$_SESSION["id"];
      $requete="SELECT * FROM utilisateur WHERE utilisateur.num=$_SESSION[id]";

      $resultat = mysqli_query($connexion, $requete);
      while ($donnees = mysqli_fetch_assoc($resultat))
      {
        $nom=$donnees['nom'];
        $prenom=$donnees['prenom'];
        $email=$donnees['email'];
        $tel=$donnees['tel'];


        echo "Votre nom: $nom <br>";
        echo "Votre prenom: $prenom <br>";
        echo "Votre email : $email <br>";
        echo "Votre tel: $tel <br>";      }
        ?>
       
       <html>
       <hr>
       </html>
<?php
        // afficher les infos du tuteur
    $id=$_SESSION["id"];

      $requete="SELECT * FROM tuteur WHERE tuteur.num=$_SESSION[id]";
       $resultat = mysqli_query($connexion, $requete);
      while ($donnees = mysqli_fetch_assoc($resultat))
{

       $num=$donnees['num'];
       $nom=$donnees['nom'];
       $prenom=$donnees['prenom'];
       $tel=$donnees['tel'];
       $email=$donnees['email'];


       echo "Num tuteur: $num <br>";
       echo "Nom tuteur: $nom <br>";
       echo "Prenom tuteur: $prenom <br>";
       echo "Teléphone tuteur: $tel <br>";
       echo "Email tuteur: $email <br>";



}





    }
 
?>
