<?php
require_once(BASE_URL . 'Connections/repnew.php');
// Connessione al database
$conn = new mysqli($servername, $username, $password, $database);

// Controllo connessione
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

// Preleva l'ID dal parametro GET
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id > 0) {
    // Cancella i record correlati dalla tabella material_rsl
    $query_material_rsl = "DELETE FROM material_rsl WHERE rsl_id = ?";
    $stmt_material_rsl = $conn->prepare($query_material_rsl);
    $stmt_material_rsl->bind_param("i", $id);

    if (!$stmt_material_rsl->execute()) {
        echo "Errore durante la cancellazione dei record da material_rsl: " . $stmt_material_rsl->error;
        $stmt_material_rsl->close();
        $conn->close();
        exit;
    }

    $stmt_material_rsl->close();

    // Cancella i record correlati dalla tabella analysis_rsl
    $query_analysis_rsl = "DELETE FROM analysis_rsl WHERE rsl_id = ?";
    $stmt_analysis_rsl = $conn->prepare($query_analysis_rsl);
    $stmt_analysis_rsl->bind_param("i", $id);

    if (!$stmt_analysis_rsl->execute()) {
        echo "Errore durante la cancellazione dei record da analysis_rsl: " . $stmt_analysis_rsl->error;
        $stmt_analysis_rsl->close();
        $conn->close();
        exit;
    }

    $stmt_analysis_rsl->close();

    // Cancella il record dalla tabella rsl
    $query_rsl = "DELETE FROM rsl WHERE id = ?";
    $stmt_rsl = $conn->prepare($query_rsl);
    $stmt_rsl->bind_param("i", $id);

    if ($stmt_rsl->execute()) {
        echo "Record e record correlati cancellati con successo!";
    } else {
        echo "Errore durante la cancellazione del record da rsl: " . $stmt_rsl->error;
    }

    $stmt_rsl->close();
} else {
    echo "ID non valido.";
}

$conn->close();

// Reindirizza all'utente verso rsl.php
header('Location: rsl.php');
