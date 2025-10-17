<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Library Management System - <?= $this->fetch('title') ?></title>
    <?= $this->Html->meta('icon') ?>

    <!-- Add Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Add Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <style>
        /* Sidebar styling */
        .sidebar {
            min-height: 100vh;
            background-color: #343a40;
            padding-top: 20px;
        }
        .sidebar a {
            color: #fff;
            text-decoration: none;
            padding: 10px 15px;
            display: block;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .sidebar i {
            margin-right: 10px;
        }
        .main-content {
            padding: 20px;
        }
        .active {
            background-color: #495057;
        }
        /* Add transition effect for buttons */
        .btn {
            transition: all 0.3s ease;
        }
        .btn:hover {
            transform: translateY(-1px);
        }
    </style>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 sidebar">
                <h4 class="text-white text-center mb-4">Library MS</h4>
                <nav>
                    <a href="<?= $this->Url->build(['controller' => 'Dashboard', 'action' => 'index']) ?>" class="<?= $this->request->getParam('action') === 'index' ? 'active' : '' ?>">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                    <a href="<?= $this->Url->build(['controller' => 'Books', 'action' => 'index']) ?>" class="<?= $this->request->getParam('controller') === 'Books' ? 'active' : '' ?>">
                        <i class="fas fa-book"></i> Books
                    </a>
                    <a href="<?= $this->Url->build(['controller' => 'Magazines', 'action' => 'index']) ?>" class="<?= $this->request->getParam('controller') === 'Magazines' ? 'active' : '' ?>">
                        <i class="fas fa-newspaper"></i> Magazines
                    </a>
                    <a href="<?= $this->Url->build(['controller' => 'Newspapers', 'action' => 'index']) ?>" class="<?= $this->request->getParam('controller') === 'Newspapers' ? 'active' : '' ?>">
                        <i class="far fa-newspaper"></i> Newspapers
                    </a>
                    <hr class="bg-light">
                    <a href="<?= $this->Url->build(['controller' => 'Issues', 'action' => 'issued']) ?>" class="<?= $this->request->getParam('action') === 'issued' ? 'active' : '' ?>">
                        <i class="fas fa-file-export"></i> Issued
                    </a>
                    <a href="<?= $this->Url->build(['controller' => 'Issues', 'action' => 'returned']) ?>" class="<?= $this->request->getParam('action') === 'returned' ? 'active' : '' ?>">
                        <i class="fas fa-file-import"></i> Returned
                    </a>
                    <a href="<?= $this->Url->build(['controller' => 'Issues', 'action' => 'notReturned']) ?>" class="<?= $this->request->getParam('action') === 'notReturned' ? 'active' : '' ?>">
                        <i class="fas fa-exclamation-circle"></i> Not Returned
                    </a>
                    <hr class="bg-light">
                    <a href="<?= $this->Url->build(['controller' => 'Reports', 'action' => 'index']) ?>" class="<?= $this->request->getParam('controller') === 'Reports' ? 'active' : '' ?>">
                        <i class="fas fa-chart-bar"></i> Reports
                    </a>
                    <hr class="bg-light">
                    <a href="<?= $this->Url->build(['controller' => 'Dashboard', 'action' => 'index']) ?>" class="<?= $this->request->getParam('controller') === 'Dashboard' && $this->request->getParam('action') === 'index' ? 'active' : '' ?>">
                        <i class="fas fa-home"></i> Home
                    </a>
                    <a href="<?= $this->Url->build(['controller' => 'Admins', 'action' => 'profile']) ?>">
                        <i class="fas fa-user"></i> Profile
                    </a>
                    <a href="<?= $this->Url->build(['controller' => 'Admins', 'action' => 'logout']) ?>">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </nav>
            </div>

            <!-- Main Content -->
            <div class="col-md-10 main-content">
                <!-- Top Navigation -->
                <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center">
                            <?= $this->Html->link(
                                '<i class="fas fa-home"></i> Dashboard',
                                ['controller' => 'Dashboard', 'action' => 'index'],
                                ['class' => 'btn btn-outline-primary me-3', 'escape' => false]
                            ) ?>
                            <span class="navbar-text">
                                Welcome, <?= $this->Identity->get('username') ?>
                            </span>
                        </div>
                        <div class="text-muted">
                            <?= date('Y-m-d H:i:s') ?>
                        </div>
                    </div>
                </nav>

                <!-- Flash Messages -->
                <?= $this->Flash->render() ?>

                <!-- Main Content -->
                <?= $this->fetch('content') ?>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>