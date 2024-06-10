<?php include('../include/headscript.php'); ?>
<?php
$conn = new mysqli($servername, $username, $password, $database);

// Verifica connessione
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Recupera i dati dal POST
$idmethods = $_POST['idmethods'];
$idanalysisrsl = $_POST['idanalysisrsl'];

// Prepara e esegui la query di aggiornamento
$sql = "UPDATE analysis_rsl SET idmethods = ? WHERE idanalysis_rsl = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $idmethods, $idanalysisrsl);

if ($stmt->execute()) {
    echo "SUCCESS";
} else {
    echo "ERROR: " . $stmt->error;
}

// Chiudi la connessione
$stmt->close();
$conn->close();
