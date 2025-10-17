<!DOCTYPE html>
<html>
<!-- In the head section of default.php -->
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
    <!-- Toastr -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <?php $this->start('css'); ?>
    <style>
        .sidebar {
    overflow: visible !important;
    z-index: 1100;
}

.main-sidebar {
    overflow: visible !important;
    z-index: 1100;
}

.user-panel {
    overflow: visible !important;
    position: relative;
}

/* Status dropdown styling */
.user-panel .dropdown {
    position: static;
}

.user-panel .dropdown-menu {
    position: absolute !important;
    left: auto !important;
    right: 0 !important;
    top: 100% !important;
    margin-top: 0.5rem;
    background-color: #343a40;
    border: 1px solid rgba(239, 208, 208, 0.1);
    min-width: 150px;
    z-index: 1101;
    transform: none !important;
}

.user-panel .dropdown-item {
    color: #fff;
    padding: 0.5rem 1rem;
    font-size: 0.875rem;
}

.user-panel .dropdown-item:hover {
    background-color: rgba(255,255,255,0.1);
    color: #fff;
}

.user-panel .dropdown-toggle {
    white-space: nowrap;
}

.user-panel .dropdown-toggle::after {
    vertical-align: middle;
}

/* Badge styling */
.badge {
    font-size: 0.875rem;
    padding: 0.4em 0.6em;
}

.badge i {
    font-size: 0.625rem;
}

/* Toast customization */
.toast-success {
    background-color: #28a745 !important;
}

.toast-error {
    background-color: #dc3545 !important;
}

.toast-info {
    background-color: #17a2b8 !important;
}

.toast-warning {
    background-color: #ffc107 !important;
}

/* Fix for dropdown button */
.btn-link:hover,
.btn-link:focus {
    text-decoration: none;
}

/* Ensure dropdown is clickable */
.dropdown,
.dropdown-menu,
.dropdown-item {
    z-index: 1101 !important;
}

/* Fix sidebar collapse behavior */
.sidebar-mini.sidebar-collapse .main-sidebar:hover {
    overflow: visible !important;
}

.sidebar-mini.sidebar-collapse .main-sidebar:hover .user-panel {
    overflow: visible !important;
}

/* Additional spacing */
.gap-2 {
    gap: 0.5rem !important;
}

.info {
    overflow: visible !important;
}
</style>
    <?php $this->end(); ?>

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
                '<i class="fas fa-home"></i> Home',
                ['controller' => 'Dashboard', 'action' => 'index'],
                ['class' => 'nav-link', 'escape' => false]
                ) ?>
            </li>
            <li class="nav-item">
        <?= $this->Html->link(
            '<i class="fas fa-user-circle"></i> Profile',
            ['controller' => 'Admins', 'action' => 'profile'],
            ['class' => 'nav-link', 'escape' => false]
        ) ?>
    </li>
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
            <div class="user-panel mt-3 pb-3 mb-3">
    <div class="info position-relative w-100">
        <a href="#" class="d-block mb-1"><?= h($currentUser) ?></a>
        <div class="d-flex align-items-center gap-2">
            <span class="badge badge-info">Admin</span>
            <div class="dropdown">
                <?php 
                $statusClass = [
                    'Online' => 'success',
                    'Offline' => 'danger',
                    'Break' => 'warning'
                ];
                $currentStatus = $this->Identity->get('status') ?? 'Online';
                ?>
                <button class="btn btn-link btn-sm dropdown-toggle p-0 text-white text-decoration-none" 
                        type="button" 
                        id="statusDropdown" 
                        data-toggle="dropdown" 
                        aria-haspopup="true" 
                        aria-expanded="false"
                        style="position: relative; z-index: 1101;">
                    <span class="badge badge-<?= $statusClass[$currentStatus] ?>" id="statusBadge">
                        <i class="fas fa-circle fa-xs"></i> <?= h($currentStatus) ?>
                    </span>
                </button>
                <div class="dropdown-menu dropdown-menu-right" 
                     aria-labelledby="statusDropdown"
                     style="position: absolute; z-index: 1101;">
                    <a class="dropdown-item status-item" href="#" data-status="Online">
                        <i class="fas fa-circle text-success"></i> Online
                    </a>
                    <a class="dropdown-item status-item" href="#" data-status="Break">
                        <i class="fas fa-circle text-warning"></i> Break
                    </a>
                    <a class="dropdown-item status-item" href="#" data-status="Offline">
                        <i class="fas fa-circle text-danger"></i> Offline
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                    <li class="nav-item">
                        <?= $this->Html->link(
                            '<i class="nav-icon fas fa-home"></i><p>Home</p>',
                            ['controller' => 'Dashboard', 'action' => 'index'],
                            ['class' => 'nav-link' . ($this->request->getParam('controller') === 'Dashboard' && $this->request->getParam('action') === 'index' ? ' active' : ''), 'escape' => false]
                        ) ?>
                    </li>
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
                    <!-- Reports Menu Item -->
                    <li class="nav-item">
                        <?= $this->Html->link(
                            '<i class="nav-icon fas fa-chart-bar"></i><p>Reports</p>',
                            ['controller' => 'Reports', 'action' => 'index'],
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

<?php $this->append('script'); ?>
<script>
$(document).ready(function() {
    // Configure Toastr
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "timeOut": "3000"
    };

    // Handle status updates
    $('.status-item').on('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        
        const status = $(this).data('status');
        console.log('Updating status to:', status); // Debug log
        
        const statusColors = {
            'Online': 'success',
            'Offline': 'danger',
            'Break': 'warning'
        };
        
        $.ajax({
            url: '<?= $this->Url->build(['controller' => 'Admins', 'action' => 'updateStatus']) ?>',
            type: 'POST',
            dataType: 'json',
            data: {
                status: status
            },
            beforeSend: function(xhr) {
                console.log('Sending request...'); // Debug log
            },
            success: function(response) {
                console.log('Response received:', response); // Debug log
                
                if (response.success) {
                    // Update the status badge
                    $('#statusBadge')
                        .removeClass('badge-success badge-danger badge-warning')
                        .addClass('badge-' + statusColors[status])
                        .html(`<i class="fas fa-circle fa-xs"></i> ${status}`);
                    
                    // Show success notification
                    toastr.success('Status updated to ' + status);
                    
                    // Close dropdown
                    $('.dropdown-menu').removeClass('show');
                } else {
                    // Show error notification with specific message
                    toastr.error(response.message || 'Failed to update status');
                }
            },
            error: function(xhr, status, error) {
                // Log detailed error information
                console.error('Error details:', {
                    status: status,
                    error: error,
                    response: xhr.responseText
                });
                
                // Show error notification
                toastr.error('Failed to update status. Please try again.');
            }
        });
    });

    // Prevent dropdown from closing when clicking inside
    $('.dropdown-menu').on('click', function(e) {
        e.stopPropagation();
    });
});
</script>
<?php $this->end(); ?>

<!-- REQUIRED SCRIPTS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<?= $this->fetch('script') ?>


</body>
</html>