<?php
if(isset($_GET['departement'])){
	$departement=(int)$_GET['departement'];
	setcookie('DerniereDepartementVisite',$departement, time() + 365*24*3600, null, null, false, true);
	if(isset($_COOKIE[$departement])){
		$comptage=$_COOKIE[$departement];
		$comptage++;
		setcookie($departement,$comptage, time() + 365*24*3600, null, null, false, true);
	}
	else{
		setcookie($departement,0, time() + 365*24*3600, null, null, false, true);
	}		
}
    require ("./include/fonction.inc.php");
	include ("./include/header.inc.php");
?>
<section>
    <?php
    echo "<article class='articleRegionETDepartement'>";
	printf("\n\t\t\t\t\t\t\t");
	$fichier_departements=fopen('./files/departements.txt','r+');
	$ligne=fgets($fichier_departements);
	$i=0;
	while($ligne=fgets($fichier_departements)){
		$ligne_separe=explode("	",$ligne);
		if((int)$ligne_separe[1]==(int)$_GET['departement']){
			$departement=$ligne_separe[5];
			break ;
        }
    }
    fclose($fichier_departements);
    $fichier_departements=fopen('./files/departements.txt','r+');
	$ligne=fgets($fichier_departements);
    $regionNombre=0;
    $region="";
    while($ligne=fgets($fichier_departements)){
		$ligne_separe=explode("	",$ligne);
		if((int)$ligne_separe[1]==(int)$_GET['departement']){
            $regionNombre=$ligne_separe[0];
            $region=getRegion($regionNombre);
			break ;
        }
    }
    
    echo "<nav class='navbar'>";
	printf("\n\t\t\t\t\t\t\t");
    echo "<div class='topnav2'>";
	printf("\n\t\t\t\t\t\t\t");
    echo "<a class='active2' href='./region.php?region=".$regionNombre."'> > ".$region."</a>";
	printf("\n\t\t\t\t\t\t\t");
    echo "<a class='active2' href='./departement.php?departement=".(int)$_GET['departement']."'> > ".$departement."</a>";
	printf("\n\t\t\t\t\t\t\t");
    echo "</div></nav>";
	printf("\n\t\t\t\t\t\t\t");
    echo "<br></br>"; 
	printf("\n\t\t\t\t\t\t\t");	
    echo "<br></br>";
	printf("\n\t\t\t\t\t\t\t");
    echo "<h2>Departement de ".$departement."</h2>";
	printf("\n\t\t\t\t\t\t\t");
    	
		$fichier_villes=fopen('./files/villes.txt','r+');
		$i=0;
		while($ligne=fgets($fichier_villes)){
			$separation=explode('","',$ligne);
			if((int)$separation[1]==$_GET['departement']){
				$ville=$separation[3];
				$villes[$i]=$ville;
				$i=$i+1;
			}
				
		}
        fclose($fichier_villes);
        if((int)$_GET['departement']==2){
			echo "<img src='img/Departements/2A.png' class='image_Region' />";
			printf("\n\t\t\t\t\t\t\t");
		}
		else{
			echo "<img src='img/Departements/".$_GET['departement'].".png' class='imageRegion' width='280' height='150' />";
			printf("\n\t\t\t\t\t\t\t");
		}
        
			
		echo "<form method='GET' action='ville.php?'>";
		printf("\n\t\t\t\t\t\t\t");
			echo "<label>Choisissez la ville : </label>";
			printf("\n\t\t\t\t\t\t\t");
			$vel="'ville'";
				echo "<select name= ".$vel." >";
				printf("\n\t\t\t\t\t\t\t");
					echo "<option value = 'PARIS' >----select----</option>";
					printf("\n\t\t\t\t\t\t\t");
					for($j=0;$j<$i;$j++){
						printf("\t\t\t");
						$str     = $villes[$j];
						$order   = array("'");
						$replace = '&apos;';
						// Traitement du premier \r\n, ils ne seront pas convertis deux fois.
						
						echo "<option value = '".$villes[$j]."' >".$villes[$j]."</option>";
						printf("\n\t\t\t\t\t\t\t");
					}
				echo "</select>";
				printf("\n\t\t\t\t\t\t\t");

		?>
		<p>Metheo dans les prochains jours :</p>
		<input id="d1" type="radio" value="1" name="forwhen"/><label for="day">Maintenant</label>		
		<input id="d1" type="radio" value="2" name="forwhen"/><label for="day"> dans 3 heures</label>
		<input id="d5" type="radio" value="3" name="forwhen"/><label for="day">Ce jour</label>
		<input id="d5" type="radio" value="4" name="forwhen"/><label for="day">dans 3 jours</label>

		<p>Affichage personaliséé (mod) :</p>
		<input id="d5" type="radio" value="normal" name="typeAffichage"/><label for="typeAffichage">Normal</label>
		<input id="d5" type="radio" value="detaille" name="typeAffichage"/><label for="typeAffichage">Detailleé</label>				
		<br></br><input type='submit' name='valider' value='VALIDER '/><br></br>
		<?php
		echo"</form>";
	echo"</article>";
		?>
</section>
<?php
    include ("./include/footer.inc.php");
?>
</body>
</html>