<!DOCTYPE html>
<html>
  <meta charset="UTF-8">
    <style>
    ::placeholder {
      color: white;
      opacity: 0.8;
    }
    </style>
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
    <h3 style="font-size:3.5rem;text-align:left;color: #333;padding-top: 5%;padding-left: 12%;font-family: 'boldfont', serif;font-weight: lighter;">Liste des élèves</h3>
    <?php
      // Connexion
      $dbhost = 'tuxa.sme.utc';
      $dbuser = 'nf92a001';
      $dbpass = '8kxDVZYm';
      $dbname = 'nf92a001';
      $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');

      // Si $GET['tri'] est vide (c'est le cas par défaut), les élèves sont classés par ID
      // Lorsque l'utilisateur appuie sur un bouton de tri, la valeur choisie est passée dans l'URL et récupérée dans $_GET['tri']
      if (empty($_GET['tri'])) {
        $choix_affichage='id_eleve';
      } else {
        $choix_affichage=$_GET['tri'];
      }

	     // On récupère l'élève recherché avec $_POST['eleve'] au 1er chargement, puis avec $_GET['eleve'] si un tri est spécifié
      if (empty($_POST['eleve'])) {
        $choix_recherche=$_GET['eleve'];
      } else {
        $choix_recherche=$_POST['eleve'];
      }

      // $result reçoit un tableau d'élèves dans l'ordre sélectionné
      $sql = "SELECT * FROM `eleves2` WHERE nom='$choix_recherche' OR prenom='$choix_recherche' ORDER BY $choix_affichage";
      $result = mysqli_query($conn, $sql);
    ?>

    <!-- Formulaire de recherche d'un élève et de tri des résultats -->
    <form action="rechercher_eleve.php" method="post">
      <!-- Les 4 liens rechargent cette page, en passant la valeur de tri dans l'URL  -->
      <a class="buttontri" style="margin-left:27%;background-color:#858585;" href="rechercher_eleve.php?tri=id_eleve&eleve=<?php echo "$choix_recherche"; ?>">Défaut <img src="images/triangle.png" alt=""></a>
      <a class="buttontri" href="rechercher_eleve.php?tri=nom&eleve=<?php echo "$choix_recherche"; ?>">Tri par nom <img src="images/triangle.png" alt=""></a>
      <a class="buttontri" href="rechercher_eleve.php?tri=prenom&eleve=<?php echo "$choix_recherche"; ?>">Tri par prenom <img src="images/triangle.png" alt=""></a>
      <a class="buttontri" href="rechercher_eleve.php?tri=date_naissance&eleve=<?php echo "$choix_recherche"; ?>">Tri par âge <img src="images/triangle.png" alt=""></a>

      <!-- Champ de recherche de l'élève, bouton loupe pour submit le form -->
      <input required type="search" style="text-align:left;width:210px;background-color:#008ef2;" placeholder="Recherche..." class="buttonsearch place" name="eleve">
      <button class="buttonloupe" style="position:absolute;margin-left:-60px;margin-top:10px;" type="submit">Y<img src='images/loupe3.png' alt='loupe' height='20' width='20' ></button>
    </form>

    <!-- Affichage des élèves -->
    <table  width='880px;'>
      <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Sexe</th>
        <th>Date de naissance</th>
        <th>Consulter</th>
      </tr>

      <!-- Formulaire pour consulter un élève (loupe à la fin de chaque ligne du tableau) -->
      <form method="post" action="consultation_eleve.php" style="margin: 0; padding:0;">
      <?php
        // Si l'élève n'existe pas
        if ($row = $result->fetch_array()) {} else {
          echo "<tr><td></td><td></td><td>Aucun résultat</td><td></td><td></td><td></td></tr>";
        }
        $result = mysqli_query($conn, $sql);

        // Sinon, pour chaque élève :
        while($row = $result->fetch_array()) {

          // On stocke les informations de l'élève dans des variables
          $id = $row['id_eleve'];
          $nom = $row['nom'];
          $prenom = $row['prenom'];
          $sexe = $row['sexe'];
          $email = $row['email'];
          $date_naissance = $row['date_naissance'];
          $date_inscription = $row['date_inscription'];

          // On affiche une ligne contenant ces informations...
          echo "<tr>";
          echo "<td>$id</td>";
    		  echo "<td>$nom</td>";
    	  	echo "<td>$prenom</td>";
          // ... avec une icône différente selon le sexe de l'élève
          if ($sexe=='F') {
            echo "<td><img src='images/female.png' alt='Smiley face' height='25' width='21' style='margin-left:5%;margin-right:auto;'></td>";
          } else {
            echo "<td><img src='images/male.png' alt='Smiley face' height='25' width='21' style='margin-left:5%;margin-right:auto;'></td>";
          }
          echo "<td>$date_naissance</td>";
          // ... et avec un bouton loupe en fin de ligne pour consulter l'élève
          echo "<td><a class='buttonloupe2' href='consultation_eleve.php?id=$id'> <img src='images/loupe.png' alt='loupe' height='25' width='25' style='margin-left:5%;margin-right:auto;'> </a></td>";
          echo "</tr>";
        }
        mysqli_close($conn);
     ?>
    </form>
  </table>
  <!-- Retour -->
  </div><br><br><br><br>
  <a class="button" href="liste_eleves.php" style="padding: 15px 45px;margin-top:120px;margin-left:45.5%;margin-right:auto;">Retour</a>

  <!-- Pied de page -->
      <div class="bottom-container" style="margin-top:200px;">
        <a href="https://www.facebook.com/Nitroschool-105795200928016/"><img src="images/facebook.png" height="80px" alt=""></a>
        <a href="https://twitter.com/nitroschool/"><img src="images/twitter.png" height="80px" alt=""></a>
        <a href="https://www.instagram.com/nitroschool/?hl=fr/"><img src="images/instagram.png" height="80px" alt=""></a>
        <p style="word-spacing: normal ; color: white; font-size: 1em ; font-family: 'Lora', serif;";>© 2019 Benjamin Missaoui</p>
      </div>
    </body>
  </html>
