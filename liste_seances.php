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
    <h3 style="font-size:3.5rem;text-align:left;color: #333;padding-top: 5%;padding-left: 12%;font-family: 'boldfont', serif;font-weight: lighter;">Liste des séances</h3>
    <?php
      // Connexion
      $dbhost = 'tuxa.sme.utc';
      $dbuser = 'nf92a001';
      $dbpass = '8kxDVZYm';
      $dbname = 'nf92a001';
      $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');

      // Si $GET['tri'] est vide (c'est le cas par défaut), les séances sont classées par ID
      // Lorsque l'utilisateur appuie sur un bouton de tri, la valeur choisie est passée dans l'URL et récupérée dans $_GET['tri']
      if (empty($_GET['tri'])) {
        $choix_affichage='idseance';
      } else {
        $choix_affichage=$_GET['tri'];
      }

      // $result reçoit un tableau de séances dans l'ordre sélectionné
      $sql = "SELECT * FROM `seances2` ORDER BY $choix_affichage";
      $result = mysqli_query($conn, $sql);
    ?>
    <!-- Les 3 liens rechargent cette page, en passant la valeur de tri dans l'URL  -->
    <a class="buttontri" style="margin-left:37.4%;background-color:#858585;" href="liste_seances.php">Défaut <img src="images/triangle.png" alt=""></a>
    <a class="buttontri" href="liste_seances.php?tri=date_seance">Tri par date <img src="images/triangle.png" alt=""></a>
    <a class="buttontri" href="liste_seances.php?tri=idtheme">Tri par thème <img src="images/triangle.png" alt=""></a>

    <!-- Affichage des séances -->
    <table>
      <tr>
        <th>ID</th>
        <th>Date</th>
        <th>Eff. Max.</th>
        <th>Thème</th>
      </tr>
      <?php
        // Pour chaque séance :
        while($row = $result->fetch_array()) {
          // On stocke les informations de la séance dans des variables
          $id = $row['idseance'];
          $date = $row['date_seance'];
          $effmax = $row['effmax'];
          $theme = $row['idtheme'];

          //On récupère le nom du thème correspondant à cet ID
          $sql2 = "SELECT * FROM `themes2` WHERE id_theme = $theme";
          $result2 = mysqli_query($conn, $sql2);
          $table_themes = $result2->fetch_array();
          $nomtheme = $table_themes['nom'];

          //On affiche une ligne dans le tableau
          echo "<tr>";
          echo "<td>$id</td>";
    		  echo "<td>$date</td>";
    	  	echo "<td>$effmax</td>";
          echo "<td>$nomtheme</td>";
          echo "</tr>";
        }
        $result = mysqli_query($conn, $sql);
        if (!($row = $result->fetch_array())) {
          echo "<tr><td></td><td>Aucune séance</td><td></td><td></td></tr>";
        }
        mysqli_close($conn);
      ?>
    </table>
  </div>
  <!-- Pied de page -->
  <div class="bottom-container" style="margin-top:200px;">
      <a href="https://www.facebook.com/Nitroschool-105795200928016/"><img src="images/facebook.png" height="80px" alt=""></a>
      <a href="https://twitter.com/nitroschool/"><img src="images/twitter.png" height="80px" alt=""></a>
      <a href="https://www.instagram.com/nitroschool/?hl=fr/"><img src="images/instagram.png" height="80px" alt=""></a>
      <p style="word-spacing: normal ; color: white; font-size: 1em ; font-family: 'Lora', serif;";>© 2019 Benjamin Missaoui</p>
  </div>
 </body>
</html>
