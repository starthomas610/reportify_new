<?php include('../include/headscript.php'); ?>
<?php //include("class/company.php"); 
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
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <style>
        .table-custom .form-control,
        .table-custom .form-select {
            height: 25px;
            padding: 2px 6px;
            font-size: 14px;
        }

        .table-custom .form-control-sm.analysis-input {
            height: 25px;
            padding: 2px 6px;
            font-size: 12px;
        }

        .form-row {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .select-container {
            position: relative;
            display: inline-block;
        }

        .selected-text {
            padding: 6px;
            cursor: pointer;
            width: 150px;
            display: inline-block;
        }


        select.form-control {
            position: absolute;
            top: 0;
            left: 0;
            width: 150px;
        }

        .select2-selection__clear {
            display: none !important;
        }

        .select-container {
            position: relative;
            display: inline-block;
        }

        .selected-text {
            padding: 6px;
            cursor: pointer;
            width: 200px;
            /* aumenta la larghezza della select */
            display: inline-block;
            border: none;
            background: none;
            outline: none;
        }

        .select-container select.form-control {
            width: 200px;
            /* aumenta la larghezza della select */
            -webkit-appearance: none;
            /* rimuove la freccia di default di alcuni browser */
            -moz-appearance: none;
            /* rimuove la freccia di default di Firefox */
            appearance: none;
            /* rimuove la freccia di default */
            background: none;
            border: 1px solid #ced4da;
            /* aggiunge un bordo alla select */
            padding: 6px;
            outline: none;
            cursor: pointer;
        }

        .green-highlight {
            background-color: #228B22 !important;
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
                        <?php if (isset($_POST['id'])) {
                            $idrsl = $_POST['id'];
                        } ?>
                        <?php if (isset($_GET['id'])) {
                            $idrsl = $_GET['id'];
                        } ?>
                        <?php if (isset($_GET['idmaterial_rsl'])) {
                            $idmaterial_rsl = $_GET['idmaterial_rsl'];
                        } ?>
                        <?php
                        if ((((isset($_POST["analysis"])) ? $_POST["analysis"] : "") != "")) {
                            $idanalysis = $_POST['analysis'];
                            $idmaterial_type = $_POST['material_id'];
                            $idrsl = $_POST['id'];
                            include('check-an-present.php');
                            $idanpr = $checkanpr->getColumnVal("idanalysis_rsl");
                            if (empty($idanpr)) {

                                $InsertQuery = new WA_MySQLi_Query($repnew);
                                $InsertQuery->Action = "insert";
                                $InsertQuery->Table = "analysis_rsl";
                                $InsertQuery->bindColumn("analysis_id", "i", "" . ((isset($_POST["analysis"])) ? $_POST["analysis"] : "")  . "", "WA_DEFAULT");
                                $InsertQuery->bindColumn("rsl_id", "i", "" . ((isset($_POST["id"])) ? $_POST["id"] : "")  . "", "WA_DEFAULT");
                                $InsertQuery->bindColumn("material_id", "i", "" . ((isset($_POST["material_id"])) ? $_POST["material_id"] : "")  . "", "WA_DEFAULT");
                                $InsertQuery->saveInSession("");
                                $InsertQuery->execute();
                                $InsertGoTo = "";
                                if (function_exists("rel2abs")) $InsertGoTo = $InsertGoTo ? rel2abs($InsertGoTo, dirname(__FILE__)) : "";
                                $InsertQuery->redirect($InsertGoTo); ?>
                            <?php
                            }
                            if (!empty($idanpr)) {
                            ?>
                                <div class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> Analysis not added. The Analysis was already present in the RSL. </div>
                        <?php        }
                        }
                        ?>

                        <?php
                        $material_id = $_GET['material_id'];
                        $conn = new mysqli($servername, $username, $password, $database);
                        $sql = "SELECT name_material FROM material_type WHERE idmaterial_type = $material_id";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $name_material = $row['name_material'];
                        }
                        $conn->close();
                        $tablequery = new WA_MySQLi_RS("tablequery", $repnew, 0);
                        $tablequery->setQuery("SELECT * FROM rsl LEFT JOIN rsl_category ON rsl.rsl_category_id=rsl_category.idrslcat LEFT JOIN department ON rsl.department_id=department.`id-department` WHERE rsl.id='$idrsl'");
                        $tablequery->execute();
                        ?>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="header-title pb-3 mt-0">RSL <?php echo ($tablequery->getColumnVal("name")); ?></h5>
                                        <a class="btn btn-danger" href="material-rsl.php?id=<?php echo ($tablequery->getColumnVal("id")); ?>" role="button" data-toggle="tooltip" title="Edit TRL">Detail RSL</a>

                                        <a class="btn btn-danger" href="update-rsl.php?id=<?php echo ($tablequery->getColumnVal("id")); ?>" role="button" data-toggle="tooltip" title="Edit TRL">Edit RSL</a>

                                        <a class="btn btn-danger" href="analysis.php" role="button">Analysis</a>
                                        <a class="btn btn-danger" href="material.php" role="button">Material</a>
                                        <a href="synoptic-table.php?idrsl=<?php echo ($tablequery->getColumnVal("id")); ?>"><button type="button" class="btn btn-success waves-effect waves-light" data-toggle="tooltip" title="Synoptic Table"><i class="bx bx-table font-size-16 align-middle"></i></button></a>
                                        <a href="pdfcreation/pdf-rsl.php?idrsl=<?php echo ($tablequery->getColumnVal("id")); ?>"><button type="button" class="btn btn-success waves-effect waves-light" data-toggle="tooltip" title="Print"><i class="bx bx-printer font-size-16 align-middle"></i></button></a>
                                        <button type="button" class="btn btn-danger waves-effect waves-light" data-toggle="tooltip" title="Save PDF" onclick="showConfirmation(<?php echo ($tablequery->getColumnVal('id')); ?>)">
                                            <i class="fa fa-file-pdf font-size-16 align-middle"></i>
                                        </button>
                                        <!-- <a href="send-email-trl.php"> --><button type="button" id="btn_send_trl" class="btn btn-success waves-effect waves-light"><i class="bx bx-mail-send font-size-16 align-middle"></i> Send TRL to clients</button><!-- </a> -->

                                        <a class="btn btn-dark" href="javascript:void(0);" onclick="window.history.back();" role="button">Go Back</a><br><br>

                                        <div class="table-responsive">
                                            <table class="table table-striped table-sm sm-0">
                                                <thead>
                                                    <tr>
                                                        <th><strong><?php echo $name_lang; ?></strong></th>
                                                        <th><strong><?php echo $description_lang; ?></strong></th>
                                                        <th><strong><?php echo $start_lang; ?></strong></th>
                                                        <th><strong><?php echo $end_lang; ?></strong></th>
                                                        <th><strong><?php echo $rsl_category_id_lang; ?></strong></th>
                                                        <th><?php echo $version_lang; ?></th>
                                                        <th><?php echo $active_lang; ?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><?php echo ($tablequery->getColumnVal("name")); ?></td>
                                                        <td><?php echo ($tablequery->getColumnVal("description")); ?></td>
                                                        <td><?php echo ($tablequery->getColumnVal("start")); ?></td>
                                                        <td><?php echo ($tablequery->getColumnVal("end")); ?></td>
                                                        <td><?php echo ($tablequery->getColumnVal("name_rslcat")); ?></td>
                                                        <td><?php echo ($tablequery->getColumnVal("version")); ?></td>
                                                        <td>
                                                            <?php if ($tablequery->getColumnVal("active") == 'Y') : ?>
                                                                <button class="btn btn-success">
                                                                    <i class="bx bx-check-double"></i>
                                                                </button>
                                                            <?php endif; ?>
                                                        </td>
                                                </tbody>
                                            </table>
                                        </div><!--end table-responsive-->

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                        <?php
                        $materialtype = new WA_MySQLi_RS("materialtype", $repnew, 1);
                        $materialtype->setQuery("SELECT * FROM material_type WHERE material_type.idmaterial_type='$material_id'");
                        $materialtype->execute();
                        ?>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="alert alert-danger" style="font-weight: bold; font-size: 16px;">
                                            <i class="fa fa-angle-double-right"></i> Material <?php echo ($materialtype->getColumnVal("name_material")); ?>
                                        </div>
                                        <h6 class="card-subtitle">Choose the analysis to add to the RSL for the material <?php echo $name_material; ?></h6><br>
                                        <?php
                                        $analysislist = new WA_MySQLi_RS("analysislist", $repnew, 0);
                                        $analysislist->setQuery("SELECT * FROM analysis WHERE analysis.company_id='$idcompany' ORDER BY analysis.name_analysis");
                                        $analysislist->execute();
                                        ?>
                                        <form method="post" id="addanalysis">
                                            <div class="form-row align-items-end">
                                                <div class="col-md-8">
                                                    <label for="analysis" class="form-label">Select Analysis</label>
                                                    <select name="analysis" class="form-select form-control-sm" id="analysis">
                                                        <?php while (!$analysislist->atEnd()) { //dyn select 
                                                        ?>
                                                            <option value="<?php echo ($analysislist->getColumnVal("idanalysis")); ?>">
                                                                <?php echo ($analysislist->getColumnVal("name_analysis")); ?>
                                                            </option>
                                                            <?php $analysislist->moveNext(); ?>
                                                        <?php } //dyn select 
                                                        ?>
                                                    </select>

                                                    <input name="idcompany" type="hidden" id="idcompany" value="<?php echo $idcompany; ?>">
                                                    <input name="material_id" type="hidden" id="material_id" value="<?php echo $material_id; ?>">
                                                    <input name="id" type="hidden" id="id" value="<?php echo ($tablequery->getColumnVal("id")); ?>">
                                                    <input type="submit" class="btn btn-primary btn-sm" value="Submit">
                                                    <button type="button" id="openPopuppreset" class="btn btn-success btn-sm ml-2">Analysis Preset</button>
                                                </div>
                                            </div>
                                        </form>
                                        <br>
                                        <script>
                                            document.getElementById("openPopuppreset").addEventListener("click", function() {
                                                // Recupera i valori delle variabili
                                                var materialId = "<?php echo $material_id; ?>";
                                                var idMaterialRsl = "<?php echo $idmaterial_rsl; ?>";
                                                var id = "<?php echo $idrsl; ?>";

                                                // Costruisci l'URL con le variabili come parametri
                                                var popupUrl = "presetanalisys.php?material_id=" + materialId + "&idmaterial_rsl=" + idMaterialRsl + "&id=" + id;

                                                // Apri il popup con le dimensioni specificate
                                                var width = window.innerWidth / 2; // Larghezza metà schermo
                                                var height = window.innerHeight; // Altezza intera schermo
                                                var left = (window.innerWidth - width) / 2; // Posizione X centrata
                                                var top = (window.innerHeight - height) / 2; // Posizione Y centrata

                                                // Apri il popup
                                                var popup = window.open(popupUrl, "_blank", "width=" + width + ", height=" + height + ", left=" + left + ", top=" + top);

                                                // Verifica se il popup è stato aperto con successo
                                                if (!popup) {
                                                    alert("Il browser ha bloccato l'apertura del popup. Assicurati di consentire i popup per questo sito.");
                                                }
                                            });
                                        </script>
                                        <?php
                                        // Connessione al database
                                        $conn = new mysqli($servername, $username, $password, $database);

                                        // Verifica connessione
                                        if ($conn->connect_error) {
                                            die("Connection failed: " . $conn->connect_error);
                                        }

                                        // Esegui la query
                                        $query = "SELECT idstandards, titlestandards, numberstandards FROM standards";
                                        $result = $conn->query($query);
                                        ?>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-sm sm-0">
                                                <thead>
                                                    <tr>
                                                        <th><strong><?php echo $analysis_id_lang; ?></strong></th>
                                                        <th>Method</th>
                                                        <th style="width: 100px;"></th>
                                                        <th style="width: 100px;">ACTION</th>
                                                        <th style="width: 100px;"></th>
                                                        <th></th>
                                                        <th></th>

                                                    </tr>
                                                </thead>
                                                <tbody class="table-danger">
                                                    <?php
                                                    $tablequery2 = new WA_MySQLi_RS("tablequery2", $repnew, 0);
                                                    $tablequery2->setQuery("SELECT * FROM `analysis_rsl` LEFT JOIN analysis ON analysis_rsl.analysis_id=analysis.idanalysis LEFT JOIN standards ON `analysis_rsl`.idmethods=standards.idstandards WHERE analysis_rsl.rsl_id='$idrsl' AND analysis_rsl.material_id='$material_id'");
                                                    $tablequery2->execute();

                                                    ?>
                                                    <?php
                                                    $wa_startindex = 0;
                                                    while (!$tablequery2->atEnd()) {
                                                        $wa_startindex = $tablequery2->Index;
                                                        $idanalysis = $tablequery2->getColumnVal("analysis_id");
                                                    ?>
                                                        <tr class="parent" id="row<?php echo $idanalysis; ?>">
                                                            <td><?php echo ($tablequery2->getColumnVal("name_analysis")); ?></td>
                                                            <td>
                                                                <label for="standards-<?php echo $idanalysis; ?>"></label>
                                                                <div class="select-container">
                                                                    <?php
                                                                    // Ripeti la query per ottenere i dati degli standard
                                                                    $result = $conn->query("SELECT idstandards, titlestandards, numberstandards FROM standards");
                                                                    $currentStandard = $tablequery2->getColumnVal("numberstandards");
                                                                    $displayText = "Select a standard";

                                                                    if ($result->num_rows > 0) {
                                                                        while ($row = $result->fetch_assoc()) {
                                                                            if ($row["numberstandards"] == $currentStandard) {
                                                                                $displayText = $row["titlestandards"] . ' - ' . $row["numberstandards"];
                                                                            }
                                                                        }
                                                                    }
                                                                    ?>
                                                                    <select id="standards-<?php echo $idanalysis; ?>" name="standards" class="form-control" data-idanalysisrsl="<?php echo $tablequery2->getColumnVal('idanalysis_rsl'); ?>" onchange="updateSelectedTextAndDatabase('standards-<?php echo $idanalysis; ?>')">
                                                                        <option value=""><?php echo $displayText; ?></option>
                                                                        <?php
                                                                        $result->data_seek(0); // Reset result set pointer to the beginning
                                                                        if ($result->num_rows > 0) {
                                                                            while ($row = $result->fetch_assoc()) {
                                                                                $selected = ($row["numberstandards"] == $currentStandard) ? "selected" : "";
                                                                                echo '<option value="' . $row["idstandards"] . '" ' . $selected . '>' . $row["titlestandards"] . ' - ' . $row["numberstandards"] . '</option>';
                                                                            }
                                                                        } else {
                                                                            echo '<option value="">No standards found</option>';
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                    <span id="update-message-<?php echo $idanalysis; ?>" class="update-message" style="display: none; color: green;">Updated</span>
                                                                </div>
                                                                <script>
                                                                    $(document).ready(function() {
                                                                        $('#standards-<?php echo $idanalysis; ?>').select2({
                                                                            placeholder: 'Select a standard',
                                                                            allowClear: true
                                                                        });
                                                                    });
                                                                </script>
                                                            </td>




                                                            <td>
                                                                <!-- <a onclick="window.open('searchenginemethod.php?idanalysis=<?php echo ($tablequery2->getColumnVal("idanalysis")); ?>&idmaterial=<?php echo $material_id; ?>&idanalysisrsl=<?php echo ($tablequery2->getColumnVal("idanalysis_rsl")); ?>', '_blank', 'location=yes,height=720,width=1000,scrollbars=yes,status=yes');">
                                                                    <button type="button" class="btn btn-primary waves-effect waves-light">Method</button>
                                                                </a> -->
                                                            </td>
                                                            <td>
                                                                <a onclick="window.open('addcommentrsl.php?idanalysis=<?php echo ($tablequery2->getColumnVal("idanalysis")); ?>&idmaterial=<?php echo $material_id; ?>&idanalysisrsl=<?php echo ($tablequery2->getColumnVal("idanalysis_rsl")); ?>', '_blank', 'location=yes,height=720,width=1000,scrollbars=yes,status=yes');">
                                                                    <button type="button" class="btn btn-primary waves-effect waves-light">Comment</button>
                                                                </a>
                                                            </td>
                                                            <td>
                                                                <a class="btn btn-danger" href="cancel-analysisrsl.php?idmaterial_rsl=<?php echo $idmaterial_rsl; ?>&idanalysis_rsl=<?php echo ($tablequery2->getColumnVal("idanalysis_rsl")); ?>&id=<?php echo ($tablequery->getColumnVal("id")); ?>&material_id=<?php echo $material_id; ?>" role="button">C</a>
                                                            </td>
                                                            <td>

                                                            </td>
                                                            <td><i class="fas fa-angle-double-down toggle-row" style="cursor: pointer;"></i></td>


                                                        </tr>
                                                        <script>
                                                            function updateSelectedText(selectId) {
                                                                var selectElement = document.getElementById(selectId);
                                                                var selectedText = selectElement.options[selectElement.selectedIndex].text;
                                                                selectElement.options[0].text = selectedText;
                                                            }
                                                        </script>
                                                        <script>
                                                            $(document).ready(function() {
                                                                $('#standards-<?php echo $idanalysis; ?>').select2({
                                                                    placeholder: 'Select a standard',
                                                                    allowClear: true
                                                                });
                                                            });
                                                        </script>
                                                        <?php
                                                        $companalysis = new WA_MySQLi_RS("companalysis", $repnew, 0);
                                                        $companalysis->setQuery("SELECT * FROM analysis_component LEFT JOIN component ON analysis_component.idcomponent=component.idcomponent WHERE analysis_component.idanalysis='$idanalysis'");
                                                        $companalysis->execute(); ?>
                                                        <?php
                                                        $umlist = new WA_MySQLi_RS("umlist", $repnew, 1);
                                                        $umlist->setQuery("SELECT * FROM unit_measure ORDER BY unit_measure.name");
                                                        $umlist->execute();
                                                        ?>
                                                        <tr class="child-row<?php echo $idanalysis; ?> table-primary" style="display: table-row;">
                                                            <th>Component</th>
                                                            <th>CAS</th>
                                                            <th style="width: 100px;">Low Lim</th>
                                                            <th style="width: 100px;">High Lim *</th>
                                                            <th style="width: 100px;">LOQ</th>
                                                            <th style="width: 150px;">UM</th>
                                                            <th style="width: 150px;">Status</th>

                                                        </tr>
                                                        <?php
                                                        $wa_startindex = 0;
                                                        while (!$companalysis->atEnd()) {
                                                            $wa_startindex = $companalysis->Index;
                                                        ?>
                                                            <?php
                                                            $idrsl = $tablequery2->getColumnVal("rsl_id");
                                                            $material_id = $tablequery2->getColumnVal("material_id");
                                                            $component_id = $companalysis->getColumnVal("idcomponent");
                                                            $analysis_id = $tablequery2->getColumnVal("analysis_id");
                                                            ?>
                                                            <tr class="child-row<?php echo $idanalysis; ?> table-info" style="display: table-row;">
                                                                <?php $testo = "Prova suggerimento"; ?>
                                                                <td class="sa-trigger" data-testo="<?php echo $testo; ?>">
                                                                    <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top" title="Suggestion"></i>
                                                                    <?php echo ($companalysis->getColumnVal("name_component")); ?>
                                                                </td>
                                                                <td><?php echo ($companalysis->getColumnVal("cas_component")); ?></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>
                                                            <?php include('../class/req-form.php'); ?>
                                                        <?php
                                                            $companalysis->moveNext();
                                                        }
                                                        $companalysis->moveFirst(); //return RS to first record
                                                        unset($wa_startindex);
                                                        unset($wa_repeatcount);
                                                        ?>
                                                    <?php $tablequery2->moveNext();
                                                    }
                                                    $tablequery2->moveFirst(); //return RS to first record
                                                    unset($wa_startindex);
                                                    unset($wa_repeatcount);
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div><!--end table-responsive-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                        <script>
                            function updateSelectedTextAndDatabase(selectId) {
                                var selectElement = document.getElementById(selectId);
                                var selectedText = selectElement.options[selectElement.selectedIndex].text;
                                selectElement.options[0].text = selectedText;

                                var idmethods = selectElement.value;
                                var idanalysisrsl = selectElement.getAttribute('data-idanalysisrsl');

                                $.ajax({
                                    url: 'update-analysis-rsl.php', // crea questo file PHP per gestire l'aggiornamento
                                    type: 'POST',
                                    data: {
                                        idmethods: idmethods,
                                        idanalysisrsl: idanalysisrsl
                                    },
                                    success: function(response) {
                                        // Mostra il messaggio "Updated"
                                        var messageElement = document.getElementById('update-message-' + selectId.split('-')[1]);
                                        $(messageElement).show();

                                        setTimeout(function() {
                                            $(messageElement).fadeOut();
                                        }, 2000);
                                    },
                                    error: function(xhr, status, error) {
                                        alert('Si è verificato un errore durante l\'aggiornamento del database: ' + error);
                                    }
                                });
                            }
                        </script>
                        <script type="text/javascript">
                            // Aggiungi il gestore di eventi di clic alla freccia
                            $(document).on('click', '.toggle-row', function(event) {
                                event.stopPropagation(); // Impedisce che l'evento si propaghi alla riga
                                var parentRowId = $(this).closest('tr').attr('id');
                                $(this).closest('tr').siblings('.child-' + parentRowId).toggle();
                            });

                            // Nascondi le righe figlio per default
                            $('tr[class*=child-]').hide().children('td');

                            /* SAVE ANALYSIS FORM UPON DATA CHANGE */
                            $('.analysis-input').on('change', function() {
                                if ($(this).attr('oldVal') !== $(this).val()) {
                                    let parentForm = $(this).closest('form');
                                    let formId = parentForm.context.form[10].defaultValue;
                                    let inputE = $(this);
                                    let defBGColor = $(inputE).css("background-color");
                                    let defTxtColor = $(inputE).css("color");
                                    $.post('../include/ajax-request.php', $('#' + formId).serialize(), function(data) {
                                        if (data != 'SUCCESS') {
                                            /* ERROR */
                                            alert(data);
                                        } else {
                                            /* SUCCESS */
                                            $(inputE).css({
                                                'background-color': '#228B22',
                                                'color': '#F0F8FF'
                                            });
                                            $(inputE).fadeOut(300, function() {
                                                $(inputE).css({
                                                    'background-color': defBGColor,
                                                    'color': defTxtColor
                                                })
                                            }).fadeIn(100);
                                        }
                                    });
                                }
                            });

                            function save_record(id) {
                                let inputE = $('.tr-input-' + id);
                                let defBGColor = $(inputE).css("background-color");
                                let defTxtColor = $(inputE).css("color");
                                $.post('../include/ajax-request.php', $('#form-' + id).serialize(), function(data) {
                                    console.log(data);
                                    return;
                                    if (data != 'SUCCESS') {
                                        /* ERROR */
                                        alert(data);
                                    } else {
                                        /* SUCCESS */
                                        $(inputE).css({
                                            'background-color': '#00a65a ',
                                            'color': '#FFF'
                                        });
                                        $(inputE).fadeOut(500, function() {
                                            $(inputE).css({
                                                'background-color': defBGColor,
                                                'color': defTxtColor
                                            })
                                        }).fadeIn(100);
                                    }
                                });
                            }
                        </script>

                    </div><!-- container -->
                </div> <!-- Page content Wrapper -->
            </div> <!-- content -->
            <?php include('../include/footer.php'); ?>
        </div>
        <!-- End Right content here -->
    </div>
    <!-- END wrapper -->

    <script>
        $(document).ready(function() {
            // Aggiungi un gestore di eventi di clic a tutti gli elementi con la classe .sa-trigger
            $('.sa-trigger').click(function() {
                // Ottieni il testo associato a questo elemento dall'attributo data-testo
                var testo = $(this).data('testo');

                // Mostra lo SweetAlert con il testo
                Swal.fire({
                    title: 'Testo da PHP',
                    text: testo,
                    icon: 'info',
                    confirmButtonText: 'Chiudi'
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

    <!-- plugin JS  -->

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
    <script>
        $(document).ready(function() {
            $('#analysis').select2();
        });
    </script>
</body>

</html>