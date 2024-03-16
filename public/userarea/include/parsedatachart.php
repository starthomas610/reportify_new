

<?php
if(isset($analytsname)) {
// fecth trend

 // $worstanalysis = "select result_project.idAnalysis AS analysisid, result_TestName, name_analysis , COUNT(*) as counter from result_project LEFT JOIN reports ON result_project.idreports=reports.idreports LEFT JOIN analysis ON result_project.idAnalysis=analysis.idanalysis WHERE reports.idcompany='$idcompany' AND result_project.result_Rating='F' GROUP BY result_TestName ORDER by counter DESC LIMIT 10";


    $paramscheck = "SELECT * FROM result_project LEFT JOIN reports ON result_project.idreports=reports.idreports
WHERE reports.iduser='$iduserlog' AND result_project.result_AnalytsName = '$analytsname' 
ORDER BY reports.reportDateIn
LIMIT 100;
";

    $resultparamscheck = mysqli_query($predoc, $paramscheck) or die("Error in Selecting " . mysqli_error($predoc));


// Print out result
$dateparamcheck=array();
$valueparamcheck=array();
while($row = mysqli_fetch_array($resultparamscheck)) {  
    $dateparamcheck[]=$row['reportDateIn'];
    $valueparamcheck[]=$row['result_Value'];

}


?>
<?php

// Assumi che $dateparamcheck e $valueparamcheck siano già popolati con i dati pertinenti

// Converte le date in timestamp per la regressione
$timestampcheck = array();
foreach ($dateparamcheck as $date) {
    $timestampcheck[] = strtotime($date);
}

// Calcola la media dei valori (y) e dei timestamp (x)
$mean_x = array_sum($timestampcheck) / count($timestampcheck);
$mean_y = array_sum($valueparamcheck) / count($valueparamcheck);

// Calcola la regressione lineare
$numerator = 0;
$denominator = 0;
for ($i = 0; $i < count($timestampcheck); $i++) {
    $numerator += ($timestampcheck[$i] - $mean_x) * ($valueparamcheck[$i] - $mean_y);
    $denominator += ($timestampcheck[$i] - $mean_x) ** 2;
}

// Coefficienti della regressione lineare y = mx + b
$m = $numerator / $denominator;
$b = $mean_y - ($m * $mean_x);

// Stampa i valori previsti per i prossimi 6 mesi
$last_date_timestamp = end($timestampcheck);
for ($j = 1; $j <= 6; $j++) {
    $next_month_timestamp = strtotime("+{$j} month", $last_date_timestamp);
    $predicted_value = $m * $next_month_timestamp + $b;
  
}


// Array per tenere traccia delle previsioni
$predicted_dates = [];
$predicted_values = [];

$last_date_timestamp = end($timestampcheck);
for ($j = 1; $j <= 6; $j++) {
    $next_month_timestamp = strtotime("+{$j} month", $last_date_timestamp);
    $predicted_value = $m * $next_month_timestamp + $b;
    
      // Formatta il valore previsto con lo stesso numero di decimali dei dati reali
    $formatted_predicted_value = number_format($predicted_value, 2);
    
    $predicted_dates[] = date('Y-m-d', $next_month_timestamp);
    $predicted_values[] = $formatted_predicted_value;
	   
}


?>
<?php
// fecth limit

 // $worstanalysis = "select result_project.idAnalysis AS analysisid, result_TestName, name_analysis , COUNT(*) as counter from result_project LEFT JOIN reports ON result_project.idreports=reports.idreports LEFT JOIN analysis ON result_project.idAnalysis=analysis.idanalysis WHERE reports.idcompany='$idcompany' AND result_project.result_Rating='F' GROUP BY result_TestName ORDER by counter DESC LIMIT 10";
  
$paramslim = "SELECT * FROM parameterslimit WHERE parameterslimit.nameparameters = '$analytsname' LIMIT 1;";
$resultparamslim = mysqli_query($predoc, $paramslim) or die("Error in Selecting " . mysqli_error($predoc));

$lowlim = null;
$highlim = null;
if ($row = mysqli_fetch_assoc($resultparamslim)) {
    $lowlim = floatval($row['lowvalue']);
$highlim = floatval($row['highvalue']);

}

}
?>