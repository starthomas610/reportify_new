<?php
include('../include/headscript.php');
$idstandards = $_GET['idstandards'];

$query = $conn->prepare("SELECT name, url FROM pdfstandards WHERE idstandards = ?");
$query->bind_param("i", $idstandards);
$query->execute();
$result = $query->get_result();
$pdfs = [];

while ($row = $result->fetch_assoc()) {
    $pdfs[] = ['name' => $row['name'], 'url' => $row['url']];
}

echo json_encode($pdfs);
