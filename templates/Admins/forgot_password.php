<?php
/**
 * @var \App\View\AppView $this
 */
?>
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3 class="text-center mb-0">Reset Password</h3>
                <p class="text-center mb-0 mt-2">Enter your email address</p>
            </div>
            <div class="card-body">
                <?= $this->Form->create() ?>
                <div class="form-group mb-3">
                    <?= $this->Form->control('email', [
                        'class' => 'form-control',
                        'placeholder' => 'Enter your registered email',
                        'label' => 'Email Address',
                        'type' => 'email',
                        'required' => true
                    ]) ?>
                </div>
                <?= $this->Form->button('Send Reset Link', [
                    'class' => 'btn btn-primary btn-block w-100 mb-3'
                ]) ?>
                <?= $this->Form->end() ?>
                
                <div class="text-center">
                    <p class="mb-0">
                        Remember your password? 
                        <?= $this->Html->link('Login here', ['action' => 'login'], ['class' => 'text-primary']) ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>