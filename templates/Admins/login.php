<?php
/**
 * @var \App\View\AppView $this
 */
?>
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3 class="text-center mb-0">Library Management System</h3>
                <p class="text-center mb-0 mt-2">Admin Login</p>
            </div>
            <div class="card-body">
            <?= $this->Form->create() ?>
            <div class="form-group mb-3">
                <?= $this->Form->control('username', [
                    'class' => 'form-control',
                    'placeholder' => 'Enter your username',
                    'label' => 'Username',
                    'required' => true
                ]) ?>
            </div>
            <div class="form-group mb-3">
                <?= $this->Form->control('password', [
                    'class' => 'form-control',
                    'placeholder' => 'Enter your password',
                    'label' => 'Password',
                    'type' => 'password',
                    'required' => true
                ]) ?>
            </div>
                <div class="form-group mb-3">
                    <div class="form-check">
                        <?= $this->Form->checkbox('remember_me', [
                            'class' => 'form-check-input',
                            'id' => 'remember_me'
                        ]) ?>
                        <?= $this->Form->label('remember_me', 'Remember Me', [
                            'class' => 'form-check-label'
                        ]) ?>
                    </div>
                </div>
                <?= $this->Form->button('Login', [
                    'class' => 'btn btn-primary btn-block w-100 mb-3'
                ]) ?>
                <?= $this->Form->end() ?>
                
                <div class="text-center">
                    <p class="mb-2">
                        <?= $this->Html->link('Forgot Password?', ['action' => 'forgotPassword'], ['class' => 'text-muted']) ?>
                    </p>
                    <p class="mb-0">
                        Don't have an account? 
                        <?= $this->Html->link('Create Admin Account', ['action' => 'signup'], ['class' => 'text-primary']) ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>