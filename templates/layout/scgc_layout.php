<?php

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>

<head>
<?php echo $this->Html->meta('csrfToken', $this->request->getAttribute('csrfToken')); ?>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <!--  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <?= $this->Html->css([
        'material-dashboard',
        'neucleo-icons',
        'neucleo-svg',

    ]) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
</head>

<body class="g-sidenav-show  bg-gray-100">


    <?php echo $this->element('flash/sidebar_scgc') ?>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <div class="container-fluid">
            <?php echo $this->element('flash/navbar') ?>
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
        <?php echo $this->element('flash/footer') ?>
    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <?= $this->Html->script([
        'jquery_plugin',
        'validate_plugin',
        'ajax',
        'script',
        'core/popper.min',
        'core/bootstrap.min',
        'material-dashboard',
        'plugins/perfect-scrollbar.min',
        'plugins/smooth-scrollbar.min',
        'neucleo-icons',
        'neucleo-svg',

    ]) ?>

    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <?= $this->fetch('script') ?>

</body>

</html>