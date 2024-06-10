<?php
header('Content-Type: application/json'); // Assicura che la risposta sia in formato JSON
// Include il file di connessione al database e le eventuali classi necessarie
include("../include/headscript.php");
include("../class/company.php");



// Controlla se la richiesta è stata effettuata tramite metodo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli($servername, $username, $password, $database);

    // Verifica la connessione
    if ($conn->connect_error) {
        echo json_encode(["success" => false, "message" => "Connessione fallita: " . $conn->connect_error]);
        exit;
    }

    $query = "UPDATE `standards` SET ";
    $params = [];
    $types = '';
    $updates = [];

    // Verifica se il campo è stato inviato e aggiungilo alla query
    if (isset($_POST['titlestandards'])) {
        $updates[] = "titlestandards=?";
        $params[] = $_POST['titlestandards'];
        $types .= 's';
    }

    if (isset($_POST['numberstandards'])) {
        $updates[] = "numberstandards=?";
        $params[] = $_POST['numberstandards'];
        $types .= 's';
    }

    if (isset($_POST['yearstandards'])) {
        $updates[] = "yearstandards=?";
        $params[] = $_POST['yearstandards'];
        $types .= 's';
    }

    if (isset($_POST['status'])) {
        $updates[] = "status=?";
        $params[] = $_POST['status'];
        $types .= 's';
    }

    if (isset($_POST['description'])) {
        $updates[] = "description=?";
        $params[] = $_POST['description'];
        $types .= 's';
    }

    if (isset($_POST['activefrom'])) {
        $updates[] = "activefrom=?";
        $params[] = $_POST['activefrom'];
        $types .= 's';
    }

    if (isset($_POST['activeto'])) {
        $updates[] = "activeto=?";
        $params[] = $_POST['activeto'];
        $types .= 's';
    }

    // Assicurati che ci sia almeno un campo da aggiornare
    if (count($updates) > 0) {
        $query .= join(', ', $updates) . " WHERE idstandards=?";
        $params[] = $_POST['idstandards'];
        $types .= 'i';

        $stmt = $conn->prepare($query);
        $stmt->bind_param($types, ...$params);

        if ($stmt->execute()) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false, "message" => "Errore durante l'aggiornamento: " . $stmt->error]);
        }

        $stmt->close();
    } else {
        echo json_encode(["success" => false, "message" => "Nessun dato da aggiornare."]);
    }

    $conn->close();
} else {
    echo json_encode(["success" => false, "message" => "Metodo non consentito"]);
}
