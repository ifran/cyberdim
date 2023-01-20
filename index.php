<?php 
    header('Content-Type: text/html; charset=utf-8');
    include('Application/core/Inc.php');
    $iV = rand(0,2000);

    $sUserName = 'Administrador';
    if (isset($_SESSION['sUserName']))
    {
        $sUserName = $_SESSION['sUserName'];
    }

    $sPage = (isset($_GET['sPage']) ? $_GET['sPage'] : '');
    // validateSession($sPage);

    if (isset($_SESSION['bLogin']) OR true)
    {
        $sLogin = 'Logout';
        $sLoginLink = HOST_PUBLIC . 'loginAction.php?sLogout=1';
        $sPerfil = 'Meu Perfil';
        $sPerfilLink = HOST_PUBLIC . 'PerfilUsuario';
    }
    else
    {
        $sLogin = 'Login';
        $sLoginLink = HOST_PUBLIC . 'Login';
        $sPerfil = 'Quero me cadastrar';
        $sPerfilLink = HOST_PUBLIC . 'Register';
        header('Location: Login');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vt Teste</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?=PATH_ADMIN_LTE?>plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="<?=PATH_ADMIN_LTE?>plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?=PATH_ADMIN_LTE?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?=PATH_ADMIN_LTE?>plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?=PATH_ADMIN_LTE?>dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?=PATH_ADMIN_LTE?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?=PATH_ADMIN_LTE?>plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="<?=PATH_ADMIN_LTE?>plugins/summernote/summernote-bs4.min.css">

    <style>
        .card-body-venda {
            padding-bottom: 0;
            padding-top: 5px;
        }

        .destacarTr:hover {
            background-color: #A0C0D0;
            cursor: pointer;
        }

        .menuLink {
            color: white;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- ICONE DE LOAD -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="<?=PATH_IMG_LOGO?>" alt="CyberDimLogo" height="60" width="60">
        </div>

        <!-- MENU LATERAL E ACIMA -->
        <?php include('menuSide.php'); ?>
        
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0"><?=$_GET['sPage']?></h1>
                        </div>
                    </div>
                </div>
            </div>

            <?php 
                try { 
                    include(PATH_VIEW . $_GET['sPage'] . 'View.php');
                } catch (Exception $e) {
                    print_r($e);
                }
            ?>
        </div>
    </div>

    <!-- jQuery -->
    <script src="<?=PATH_ADMIN_LTE?>plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?=PATH_ADMIN_LTE?>plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="<?=PATH_ADMIN_LTE?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="<?=PATH_ADMIN_LTE?>plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="<?=PATH_ADMIN_LTE?>plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="<?=PATH_ADMIN_LTE?>plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="<?=PATH_ADMIN_LTE?>plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="<?=PATH_ADMIN_LTE?>plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="<?=PATH_ADMIN_LTE?>plugins/moment/moment.min.js"></script>
    <script src="<?=PATH_ADMIN_LTE?>plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="<?=PATH_ADMIN_LTE?>plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="<?=PATH_ADMIN_LTE?>plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="<?=PATH_ADMIN_LTE?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?=PATH_ADMIN_LTE?>dist/js/adminlte.js"></script>
    <!-- Mask -->
    <script src="<?=PATH_ADMIN_LTE?>plugins/inputmask/jquery.inputmask.min.js"></script>

    <script src="<?=PATH_JS?>genericFuncs.js?v=<?=$iV?>"></script>

    <script>
    function tipoQuant(iTipo) 
    {
        _$('iQuantidadeDiv').style.display = 'none';
        _$('iAlturaDiv').style.display = 'none';
        _$('iLarguraDiv').style.display = 'none';

        if (iTipo == 1) {
            _$('iQuantidadeDiv').style.display = '';
        } else if (iTipo == 2) {
            _$('iAlturaDiv').style.display = '';
            _$('iLarguraDiv').style.display = '';
        }
    }

    $(function () {
        $('[data-mask]').inputmask()
    });
</script>
</body>
</html>
