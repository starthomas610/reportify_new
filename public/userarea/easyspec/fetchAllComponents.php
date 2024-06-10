<?php include('../include/headscript.php'); ?>
<?php include("../class/company.php"); ?>
<?php // Assicurati di includere il file di connessione al DB
$conn = new mysqli($servername, $username, $password, $database);
$query = $_GET['query'];  // Ricevi la stringa di ricerca
$sql = "SELECT * FROM component ORDER BY name_component";  // Query SQL per il filtraggio
$stmt = $conn->prepare($sql);
$searchTerm = '%' . $query . '%';
$stmt->bind_param('ss', $searchTerm, $searchTerm);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['idcomponent']}</td>
                <td>{$row['name_component']}</td>
                <td>{$row['cas_component']}</td>
                <td>{$row['formula_component']}</td>
                <td>{$row['component_family_id']}</td>
                <td>Edit/Delete Buttons</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='6'>No results found</td></tr>";
}
$stmt->close();
$conn->close();
