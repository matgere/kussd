<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="../../assets/img/logo-fav.png">
        <title>UniversEdu</title>
        <link rel="stylesheet" type="text/css" href="../../assets/lib/perfect-scrollbar/css/perfect-scrollbar.css"/>
        <link rel="stylesheet" type="text/css" href="../../assets/lib/material-design-icons/css/material-design-iconic-font.min.css"/>
        <link rel="stylesheet" type="text/css" href="../../assets/lib/datetimepicker/css/bootstrap-datetimepicker.min.css"/>
        <link rel="stylesheet" type="text/css" href="../../assets/lib/select2/css/select2.min.css"/>
        <link rel="stylesheet" type="text/css" href="../../assets/lib/dropzone/dropzone.css"/>
        <link rel="stylesheet" href="../../assets/css/app.css" type="text/css"/>
        <link rel="stylesheet" href="../css/core.css" type="text/css"/>
        <!-- 		Query TreeTable plugin's script -->
        <link rel="stylesheet" href="../../assets/css/jquery.treetable.css" type="text/css"/>
        <!-- 	<link rel="stylesheet" href="../../assets/css/jquery.treetable.theme.default.css" type="text/css"/> -->
        <link rel="stylesheet" href="../css/core.css" type="text/css"/>
        <!-- 	Ajout�s -->
        <link rel="stylesheet" href="../css/prism.css" type="text/css" />
        <link rel="stylesheet" href="../css/demo.css" type="text/css" />
        <link rel="stylesheet" href="../css/intlTelInput.css" type="text/css" />
        <link rel="stylesheet" href="../css/isValidNumber.css" type="text/css" />
        <link rel="stylesheet" href="../../assets/css/app.css" type="text/css" />
        <link rel="stylesheet" href="../css/core.css" type="text/css" />
        <link rel="stylesheet" href="../../plugins/pnotify/pnotify.custom.min.css" type="text/css" />
        <style>
            <!--
            .expander{
                margin-left: -13px !important;
                padding: 8px !important;
            }
            -->
        </style>
    </head>
    <body>
        <!--  	<div class="be-top-header"> -->
        <div class="be-wrapper">
            <nav class="navbar navbar-expand fixed-top be-top-header">
                <div class="container-fluid">
                    <div class="be-navbar-header"><a class="navbar-brand" href="#" style="background-image:none; font-size: 20px;">KUSSD+</a>
                    </div>
                </div>
            </nav>
<!--             <div class=""> -->
                <div class="page-head" style=" top: -10px;">
                <div class="btn-toolbar float-left margin-bottom">
                	<h3 style="color: #14181f; font-family: bold;">Menus</h3>
                </div>
                    <div class="btn-toolbar float-right margin-bottom">
                        <div class="btn-group btn-space mr-2">
                            <button id="btn_newMenu" class="btn btn-secondary" type="button" title="Ajouter un nouveau Menu USSD" data-toggle="tooltip" data-placement="bottom"><i class="icon mdi mdi-plus"></i></button>
                        </div>
                        <div class="btn-group btn-space mr-2">
                            <button id="btn_generateMenu" class="btn btn-secondary" type="button" title="generer menu(s)" data-toggle="tooltip" data-placement="bottom"><i class="icon mdi mdi-play"></i></button>
                        </div>
                    </div>
                </div>
                <div class="main-content container-fluid">
                    <div class="card card-table">
                        <table class="table" id="tree">
                            <thead>
                                <tr>
                                    <th>Titre(title)</th>
                                    <th>Text</th>
                                    <th>Type(acceskey ou input)</th>
                                    <th>Parent</th>
                                    <th>Action(GET ou POST)</th>
                                    <th>URL</th>
                                </tr>
                            </thead>
                            <tbody class="tree-tbody">

                                
                            </tbody>

                        </table>
                    </div>
                </div>
<!--             </div>    -->
        </div>
        <!--      </div> -->

        <script src="//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
        <script src="../../assets/lib/perfect-scrollbar/js/perfect-scrollbar.min.js" type="text/javascript"></script>
        <script src="../../assets/lib/bootstrap/dist/js/bootstrap.bundle.min.js" type="text/javascript"></script>
        <script src="../../assets/js/app.js" type="text/javascript"></script>
        <script src="../../assets/lib/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
        <script src="../../assets/lib/moment.js/min/moment.min.js" type="text/javascript"></script>
        <script src="../../assets/lib/datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
        <script src="../../assets/lib/fuelux/js/wizard.js" type="text/javascript"></script>
        <script src="../../assets/lib/dropzone/dropzone.js" type="text/javascript"></script>
        <script src="../../assets/lib/select2/js/select2.min.js" type="text/javascript"></script>
        <script src="../../assets/lib/select2/js/select2.full.min.js" type="text/javascript"></script>
        <script src="../../assets/lib/jquery.maskedinput/jquery.maskedinput.js" type="text/javascript"></script>
        <script src="../../assets/js/app-form-masks.js" type="text/javascript"></script>
<!--         <script src="../kadm/kadm.js" type="text/javascript"></script> -->
        <script src="../klib/kutils.js" type="text/javascript"></script>
        <script src="kmenu.js" type="text/javascript"></script>
        <script src="kmain.js" type="text/javascript"></script>
        <script src="../klib/bsDialog.js" type="text/javascript"></script>
        <script src="../../assets/lib/parsley/parsley.min.js" type="text/javascript"></script>
        <script src="../../plugins/pnotify/pnotify.custom.min.js"type="text/javascript"></script>
        <script src="../../assets/js/prism.js" type="text/javascript"></script>
        <script src="../../assets/js/intlTelInput.js" type="text/javascript"></script>
        <!-- 		Query TreeTable plugin's script -->
        <script src="../../assets/js/jquery.treetable.js"></script>
    </body>
</html>