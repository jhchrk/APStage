<?php
session_start();
?>        
<html>
<head> <link href="style.css" media="all" rel="stylesheet" type="text/css"/> </head>
<body>

<?php
include 'conf.php';
if (isset($_POST['update'])) //recupere données de nouveaucr.php
      {
        $date=$_POST['date'];
        $contenu= addslashes($_POST['contenu']);
        $id=$_SESSION["id"];
       // $note=$_POST['note'];
$connexion = mysqli_connect($serveurBDD,$userBDD,$mdpBDD,$nomBDD);
        $requete="INSERT INTO cr (date,datetime,description,num_utilisateur) VALUES ('$date',NOW(),'$contenu','$id');"; //crée nouveau compte rendu avec infos recuperees
//echo "<br>$requete<hr>";
        if(!mysqli_query($connexion,$requete)) 
            {
            echo "erreur";
            }
        else //si possibilité de faire la requete :
            {
           echo "nouveau compte-rendu crée";
            }
    }
if (isset ($_POST['modif'])) //recupere les donnees de modif.php
{
        if (isset($_GET['id'])) //verifi que la variable est envoyer
        {
         
         $nomvar=$GET['id'];
        }

       $contenu= addslashes($_POST['contenu']);
       $id=$_SESSION['id'];
       $connexion = mysqli_connect($serveurBDD,$userBDD,$mdpBDD,$nomBDD);
       $requete="UPDATE cr SET description = '$contenue' WHERE num_utilisateur=$id AND num=$nomvar"; //modifier le compte rendu
       if(!mysqli_query($connexion,$serveur))
       {
         echo "erreur";
       }
       else
       {
         echo "Compte-rendu modifié";
       }

}

if ($_SESSION["type"] ==1) //si connexion en prof
  {
 ?>
  
    <ul class="nav">
    <li><a href="accueil.php">Accueil</a></li>
    <li><a href="perso.php">Profil</a></li>
    <li><a href="cr.php">Compte rendus</a></li>
    <lI><a href="eleves.php">Liste Elèves</a></li>
    </ul> 
<?php
     if($connexion = mysqli_connect($serveurBDD,$userBDD,$mdpBDD,$nomBDD))
      {
        $id=$_SESSION["id"];     
        $requete="SELECT * FROM cr,utilisateur WHERE utilisateur.num = cr.num_utilisateur ORDER BY date DESC";
         //recupere tous les comptes rendus par date decroissante ( du plus récent au plus ancien)

        $resultat = mysqli_query($connexion, $requete);
        while($donnees = mysqli_fetch_assoc($resultat))
          {
            $num=$donnees['num'];
            $contenu=$donnees['description'];
            $nom=$donnees['nom'];
            
            
            
            echo "<table border=2><thead> <tr> <th colspan=2> <u>Compte rendu n°$num de $nom</u> </th> </tr> </thead>
            <tbody> <tr> <td>  $contenu</td> </tr>   </td> </tr> </tbody> </table> <br>"; // affiche les CR du plus recent au plus ancien 
          }
    }
 ?>
<?php 
}
else //si connexion en eleve
  { 
    ?>
    
    <ul class="nav">
    <li><a href="accueil.php">Accueil</a></li> 
    <li><a href="perso.php">Profil</a></li>                                                                                    
    <li><a href="cr.php">Compte rendus</a></li>
    <li><a href="nouveaucr.php">Nouveau compte-rendu</a></li>
    </ul> 
 <?php

       if($connexion = mysqli_connect($serveurBDD,$userBDD,$mdpBDD,$nomBDD))
      {
        $id=$_SESSION["id"];     
        $requete="SELECT cr.* FROM cr,utilisateur WHERE utilisateur.num = cr.num_utilisateur AND utilisateur.num=$_SESSION[id] ORDER BY date DESC"; //recupere tous les comptes rendus par date decroissante
        $resultat = mysqli_query($connexion, $requete);
        while($donnees = mysqli_fetch_assoc($resultat))
          {
            $num=$donnees['num'];
            $contenu=$donnees['description'];
            $note=$donnees['note'];
            
            echo "<table border=2><thead> <tr> <th colspan=2> <u>n°$num</u> </th> </tr> </thead>
            <tbody> <tr> <td> $contenu</td>  <tr> <tr> <td> <a href='modif.php?id=$num'>Modifier</a> </td> </tr> </tbody> </table> <br>";  //affiche tous les compte rendus du plus recent au plus ancien + lien pour modifier
          }
    }

 
    }  

?>