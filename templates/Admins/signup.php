<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Admin $admin
 */
?>
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3 class="text-center mb-0">Create Admin Account</h3>
            </div>
            <div class="card-body">
                <?= $this->Form->create($admin) ?>
                <div class="form-group mb-3">
                    <?= $this->Form->control('full_name', [
                        'class' => 'form-control',
                        'placeholder' => 'Enter your full name',
                        'label' => 'Full Name',
                        'required' => true
                    ]) ?>
                </div>
                <div class="form-group mb-3">
                    <?= $this->Form->control('username', [
                        'class' => 'form-control',
                        'placeholder' => 'Choose a username',
                        'label' => 'Username',
                        'required' => true
                    ]) ?>
                </div>
                <div class="form-group mb-3">
                    <?= $this->Form->control('email', [
                        'class' => 'form-control',
                        'placeholder' => 'Enter your email address',
                        'label' => 'Email Address',
                        'type' => 'email',
                        'required' => true
                    ]) ?>
                </div>
                <div class="form-group mb-3">
                    <?= $this->Form->control('password', [
                        'class' => 'form-control',
                        'placeholder' => 'Create a strong password',
                        'label' => 'Password',
                        'type' => 'password',
                        'required' => true
                    ]) ?>
                </div>
                <?= $this->Form->button('Create Admin Account', [
                    'class' => 'btn btn-primary btn-block w-100'
                ]) ?>
                <?= $this->Form->end() ?>
                
                <hr>
                <div class="text-center">
                    <p class="mb-0">Already have an account? 
                        <?= $this->Html->link('Login here', ['action' => 'login'], ['class' => 'text-primary']) ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>