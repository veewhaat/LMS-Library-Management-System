<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LMS - <?= $this->fetch('title') ?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <!-- AdminLTE -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">

    <style>
    body {
        background: #f4f6f9;
        min-height: 100vh;
        padding-top: 20px;
    }

    .auth-header {
        text-align: center;
        margin-bottom: 40px;
        padding: 20px;
        background: white;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .auth-header h1 {
        color: #4e73df;
        font-size: 2.5rem;
        font-weight: 700;
        margin: 0;
        text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
    }

    .auth-header .subtitle {
        color: #666;
        font-size: 1.1rem;
        margin-top: 5px;
    }

    .auth-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 20px 0;
    }

    /* Adjust the content width */
    .container {
        max-width: 1140px; /* Standard Bootstrap container width */
        width: 100%;
        padding-right: 15px;
        padding-left: 15px;
        margin-right: auto;
        margin-left: auto;
    }

    /* Match your original widths */
    .login-container {
        width: 100%;
        max-width: 1000px; /* For login form */
    }

    .signup-container {
        width: 100%;
        max-width: 800px; /* For signup form */
    }

    .card {
        box-shadow: 0 0 15px rgba(0,0,0,0.1);
        margin-bottom: 0;
        width: 100%;
    }

    .card-header {
        border-bottom: 0;
        padding: 1.5rem;
    }

    .card-header h3 {
        font-size: 1.5rem;
        font-weight: 600;
    }

    .bg-primary {
        background-color: #4e73df !important;
    }

    .btn-primary {
        background-color: #4e73df;
        border-color: #4e73df;
    }

    .btn-primary:hover {
        background-color: #2e59d9;
        border-color: #2653d4;
    }

    .text-primary {
        color: #4e73df !important;
    }

    .form-control:focus {
        border-color: #4e73df;
        box-shadow: 0 0 0 0.2rem rgba(78,115,223,0.25);
    }

    .form-check-input:checked {
        background-color: #4e73df;
        border-color: #4e73df;
    }

    /* Flash message styles */
    .message {
        padding: 1rem;
        margin-bottom: 1rem;
        border-radius: .25rem;
        animation: fadeOut 5s forwards;
        animation-delay: 3s;
        width: 100%;
        max-width: 600px;
    }

    .message.success {
        background-color: #d4edda;
        border-color: #c3e6cb;
        color: #155724;
    }

    .message.error {
        background-color: #f8d7da;
        border-color: #f5c6cb;
        color: #721c24;
    }

    @keyframes fadeOut {
        from {opacity: 1;}
        to {opacity: 0;}
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .auth-header h1 {
            font-size: 2rem;
        }
        .auth-header .subtitle {
            font-size: 1rem;
        }
        .container {
            padding-right: 20px;
            padding-left: 20px;
        }
    }
    </style>

    <?= $this->fetch('css') ?>
</head>
<body>
    <!-- Main header -->
    <div class="auth-header">
        <h1>LMS - Library Management</h1>
        <div class="subtitle">Welcome to Library Management System</div>
    </div>

    <!-- Main content -->
    <div class="container">
        <div class="auth-container">
            <div class="<?= $this->request->getParam('action') === 'login' ? 'login-container' : 'signup-container' ?>">
                <?= $this->Flash->render() ?>
                <?= $this->fetch('content') ?>
            </div>
        </div>
    </div>

    <style>
.message {
    padding: 1rem;
    margin-bottom: 1rem;
    border-radius: .25rem;
    animation: fadeOut 5s forwards;
    animation-delay: 3s;
}
.message.success {
    background-color: #d4edda;
    border-color: #c3e6cb;
    color: #155724;
}
.message.error {
    background-color: #f8d7da;
    border-color: #f5c6cb;
    color: #721c24;
}
@keyframes fadeOut {
    from {opacity: 1;}
    to {opacity: 0;}
}
</style>

    <!-- REQUIRED SCRIPTS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    <?= $this->fetch('script') ?>
</body>
</html>