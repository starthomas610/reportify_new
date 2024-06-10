<?php
include('../include/headscript.php');  // Assicurati che questo file contenga la configurazione di $conn
include("../class/company.php");

$conn = new mysqli($servername, $username, $password, $database);

$idstandards = $_GET['idstandards'];

$response = array();
$response['files'] = array();

if (isset($idstandards)) {
    $query = $conn->prepare("SELECT pdffilename FROM pdfstandards WHERE idstandards = ?");
    $query->bind_param("i", $idstandards);
    $query->execute();
    $result = $query->get_result();

    while ($row = $result->fetch_assoc()) {
        $response['files'][] = array(
            'filename' => $row['pdffilename']
        );
    }
    echo json_encode($response);
} else {
    echo json_encode(array("status" => "error", "message" => "ID non fornito."));
}
