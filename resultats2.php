<!DOCTYPE html>
<html>
  <meta charset="UTF-8">
    <head>
      <!-- Polices d'écriture et style CSS -->
      <link rel="stylesheet" href="css/newstyle.css">
      <link href="https://fonts.googleapis.com/css?family=Alegreya&display=swap" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Crimson+Text&display=swap" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Lora&display=swap" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Nobile&display=swap" rel="stylesheet">
      <link rel="icon" href="images/favicon.ico">
      <link rel="stylesheet" href="fonts/fonts.css" type="text/css"  />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <title>L'Autoécole du futur</title>
    </head>
    <body>
    <!-- Barre de navigation -->
    <div class="newnav">
      <div style="background-color:white">
          <a href="index.html"><img class="logo" height="54px" style="margin-left:95px;padding-bottom:9px;" src="images/logoRoro.png" alt="logo"></a>
            <!-- Menu Elèves -->
            <div style="margin-left:3.5%" class="dropdown">
                <button class="dropbtn">Elèves  <img src="images/icon_bottom.png" class="triangle" alt=""></button>
                <div class="dropdown-content">
                <a href="liste_eleves.php">Consulter un élève</a>
                <a href="ajouter_eleve2.html">Ajouter un élève</a>
                <a href="calendrier_eleve.php">Calendrier élève</a>
                <a href="statistiques_eleve.php">Statistiques élève</a>
                </div>
              </div>
          <!-- Menu Séances -->
          <div class="dropdown">
              <button class="dropbtn">Séances  <img src="images/icon_bottom.png" class="triangle" alt=""></button>
              <div class="dropdown-content">
              <a href="liste_seances.php">Afficher les séances</a>
              <a href="ajouter_seance.php">Ajouter une séance</a>
              <a href="supprimer_seance.php">Supprimer une séance</a>
              <a href="inscription.php">Inscrire un élève</a>
              <a href="desinscription.php">Désinscrire un élève</a>
              <a href="resultats.php">Saisir résultats d'une séance</a>
              </div>
            </div>
        <!-- Menu Thèmes -->
        <div class="dropdown">
            <button class="dropbtn">Thèmes  <img src="images/icon_bottom.png" class="triangle" alt=""></button>
            <div class="dropdown-content">
            <a href="liste_themes.php">Gérer les thèmes</a>
            <a href="ajouter_theme.html">Ajouter un thème</a>
            </div>
        </div>
        <a class="deco" href="index.html" style="padding:12px;float:right;margin-right:75px;">Déconnexion</a>
      </div>
      <!-- Ombre sous la barre -->
      <div class="shadow"></div>
    </div>
    <h3 style="font-size:3.5rem;text-align:left;color: #333;padding-top: 5%;padding-left: 12%;font-family: 'boldfont', serif;font-weight: lighter;">élèves inscrits à cette séance</h3>

<!-- Affichage d'un tableau à compléter avec les notes des élèves -->
<form class="tablist" action="resultats3.php" method="post">
    <table>
      <tr>
        <th>Elève</th>
        <th>Nombre de fautes</th>
      </tr>

      <?php
        // Connexion
        $dbhost = 'tuxa.sme.utc';
        $dbuser = 'nf92a001';
        $dbpass = '8kxDVZYm';
        $dbname = 'nf92a001';
        $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');

        // On récupère la séance choisie
        $choix_seance=$_POST['seance'];

        // $result reçoit la liste des étudiants inscrits à cette séance
        $sql = "SELECT * FROM `inscription2` WHERE id_seance='$choix_seance'";
        $result = mysqli_query($conn, $sql);

        // On transmet en hidden la séance choisie pour la page resultats3.php
        echo "<input required type=".'"hidden"'; echo 'name ="seance" value='."$choix_seance";  echo " placeholder=".'"5"'." style=".'"background-color:transparent;padding:0;margin:0;vertical-align: middle;text-align:center;"'."";


        // Si des élèves sont inscrits à la séance :
        if ($row = $result->fetch_array()) {
          $result = mysqli_query($conn, $sql);

          // Pour chaque élève inscrit à la séance choisie :
          while($row = $result->fetch_array()) {
            $id = $row['id_eleve']; //On récupère l'ID de l'élève
            $sql4 = "SELECT * FROM `eleves2` WHERE id_eleve='$id'"; //On recherche le nom/prénom correspondant
            $result4 = mysqli_query($conn, $sql4);
            $row4 = $result4->fetch_array();
            $prenom=$row4['prenom'];
            $nom=$row4['nom'];
            $fautes_actuelles = $row['fautes']; // On récupère l'ancienne note (si l'élève à déjà été noté)

            // Puis on affiche une ligne de tableau, avec une input à remplir au bout (préremplie si l'élève a déjà été noté)
            // On range la note que l'utilisateur va entrer dans $_POST[id]
            echo "<tr>";
            echo "<td>$id. $prenom $nom</td>";
      		  echo "<td><input type='number' max='40' min='0' value='$fautes_actuelles' name='$id' placeholder='5' style='background-color:transparent;padding:0;margin:0;vertical-align: middle;text-align:center;'</td>";
            echo "</tr>";
         }
         // Et enfin, on affiche un bouton pour submit le form
         echo '
         </table>
                 <button type="submit" class="button" style="margin-left:44%;margin-right:auto;margin-top:65px;">Valider la saisie</button>';
        }
        // Si aucun élève n'est inscrit, on affiche une ligne vide et un bouton de retour
        else {
          echo "<tr>";
          echo "<td>Aucun élève n'est inscrit à cette séance</td>";
          echo "<td></td></tr>";
          echo '</table><button type="submit" class="button" formaction="resultats.php" style="margin-left:46%;margin-right:auto;margin-top:100px;">Annuler</button>';
        }
       mysqli_close($conn);
      ?>
    </form>
    <!-- Pied de page -->
    <div class="bottom-container" style="margin-top:200px;">
      <a href="https://www.facebook.com/Nitroschool-105795200928016/"><img src="images/facebook.png" height="80px" alt=""></a>
      <a href="https://twitter.com/nitroschool/"><img src="images/twitter.png" height="80px" alt=""></a>
      <a href="https://www.instagram.com/nitroschool/?hl=fr/"><img src="images/instagram.png" height="80px" alt=""></a>
      <p style="word-spacing: normal ; color: white; font-size: 1em ; font-family: 'Lora', serif;";>© 2019 Benjamin Missaoui</p>
    </div>
  </body>
</html>
