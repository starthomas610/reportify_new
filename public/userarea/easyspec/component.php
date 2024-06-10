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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .table-custom tr {
            height: 40px;
            line-height: 40px;
        }

        .table-custom td,
        .table-custom th {
            padding: 4px 8px;
        }

        .table-custom .btn {
            padding: 2px 15px;
            line-height: 1.7;
            font-size: 14px;
        }

        .form-row {
            display: flex;
            align-items: center;
            /* Questo allinea verticalmente gli elementi nella riga */
            gap: 10px;
            /* Questo crea una piccola distanza tra gli elementi nella riga */
        }

        .table-custom .form-control,
        .table-custom .form-select {
            height: 25px;
            /* Puoi modificare questo valore per adattarlo al tuo design */
            padding: 2px 6px;
            /* riduce la dimensione del padding */
            font-size: 14px;
            /* riduce la dimensione del font */
        }

        .table-custom .form-control-sm.analysis-input {
            height: 25px;
            /* Questo modifica la dimensione degli input con classe 'form-control-sm' e 'analysis-input' */
            padding: 2px 6px;
            font-size: 12px;
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
                                        <h5 class="header-title pb-3 mt-0">EasySpec: <?php echo $component; ?></h5>

                                        <a class="btn btn-danger" href="insert-component.php" role="button">Insert New Component</a> <a class="btn btn-danger" href="component-family.php" role="button">Component Family</a> <button type="button" onclick="goBack()" class="btn btn-dark waves-effect waves-light"><i class="fa fa-backward"></i> Back</button> <br><br>
                                        <script>
                                            function goBack() {
                                                window.history.back();
                                            }
                                        </script>
                                        <div class="col-sm-12 mb-3">
                                            <input type="text" class="form-control" id="searchInput" placeholder="Search by Component or CAS">
                                        </div>




                                        <div class="table-responsive">

                                            <table class="table table-striped table-sm sm-0">
                                                <thead>

                                                    <tr>
                                                        <th><strong></strong></th>
                                                        <th><strong><?php echo $name_component_lang; ?></strong></th>

                                                        <th><strong><?php echo $cas_component_lang; ?></strong></th>
                                                        <th><strong><?php echo $formula_component_lang; ?></strong></th>
                                                        <th><strong><?php echo $component_family_id_lang; ?></strong></th>

                                                        <th></th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $tablequery = new WA_MySQLi_RS("tablequery", $repnew, 30);
                                                    $tablequery->setQuery("SELECT component.*, component_family.*, component_family_type.*, component.company_id AS companyidcomp FROM `component` LEFT JOIN component_family ON component.component_Family_id=component_family.idcomponentfamily LEFT JOIN component_family_type ON component.component_family_type=component_family_type.idcomponentfamilytype ORDER BY component.preset");
                                                    $tablequery->execute();

                                                    ?>
                                                    <?php

                                                    $wa_startindex = 0;
                                                    while (!$tablequery->atEnd()) {
                                                        $wa_startindex = $tablequery->Index;
                                                    ?>
                                                        <tr>
                                                            <td><?php echo ($tablequery->getColumnVal("idcomponent")); ?></td>
                                                            <td><?php echo ($tablequery->getColumnVal("name_component")); ?></td>

                                                            <td><?php echo ($tablequery->getColumnVal("cas_component")); ?></td>
                                                            <td><?php echo ($tablequery->getColumnVal("formula_component")); ?></td>
                                                            <td><?php echo ($tablequery->getColumnVal("name_componentfamily")); ?></td>
                                                            <td>
                                                                <?php
                                                                $compidcompany = $tablequery->getColumnVal("companyidcomp");


                                                                //if ($compidcompany == $idcompany) { 
                                                                ?>
                                                                <a class="btn btn-danger" href="update-component.php?idcomponent=<?php echo ($tablequery->getColumnVal("idcomponent")); ?>" role="button">E</a><?php //} 
                                                                                                                                                                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                //  if ($compidcompany == $idcompany) { 
                                                                ?>
                                                                <a class="btn btn-danger" href="cancel-component.php?idcomponent=<?php echo ($tablequery->getColumnVal("idcomponent")); ?>" role="button">C</a>
                                                            </td>
                                                        </tr> <?php // } 
                                                                ?>
                                                    <?php
                                                        $tablequery->moveNext();
                                                    }
                                                    $tablequery->moveFirst(); //return RS to first record
                                                    unset($wa_startindex);
                                                    unset($wa_repeatcount);
                                                    ?>
                                                </tbody>

                                            </table>
                                            <br>
                                            <a href="<?php echo $tablequery->getFirstPageLink(); ?>"><i class="fas fa-angle-double-left fa-2x"></i></a>
                                            <a href="<?php echo $tablequery->getPrevPageLink(); ?>"><i class="fas fa-angle-left fa-2x"></i></a>
                                            <a href="<?php echo $tablequery->getNextPageLink(); ?>"><i class="fas fa-angle-right fa-2x"></i></a>
                                            <a href="<?php echo $tablequery->getLastPageLink(); ?>"><i class="fas fa-angle-double-right fa-2x"></i></a>

                                        </div><!--end table-responsive-->

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                        <script>
                            $(document).ready(function() {
                                $('#searchInput').on('input', function() {
                                    var searchValue = $(this).val();

                                    if (searchValue.length >= 3) {
                                        $.ajax({
                                            url: 'search_components.php', // Percorso del file PHP che gestisce la ricerca
                                            type: 'GET',
                                            data: {
                                                query: searchValue
                                            }, // Invia la query come parametro GET
                                            success: function(data) {
                                                $('table tbody').html(data); // Aggiorna il corpo della tabella con i risultati
                                            },
                                            error: function() {
                                                alert('Errore nella ricerca dei componenti');
                                            }
                                        });
                                    } else {
                                        fetchAllComponents(); // Funzione per ripristinare tutti i componenti
                                    }
                                });
                            });

                            function fetchAllComponents() {
                                $.ajax({
                                    url: 'fetchAllComponents.php', // Percorso del file PHP che restituisce tutti i componenti
                                    type: 'GET',
                                    success: function(data) {
                                        $('table tbody').html(data);
                                    },
                                    error: function() {
                                        alert('Errore nel caricamento dei componenti');
                                    }
                                });
                            }
                        </script>



                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                const componentInput = document.getElementById("filter-component");
                                const descriptionInput = document.getElementById("filter-description");
                                const casInput = document.getElementById("filter-cas");
                                const formulaInput = document.getElementById("filter-formula");
                                const familyInput = document.getElementById("filter-family");

                                const tableBody = document.getElementById("table-data").getElementsByTagName("tbody")[0];

                                // Memorizza il contenuto originale della tabella
                                const originalTableContent = tableBody.innerHTML;

                                // Aggiungi un ascoltatore di eventi input per ciascun input di filtro
                                componentInput.addEventListener("input", filterTable);
                                descriptionInput.addEventListener("input", filterTable);
                                casInput.addEventListener("input", filterTable);
                                formulaInput.addEventListener("input", filterTable);
                                familyInput.addEventListener("input", filterTable);

                                function filterTable() {
                                    const componentValue = componentInput.value;
                                    const descriptionValue = descriptionInput.value;
                                    const casValue = casInput.value;
                                    const formulaValue = formulaInput.value;
                                    const familyValue = familyInput.value;

                                    // Se tutti gli input sono vuoti, ripristina la tabella al suo stato originale
                                    if (!componentValue && !descriptionValue && !casValue && !formulaValue && !familyValue) {
                                        tableBody.innerHTML = originalTableContent;
                                        return;
                                    }

                                    // Verifica se almeno uno degli input ha una lunghezza di almeno 3
                                    if (componentValue.length < 3 && descriptionValue.length < 3 && casValue.length < 3 && formulaValue.length < 3 && familyValue.length < 3) {
                                        return; // esce dalla funzione se nessun input ha una lunghezza di almeno 3
                                    }

                                    // Effettua una richiesta AJAX al server per ottenere i risultati filtrati
                                    fetch(`filter.php?component=${componentValue}&description=${descriptionValue}&cas=${casValue}&formula=${formulaValue}&family=${familyValue}`)
                                        .then(response => response.json())
                                        .then(data => {
                                            // Aggiorna la tabella con i dati filtrati
                                            updateTable(data);
                                        })
                                        .catch(error => {
                                            console.error('Errore durante la richiesta AJAX:', error);
                                        });
                                }

                                function updateTable(filteredData) {
                                    tableBody.innerHTML = "";

                                    filteredData.forEach(rowData => {
                                        const row = document.createElement("tr");
                                        row.innerHTML = `
            <td>${rowData.idcomponent}</td>
            <td>${rowData.name_component}</td>
            <td>${rowData.description_component}</td>
            <td>${rowData.cas_component}</td>
            <td>${rowData.formula_component}</td>
            <td>${rowData.name_componentfamily}</td>
            <td><a class="btn btn-danger" href="update-component.php?idcomponent=${rowData.idcomponent}" role="button">E</a></td>
            <td><a class="btn btn-danger" href="cancel-component.php?idcomponent=${rowData.idcomponent}" role="button">C</a></td>
        `;
                                        tableBody.appendChild(row);
                                    });
                                }
                            });
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
            $('[data-toggle="tooltip"]').tooltip();
        });
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