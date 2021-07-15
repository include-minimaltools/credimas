<?php if($this->data['photo'] == '') $this->data['photo'] = 'default.jpg';?>
<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Credit Managment Systems</title>
    <meta name="description" content="Sistema de manejo de creditos">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="https://i.imgur.com/QRAUqs9.png">
    <link rel="shortcut icon" href="https://i.imgur.com/QRAUqs9.png">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="<?php echo constant('URL')?>/assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="<?php echo constant('URL')?>/assets/css/style.css">

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
    <link href="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/jqvmap@1.5.1/dist/jqvmap.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    
</head>

<script src="<?php echo constant('URL')?>/assets/js/lib/jquery.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>

<body>
    <!-- Left Panel -->
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="menu-title">Menú</li>
                    <li class="menu-item-has-children dropdown">
                        <ul class="sub-menu children dropdown-menu show">

                            <li><i class="fa fa-home"></i><a href="<?php echo constant('URL')?>">Inicio</a></li>

                            
                            <li class="menu-title">Configuración</li>
                            <li><i class="menu-icon fa fa-cog"></i><a href="<?php echo constant('URL')?>/updateprofile">Editar cuenta</a></li>
                            <li><i class="menu-icon fa fa-sign-in"></i><a href="<?php echo constant('URL')?>/Logout">Cerrar sesión</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </aside>
    <div id="right-panel" class="right-panel">
        <header id="header" class="header">
            <div class="top-left">
                <div class="navbar-header row">
                    <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
                </div>
            </div>
            <div class="top-right">
                <div class="header-menu">  
                    <div class="text-center" style="padding-top:15px;">
                        <label>Bienvenido, <?php echo $this->data['name'];?>!</label>
                    </div>
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="user-profile">
                            <div id="profile_photo" style="background-image: url('images/users/<?php echo $this->data['photo'];?>')"></div>
                        </div>
                        </a>
                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="<?php echo constant('URL')?>/updateprofile"><i class="fa fa- user"></i>Mi perfil</a>
                            <a class="nav-link" href="<?php echo constant('URL')?>/Logout"><i class="fa fa-power -off"></i>Cerrar Sesion</a>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="content">
<!------------------- Aquí continúa el código de cada formulario -------------------->