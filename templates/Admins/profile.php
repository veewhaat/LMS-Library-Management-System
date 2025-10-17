<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3 class="card-title mb-0"><i class="fas fa-user-circle"></i> My Profile</h3>
            </div>
            <div class="card-body">
                <?= $this->Form->create($admin) ?>
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control" value="<?= h($admin->username) ?>" readonly>
                    <small class="form-text text-muted">Username cannot be changed</small>
                </div>

                <div class="mb-3">
                    <?= $this->Form->control('full_name', [
                        'class' => 'form-control',
                        'label' => ['class' => 'form-label', 'text' => 'Full Name'],
                        'required' => true
                    ]) ?>
                    <?php if ($this->Form->isFieldError('full_name')): ?>
                        <div class="invalid-feedback d-block">
                            <?= $this->Form->error('full_name') ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <?= $this->Form->control('email', [
                        'class' => 'form-control',
                        'type' => 'email',
                        'label' => ['class' => 'form-label', 'text' => 'Email Address'],
                        'required' => true
                    ]) ?>
                    <?php if ($this->Form->isFieldError('email')): ?>
                        <div class="invalid-feedback d-block">
                            <?= $this->Form->error('email') ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="d-grid gap-2">
                    <?= $this->Form->button(__('Save Changes'), [
                        'class' => 'btn btn-primary btn-block'
                    ]) ?>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    margin-top: 20px;
    box-shadow: 0 0 15px rgba(0,0,0,0.1);
}

.card-header {
    padding: 1rem;
}

.card-title {
    font-size: 1.25rem;
}

.form-label {
    font-weight: bold;
}

.btn-block {
    width: 100%;
}

.invalid-feedback {
    display: block;
    color: #dc3545;
    margin-top: 0.25rem;
}
</style>