<?php
    function getRegion($region){
        switch($region){
			
			case 11:
				$regionNb="Île-de-France";
			break;
			case 24:
				$regionNb="Centre-Val de Loire";
			break;
			case 27:
				$regionNb="Bourgogne-Franche-Comté";
			break;
			case 28:
				$regionNb="Normandie";
			break;
			case 32:
				$regionNb="Hauts-de-France";
			break;
			case 44:
				$regionNb="Grand Est";
			break;
			case 52:
				$regionNb="Pays de la Loire";
			break;
			case 53:
				$regionNb="Bretagne";
			break;
			case 75:
				$regionNb="Nouvelle-Aquitaine";
			break;
			case 84 :
				$regionNb="Auvergne-Rhône-Alpes";
			break;
			case 76:
				$regionNb="Occitanie";
			break;
			case 93:
				$regionNb="Provence-Alpes-Côte d'Azur";
			break;
			case 94:
				$regionNb="Corse";
			break;
	}
return $regionNb;
}
?>
<?php

define("DEFAULT_LANG", "en");

$jours = array(1 => "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche");
$mois = array(1 => "Janvier", "F&eacute;vrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Ao&ucirc;t", "Septembre", "Octobre", "Novembre", "D&eacute;cembre");

/**
 * construit une date en français
 * @param $timestamp (int) : le timestamp
 * @return (string) : la date en francais (ex. "mercredi 21 mars 2018")
 */
function date_fr(int $timestamp = null) : string {
    if ($timestamp == null) { 
        $timestamp = time(); 
    }
    global $jours, $mois;
    return $jours[date("N", $timestamp)]." ".date("j", $timestamp)." ".$mois[date("n", $timestamp)];
}

/**
 * construit la date courante dans la langue passee en parametre
 * @param (String) $lang la langue (format ISO sur 2 caracteres) dans laquelle on souhaite la date courante
 * @return (String) la date exprimée dans une des langues disponibles encapsule dans un tag HTML 5 de type <time>
 */
