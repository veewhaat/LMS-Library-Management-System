<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LMS Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- AdminLTE -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">

    <?= $this->fetch('css') ?>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <?= $this->Html->link(
                    '<i class="fas fa-sign-out-alt"></i> Logout',
                    ['controller' => 'Admins', 'action' => 'logout'],
                    ['class' => 'nav-link', 'escape' => false]
                ) ?>
            </li>
        </ul>
    </nav>

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="/" class="brand-link">
            <span class="brand-text font-weight-light">LMS Dashboard</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="info">
                    <a href="#" class="d-block"><?= h($currentUser) ?></a>
                    <span class="badge badge-info">Admin</span>
                    <span class="badge badge-success">Online</span>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                    <li class="nav-item">
                        <?= $this->Html->link(
                            '<i class="nav-icon fas fa-book"></i><p>Books</p>',
                            ['controller' => 'Books', 'action' => 'index'],
                            ['class' => 'nav-link', 'escape' => false]
                        ) ?>
                    </li>
                    <li class="nav-item">
                        <?= $this->Html->link(
                            '<i class="nav-icon fas fa-newspaper"></i><p>Magazines</p>',
                            ['controller' => 'Magazines', 'action' => 'index'],
                            ['class' => 'nav-link', 'escape' => false]
                        ) ?>
                    </li>
                    <li class="nav-item">
                        <?= $this->Html->link(
                            '<i class="nav-icon fas fa-newspaper"></i><p>Newspapers</p>',
                            ['controller' => 'Newspapers', 'action' => 'index'],
                            ['class' => 'nav-link', 'escape' => false]
                        ) ?>
                    </li>
                    <li class="nav-item">
                        <?= $this->Html->link(
                            '<i class="nav-icon fas fa-hand-holding"></i><p>Issued</p>',
                            ['controller' => 'Issued', 'action' => 'index'],
                            ['class' => 'nav-link', 'escape' => false]
                        ) ?>
                    </li>
                    <li class="nav-item">
                        <?= $this->Html->link(
                            '<i class="nav-icon fas fa-undo"></i><p>Returned</p>',
                            ['controller' => 'Returned', 'action' => 'index'],
                            ['class' => 'nav-link', 'escape' => false]
                        ) ?>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <!-- Content Header -->
        <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><?= $this->fetch('title') ?></h1>
            </div>
            <div class="col-sm-6">
                <p class="float-right text-muted">
                    <i class="far fa-clock"></i> Current Date and Time (MYT): <?= h($currentDateTime) ?>
                </p>
            </div>
        </div>
    </div>
</div>

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <?= $this->Flash->render() ?>
                <?= $this->fetch('content') ?>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="main-footer">
        <div class="float-right d-none d-sm-inline">
            Library Management System
        </div>
        <strong>Copyright &copy; <?= date('Y') ?></strong> All rights reserved.
    </footer>
</div>

<!-- REQUIRED SCRIPTS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

<?= $this->fetch('script') ?>
</body>
</html>