<!DOCTYPE html>
<html class="loading" lang="es_MX" data-textdirection="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">

    <meta name="title" content="<?php echo isset($pagina_titulo) ? $pagina_titulo . " | " : ""; ?><?php echo titulo() ? titulo() : ""; ?>">
    <meta name="description" content="<?php echo descripcion(); ?>">
    <meta name="keywords" content="<?php echo palabras_clave(); ?>">
    <meta name="author" content="<?php echo autor(); ?>">
    <meta name="language" content="es_MX">

    <meta property="og:image" content="<?php echo base_url('almacenamiento/recursos/logos/avatar-s-1.png'); ?>">
    <meta property="og:title" content="<?php echo isset($pagina_titulo) ? $pagina_titulo . " | " : ""; ?><?php echo titulo() ? titulo() : ""; ?>">
    <meta property="og:description" content="<?php echo descripcion(); ?>">
    <meta property="article:author" content="<?php echo autor(); ?>">
    <meta property="og:locale" content="es_MX">
    <meta property="og:type" content="website">

    <title><?php echo isset($pagina_titulo) ? $pagina_titulo . " | " : ""; ?><?php echo titulo() ? titulo() : ""; ?></title>

    <link rel="apple-touch-icon" href="<?php echo base_url('almacenamiento/recursos/logos/favicon/apple-icon-120x120.png'); ?>">
    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo base_url('almacenamiento/recursos/logos/favicon/apple-icon-57x57.png'); ?>">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo base_url('almacenamiento/recursos/logos/favicon/apple-icon-60x60.png'); ?>">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url('almacenamiento/recursos/logos/favicon/apple-icon-72x72.png'); ?>">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url('almacenamiento/recursos/logos/favicon/apple-icon-76x76.png'); ?>">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url('almacenamiento/recursos/logos/favicon/apple-icon-114x114.png'); ?>">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url('almacenamiento/recursos/logos/favicon/apple-icon-120x120.png'); ?>">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo base_url('almacenamiento/recursos/logos/favicon/apple-icon-144x144.png'); ?>">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url('almacenamiento/recursos/logos/favicon/apple-icon-152x152.png'); ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url('almacenamiento/recursos/logos/favicon/apple-icon-180x180.png'); ?>">
    <link rel="icon" type="image/png" sizes="192x192" href="<?php echo base_url('almacenamiento/recursos/logos/favicon/android-icon-192x192.png'); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url('almacenamiento/recursos/logos/favicon/favicon-32x32.png'); ?>">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url('almacenamiento/recursos/logos/favicon/favicon-96x96.png'); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url('almacenamiento/recursos/logos/favicon/favicon-16x16.png'); ?>">
    <link rel="manifest" href="<?php echo base_url('almacenamiento/recursos/logos/favicon/manifest.json'); ?>">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?php echo base_url('almacenamiento/recursos/logos/favicon/ms-icon-144x144.png'); ?>">
    <meta name="theme-color" content="#ffffff">

    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('almacenamiento/recursos/logos/favicon/favicon.ico'); ?>">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Muli:300,400,500,700" rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>app-assets/css/vendors.css">
    <!-- END VENDOR CSS-->
    <!-- BEGIN ROBUST CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>app-assets/css/app.css">
    <!-- END ROBUST CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>app-assets/css/core/menu/menu-types/horizontal-menu.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>app-assets/css/core/colors/palette-gradient.css">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/main.css">
    <!-- END Custom CSS-->

    <?php if (isset($styles) && is_array($styles)) : ?>
        <?php foreach ($styles as $style) : ?>
            <link rel="stylesheet" type="text/css" href="<?php echo !$style['es_rel'] ? $style['href'] : base_url() . 'assets/css/' . $style['href']; ?>">
        <?php endforeach; ?>
    <?php endif; ?>

</head>

<!-- ////////////////////////////////////////////////////////////////////////////-->

