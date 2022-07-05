<?php
    require_once ('jpgraph/src/jpgraph.php');
    require_once ('jpgraph/src/jpgraph_pie.php');
    require_once ('jpgraph/src/jpgraph_pie3d.php');
    include ("./include/header.inc.php");
?>
<section>
    <article>
		<?php
			echo "<article class='articleStat'>";
			printf("\n\t\t\t\t\t\t\t");
			echo "<p class='p3'>Graphique de consulatations des villes :</p>";
			printf("\n\t\t\t\t\t\t\t");
			echo "<img src='./graph/graphVilles.php' class='graphique' alt='graph de visites des villes'/>";
			printf("\n\t\t\t\t\t\t\t");
			echo "</article>"; 
			printf("\n\t\t\t\t\t\t\t");
			echo "<article class='articleStat'>";
			printf("\n\t\t\t\t\t\t\t");
			echo "<p class='p3'>Graphique de visites sur le site :</p>";
			printf("\n\t\t\t\t\t\t\t");
			echo "<img src='./graph/graphVisites.php' class='graphique' alt='graph de Visites'/>";
			printf("\n\t\t\t\t\t\t\t");
			echo "</article>";
			printf("\n\t\t\t\t\t\t\t");
        ?>
    </article>
</section>
<?php
    include ("./include/footer.inc.php");
?>
</body>
</html>