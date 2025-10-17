<?php
/**
 * @var \App\View\AppView $this
 * @var string $currentDateTime
 * @var string $currentUser
 */
?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="position-relative">
                <?= $this->Html->image('library.jpg', [
                    'class' => 'img-fluid w-100',
                    'alt' => 'Library Management System',
                    'style' => 'max-height: 400px; object-fit: cover;'
                ]) ?>
                <div class="position-absolute" style="bottom: 0; left: 0; right: 0; background: rgba(0,0,0,0.7); padding: 20px;">
                    <h3 class="text-white mb-0">Welcome to Library Management System</h3>
                    <p class="text-white-50 mb-0">Manage your library efficiently</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3><?= $totalBooks ?></h3>
                <p>Total Books</p>
            </div>
            <div class="icon">
                <i class="fas fa-book"></i>
            </div>
            <?= $this->Html->link('More info <i class="fas fa-arrow-circle-right"></i>', 
                ['controller' => 'Books', 'action' => 'index'],
                ['class' => 'small-box-footer', 'escape' => false]
            ) ?>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3><?= $totalMagazines ?></h3>
                <p>Total Magazines</p>
            </div>
            <div class="icon">
                <i class="fas fa-newspaper"></i>
            </div>
            <?= $this->Html->link('More info <i class="fas fa-arrow-circle-right"></i>', 
                ['controller' => 'Magazines', 'action' => 'index'],
                ['class' => 'small-box-footer', 'escape' => false]
            ) ?>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3><?= $totalNewspapers ?></h3>
                <p>Total Newspapers</p>
            </div>
            <div class="icon">
                <i class="fas fa-newspaper"></i>
            </div>
            <?= $this->Html->link('More info <i class="fas fa-arrow-circle-right"></i>', 
                ['controller' => 'Newspapers', 'action' => 'index'],
                ['class' => 'small-box-footer', 'escape' => false]
            ) ?>
        </div>
    </div>
    <!-- ./col -->
</div>
<!-- /.row -->

<!-- Second row -->
<div class="row">
    <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-primary">
            <div class="inner">
                <h3><?= $totalIssued ?></h3>
                <p>Currently Issued</p>
            </div>
            <div class="icon">
                <i class="fas fa-hand-holding"></i>
            </div>
            <?= $this->Html->link('More info <i class="fas fa-arrow-circle-right"></i>', 
                ['controller' => 'Issued', 'action' => 'index'],
                ['class' => 'small-box-footer', 'escape' => false]
            ) ?>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3><?= $totalReturned ?></h3>
                <p>Returned (Cleared)</p>
            </div>
            <div class="icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <?= $this->Html->link('More info <i class="fas fa-arrow-circle-right"></i>', 
                ['controller' => 'Returned', 'action' => 'index'],
                ['class' => 'small-box-footer', 'escape' => false]
            ) ?>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3><?= $notReturned ?></h3>
                <p>Not Returned</p>
            </div>
            <div class="icon">
                <i class="fas fa-exclamation-circle"></i>
            </div>
            <?= $this->Html->link('More info <i class="fas fa-arrow-circle-right"></i>', 
                ['controller' => 'Issued', 'action' => 'index'],
                ['class' => 'small-box-footer', 'escape' => false]
            ) ?>
        </div>
    </div>
    <!-- ./col -->
</div>
<!-- /.row -->