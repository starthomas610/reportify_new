<?php
include('../include/headscript.php');
include("../class/company.php");

if (isset($_POST['filename']) && isset($_POST['idstandards'])) {
    $filename = $_POST['filename'];
    $idstandards = $_POST['idstandards'];
    $filePath = "../pdfstandards/" . $filename;

    // Cancella il file dal server
    if (file_exists($filePath)) {
        unlink($filePath);
    }

    // Cancella il record dal database
    $conn = new mysqli($servername, $username, $password, $database);
    $delete = $conn->prepare("DELETE FROM pdfstandards WHERE idstandards = ? AND pdffilename = ?");
    $delete->bind_param("is", $idstandards, $filename);
    if ($delete->execute()) {
        echo json_encode(array("status" => "success", "message" => "File cancellato."));
    } else {
        echo json_encode(array("status" => "error", "message" => "Errore durante la cancellazione dal database."));
    }
    $delete->close();
} else {
    echo json_encode(array("status" => "error", "message" => "Parametri mancanti."));
}
