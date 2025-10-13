<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Returned $returned
 * @var array $returnedIssues
 */
?>
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="returned form content">
            <?= $this->Form->create($returned) ?>
            <fieldset>
                <legend><?= __('Add Return Record') ?></legend>
                
                <div class="form-group mb-3">
                    <?= $this->Form->label('issued_id', 'Select Returned Book') ?>
                    <?= $this->Form->select('issued_id', $returnedIssues, [
                        'class' => 'form-control',
                        'empty' => 'Select a returned book',
                        'required' => true
                    ]) ?>
                </div>

                <div class="form-group mb-3">
                    <?= $this->Form->label('return_date', 'Return Date') ?>
                    <?= $this->Form->date('return_date', [
                        'class' => 'form-control',
                        'required' => true,
                        'value' => date('Y-m-d')
                    ]) ?>
                </div>

                <div class="form-group mb-3">
                    <?= $this->Form->label('fine', 'Fine Amount') ?>
                    <?= $this->Form->number('fine', [
                        'class' => 'form-control',
                        'step' => '0.01',
                        'min' => '0',
                        'value' => '0.00'
                    ]) ?>
                </div>
            </fieldset>
            <div class="text-center mt-4">
                <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary']) ?>
                <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-secondary']) ?>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

<style>
.returned.form {
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