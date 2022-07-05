<?php
	if(isset($_GET['region'])){
		$region=$_GET['region'];
		setcookie('DerniereRegionVisite',$region, time() + 365*24*3600, null, null, false, true);
		if(isset($_COOKIE[$region])){
			$comptage=$_COOKIE[$region];
			$comptage++;
			setcookie($region,$comptage, time() + 365*24*3600, null, null, false, true);
		}
		else{
			setcookie($region,0, time() + 365*24*3600, null, null, false, true);
		}		
	}
	include ("./include/header.inc.php");		
?>
<?php
	if(!empty($_GET['region'])){
		
		switch($_GET['region']){
			
			case 11:
				$region="Île-de-France";
				$img="img/regions/11.png";
			break;
			case 24:
				$region="Centre-Val de Loire";
				$img="img/regions/24.png";
			break;
			case 27:
				$region="Bourgogne-Franche-Comté";
				$img="img/regions/27.png";
			break;
			case 28:
				$region="Normandie";
				$img="img/regions/28.png";
			break;
			case 32:
				$region="Hauts-de-France";
				$img="img/regions/32.png";
			break;
			case 44:
				$region="Grand Est";
				$img="img/regions/44.png";
			break;
			case 52:
				$region="Pays de la Loire";
				$img="img/regions/52.png";
			break;
			case 53:
				$region="Bretagne";
				$img="img/regions/53.png";
			break;
			case 75:
				$region="Nouvelle-Aquitaine";
				$img="img/regions/75.png";
			break;
			case 84 :
				$region="Auvergne-Rhône-Alpes";
				$img="img/regions/84.png";
			break;
			case 76:
				$region="Occitanie";
				$img="img/regions/76.png";
			break;
			case 93:
				$region="Provence-Alpes-Côte d'Azur";
				$img="img/regions/93.png";
			break;
			case 94:
				$region="Corse";
				$img="img/regions/94.png";
			break;
		}	
	}    
?>
<?php
echo "<section>";
printf("\n\t\t\t\t\t\t\t");
echo "<article class='articleRegionETDepartement'>";
printf("\n\t\t\t\t\t\t\t");
echo "<nav class='navbar'>";
printf("\n\t\t\t\t\t\t\t");
echo "<div class='topnav2'>";
printf("\n\t\t\t\t\t\t\t");
echo "<a class='active2' href='./region.php?region=".$_GET['region']."'> >".$region."</a>";
printf("\n\t\t\t\t\t\t\t");
echo "</div></nav>";
printf("\n\t\t\t\t\t\t\t");
    echo "<br></br>";  
	printf("\n\t\t\t\t\t\t\t");
    echo "<br></br>";    
	printf("\n\t\t\t\t\t\t\t");
    echo "<h2>Region de ".$region."</h2>";
	printf("\n\t\t\t\t\t\t\t");
    echo "<img src='".$img."' class='imageRegion'  width='280' height='150' />";
	printf("\n\t\t\t\t\t\t\t");
    echo "<br></br>";
	printf("\n\t\t\t\t\t\t\t");
	echo "<br></br>";
	printf("\n\t\t\t\t\t\t\t");
	printf("\n\t\t\t\t\t\t\t");    		
	$fichier_departements=fopen('./files/departements.txt','r+');
	$ligne=fgets($fichier_departements);
	$i=0;
	while($ligne=fgets($fichier_departements)){
		$ligne_separe=explode("	",$ligne);
		if((int)$ligne_separe[0]==$_GET['region']){
			$departement=$ligne_separe[5];
			$nBdepartement=(int)$ligne_separe[1];
			$nBdepartements[$i]=$nBdepartement;
			$departements[$i]=$departement;
				$i=$i+1;
		}			
	}

	fclose($fichier_departements);
	echo "<form method='GET' action='departement.php?'> ";
	printf("\n\t\t\t\t\t\t\t");
	echo "<label>Choisissez le Departement : </label>";
	printf("\n\t\t\t\t\t\t\t");
	echo "<select name= 'departement' > ";
	printf("\n\t\t\t\t\t\t\t");
	$defaut=11;
			echo "<option value = '".$defaut."' >----select----</option>";
			printf("\n\t\t\t\t\t\t\t");
				for($j=0;$j<$i;$j++){
					printf("\t\t\t");
					echo "<option value = '".$nBdepartements[$j]."' >".$departements[$j]."</option>";
					printf("\n\t\t\t\t\t\t\t");
				}
				echo "</select>";
				printf("\n\t\t\t\t\t\t\t");
				echo "<input type='submit' name='valider' value='VALIDER '/>";
				printf("\n\t\t\t\t\t\t\t");
			echo "</form>";	
			printf("\n\t\t\t\t\t\t\t");
        echo "<br></br>";
		printf("\n\t\t\t\t\t\t\t");
	echo"</article>";
	printf("\n\t\t\t\t\t\t\t");
	echo"</section>";
	printf("\n\t\t\t\t\t\t\t");
?>
<?php
    include ("./include/footer.inc.php");
?>
</body>
</html>