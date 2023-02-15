<?php
session_start();
?>        
<html>
<head> <link href="style.css" media="all" rel="stylesheet" type="text/css"/> </head>
<body>

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
    <li><a href="eleves.php">Liste Elèves </a></li>
    </ul> </html> <?php
  }
  else
  {
  	?>
  	<html>
  	</html> <?php
  }

  if ($connexion = mysqli_connect($serveurBDD,$userBDD,$mdpBDD,$nomBDD) )
  {     
        $id=$_SESSION["id"];     
        $requete="SELECT utilisateur.*, tuteur.nom as 'nomtuteur' , tuteur.tel as 'tuteurtel' FROM utilisateur,tuteur  
        WHERE 'type'=0"; //affiche tout les eleves
        ; //recupere tous les comptes rendus par date decroissante
        $resultat = mysqli_query($connexion, $requete);
        while($donnees = mysqli_fetch_assoc($resultat))
          {
          	$num=$donnees['num'];
            $nom=$donnees['nom'];
            $prenom=$donnees['prenom'];
            $nomt=$donnees['nomtuteur'];
           
            
           
             echo "<table border=2><thead> <tr> <th colspan=2> <u>n°$num</u> </th> </tr> </thead>
            <tbody> <tr> <td> $nom</td> 
             <t/r> <tbody> <tr> <td> $prenom </td> </tr> </thead><t/r> 
             <tbody> <tr> <td> Nom tuteur: $nomt </tr>

             <tr> <td> <a href='supprimer.php?id=num'>supprimer</a> </td> </tr> </tbody> </table> <br>"; 
        }
    

 
    }  

?>