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
    <h3 style="font-size:3.5rem;text-align:left;color: #333;padding-top: 5%;padding-left: 12%;font-family: 'boldfont', serif;font-weight: lighter;">Liste des thèmes actifs</h3>
    <?php
      // Connexion
      $dbhost = 'tuxa.sme.utc';
      $dbuser = 'nf92a001';
      $dbpass = '8kxDVZYm';
      $dbname = 'nf92a001';
      $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');

      // $result reçoit la liste des thèmes actifs
      $sql = "SELECT * FROM `themes2` WHERE supprime=0";
      $result = mysqli_query($conn, $sql);
    ?>
    <!-- Affichage des thèmes actifs -->
    <table width="1200px;">
      <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Description</th>
        <th>Désactiver</th>
    </tr>


    <?php
      // S'il existe des thèmes actifs :
      if ($row = $result->fetch_array()){
        $result = mysqli_query($conn, $sql);

        // Pour chaque thème actif :
        while($row = $result->fetch_array()) {
          // On stocke ses attributs dans des variables
          $id = $row['id_theme'];
          $nom = $row['nom'];
          $desc = $row['description'];

          // On affiche une ligne
          echo "<tr>";
          echo "<td>$id</td>";
          echo "<td>$nom</td>";
          echo "<td>$desc</td>";
          echo "<td><a href='desactiver_theme2.php?id=$id'> <img src='images/binicon.svg' alt='Smiley face' height='25' width='25' style='margin-left:5%;margin-right:auto;'> </a></td>";
          echo "</tr>";
       }
      // Si aucun thème n'est actif, on affiche une ligne vide
      } else {
        echo "<tr><td></td><td>Aucun thème n'est actif</td><td></td><td></td></tr>";
    }
  ?>
  </table>

  <h3 style="font-size:3.5rem;text-align:left;color: #333;padding-top: 30px;padding-left: 12%;font-family: 'boldfont', serif;font-weight: lighter;">Liste des thèmes désactivés</h3>
  <!-- Affichage des thèmes inactifs -->
  <table  width="1200px">
    <tr>
      <th>ID</th>
      <th>Nom</th>
      <th>Description</th>
      <th>Réactiver</th>
    </tr>


  <?php
    // $result reçoit la liste des thèmes inactifs
    $sql = "SELECT * FROM `themes2` WHERE supprime=1";
    $result = mysqli_query($conn, $sql);

    // S'il existe des thèmes actifs :
    if ($row = $result->fetch_array()){
      $result = mysqli_query($conn, $sql);

      // Pour chaque thème inactif :
      while($row = $result->fetch_array()) {
        $id = $row['id_theme'];
        $nom = $row['nom'];
        $desc = $row['description'];

        // On affiche une ligne
        echo "<tr>";
        echo "<td>$id</td>";
        echo "<td>$nom</td>";
        echo "<td>$desc</td>";
        echo "<td><a href='reactiver_theme2.php?id=$id'> <img src='images/confirmer2.png' alt='Smiley face' height='25' width='25' style='margin-left:5%;margin-right:auto;'> </a></td>";
        echo "</tr>";
     }
    // Si aucun thème n'est actif, on affiche une ligne vide
    } else {
      echo "<tr><td></td><td>Aucun thème n'est désactivé</td><td></td><td></td></tr>";
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
