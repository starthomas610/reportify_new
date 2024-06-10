<?php include('../include/headscript.php'); ?>
<?php include("../class/company.php"); ?>
<?php

$idstandards = isset($_GET['id']) ? intval($_GET['id']) : 0;

$conn = new mysqli($servername, $username, $password, $database);


if ($idstandards <= 0) {
    die("ID non valido.");
}

$data = [];
if ($idstandards > 0) {
    $query = $conn->prepare("SELECT * FROM `standards` WHERE idstandards = ?");
    $query->bind_param("i", $idstandards);
    $query->execute();
    $result = $query->get_result();
    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
    } else {
        die("Record non trovato.");
    }
    $query->close();
}

// Controlla se ci sono dati da mostrare nel form
$titlestandards = $data['titlestandards'] ?? '';
$numberstandards = $data['numberstandards'] ?? '';
$yearstandards = $data['yearstandards'] ?? '';
$status = $data['status'] ?? '';
$activefrom = $data['activefrom'] ?? date('Y-m-d');
$activeto = $data['activeto'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <?php include('../include/seo.php'); ?>

    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="shortcut icon" href="../assets/images/favicon.ico">

    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/style.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    <!-- Includi il CSS di Dropzone -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.css" rel="stylesheet">

    <!-- Includi il JavaScript di Dropzone -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js"></script>

    <style>
        .updated-field {
            background-color: #c9e2c9 !important;
            /* Colore verde chiaro */
            transition: background-color 2s ease-out;
            /* Transizione lenta per una migliore visibilità */
        }

        .form-check-input {
            position: relative;
            /* Posizionamento relativo per il contenitore del checkbox */
        }

        .update-message {
            position: absolute;
            /* Posizionamento assoluto per il messaggio */
            left: 100%;
            /* Posiziona a destra del checkbox */
            margin-left: 10px;
            /* Spazio tra il checkbox e il messaggio */
            color: green;
            /* Colore del testo */
        }

        .updated-label {
            background-color: #c9e2c9 !important;
            /* Colore verde chiaro */
            transition: background-color 2s ease-out;
            /* Transizione lenta per una migliore visibilità */
        }

        .dropzone {
            border: 2px dashed #0087F7;
            /* bordo tratteggiato azzurro */
            border-radius: 5px;
            /* bordi arrotondati */
            background: rgba(0, 135, 247, 0.1);
            /* sfondo leggermente azzurrino */
            min-height: 100px;
            /* altezza ridotta */
            display: flex;
            align-items: center;
            /* allinea verticalmente l'icona e il testo */
            justify-content: center;
            /* allinea orizzontalmente l'icona e il testo */
            padding: 20px;
        }

        .dropzone .dz-message {
            text-align: center;
            margin: 0;
            font-size: 16px;
            color: #333;
        }

        .dropzone .dz-message:before {
            content: '\2601';
            /* Codice Unicode per l'icona della nuvola */
            font-size: 48px;
            color: #0087F7;
            display: block;
        }
    </style>





</head>


<body class="fixed-left">

    <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner"></div>
        </div>
    </div>

    <!-- Begin page -->
    <div id="wrapper">

        <?php include('../include/navigationbar.php'); ?>

        <!-- Start right Content here -->

        <div class="content-page">
            <!-- Start content -->
            <div class="content">

                <?php include('../include/topbar.php'); ?>

                <div class="page-content-wrapper ">

                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-title-box">
                                    <div class="btn-group float-right">
                                        <ol class="breadcrumb hide-phone p-0 m-0">
                                            <li class="breadcrumb-item"><a href="#">Reportify</a></li>
                                            <li class="breadcrumb-item active">EasySpec</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">EasySpec</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title end breadcrumb -->

                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="header-title pb-3 mt-0">EasySpec: Update Standard</h5>

                                        <div>
                                            <form method="post" class="form-horizontal p-t-20" id="updatebeach">

                                                <div class="mb-3 row">
                                                    <label for="titlestandards" class="col-sm-3 control-label">Title Standard</label>
                                                    <div class="col-sm-9">
                                                        <input name="titlestandards" type="text" class="form-control" id="titlestandards" value="<?php echo htmlspecialchars($titlestandards ?? ''); ?>">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="numberstandards" class="col-sm-3 control-label">Number Standard</label>
                                                    <div class="col-sm-9">
                                                        <input name="numberstandards" type="text" class="form-control" id="numberstandards" value="<?php echo htmlspecialchars($numberstandards ?? ''); ?>">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="yearstandards" class="col-sm-3 control-label">Year Standard</label>
                                                    <div class="col-sm-9">
                                                        <select name="yearstandards" class="form-control" id="yearstandards">
                                                            <option value="">Select</option>
                                                            <?php
                                                            $currentYear = date('Y');
                                                            for ($year = $currentYear; $year >= 1900; $year--) {
                                                                echo "<option value='$year'" . (($yearstandards ?? '') == $year ? " selected" : "") . ">$year</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="status" class="col-sm-3 control-label">Status</label>
                                                    <div class="col-sm-2">
                                                        <input type="hidden" name="status" value="I"> <!-- Campo nascosto con valore "I" -->
                                                        <input name="status" type="checkbox" class="form-check-input" id="status" value="A" style="width: 20px; height: 20px;" <?php echo (($status ?? '') == 'A' ? 'checked' : ''); ?>>
                                                        <label class="form-check-label" for="status">Active</label>
                                                    </div>
                                                </div>

                                                <input type="hidden" name="idstandards" value="<?php echo htmlspecialchars($idstandards ?? ''); ?>">

                                                <div class="form-group row">
                                                    <label for="description" class="col-sm-3 control-label">Description</label>
                                                    <div class="col-sm-9">
                                                        <textarea name="description" class="form-control" id="description" rows="4"><?php echo htmlspecialchars($description ?? ''); ?></textarea>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="activefrom" class="col-sm-3 control-label">Active From</label>
                                                    <div class="col-sm-9">
                                                        <input name="activefrom" type="date" class="form-control" id="activefrom" value="<?php echo htmlspecialchars($activefrom ?? date('Y-m-d')); ?>">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="activeto" class="col-sm-3 control-label">Active To</label>
                                                    <div class="col-sm-9">
                                                        <input name="activeto" type="date" class="form-control" id="activeto" value="<?php echo htmlspecialchars($activeto ?? ''); ?>">
                                                    </div>
                                                </div>


                                            </form>
                                        </div><!--end table-responsive-->

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->


                    </div><!-- container -->
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="header-title pb-3 mt-0">Documenti Caricati</h5>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Filename</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="fileList">
                                                <!-- I file caricati verranno aggiunti qui dinamicamente -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Dropzone Area -->
                        <div class="row">
                            <div class="col-sm-12">
                                <form action="stdupload.php" class="dropzone" id="file-upload"></form>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <a href="standards.php" class="btn btn-primary mt-3">
                                <i class="bx bx-arrow-back"></i> Back to Standards
                            </a>
                        </div>
                    </div><br>


                    <script>
                        Dropzone.options.fileUpload = {
                            url: "stdupload.php",
                            paramName: "file", // I file saranno disponibili in $_FILES['file']
                            maxFilesize: 20, // Dimensione massima del file in MB
                            acceptedFiles: "application/pdf",
                            dictDefaultMessage: "Trascina qui i file o clicca per caricare",
                            sending: function(file, xhr, formData) {
                                // Aggiungi l'idstandards come parte del formData
                                formData.append("idstandards", '<?php echo $idstandards; ?>');
                            },
                            init: function() {
                                this.on("success", function(file, responseText) {
                                    var response = JSON.parse(responseText);
                                    if (response.status === 'ok') {
                                        fetchFiles();
                                    } else {
                                        alert(response.message);
                                    }
                                });
                            }
                        };
                    </script>



                </div> <!-- Page content Wrapper -->

            </div> <!-- content -->

            <?php include('../include/footer.php'); ?>

        </div>
        <!-- End Right content here -->

    </div>
    <!-- END wrapper -->
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#updatebeach input[type="checkbox"]').change(function() {
                // Quando lo stato del checkbox cambia
                if (this.checked) {
                    // Se il checkbox è selezionato, imposta il valore "A"
                    $(this).val('A');
                } else {
                    // Se il checkbox non è selezionato, imposta il valore del campo nascosto su "I"
                    $(this).prev('input[type="hidden"]').val('I');
                }
            });

            $('#updatebeach').on('submit', function() {
                // Prima del submit, verifica lo stato del checkbox e aggiorna i valori di conseguenza
                var checkbox = $('#status');
                if (checkbox.is(':checked')) {
                    checkbox.val('A');
                } else {
                    checkbox.prev('input[type="hidden"]').val('I');
                }
            });
            $('#updatebeach input, #updatebeach select, #updatebeach textarea').on('change blur', function() {
                var field = $(this);
                var formData = $(this).closest('form').serialize();

                updateData(formData, field);
            });

            function updateData(formData, field) {
                $.ajax({
                    type: 'POST',
                    url: 'updatestd.php',
                    data: formData,
                    dataType: 'json',

                    success: function(data) {
                        if (data.success) {
                            if (field.is(':checkbox')) {
                                // Applica la classe al label che segue il checkbox
                                var label = field.next('label');
                                label.addClass('updated-label');
                                setTimeout(function() {
                                    label.removeClass('updated-label');
                                }, 2000); // Mantiene il colore verde per 2 secondi
                            } else {
                                // Applica la classe per il colore verde
                                field.addClass('updated-field');
                                setTimeout(function() {
                                    field.removeClass('updated-field');
                                }, 2000);
                            }
                        } else {
                            alert(data.message || "Errore sconosciuto.");
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Errore di connessione al server: ' + error);
                    }
                });
            }
        });
    </script>

    <script>
        function fetchFiles() {
            $.ajax({
                url: 'stdlistquery.php',
                type: 'GET',
                data: {
                    idstandards: '<?php echo $idstandards; ?>'
                },
                dataType: 'json',
                success: function(data) {
                    console.log(data); // Debugging: stampa i dati ricevuti
                    var tableRef = document.getElementById('fileList');
                    tableRef.innerHTML = ''; // Pulisci la tabella
                    data.files.forEach(function(file) {
                        var newRow = tableRef.insertRow();
                        var nameCell = newRow.insertCell(0);
                        var link = document.createElement('a');
                        link.setAttribute('href', "../pdfstandards/" + file.filename);
                        link.setAttribute('target', '_blank');
                        link.textContent = file.filename;
                        nameCell.appendChild(link);

                        var deleteCell = newRow.insertCell(1);
                        var deleteIcon = document.createElement('i');
                        deleteIcon.className = 'fa fa-trash';
                        deleteIcon.style.color = 'red';
                        deleteIcon.style.cursor = 'pointer';
                        deleteIcon.onclick = function() {
                            deleteFile(file.filename, '<?php echo $idstandards; ?>');
                        };
                        deleteCell.appendChild(deleteIcon);
                    });
                },
                error: function(xhr, status, error) {
                    console.error("Errore durante il recupero dei file: " + error);
                }
            });
        }




        document.addEventListener('DOMContentLoaded', function() {
            fetchFiles(); // Chiamata iniziale al caricamento della pagina

            // Configurazione di Dropzone
            Dropzone.options.fileUpload = {
                url: "stdupload.php",
                init: function() {
                    this.on("success", function(file, responseText) {
                        var response = JSON.parse(responseText);
                        if (response.status === 'ok') {
                            fetchFiles(); // Aggiorna la tabella solo se il file è caricato con successo
                        } else {
                            console.error("Errore: " + response.message); // Utilizza console.error per gli errori
                        }
                    });
                    this.on("error", function(file, response) {
                        console.error("Errore durante il caricamento del file: " + response); // Mostra gli errori in console
                    });
                }
            };



        });
    </script>
    <script>
        function deleteFile(filename, idstandards) {
            // Mostra un dialogo di conferma prima di procedere con la cancellazione
            Swal.fire({
                title: 'Do you want to cancel the file?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Se l'utente conferma, procedi con la cancellazione
                    $.ajax({
                        url: 'deleteFile.php',
                        type: 'POST',
                        data: {
                            filename: filename,
                            idstandards: idstandards
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.status === 'success') {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                );
                                fetchFiles(); // Aggiorna la lista dopo la cancellazione
                            } else {
                                Swal.fire(
                                    'Error!',
                                    'An error occurred while deleting the file.',
                                    'error'
                                );
                            }
                        }
                    });
                }
            });
        }
    </script>








    <!-- plugin JS  -->
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/modernizr.min.js"></script>
    <script src="../assets/js/detect.js"></script>
    <script src="../assets/js/fastclick.js"></script>
    <script src="../assets/js/jquery.slimscroll.js"></script>
    <script src="../assets/js/jquery.blockUI.js"></script>
    <script src="../assets/js/waves.js"></script>
    <script src="../assets/js/jquery.nicescroll.js"></script>
    <script src="../assets/js/jquery.scrollTo.min.js"></script>

    <script src="../assets/plugins/chart.js/chart.min.js"></script>
    <script src="../assets/pages/dashboard.js"></script>

    <!-- App js -->
    <script src="../assets/js/app.js"></script>


</body>

</html>