<body class="horizontal-layout horizontal-menu horizontal-menu-padding 2-columns menu-expanded" data-open="hover" data-menu="horizontal-menu" data-col="2-columns">

    <!-- fixed-top-->
    <nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-static-top navbar-light navbar-border navbar-brand-center">
        <div class="navbar-wrapper">

            <div class="navbar-header">
                <ul class="nav navbar-nav flex-row">

                    <li class="nav-item mobile-menu d-md-none mr-auto">
                        <a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile">
                            <span class="avatar avatar-online">
                                <img src="<?php echo base_url(); ?>app-assets/images/portrait/small/avatar-s-1.png" alt="avatar">
                                <i></i>
                            </span>
                        </a>
                    </li>

                    <li class="nav-item d-md-none">
                        <a class="navbar-brand" href="<?php echo site_url('site/inicio'); ?>">
                            <img class="img-fluid" width="100px" alt="<?php echo titulo(); ?>" src="<?php echo base_url(); ?>almacenamiento/recursos/logos/logo.png">
                        </a>
                    </li>

                    <li class="nav-item d-md-none">
                        <a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#">
                            <i class="ft-menu font-large-1"></i>
                        </a>
                    </li>

                </ul>
            </div>

            <div class="navbar-container content center-layout">
                <div class="collapse navbar-collapse" id="navbar-mobile">

                    <ul class="nav navbar-nav mr-auto float-left d-none d-md-block">
                        <a class="navbar-brand" href="<?php echo site_url('site/inicio'); ?>">
                            <img class="img-fluid" width="100px" alt="<?php echo titulo(); ?>" src="<?php echo base_url(); ?>almacenamiento/recursos/logos/logo.png">
                        </a>
                    </ul>

                    <ul class="nav navbar-nav float-right">

                        <li class="dropdown-user nav-item">

                            <a class="nav-link dropdown-user-link" href="#">
                                <span class="avatar avatar-online">
                                    <img src="<?php echo base_url(); ?>app-assets/images/portrait/small/avatar-s-1.png" alt="avatar">
                                    <i></i>
                                </span>
                                <span class="user-name"><?php echo $this->session->userdata('user_nombre'); ?></span>
                            </a>

                        </li>

                        <!--li class="nav-item">
                            <a class="nav-link" href="<?php echo site_url('site/inicio'); ?>" target="_blank" rel="noopener noreferrer">
                                <i class="icon-screen-desktop"></i> Ver web
                            </a>
                        </li-->

                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo site_url('login/cerrar_sesion'); ?>">
                                <i class="ft-power"></i> Cerrar sesión
                            </a>
                        </li>

                        <li class="nav-item d-none d-md-block">
                            <a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#">
                                <i class="ft-menu"></i>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>

        </div>
    </nav>

    <!-- ////////////////////////////////////////////////////////////////////////////-->

    <div class="header-navbar navbar-expand-sm navbar navbar-horizontal navbar-fixed navbar-light navbar-without-dd-arrow navbar-shadow d-print-none" role="navigation" data-menu="menu-wrapper">
        <div class="navbar-container main-menu-content content center-layout" data-menu="menu-container">
            <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">

                <li class="nav-item">
                    <a class="nav-link <?php echo isset($pagina_menu_inicio) ? 'active' : ''; ?>" href="<?php echo site_url('site/inicio'); ?>">
                        <i class="icon-home"></i>
                        <span data-i18n="nav.inicio.main">Inicio</span>
                    </a>
                </li>

                <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link <?php echo isset($pagina_menu_clientes) ? 'active' : ''; ?>" href="#" data-toggle="dropdown"><i class="icon-user"></i><span data-i18n="nav.dash.main">Clientes <i class="ft-chevron-down"></i></span></a>
                    <ul class="dropdown-menu">
                        <li data-menu=""><a class="dropdown-item" href="<?php echo site_url('site/clientes'); ?>" data-toggle="dropdown">General</a></li>
                    </ul>
                </li>

                <?php $user_rol_identificador = $this->session->userdata('user_rol_identificador');

                if ($user_rol_identificador == null) : ?>

                    <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link <?php echo isset($pagina_menu_desarrollos) ? 'active' : ''; ?> <?php echo isset($pagina_menu_inmuebles) ? 'active' : ''; ?>" href="#" data-toggle="dropdown"><i class="icon-layers"></i><span data-i18n="nav.dash.main">Catálogo <i class="ft-chevron-down"></i></span></a>
                        <ul class="dropdown-menu">
                            <li data-menu=""><a class="dropdown-item" href="<?php echo site_url('site/desarrollos'); ?>" data-toggle="dropdown">Desarrollos</a></li>
                            <li data-menu=""><a class="dropdown-item" href="<?php echo site_url('site/inmuebles'); ?>" data-toggle="dropdown">Inmuebles</a></li>
                            <li data-menu=""><a class="dropdown-item" href="<?php echo site_url('site/desarrollo_interes'); ?>" data-toggle="dropdown">Desarrollos de interes</a></li>
                            <!-- <li data-menu=""><a class="dropdown-item" href="<?php // echo site_url('site/como_se_entero'); 
                                                                                    ?>" data-toggle="dropdown">Como se entero</a></li> -->
                        </ul>
                    </li>

                    <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link <?php echo isset($pagina_menu_pagos) ? 'active' : ''; ?> <?php echo isset($pagina_menu_facturacion) ? 'active' : ''; ?>" href="#" data-toggle="dropdown"><i class="icon-folder"></i><span data-i18n="nav.dash.main">Ventas <i class="ft-chevron-down"></i></span></a>
                        <ul class="dropdown-menu">
                            <li data-menu=""><a class="dropdown-item" href="<?php echo site_url('site/procesos_venta'); ?>" data-toggle="dropdown">Procesos de venta</a></li>
                            <li data-menu=""><a class="dropdown-item" href="<?php echo site_url('site/facturacion'); ?>" data-toggle="dropdown">Facturación</a></li>
                            <li data-menu=""><a class="dropdown-item" href="<?php echo site_url('site/pagos_caja'); ?>" data-toggle="dropdown">Pagos de caja</a></li>
                            <li data-menu=""><a class="dropdown-item" href="<?php echo site_url('site/pagos'); ?>" data-toggle="dropdown">Pagos</a></li>
                        </ul>
                    </li>

                    <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link <?php echo isset($pagina_menu_usuarios) ? 'active' : ''; ?> <?php //echo isset($pagina_menu_roles) ? 'active' : ''; 
                                                                                                                                                                        ?>" href="#" data-toggle="dropdown"><i class="icon-settings"></i><span data-i18n="nav.dash.main">Sistema <i class="ft-chevron-down"></i></span></a>
                        <ul class="dropdown-menu">
                            <li data-menu=""><a class="dropdown-item" href="<?php echo site_url('site/usuarios'); ?>" data-toggle="dropdown">Usuarios</a></li>
                            <li data-menu=""><a class="dropdown-item" href="<?php echo site_url('site/notas'); ?>" data-toggle="dropdown">Notas</a></li>
                            <li data-menu=""><a class="dropdown-item" href="<?php echo site_url('site/logs'); ?>" data-toggle="dropdown">Logs</a></li>
                            <!--li data-menu=""><a class="dropdown-item" href="<?php echo site_url('site/roles'); ?>" data-toggle="dropdown">Roles</a></li-->
                        </ul>
                    </li>

                <?php endif; ?>

            </ul>
        </div>
    </div>