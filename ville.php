<?php
	if(isset($_GET['ville'])){
		$ville=$_GET['ville'];
		setcookie('DerniereVilleVisite',$ville, time() + 365*24*3600, null, null, false, true);
		
	}
?>
<?php
	include('./include/header.inc.php');
?>
<?php
	require ("./include/fonction.inc.php");
	require ("./include/util.inc.php");
	$fichierVille="./data/comptageDesVilles/".(String)$ville;
	if(file_exists($fichierVille)){
		comptageVisites($fichierVille);
	}
	else{
		$f = fopen($fichierVille, "x+");
		$zero=0;
		fputs($f,$zero);
		fclose($f);
		comptageVisites($fichierVille);
	}
?>
<?php
	if(isset($_GET['ville'])){
		$ville=$_GET['ville'];	
	}
	else{
		$ville="PARIS";
	}
	if(isset($_GET['jour'])){
		$jour=(String)$_GET['jour'];
	}
	else{
		$jour=0;
	}
	if(!isset($_GET['typeAffichage'])){
		$typeDeAffichage="detaille";
	}
	else{
		$typeDeAffichage=$_GET['typeAffichage'];
	}
	if(!isset($_GET['forwhen'])){
		$quand=3;
	}
	else{
		$quand=(int)$_GET['forwhen'];
	}	
?>
<section>
	<article class="articleRegionETDepartement">
		 <?php 
		 	$fichier_villes=fopen('./files/villes.txt','r+');
			$ligne=fgets($fichier_villes);
			$i=0;
			while($ligne=fgets($fichier_villes)){
				$separation=explode('","',$ligne);
				if((String)$separation[3]==(String)$ville){
					$departementNB=(int)$separation[1];
				}
			}
			if($departementNB==null){
				$departementNB=95;
			}
			$fichier_departements=fopen('./files/departements.txt','r+');
			$ligne=fgets($fichier_departements);
			$i=0;
			while($ligne=fgets($fichier_departements)){
			$ligne_separe=explode("	",$ligne);
				if((int)$ligne_separe[1]==$departementNB){
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
				if((int)$ligne_separe[1]==(int)$departementNB){
					$regionNombre=$ligne_separe[0];
					$region=getRegion($regionNombre);
					break ;
				}
			}
			echo "<nav class='navbar'>";
			printf("\n\t\t\t\t\t\t\t");
			echo "<div class='topnav2'>";
			printf("\n\t\t\t\t\t\t\t");
			echo "<a class='active2' href='./region.php?region&#61;".$regionNombre."'> > ".$region."</a>";
			printf("\n\t\t\t\t\t\t\t");
			echo "<a class='active2' href='./departement.php?departement&#61;".$departementNB."'> > ".$departement."</a>";
			printf("\n\t\t\t\t\t\t\t");
			echo "<a class='active2' href='./ville.php?ville=".$ville."&amp;forwhen&#61;4typeAffichage&#61;detaille'> > ".$ville."</a>";
			printf("\n\t\t\t\t\t\t\t");
			echo "</div></nav>";
			printf("\n\t\t\t\t\t\t\t");
			echo "<br></br>";
			printf("\n\t\t\t\t\t\t\t");
			echo "<br></br>";
			printf("\n\t\t\t\t\t\t\t");
			printf("\n\t\t\t\t\t\t\t");
		    echo "<h2> VILLE DE ".$ville."</h2>";
			printf("\n\t\t\t\t\t\t\t");
			echo "<p>Aujourd'hui on est le: ".date_fr()."</p>";
			printf("\n\t\t\t\t\t\t\t");
			$date=date("Y-m-d");
			$keyOpenWheater= "&APPID=390b8d52144413185a08eb98de2dba77&units=metric&lang=fr";
			$format = 'http://api.openweathermap.org/data/2.5/forecast?q=%s%s';
			$url=sprintf($format,$ville,$keyOpenWheater);
			$data=file_get_contents($url);
			$data=json_decode($data,true);
			  
			echo "<p>Population : ".$data['city']['population']."</p> ";
			printf("\n\t\t\t\t\t\t\t");
			echo "<p>Lever de soleil : ".date("h:i:s A",$data['city']['sunrise'])."</p>";
			printf("\n\t\t\t\t\t\t\t");
			echo "<p>Coucher du soleil : ".date("h:i:s A",$data['city']['sunset'])."</p>";
			printf("\n\t\t\t\t\t\t\t");
		?>
	</article>
        <?php
            
			switch($quand){
				case 1 :

					meteoActuel($ville,$typeDeAffichage);
				break;
				case 2 :
					meteoPour3Heures($ville,$typeDeAffichage);
				break;
				case 3 :
					meteoPourLaJournee($ville,10,$typeDeAffichage); 
				break;
				case 4:
					meteoPour3Jours($ville,$typeDeAffichage);
				break;
				default:
				meteoPour3Jours($ville,$typeDeAffichage);
				break;
			}
			$k = array();
			for($i = 0; $i < count($_COOKIE); $i++){
				$k[$i] = key($_COOKIE);
				next($_COOKIE);
			}
			echo $k[0];
			printf("\n\t\t\t\t\t\t\t");
		?>
</section>
<?php

	include('./include/footer.inc.php');
?>
</body>
</html>