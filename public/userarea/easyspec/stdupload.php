<?php
include('../include/headscript.php');  // Assicurati che questo file contenga la configurazione di $conn
include("../class/company.php");

$idstandards = $_POST['idstandards'];  // Assicurati che questo valore venga passato correttamente

$targetDir = "../pdfstandards/";
$response = array();
$uploadStatus = 1;

// Se il file è stato inviato
if (!empty($_FILES["file"]["name"])) {
    $fileName = basename($_FILES["file"]["name"]);
    $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

    // Permetti solo file PDF
    if (strtolower($fileType) == 'pdf') {
        // Rinomina il file con il timestamp
        $newFileName = $fileName . '_' . time() . '.' . $fileType;
        $targetFilePath = $targetDir . $newFileName;

        // Carica il file
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
            // Inserisci il record nel database
            $conn = new mysqli($servername, $username, $password, $database);

            $insert = $conn->prepare("INSERT INTO pdfstandards (idstandards, pdffilename) VALUES (?, ?)");
            $insert->bind_param("is", $idstandards, $newFileName);
            if ($insert->execute()) {
                $response['status'] = 'ok';
                $response['message'] = 'File caricato e inserito con successo.';
            } else {
                $uploadStatus = 0;
                $response['message'] = 'Caricamento del file riuscito, ma errore durante l\'inserimento nel database.';
            }
            $insert->close();
        } else {
            $uploadStatus = 0;
            $response['message'] = 'Errore durante il caricamento del file.';
        }
    } else {
        $uploadStatus = 0;
        $response['message'] = 'Solo i file PDF sono permessi.';
    }
} else {
    $uploadStatus = 0;
    $response['message'] = 'Si prega di selezionare un file da caricare.';
}

// Risposta dello stato di upload
$response['status'] = $uploadStatus ? 'ok' : 'err';
echo json_encode($response);
