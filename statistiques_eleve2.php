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
      // Connexion
      date_default_timezone_set('Europe/Paris');
      $date_du_jour = date("Y-m-d");
      $dbhost = 'tuxa.sme.utc';
      $dbuser = 'nf92a001';
      $dbpass = '8kxDVZYm';
      $dbname = 'nf92a001';
      $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');

      // On récupère l'élève choisi
      $choix_eleve=$_POST['eleve'];

      // On récupère le nom/prénom correspondant
      $requete_eleve = "SELECT * FROM `eleves2` WHERE id_eleve='$choix_eleve'";
      $result_eleve = mysqli_query($conn, $requete_eleve);
      $ligne_eleve=$result_eleve->fetch_array();
      $nom = $ligne_eleve['nom'];
      $prenom = $ligne_eleve['prenom'];
    ?>

    <!-- Affichage des statistiques -->
    <h3 style="font-size:3.5rem;text-align:left;color: #333;padding-top: 5%;padding-left: 12%;font-family: 'boldfont', serif;font-weight: lighter;">Résultats de <?php echo "$prenom $nom"; ?></h3>
    <?php
       // $choix_affichage récupère la valeur choisie : affichage par thème et par séance
       // $choix_affichage est vide si l'utilisateur accède aux statistiques par la page consultation_eleve.php
       //   --> Dans ce cas, l'affichage se fait par thème par défaut
      if (empty($_POST['choix_affichage'])) {
        $choix_affichage = 'T';
      }else{
      $choix_affichage = $_POST['choix_affichage'];
      }

      // $result récupère les séances auquel l'élève est inscrit
      $sql = "SELECT * FROM `inscription2` WHERE id_eleve='$choix_eleve'";
      $result = mysqli_query($conn, $sql);

      // Si l'affichage est par séance :
      if ($choix_affichage=='S'){
        //  1/ On affiche l'en-tête du tableau
        echo
        '<table>
          <tr>
            <th></th>
            <th>Date de la séance</th>
            <th>Thème</th>
            <th>Résultat</th>
          </tr>';
        // 2/ Si l'élève n'est inscrit à aucune, séance, on affiche une ligne vide
        if ($row = $result->fetch_array()) {} else {
          echo "<tr><td></td>";
          echo "<td>Cet élève n'a pas encore eu de séance</td>";
          echo "<td></td><td></td>
          </tr>";
        }

        // 3/ Si l'élève a eu des séances :
        $cpt=1;
        $result = mysqli_query($conn, $sql);

        // Pour chaque séance
        while($row = $result->fetch_array()) {
          // On récupère le nombre de fautes, qu'on passe à "Pas encore noté" si la colonne fautes est vide
          $fautes = $row['fautes'];
          if (empty($fautes)) {
            $nb_fautes='Pas encore noté';
          } else {
            $nb_fautes="$fautes faute(s)";
          }

          // On récupère l'ID de la séance
          $ids = $row['id_seance'];
          // On récupère la date et l'id_theme correspondant
          $sql4 = "SELECT * FROM `seances2` WHERE idseance='$ids'";
          $result4 = mysqli_query($conn, $sql4);
          $row4 = $result4->fetch_array();
          $date=$row4['date_seance'];
          $idt = $row4['idtheme'];
          // Puis on récupère le nom correspondant à ce thème
          $sql5 = "SELECT * FROM `themes2` WHERE id_theme='$idt'";
          $result5 = mysqli_query($conn, $sql5);
          $row5 = $result5->fetch_array();
          $nom_theme=$row5['nom'];

          // Si la séance est passée, on affiche une ligne dans le tableau
          if ($date_du_jour>$date) {
            echo "<tr>";
            echo "<td>$cpt</td>";
            echo "<td>$date</td>";
            echo "<td>$nom_theme</td>";
            echo "<td>$nb_fautes</td>";
            $cpt=$cpt+1;
            echo "</tr>";
          }
       }
     }

     // Si l'affichage se fait par thème
     else {
       //  1/ On affiche l'en-tête du tableau
       echo
       '<table>
         <tr>
           <th>ID</th>
           <th>Thème</th>
           <th>Nombre moyen de fautes</th>
           <th>Taux de réussite</th>
         </tr>';
         // 2/ Si l'élève n'est inscrit à aucune, séance, on affiche une ligne vide
         if ($row = $result->fetch_array()) {} else {
           echo "<tr><td></td><td></td>";
           echo "<td>Cet élève n'a pas encore eu de séance</td>";
           echo "<td></td>
           </tr>";
         }

         // 3/ Pour chaque ligne de la table thème, on initialise deux variables dynamiques :
         //   a) La variable $fautes_theme_[nom] compte le nombre de fautes faites sur toutes les séances sur ce thème
         //   b) La variable $cpt_[nom] compte le nombre de séances faites sur ce thème
         // Ces deux variables permettront d'effectuer les calculs statistiques
         $sql6 = "SELECT * FROM `themes2`";
         $result6 = mysqli_query($conn, $sql6);
         while($row6 = $result6->fetch_array()) {
           $letheme = $row6['nom'];
           ${'fautes_theme_'.$letheme}=0;
           ${'cpt_'.$letheme}=0;
         }

         // 4/ Pour chaque séance à laquelle l'élève est inscrit :
         $cpt=1;
         $result = mysqli_query($conn, $sql);
         while($row = $result->fetch_array()) {
           $fautes = $row['fautes']; // On récupère le nombre de fautes
           $ids = $row['id_seance'];
           // On récupère l'ID de la séance, la date correspondante et le thème correspondant
           $sql4 = "SELECT * FROM `seances2` WHERE idseance='$ids'";
           $result4 = mysqli_query($conn, $sql4);
           $row4 = $result4->fetch_array();
           $date=$row4['date_seance'];
           $idt = $row4['idtheme'];
           $sql5 = "SELECT * FROM `themes2` WHERE id_theme='$idt'";
           $result5 = mysqli_query($conn, $sql5);
           $row5 = $result5->fetch_array();
           $nom_theme=$row5['nom'];

            /* Puis, si la séance est passée,
            On incrémente $cpt_[nom] de 1 (car il y a une séance de plus sur ce thème)
            Et on ajoute à $fautes_theme_[nom] le nombre de fautes pour cette séance */
           if ($date_du_jour>$date) {
             ${'cpt_'.$nom_theme}=${'cpt_'.$nom_theme}+1;
             ${'fautes_theme_'.$nom_theme}=${'fautes_theme_'.$nom_theme}+$fautes;
           }
         }

         // Enfin, pour chaque thème de la table :
         $sql6 = "SELECT * FROM `themes2`";
         $result6 = mysqli_query($conn, $sql6);
         while($row6 = $result6->fetch_array()) {
           $id_theme = $row6['id_theme'];
           $letheme = $row6['nom'];
           // S'il y a eu des séances sur le thème :
           if (${'cpt_'.$letheme}!=0){
             // $score fait la moyenne du nombre de fautes : $fautes_theme_[nom]/$cpt_[nom]
             $score = ${'fautes_theme_'.$letheme}/${'cpt_'.$letheme};
             // $scoreprc convertit cette moyenne en pourcentage
             $scoreprc=((40-$score)/40)*100;
             // On affiche une ligne dans le tableau
             echo "<tr>";
             echo "<td>$id_theme.</td>";
             echo "<td>$letheme</td>";
             echo "<td>$score faute(s)</td>";
             echo "<td>$scoreprc %</td>";
             echo "</tr>";}
           }
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
