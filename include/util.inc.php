<?php
	function comptageVisites($file){
		$file = fopen($file,"r+");
		$ligne = fgets($file);
		$ligne++;
		fseek($file,0);
		fputs($file,$ligne);
	}
?>
<?php
	function comptageDeVilles($file){
		$file = fopen($file,"r+");
		$ligne = fgets($file);
		$ligne++;
		fseek($file,0);
		fputs($file,$ligne);
	}
?>
<?php
	function getDataVisitesY(){
        $data=null;
        $dossier =(array)scandir("../data/comptageDeVisites", 1);
        for($i=0;$i<sizeof($dossier)-2;$i++){   
            $file = fopen("../data/comptageDeVisites/".$dossier[$i],"r+");
            $nombre =(int)fgets($file);
            $data[$i]=(int)$nombre;
            fclose($file);
        }   
        return $data;
    }
?>
<?php
	function getDataVisitesJoursX(){
        $data=null;
        $dossier =(array)scandir("../data/comptageDeVisites", 1);
        for($i=0;$i<sizeof($dossier)-2;$i++){   
            $data[$i]=(String)$dossier[$i];
            $ligne=null;
			$ligne=explode(".",$data[$i]);
			$data[$i]=$ligne[0];
        }   
        return $data;
    }
?>
<?php
	function getDataVisitesVillesY(){
        $data=null;
        $dossier =(array)scandir("../data/comptageDesVilles", 1);
        for($i=0;$i<sizeof($dossier)-2;$i++){   
            $file = fopen("../data/comptageDesVilles/".$dossier[$i],"r+");
            $nombre =(int)fgets($file);
            $data[$i]=(int)$nombre;
            fclose($file);
        }   
        return $data;
    }
?>
<?php
	function getDataVisitesVillesX(){
        $data=null;
        $dossier =(array)scandir("../data/comptageDesVilles", 1);
        for($i=0;$i<sizeof($dossier)-2;$i++){   
            $data[$i]=(String)$dossier[$i];
        }   
        return $data;
    }
?>