function fechadehoy(string $lang = DEFAULT_LANG) : string {
    $jours = array(1 => "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche");
    $days = array(1 => "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
     $dias = array(1 => "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado", "Domingo");
     $mois = array(1 => "Janvier", "F&eacute;vrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Ao&ucirc;t", "Septembre", "Octobre", "Novembre", "D&eacute;cembre"); 
     $months = array(1 => "January", "February", "Marsh", "April", "May", "June", "July", "August", "September", "October", "November", "December");
     $meses = array(1 => "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Deciembre");
    $date = "<time datetime=\"".date("Y")."-".date("m")."-".date("d")."\">";

     switch($lang) {
        case "fr" : 
            $date .= $jours[date("N")+1]." ".date("j")." ".$mois[date("n")]." ".date("Y");
            break;
        case "es" : 
            $date .= $dias[date("N")].", ".date("j")." de ".$meses[date("n")]." de ".date("Y");
            break;
        default : // "en" or something else
            $date .= $days[date("N")].", ".$months[date("n")]." ".date("j").", ".date("Y");
            break;
    }
    $date .= "</time>";
    return $date;
}

?> 
<?php
    function dateplus($t){
        $jours = array(1 => "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche");
        $mois = array(1 => "Janvier", "F&eacute;vrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aocucirc;t", "Septembre", "Octobre", "Novembre", "D&eacute;cembre"); 
          
        $jourDeLaSemaine=(int)date("N");
        $jour=(int)date("j");
        $moiss=(int)date("n");
        $jourDeLaSemaine+=$t;
        $jour+=$t;
        if($jour==31){
            $jour=1;
            $moiss++;
        }



        if($jourDeLaSemaine==8){
            $jourDeLaSemaine=1;
        }
        if($jourDeLaSemaine<1){          
            $jourDeLaSemaine=1;
        }
        if($t!=0){
            if($jourDeLaSemaine>8){
                $jourDeLaSemaine=$jourDeLaSemaine-7;
            }
            echo "<p id='ancre".$t."'>Meteo pour ".$jours[$jourDeLaSemaine]." ".$jour." ".$mois[$moiss]." </p>";
			printf("\n\t\t\t\t\t\t\t");
        }
        else{
            echo "<p id='ancre".$t."'>Aujourd'hui ".$jours[$jourDeLaSemaine]." ".$jour." ".$mois[$moiss]." </p>";
			printf("\n\t\t\t\t\t\t\t");
        }
    }
?>
<?php
    function meteoActuel($ville,$perferences){
        $keyOpenWheater= "&APPID=390b8d52144413185a08eb98de2dba77&units=metric&lang=fr";
        $format = 'http://api.openweathermap.org/data/2.5/forecast?q=%s%s';
        $url=sprintf($format,$ville,$keyOpenWheater);
        $data=file_get_contents($url);
        $data=json_decode($data,true);
        $i=0; 
        $comptage=8;
        $ref=0;  
            echo "<article class='articleMeteo'>";
			printf("\n\t\t\t\t\t\t\t");
            echo ("<td><img src='http://openweathermap.org/img/wn/".$data['list'][$i]['weather'][0]['icon'].".png' alt='Icon de la meteo' height='340' widht='340' class='icon1Day' /></td>");
			printf("\n\t\t\t\t\t\t\t");
            $day=explode(" ",$data['list'][$i]['dt_txt']);
            //echo $day[1];   
            echo "<p class='temp'>".$data['list'][$i]['main']['temp_max']."C° </p>";
			printf("\n\t\t\t\t\t\t\t");
            echo "<p>".$data['list'][$i]['weather'][0]['description']."</p>";
			printf("\n\t\t\t\t\t\t\t");
            if($perferences=="detaille"){
                
                echo "<p> Vent : ".$data['list'][$i]['wind']['speed']." km/h</p>";
				printf("\n\t\t\t\t\t\t\t");
                echo "<p>Pression :".$data['list'][$i]['main']['pressure']."J/m </p>";
				printf("\n\t\t\t\t\t\t\t");
                echo "<p>T.Min: ".$data['list'][$i]['main']['temp_min']."C° </p>";
				printf("\n\t\t\t\t\t\t\t");
                echo "<p>T.Max: ".$data['list'][$i]['main']['temp_max']."C° </p>";
				printf("\n\t\t\t\t\t\t\t");
            }
            echo "</article>";
			printf("\n\t\t\t\t\t\t\t");
    }
?>
<?php
    function meteoPour3Heures($ville,$perferences){
        $keyOpenWheater= "&APPID=390b8d52144413185a08eb98de2dba77&units=metric&lang=fr";
        $format = 'http://api.openweathermap.org/data/2.5/forecast?q=%s%s';
        $url=sprintf($format,$ville,$keyOpenWheater);
        $data=file_get_contents($url);
        $data=json_decode($data,true);
        $i=0; 
        $comptage=8;
        $ref=0;  
            echo "<article class='articleMeteo'>";
			printf("\n\t\t\t\t\t\t\t");
            echo ("<td><img src='http://openweathermap.org/img/wn/".$data['list'][1]['weather'][0]['icon'].".png' alt='Icon de la meteo' height='340' widht='340' class='icon1Day' /></td>");
			printf("\n\t\t\t\t\t\t\t");
            $day=explode(" ",$data['list'][1]['dt_txt']);
            //echo $day[1];   
            echo "<p class='temp'>".$data['list'][1]['main']['temp_max']."C° </p>";
			printf("\n\t\t\t\t\t\t\t");
            echo "<p> Ciel ".$data['list'][1]['weather'][0]['description']."</p>";
			printf("\n\t\t\t\t\t\t\t");
            if($perferences=="detaille"){
                
                echo "<p> Vent : ".$data['list'][1]['wind']['speed']." km/h</p>";
				printf("\n\t\t\t\t\t\t\t");
                echo "<p>Pression :".$data['list'][1]['main']['pressure']."J/m </p>";
				printf("\n\t\t\t\t\t\t\t");
                echo "<p>T.Min: ".$data['list'][1]['main']['temp_min']."C° </p>";
				printf("\n\t\t\t\t\t\t\t");
                echo "<p>T.Max: ".$data['list'][1]['main']['temp_max']."C° </p>";
				printf("\n\t\t\t\t\t\t\t");
            }
            echo "</article>";
			printf("\n\t\t\t\t\t\t\t");
    }
?>
<?php
    function meteoPourLaJournee($ville,$temp,$perferences){
        $keyOpenWheater= "&APPID=390b8d52144413185a08eb98de2dba77&units=metric&lang=fr";
        $format = 'http://api.openweathermap.org/data/2.5/forecast?q=%s%s';
        $url=sprintf($format,$ville,$keyOpenWheater);
        $data=file_get_contents($url);
        $data=json_decode($data,true);
        $i=0; 
        $comptage=8;
        $ref=0;
        $ligne=(String)$data['list'][0]['dt_txt'];
        $separation=explode(" ",$ligne);
            $j=0;     
            echo "<article class='articleMeteo'>";
			printf("\n\t\t\t\t\t\t\t");
            echo "<h3>".$ville."</h3>";
			printf("\n\t\t\t\t\t\t\t");
            dateplus($j);
            echo "<table>";
			printf("\n\t\t\t\t\t\t\t");
            echo "<tr>";
			printf("\n\t\t\t\t\t\t\t");
            
            for($i=0;$i<8;$i++){
                $ligne=(String)$data['list'][$i]['dt_txt'];
                $separation=explode(" ",$ligne);
                if($separation[0]==date("Y-m-d")){
                    echo ("<td><img src='http://openweathermap.org/img/wn/".$data['list'][$i]['weather'][0]['icon'].".png' alt='Icon de la meteo' height='140' widht='140' /></td>");
					printf("\n\t\t\t\t\t\t\t");
                
                }
            }   
            echo "</tr>";
			printf("\n\t\t\t\t\t\t\t");
            echo "<tr>";
			printf("\n\t\t\t\t\t\t\t");
        
            for($i=0;$i<8;$i++){
                $ligne=(String)$data['list'][$i]['dt_txt'];
                $separation=explode(" ",$ligne);
                $day=explode(" ",$data['list'][$i]['dt_txt']);
                if($separation[0]==date("Y-m-d")){
                    $day=explode(" ",$data['list'][$i]['dt_txt']);
                    echo "<td> Pour : ".$day[1]."</td>";
					printf("\n\t\t\t\t\t\t\t");
                }
            }
            echo "</tr>";
			printf("\n\t\t\t\t\t\t\t");
            echo "<tr>";
			printf("\n\t\t\t\t\t\t\t");
            
            for($i=0;$i<8;$i++){
                $ligne=(String)$data['list'][$i]['dt_txt'];
                $separation=explode(" ",$ligne);   
                if($separation[0]==date("Y-m-d")){
                    echo "<td><p class='pd'>".$data['list'][$i]['main']['temp_max']."C° </p></td>";
					printf("\n\t\t\t\t\t\t\t");
                }
            }   
            echo "</tr>";
			printf("\n\t\t\t\t\t\t\t");
            echo "<tr>";
			printf("\n\t\t\t\t\t\t\t");
            for($i=0;$i<8;$i++){
                $ligne=(String)$data['list'][$i]['dt_txt'];
                $separation=explode(" ",$ligne); 
                if($separation[0]==date("Y-m-d")){
                    echo "<td> Ciel ".$data['list'][$i]['weather'][0]['description']."</td>";
					printf("\n\t\t\t\t\t\t\t");
                }
            }
            echo "</tr>";
			printf("\n\t\t\t\t\t\t\t");
            echo "<tr>";
			printf("\n\t\t\t\t\t\t\t");
            if($perferences=="detaille"){
                for($i=0;$i<8;$i++){ 
                    $ligne=(String)$data['list'][$i]['dt_txt'];
                    $separation=explode(" ",$ligne);
                    if($separation[0]==date("Y-m-d")){
                        echo "<td> Vent : ".$data['list'][$i]['wind']['speed']." km/h</td>";
						printf("\n\t\t\t\t\t\t\t");
                    }
                }
            
                echo "</tr>";
				printf("\n\t\t\t\t\t\t\t");
                echo "<tr>";
				printf("\n\t\t\t\t\t\t\t");
                for($i=0;$i<8;$i++){ 
                    $ligne=(String)$data['list'][$i]['dt_txt'];
                    $separation=explode(" ",$ligne);
                    if($separation[0]==date("Y-m-d")){
                        echo "<td>Pression :".$data['list'][$i]['main']['pressure']."J/m </td>";
						printf("\n\t\t\t\t\t\t\t");
                    }
                }
                echo "</tr>";
				printf("\n\t\t\t\t\t\t\t");
                echo "<tr>";
				printf("\n\t\t\t\t\t\t\t");
                for($i=0;$i<8;$i++){ 
                    $ligne=(String)$data['list'][$i]['dt_txt'];
                    $separation=explode(" ",$ligne);
                    if($separation[0]==date("Y-m-d")){
                        echo "<td>T.Min: ".$data['list'][$i]['main']['temp_min']."C° </td>";
						printf("\n\t\t\t\t\t\t\t");
                    }
                }
                echo "</tr>";
				printf("\n\t\t\t\t\t\t\t");
                echo "<tr>";
				printf("\n\t\t\t\t\t\t\t");
                for($i=0;$i<8;$i++){ 
                    $ligne=(String)$data['list'][$i]['dt_txt'];
                    $separation=explode(" ",$ligne);
                    if($separation[0]==date("Y-m-d")){
                        echo"<td>T.Max: ".$data['list'][$i]['main']['temp_max']."C° </td>";
						printf("\n\t\t\t\t\t\t\t");
                    }
                }
            }
                echo "</tr>";
				printf("\n\t\t\t\t\t\t\t");
                echo "<tr>";
				printf("\n\t\t\t\t\t\t\t");
            echo "</tr>";
			printf("\n\t\t\t\t\t\t\t");
            echo "</table>";
			printf("\n\t\t\t\t\t\t\t");
            echo "</article>";
			printf("\n\t\t\t\t\t\t\t");
    }
?>

<?php

    function meteoPour3Jours($ville,$perferences){
        $keyOpenWheater= "&APPID=390b8d52144413185a08eb98de2dba77&units=metric&lang=fr";
        $format = 'http://api.openweathermap.org/data/2.5/forecast?q=%s%s';
        $url=sprintf($format,$ville,$keyOpenWheater);
        $data=file_get_contents($url);
        $data=json_decode($data,true);  
        for($j=0;$j<3;$j++){
			$date=date("Y-m-d",mktime(0, 0, 0, date("m") , date("d")+$j, date("Y")));
			echo "<article class='articleMeteo'>";
			printf("\n\t\t\t\t\t\t\t");
            echo "<h3>".$ville."</h3>";
			printf("\n\t\t\t\t\t\t\t");
            //echo $date;
            dateplus($j);
            echo "<table>";
			printf("\n\t\t\t\t\t\t\t");
            echo "<tr>";
			printf("\n\t\t\t\t\t\t\t");
                
            for($i=0;$i<20;$i++){
                $ligne=(String)$data['list'][$i]['dt_txt'];
                $separation=explode(" ",$ligne);
				if($separation[0]==$date){
					echo ("<td><img src='http://openweathermap.org/img/wn/".$data['list'][$i]['weather'][0]['icon'].".png' alt='Icon de la meteo' height='140' widht='140' /></td>");
					printf("\n\t\t\t\t\t\t\t");
                    
                }
			}   
			echo "</tr>";
			printf("\n\t\t\t\t\t\t\t");
			echo "<tr>";
			printf("\n\t\t\t\t\t\t\t");
            
            for($i=0;$i<20;$i++){
                    $ligne=(String)$data['list'][$i]['dt_txt'];
                    $separation=explode(" ",$ligne);
                    $day=explode(" ",$data['list'][$i]['dt_txt']);
                    if($separation[0]==$date){
                        $day=explode(" ",$data['list'][$i]['dt_txt']);
                        echo "<td> Pour : ".$day[1]."</td>";
						printf("\n\t\t\t\t\t\t\t");
                    }
                }
                echo "</tr>";
				printf("\n\t\t\t\t\t\t\t");
                echo "<tr>";
				printf("\n\t\t\t\t\t\t\t");
                
                for($i=0;$i<20;$i++){
                    $ligne=(String)$data['list'][$i]['dt_txt'];
                    $separation=explode(" ",$ligne);   
                    if($separation[0]==$date){
                        echo "<td><p class='pd'>".$data['list'][$i]['main']['temp_max']."C° </p></td>";
						printf("\n\t\t\t\t\t\t\t");
                    }
                }   
                echo "</tr>";
				printf("\n\t\t\t\t\t\t\t");
                echo "<tr>";
				printf("\n\t\t\t\t\t\t\t");
                for($i=0;$i<20;$i++){
                    $ligne=(String)$data['list'][$i]['dt_txt'];
                    $separation=explode(" ",$ligne); 
                    if($separation[0]==$date){
                        echo "<td> Ciel ".$data['list'][$i]['weather'][0]['description']."</td>";
						printf("\n\t\t\t\t\t\t\t");
                    }
                }
                echo "</tr>";
				printf("\n\t\t\t\t\t\t\t");
                echo "<tr>";
				printf("\n\t\t\t\t\t\t\t");
                if($perferences=="detaille"){
                    for($i=0;$i<20;$i++){ 
                        $ligne=(String)$data['list'][$i]['dt_txt'];
                        $separation=explode(" ",$ligne);
                        if($separation[0]==$date){
							echo "<td> Vent : ".$data['list'][$i]['wind']['speed']." km/h</td>";
							printf("\n\t\t\t\t\t\t\t");
                        }
                    }
                
                    echo "</tr>";
					printf("\n\t\t\t\t\t\t\t");
                    echo "<tr>";
					printf("\n\t\t\t\t\t\t\t");
                    for($i=0;$i<20;$i++){ 
						$ligne=(String)$data['list'][$i]['dt_txt'];
                        $separation=explode(" ",$ligne);
                        if($separation[0]==$date){
                            echo "<td>Pression :".$data['list'][$i]['main']['pressure']."J/m </td>";
							printf("\n\t\t\t\t\t\t\t");
                        }
                    }
                    echo "</tr>";
					printf("\n\t\t\t\t\t\t\t");
                    echo "<tr>";
					printf("\n\t\t\t\t\t\t\t");
                    for($i=0;$i<20;$i++){ 
                        $ligne=(String)$data['list'][$i]['dt_txt'];
                        $separation=explode(" ",$ligne);
                        if($separation[0]==$date){
                            echo "<td>T.Min: ".$data['list'][$i]['main']['temp_min']."C° </td>";
							printf("\n\t\t\t\t\t\t\t");
                        }
                    }
                    echo "</tr>";
					printf("\n\t\t\t\t\t\t\t");
                    echo "<tr>";
					printf("\n\t\t\t\t\t\t\t");
                    for($i=0;$i<20;$i++){ 
                        $ligne=(String)$data['list'][$i]['dt_txt'];
                        $separation=explode(" ",$ligne);
                        if($separation[0]==$date){
                            echo"<td>T.Max: ".$data['list'][$i]['main']['temp_max']."C° </td>";
							printf("\n\t\t\t\t\t\t\t");
                        }
                    }
                }
                    echo "</tr>";
					printf("\n\t\t\t\t\t\t\t");
                    echo "<tr>";
					printf("\n\t\t\t\t\t\t\t");
                echo "</tr>";
				printf("\n\t\t\t\t\t\t\t");
                echo "</table>";
				printf("\n\t\t\t\t\t\t\t");
                echo "</article>";
				printf("\n\t\t\t\t\t\t\t");
		}
	}
?>
<?php
    function meteoPourDerniereVilleVisite($ville,$perferences){
        $keyOpenWheater= "&APPID=390b8d52144413185a08eb98de2dba77&units=metric&lang=fr";
        $format = 'http://api.openweathermap.org/data/2.5/forecast?q=%s%s';
        $url=sprintf($format,$ville,$keyOpenWheater);
        $data=file_get_contents($url);
        $data=json_decode($data,true);
        $i=0; 
        $comptage=8;
        $ref=0;  
            echo "<article class='articleMeteoDerniereVilleVisite'>";
			printf("\n\t\t\t\t\t\t\t");
            echo "<p class='p2'>Meteo de la derrniere ville consulté :</p>";
			printf("\n\t\t\t\t\t\t\t");
            echo "<h2>".$ville."</h2>";
			printf("\n\t\t\t\t\t\t\t");
            echo ("<img src='http://openweathermap.org/img/wn/".$data['list'][$i]['weather'][0]['icon'].".png' alt='Icon de la meteo' height='340' widht='340' class='icon1Day' />");
			printf("\n\t\t\t\t\t\t\t");
            $day=explode(" ",$data['list'][$i]['dt_txt']);
            echo "<p class='temp'>".$data['list'][$i]['main']['temp_max']."C° </p>";
			printf("\n\t\t\t\t\t\t\t");
            echo "<p> Ciel ".$data['list'][$i]['weather'][0]['description']."</p>";
			printf("\n\t\t\t\t\t\t\t");
            if($perferences=="detaille"){
                
                echo "<p> Vent : ".$data['list'][$i]['wind']['speed']." km/h</p>";
				printf("\n\t\t\t\t\t\t\t");
                echo "<p>Pression :".$data['list'][$i]['main']['pressure']."J/m </p>";
				printf("\n\t\t\t\t\t\t\t");
                echo "<p>T.Max: ".$data['list'][$i]['main']['temp_max']."C° </p>";
				printf("\n\t\t\t\t\t\t\t");
            }
            echo "</article>";
			printf("\n\t\t\t\t\t\t\t");
    }
?>