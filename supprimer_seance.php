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

    <!-- Formulaire de suppression d'une séance -->
    <div class="formulaire" style="height:475px;padding:10px">
        <div class="inscription" style="  margin-top:1%">
          <img height="70px" style="padding:0px;margin-left:2%" src="images/sessicon.png" alt="icon">
          <h3 style="font-size:3.5rem;text-align:center;color: #333"> Gérer séances</h3>
        </div>
      <form style="font-family: 'Roboto', sans-serif;font-size:1.5rem;margin-left:60px; margin-right:60px;" class="" action="supprimer_seance2.php" method="post"><br>
        <label for="seance">Choisissez une seance</label><br>
        <?php
          // Connexion
          date_default_timezone_set('Europe/Paris');
          $date_actuelle= date("Y-m-d");
          $dbhost = 'tuxa.sme.utc';
          $dbuser = 'nf92a001';
          $dbpass = '8kxDVZYm';
          $dbname = 'nf92a001';
          $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');
        ?>
        <select name="seance" class="custom-select" id="seance" style="width:95%;margin-top:20px;text-decoration:none;background-color:white;border:none;" required>
            <option value="" style="display:none;margin-top:10px;">Choisissez une séance</option>
            <?php
              // $result récupère toutes les séances futures
              $sql = "SELECT * FROM `seances2` WHERE DATEDIFF(date_seance, '$date_actuelle') >=0";
              $result = mysqli_query($conn, $sql);

              // Pour chaque séance :
              while($row = $result->fetch_array()) {
                // On récupère l'ID de la séance, la séance et l'ID du thème
                $id = $row['idseance'];
                $date_seance = $row['date_seance'];
                $idtheme = $row['idtheme'];
                // On récupère le nom du thème correspondant
                $requete_theme = "SELECT * FROM `themes2` WHERE id_theme='$idtheme'";
                $result_theme = mysqli_query($conn, $requete_theme);
                $ligne_theme=$result_theme->fetch_array();
                $nom = $ligne_theme['nom'];
                // On affiche une option dans le select, avec pour valeur l'ID de la séance
                echo '<option value="'.$id.'">'.$id.'. Séance du '.$date_seance.' sur le theme '."$nom".'</option>';           }
                mysqli_close($conn);
            ?>
        </select>
        <hr class="underrule">
        <input type="submit" value="Supprimer" style="margin-top:52px;padding:10px;width:50%;margin-left:24%">
      </form>
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
