<?php $comptable=$_SESSION['comptable']; ?>
<h3>Fiche de frais du mois <?php echo $numMois."-".$numAnnee?> : 
    </h3>
<?php if ($comptable == 1) { ?>
<a href='index.php?uc=voirpdf&action=pdf'>Cliquez ici pour visualiser le PDF<img src='images/filetype_pdf.png' border='0'></a>
<?php } ?>
    <div class="encadre">
    <p>
        Etat : <?php echo $libEtat?> depuis le <?php echo $dateModif?> <br> Montant validé : <?php echo $montantValide?>
              
                     
    </p>
        <form method="post" action="index.php?uc=validationFicheFrais&action=validFrais"></form>
  	<table class="listeLegere">
  	   <caption>Eléments forfaitisés </caption>
        <tr>
         <?php
         foreach ( $lesFraisForfait as $unFraisForfait ) 
		 {
			$libelle = $unFraisForfait['libelle'];
		?>	
			<th> <?php echo $libelle?></th>
		 <?php
        }
		?>
		</tr>
        <tr>
        <?php
          foreach (  $lesFraisForfait as $unFraisForfait  ) 
		  {
				$quantite = $unFraisForfait['quantite'];
		?>
                <td class="qteForfait"><?php echo $quantite?> </td>
		 <?php
          }
		?>
		</tr>
    </table>
  	<table class="listeLegere">
  	   <caption>Descriptif des éléments hors forfait -<?php echo $nbJustificatifs ?> justificatifs reçus -
       </caption>
             <tr>
                <th class="date">Date</th>
                <th class="libelle">Libellé</th>
                <th class='montant'>Montant</th>
                 <?php if ($comptable == 1 ){ ?>
                 <th class='montant'>Actions</th>
                 <?php } ?>
             </tr>
        <?php      
          foreach ( $lesFraisHorsForfait as $unFraisHorsForfait ) 
		  {
              $id = $unFraisHorsForfait['id'];
			$date = $unFraisHorsForfait['date'];
			$libelle = $unFraisHorsForfait['libelle'];
			$montant = $unFraisHorsForfait['montant'];

		?>

             <tr>
                 <form method="post" action="index.php?uc=validationFicheFrais&action=reportRefus">
                     <input type="text"  name ="id" hidden="hidden" value="<?php echo $id ?> " >
                <td><input type ="text" name="date" readonly="readonly" value="<?php echo $date ?>"/> </td>
                <td><input type ="text" size="40" name="libelle" readonly="readonly" value="<?php echo $libelle ?>"/></td>
                <td><input type ="text" name="montant" readonly="readonly" value="<?php echo $montant ?>"/></td>

              <?php if ( $comptable == 1) { ?>
                     <?php echo $report . $refuser; ?>
                 </form>
             </tr>
    <?php } ?>



              <?php
          }
        ?>

    </table>

    </div>

<?php if
($comptable == 1) { ?>
    <?php
    if ($valider == 1) {
        ?>

        <form method="post" action="index.php?uc=validationFicheFrais&action=validFiche">
            <input type="submit" name="validFrais" value="Valider"/>
        </form>


        <?php
    } elseif ($valider == 2) {
        ?>
        <form method="post" action="index.php?uc=suiviPaiement&action=remboursement">
            <input type="submit" name="rembourserFrais" value="Rembourser"/>
        </form>
        <?php
    } else {
        echo "";
    }
}

?>






