<!DOCTYPE html>
<html lang="es_MX">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vocom</title>

    <meta name="keywords" content="Jada Demoliciones, demoledores, sustentables, excavaciones, desmantelamientos, arquitectura, demoliciones">
    <meta name="descripcion" content="Somos una empresa con 70 años de experiencia especializada en la regeneración de espacios urbanos.">

    <meta property="og:title" content="Jada Demoliciones">
    <meta property="og:url" content="<?php echo base_url(); ?>">
    <meta property="og:description" content="Somos una empresa con 70 años de experiencia especializada en la regeneración de espacios urbanos." />
    <meta property="og:image" content="<?php echo base_url(); ?>assets/images/logo.png">
    <meta property="og:locale:alternate" content="es_MX">

    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.24/b-1.7.0/b-html5-1.7.0/b-print-1.7.0/r-2.2.7/datatables.min.css"/>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/libraries/iziToast.min.css"> 
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/styles.css">
    <?php echo $this->template->stylesheet; ?>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.24/b-1.7.0/b-html5-1.7.0/b-print-1.7.0/r-2.2.7/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.8.0/dist/chart.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/libraries/iziToast.min.js"></script>
</head>
<body data-ruta="<?php echo base_url(); ?>">

    <?php echo $this->template->content;?>
    
    <script src="<?php echo base_url(); ?>assets/js/scripts.js"></script>

</body>
</html>