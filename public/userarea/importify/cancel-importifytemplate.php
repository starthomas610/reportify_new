<?php include('../include/headscript.php'); ?>
<?php
$conn = new mysqli($servername, $username, $password, $database);
// Verifica se l'ID è presente nell'URL
if (isset($_GET['idimporttemplates'])) {
    $id = $_GET['idimporttemplates'];

    // Prepara la query di cancellazione
    $query = "DELETE FROM template_importify WHERE idimporttemplates = ?";

    // Prepara la dichiarazione
    if ($stmt = $conn->prepare($query)) {
        // Lega i parametri
        $stmt->bind_param("i", $id);

        // Esegui la query
        if ($stmt->execute()) {
            // Reindirizza alla dashboard
            header("Location: importifydashboard.php");
            exit();
        } else {
            echo "Errore nell'esecuzione della query.";
        }
    } else {
        echo "Errore nella preparazione della query.";
    }

    // Chiudi la dichiarazione
    $stmt->close();
} else {
    echo "ID non specificato.";
}

// Chiudi la connessione
$conn->close();
