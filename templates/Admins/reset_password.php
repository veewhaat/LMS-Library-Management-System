<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Admin $admin
 */
?>
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3 class="text-center mb-0">Set New Password</h3>
            </div>
            <div class="card-body">
                <?= $this->Form->create($admin) ?>
                <div class="form-group mb-3">
                    <?= $this->Form->control('password', [
                        'class' => 'form-control',
                        'placeholder' => 'Enter your new password',
                        'label' => 'New Password',
                        'type' => 'password',
                        'required' => true
                    ]) ?>
                </div>
                <div class="form-group mb-3">
                    <?= $this->Form->control('confirm_password', [
                        'class' => 'form-control',
                        'placeholder' => 'Confirm your new password',
                        'label' => 'Confirm Password',
                        'type' => 'password',
                        'required' => true
                    ]) ?>
                </div>
                <?= $this->Form->button('Reset Password', [
                    'class' => 'btn btn-primary btn-block w-100'
                ]) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>