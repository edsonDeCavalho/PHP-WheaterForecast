<?php
	include ("./include/header.inc.php");
	require ("./include/fonction.inc.php");
	require ("./include/util.inc.php");
	$date="./data/comptageDeVisites/".(String)date("Y-m-d").".txt";
	if(file_exists($date)){
		comptageVisites($date);
	}
	else{
		$f = fopen($date, "x+");
		$zero=0;
		fputs($f,$zero);
		fclose($f);
		comptageVisites($date);
	}
?>
	<!--Section-->
<section>
	<?php
		if(isset($_COOKIE['DerniereVilleVisite'])){
			$derniereVilleVisite=$_COOKIE['DerniereVilleVisite'];
			meteoPourDerniereVilleVisite($derniereVilleVisite,"detaille");
		}
	?>
<h2 class="transparent">Veuillez sélectionner une région :</h2>
    <article class="articleCarteDeFrance2">
	<h2 class='h2Index'>Veuillez sélectionner une région :</h2>
	<map name="region">
	<area shape="rect" coords="416,192,528,257"
	href="./region.php?region=11"
	alt="page region"/>
	
	<area shape="rect" coords="421,55,565,555"
	href="./region.php?region=32"
	alt="page region"/>
	
	<area shape="rect" coords="240,151,409,222"
	href="./region.php?region=28"
	alt="page region"/>
	
	<area shape="rect" coords="70,220,238,300"
	href="./region.php?region=53"
	alt="page region"/>
	
	<area shape="rect" coords="531,139,785,289"
	href="./region.php?region=44"
	alt="page region"/>
	
	<area shape="rect" coords="206,289,311,369"
	href="./region.php?region=52"
	alt="page region"/>
	
	<area shape="rect" coords="331,274,496,385"
	href="./region.php?region=24"
	alt="page region"/>

	<area shape="rect" coords="494,299,721,408"
	href="./region.php?region=27"
	alt="page region"/>
	
	<area shape="rect" coords="232,466,397,577"
	href="./region.php?region=75"
	alt="page region"/>

	<area shape="rect" coords="360,619,540,754"
	href="./region.php?region=76"
	alt="page region"/>
	
	<area shape="rect" coords="478,444,722,565"
	href="./region.php?region=84"
	alt="page region"/>
	
	<area shape="rect" coords="616,609,771,709"
	href="./region.php?region=93"
	alt="page region"/>
	
	<area shape="rect" coords="770,659,860,808"
	href="./region.php?region=94"
	alt="page region"/>

</map>
<figure>
	<div class="imageIndex">
	<img usemap="#region" src="./img/carte_France.png" class="image_CarteDeFrance" alt="carte de france"  id="carte"/>
	</div>
</figure>  
</article>
</section>	
<?php
	include ("./include/footer.inc.php");
?>
</body>
</html>