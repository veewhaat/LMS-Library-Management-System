<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Issued $issued
 * @var array $books
 */
?>
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="issued form content">
            <?= $this->Form->create($issued) ?>
            <fieldset>
                <legend><?= __('Issue New Book') ?></legend>
                <div class="form-group mb-3">
                    <?= $this->Form->label('member', 'Member Name') ?>
                    <?= $this->Form->text('member', [
                        'class' => 'form-control',
                        'required' => true,
                        'placeholder' => 'Enter member name'
                    ]) ?>
                </div>

                <div class="form-group mb-3">
                    <?= $this->Form->label('number', 'Member Number') ?>
                    <?= $this->Form->text('number', [
                        'class' => 'form-control',
                        'required' => true,
                        'placeholder' => 'Enter member number'
                    ]) ?>
                </div>

                <div class="form-group mb-3">
                    <?= $this->Form->label('book_number', 'Book') ?>
                    <?= $this->Form->select('book_number', $books, [
                        'class' => 'form-control',
                        'required' => true,
                        'empty' => 'Select a book'
                    ]) ?>
                </div>

                <div class="form-group mb-3">
                    <?= $this->Form->label('issue_date', 'Issue Date') ?>
                    <?= $this->Form->date('issue_date', [
                        'class' => 'form-control',
                        'required' => true,
                        'value' => date('Y-m-d')
                    ]) ?>
                </div>

                <div class="form-group mb-3">
                    <?= $this->Form->label('due_date', 'Due Date') ?>
                    <?= $this->Form->date('due_date', [
                        'class' => 'form-control',
                        'placeholder' => 'Select due date'
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
.issued.form {
    background: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    margin: 20px auto;
}

.form-group {
    margin-bottom: 1rem;
}

.form-control {
    margin-bottom: 0.5rem;
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