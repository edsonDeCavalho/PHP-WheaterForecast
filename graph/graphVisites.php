<?php // content="text/plain; charset=utf-8"
require_once ("../include/util.inc.php");
require_once ('../jpgraph/src/jpgraph.php');
require_once ('../jpgraph/src/jpgraph_line.php');

$datay1 = getDataVisitesY();

// Setup the graph
$graph = new Graph(1000,800,'auto');
$graph->SetScale("textlin",0,$aYMax=150);

$theme_class=new UniversalTheme;

$graph->SetTheme($theme_class);
$graph->img->SetAntiAliasing(false);
$graph->title->Set('graphique des visites');
$graph->SetBox(false);

$graph->SetMargin(40,20,36,63);

$graph->img->SetAntiAliasing();

$graph->yaxis->HideZeroLabel();
$graph->yaxis->HideLine(false);
$graph->yaxis->HideTicks(false,false);

$graph->xgrid->Show();
$graph->xgrid->SetLineStyle("solid");
$datav=getDataVisitesJoursX();
$graph->xaxis->SetTickLabels($datav);
$graph->xgrid->SetColor('#E3E3E3');

// Create the first line
$p1 = new LinePlot($datay1);
$graph->Add($p1);
$p1->SetColor("#f50d0d");
$p1->SetLegend('Nombre de visites');

$graph->legend->SetFrameWeight(1);

// Output line
$graph->Stroke();

?>

