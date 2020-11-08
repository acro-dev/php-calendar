<?php

function showCalendar($timestamp_recu) {

  // 1ere Etape : Declaration des variables nécessaires :

  /* Variable pour le mois en cours */

  $annee_a_afficher = date('Y',$timestamp_recu);
  $mois_a_afficher = date('m',$timestamp_recu);

  $nombre_de_jour_dans_le_mois = date('t',$timestamp_recu);

$premierJourDuMois = mktime(0,0,0,$mois_a_afficher,1,$annee_a_afficher);
  $premier_jour_du_mois_en_chiffre = date('w',$premierJourDuMois);

  /* Variable pour le mois précedant */

  if ($mois_a_afficher > 1 AND $mois_a_afficher <= 12) {
    $mois_precedant = $mois_a_afficher - 1;
	  $annee_precedante = $annee_a_afficher;
  }
  elseif ($mois_a_afficher == 1) {
    $mois_precedant = 12;
	  $annee_precedante =$annee_a_afficher - 1;
  }
  else {
    echo "DEBUG : Erreur en relation avec la determination du mois précédent";
  }

  $timestamp_du_mois_precedant = mktime(0,0,0,$mois_precedant,1,$annee_precedante);
  $nombre_de_jour_dans_le_mois_precedant = date('t',$timestamp_du_mois_precedant);

  /* On determine ici quel sera le premier jour du mois precedant à afficher,
  cette variable sera par la suite incrementé*/

  if ($premier_jour_du_mois_en_chiffre > 1 AND $premier_jour_du_mois_en_chiffre <= 6) {
    $jour_du_mois_precedant_afficher = $nombre_de_jour_dans_le_mois_precedant - $premier_jour_du_mois_en_chiffre + 2;
  }
  elseif ($premier_jour_du_mois_en_chiffre == 0) {
    $jour_du_mois_precedant_afficher = $nombre_de_jour_dans_le_mois_precedant - 5;
  }
  elseif ($premier_jour_du_mois_en_chiffre == 1) {
    $jour_du_mois_precedant_afficher = $nombre_de_jour_dans_le_mois_precedant - 6;
  }

  /* Petites variables diverses */
  $jour_de_la_semaine = 1; // Savoir combien de jour de la semaine sont affichés
  $jour_afficher = 0; // Savoir combien de jour du calendrier sont affichés (42 cellules)
  $jour_du_mois_afficher = 1; // Savoir combien de jour du mois sont affichés
  $jour_du_mois_suivant = 1; // Pour combler les cellules vide de la fin


  // 2eme ETAPE : On génere le calendrier sous forme de tableau :

?>

<table class="calendrier">
  <tr>
      <th colspan="7"><?php echo date('M',$timestamp_recu)." ".$annee_a_afficher ; ?></th>
  </tr>
  <tr>
      <td class="jour_en_lettres">Lu</td>
      <td class="jour_en_lettres">Ma</td>
      <td class="jour_en_lettres">Me</td>
      <td class="jour_en_lettres">Je</td>
      <td class="jour_en_lettres">Ve</td>
      <td class="jour_en_lettres">Sa</td>
      <td class="jour_en_lettres">Di</td>
  </tr>
  <tr>
    <?php
      // On commence en tenant compte du mois precedant
      while ($jour_du_mois_precedant_afficher <= $nombre_de_jour_dans_le_mois_precedant) {
        echo "<td class=\"jour_du_mois_precedant\">".$jour_du_mois_precedant_afficher."</td>";

        $jour_du_mois_precedant_afficher++;
        $jour_de_la_semaine++;
        $jour_afficher++;

        if ($jour_de_la_semaine > 7 AND $jour_afficher < 42 ) {
          echo "</tr><tr>";
          $jour_de_la_semaine = 1;
        }

      } // Fin de la boucle d'affichage des jours du mois précédant


     while ($jour_du_mois_afficher <= $nombre_de_jour_dans_le_mois) {
        if ($jour_du_mois_afficher != date("d",$timestamp_recu)) {
          echo "<td class=\"jour_du_mois_en_cours\">".$jour_du_mois_afficher."</td>";
        }
        if ($jour_du_mois_afficher == date("d",$timestamp_recu)) {
          echo "<td class=\"jour_du_mois_en_cours\"><strong>".$jour_du_mois_afficher."</strong></td>";
        }

        $jour_du_mois_afficher++;
        $jour_de_la_semaine++;
        $jour_afficher++;

        if ($jour_de_la_semaine > 7 AND $jour_afficher < 42 ) {
          echo "</tr><tr>";
          $jour_de_la_semaine = 1;
        }
      } // Fin de la boucle d'affichage du mois a afficher

      // On fini en remplissant les cellules vides avec les jours du mois suivant

      while ($jour_afficher < 42) {
        echo "<td class=\"jour_du_mois_suivant\">".$jour_du_mois_suivant."</td>";

        $jour_du_mois_suivant++;
        $jour_de_la_semaine++;
        $jour_afficher++;

        if ($jour_de_la_semaine > 7 AND $jour_afficher < 42 ) {
          echo "</tr><tr>";
          $jour_de_la_semaine = 1;
        }
      } // Fin de la boucle d'affichage des jours du mois suivant
    ?>
  </tr>
</table>

<?php
} // Fin de la fonction 'afficher_calendrier'
?>
