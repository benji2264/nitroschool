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
    <?php
      //Connexion
      date_default_timezone_set('Europe/Paris');
      $date_du_jour = date("Y-m-d");
      $dbhost = 'tuxa.sme.utc';
      $dbuser = 'nf92a001';
      $dbpass = '8kxDVZYm';
      $dbname = 'nf92a001';
      $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');

      // Récupération de l'élève choisi
      $choix_eleve=$_POST['eleve'];

      // Récupération de l'élève correspondant dans le BDD
      $requete_eleve = "SELECT * FROM `eleves2` WHERE id_eleve='$choix_eleve'";
      $result_eleve = mysqli_query($conn, $requete_eleve);
      $ligne_eleve=$result_eleve->fetch_array();

      // Stockage du nom/prénom de l'élève choisi dans $nom et $prenom
      $nom = $ligne_eleve['nom'];
      $prenom = $ligne_eleve['prenom'];
    ?>
    <h3 style="font-size:3.5rem;text-align:left;color: #333;padding-top: 5%;padding-left: 12%;font-family: 'boldfont', serif;font-weight: lighter;">Futures séances de <?php echo "$prenom $nom";?></h3>

    <!-- Affichage des séances de l'élève -->
    <table>
      <tr>
        <th>ID</th>
        <th>Date de la séance</th>
        <th>Thème</th>
      </tr>
      <?php
        //$result reçoit les séances auxquels l'élève est inscrit
        $sql = "SELECT * FROM `inscription2` WHERE id_eleve='$choix_eleve'";
        $result = mysqli_query($conn, $sql);

        $cpt=0;
        while($row = $result->fetch_array()) { // Pour chaque inscription :
          $idseance = $row['id_seance'];       // - On récupère l'ID de la séance
          $sql4 = "SELECT * FROM `seances2` WHERE idseance='$idseance'";
          $result4 = mysqli_query($conn, $sql4);
          $row4 = $result4->fetch_array();
          $date=$row4['date_seance'];          // - On récupère la date de la séance correspondante
          $idt = $row4['idtheme'];             // - On récupère le thème de la séance
          $sql5 = "SELECT * FROM `themes2` WHERE id_theme='$idt'";
          $result5 = mysqli_query($conn, $sql5);
          $row5 = $result5->fetch_array();
          $nom_theme=$row5['nom'];            // - On récupère le nom du thème correspondant

          if ($date_du_jour<$date) {          // Puis on affiche cette inscription si la date de la séance n'est pas passée
            echo "<tr>";
            echo "<td>$idseance</td>";
            echo "<td>$date</td>";
            echo "<td>$nom_theme</td>";
            $cpt=$cpt+1;                      // Et le compteur s'incrémente : il compte le nombre de "futures séances"
            echo "</tr>";
          }
        }
        if ($cpt==0) {                        // Si le compteur vaut 0, c'est donc que l'élève n'est inscrit à aucune (future) séance
         echo "<tr><td></td>";
         echo "<td>Cet élève n'est inscrit à aucune séance</td>";
         echo "<td></td></td>
         </tr>";
       }
       mysqli_close($conn);
       ?>
  </table>

  <!-- Pied de page -->
      <div class="bottom-container" style="margin-top:200px;">
        <a href="https://www.facebook.com/Nitroschool-105795200928016/"><img src="images/facebook.png" height="80px" alt=""></a>
        <a href="https://twitter.com/nitroschool/"><img src="images/twitter.png" height="80px" alt=""></a>
        <a href="https://www.instagram.com/nitroschool/?hl=fr/"><img src="images/instagram.png" height="80px" alt=""></a>
        <p style="word-spacing: normal ; color: white; font-size: 1em ; font-family: 'Lora', serif;";>© 2019 Benjamin Missaoui</p>
      </div>
    </body>
  </html>
