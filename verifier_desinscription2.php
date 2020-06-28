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

      // Au premier chargement de la page, $_GET[id_seance] est vide
      // la page affiche donc simplement un tableau d'inscriptions avec une poubelle à la fin de chaque ligne
      // si l'utilisateur clique sur la poubelle, la page est rechargée en passant dans l'URL l'ID de la séance correspondante
      // $_GET[id_seance] n'est donc plus vide et le if s'exécute, on supprime l'inscription

      if (!empty($_GET['id_seance'])) {
        $idseance=$_GET['id_seance']; // On récupère la séance de laquelle on souhaite désinscrire l'élève
        $choix_eleve=$_GET['id_eleve']; // On récupère l'élève choisi dans la page desinscription.php
        $requete_supprime = "DELETE FROM `inscription2` WHERE (id_eleve='$choix_eleve') AND (id_seance='$idseance')"; // On désinscrit l'élève
        $result_supprime = mysqli_query($conn, $requete_supprime);
        // On affiche un message de confirmation
        echo '
          <div class="formulaire" style="background-color:#7ac27e;padding:10px;padding-top:20px;padding-bottom:20px;text-align:center;color:white;font-size:1.25rem;font-weight:bold;font-family:'."Roboto".';">
              DESINSCRIPTION EFFECTUEE AVEC SUCCES
          </div>';
      }
      // si $_GET['id_seance'] est vide, alors l'utilisateur vient directement de la page desinscription.php,
      // On récupère donc simplement l'élève choisi avec un $_POST['eleve']
      else {
        $choix_eleve=$_POST['eleve'];
        echo "<br><br><br><br><br>";
      }

      // On récupère le nom, prénom de l'élève choisi
      $requete_eleve = "SELECT * FROM `eleves2` WHERE id_eleve='$choix_eleve'";
      $result_eleve = mysqli_query($conn, $requete_eleve);
      $ligne_eleve=$result_eleve->fetch_array();
      $nom = $ligne_eleve['nom'];
      $prenom = $ligne_eleve['prenom'];
    ?>
    <h3 style="font-size:3.5rem;text-align:left;color: #333;padding-top: 0%;padding-left: 12%;font-family: 'boldfont', serif;font-weight: lighter;">Futures séances de <?php echo "$prenom $nom"; ?></h3>

    <!-- En-tête du tableau -->
    <table>
      <tr>
        <th>ID</th>
        <th>Date de la séance</th>
        <th>Thème</th>
        <th>Désinscrire</th>
      </tr>

    <?php
      // $result récupère toutes les séances auxquelles l'élève est inscrit
      $sql = "SELECT * FROM `inscription2` WHERE id_eleve='$choix_eleve'";
      $result = mysqli_query($conn, $sql);

      // $cpt compte le nombre de séances futures auxquelles l'élève est inscrit
      $cpt=0;
      // Pour chaque séance :
      while($row = $result->fetch_array()) {
        //On récupère la date de la séance
        $idseance = $row['id_seance'];
        $sql4 = "SELECT * FROM `seances2` WHERE idseance='$idseance'";
        $result4 = mysqli_query($conn, $sql4);
        $row4 = $result4->fetch_array();
        $date=$row4['date_seance'];

        // On récupère le thème de la séance
        $idt = $row4['idtheme'];
        $sql5 = "SELECT * FROM `themes2` WHERE id_theme='$idt'";
        $result5 = mysqli_query($conn, $sql5);
        $row5 = $result5->fetch_array();
        $nom_theme=$row5['nom'];

        // Puis, si la séance n'est pas encore passée :
        if ($date_du_jour<$date) {
          // On affiche une ligne de tableau avec une poubelle à la fin, que l'on peut cliquer pour recharger cette page avec l'ID séance dans l'URL
          // Cet ID séance dans l'URl va permettre de supprimer l'inscription souhaitée
          echo "<tr>";
          echo "<td>$idseance</td>";
          echo "<td>$date</td>";
          echo "<td>$nom_theme</td>";
          echo "<td><a href='verifier_desinscription2.php?id_seance=$idseance&id_eleve=$choix_eleve'> <img src='images/binicon.svg' alt='Smiley face' height='25' width='25' style='margin-left:5%;margin-right:auto;'> </a></td>";
          $cpt=$cpt+1;
          echo "</tr>";
        }
      }
      // Si $cpt vaut 0, l'élève n'est inscrit à aucune future séance, et on affiche une ligne vide
      if ($cpt==0) {
        echo "<tr><td></td>";
        echo "<td>Cet élève n'est inscrit à aucune séance</td>";
        echo "<td></td></td><td></td>
        </tr>";
      }
      mysqli_close($conn);
    ?>
    </table><br><br><br><br>

    <!-- Bouton retour -->
    <a class="button" href="desinscription.php" style="padding: 15px 45px;margin-top:120px;margin-left:45.5%;margin-right:auto;">Retour</a>

    <!-- Pied de page -->
        <div class="bottom-container" style="margin-top:200px;">
          <a href="https://www.facebook.com/Nitroschool-105795200928016/"><img src="images/facebook.png" height="80px" alt=""></a>
          <a href="https://twitter.com/nitroschool/"><img src="images/twitter.png" height="80px" alt=""></a>
          <a href="https://www.instagram.com/nitroschool/?hl=fr/"><img src="images/instagram.png" height="80px" alt=""></a>
          <p style="word-spacing: normal ; color: white; font-size: 1em ; font-family: 'Lora', serif;";>© 2019 Benjamin Missaoui</p>
        </div>
      </body>
    </html>
