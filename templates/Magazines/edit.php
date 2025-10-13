<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Magazine $magazine
 */
?>
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="magazines form content">
            <?= $this->Form->create($magazine) ?>
            <fieldset>
                <legend><?= __('Edit Magazine') ?></legend>
                <div class="form-group mb-3">
                    <?= $this->Form->label('type', 'Type') ?>
                    <?= $this->Form->text('type', [
                        'class' => 'form-control',
                        'required' => true
                    ]) ?>
                </div>

                <div class="form-group mb-3">
                    <?= $this->Form->label('name', 'Name') ?>
                    <?= $this->Form->text('name', [
                        'class' => 'form-control',
                        'required' => true
                    ]) ?>
                </div>

                <div class="form-group mb-3">
                    <?= $this->Form->label('date_of_receipt', 'Date of Receipt') ?>
                    <?= $this->Form->date('date_of_receipt', [
                        'class' => 'form-control',
                        'required' => true
                    ]) ?>
                </div>

                <div class="form-group mb-3">
                    <?= $this->Form->label('date_published', 'Date Published') ?>
                    <?= $this->Form->date('date_published', [
                        'class' => 'form-control',
                        'required' => true
                    ]) ?>
                </div>

                <div class="form-group mb-3">
                    <?= $this->Form->label('pages', 'Pages') ?>
                    <?= $this->Form->number('pages', [
                        'class' => 'form-control',
                        'required' => true,
                        'min' => '1'
                    ]) ?>
                </div>

                <div class="form-group mb-3">
                    <?= $this->Form->label('price', 'Price') ?>
                    <?= $this->Form->number('price', [
                        'class' => 'form-control',
                        'required' => true,
                        'step' => '0.01',
                        'min' => '0'
                    ]) ?>
                </div>

                <div class="form-group mb-3">
                    <?= $this->Form->label('publisher', 'Publisher') ?>
                    <?= $this->Form->text('publisher', [
                        'class' => 'form-control',
                        'required' => true
                    ]) ?>
                </div>
            </fieldset>
            <div class="text-center mt-4">
                <?= $this->Form->button(__('Save Changes'), ['class' => 'btn btn-primary']) ?>
                <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-secondary']) ?>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

<style>
/* Same styles as add.php */
.magazines.form {
    background: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    margin: 20px auto;
}

.form-group {
    margin-bottom: 1rem;
}

.form-control:focus {
    border-color: #4e73df;
    box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
}

legend {
    border-bottom: 2px solid #f8f9fa;
    padding-bottom: 10px;
    margin-bottom: 20px;
    color: #2c3e50;
    font-weight: bold;
}

.btn {
    margin: 0 5px;
    padding: 8px 20px;
}

label {
    font-weight: 600;
    color: #4a5568;
}
</style>