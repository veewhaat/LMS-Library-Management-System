<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Returned $returned
 */
?>
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="returned form content">
            <?= $this->Form->create($returned) ?>
            <fieldset>
                <legend><?= __('Edit Return Record') ?></legend>

                <div class="form-group mb-3">
                    <?= $this->Form->label('return_date', 'Return Date') ?>
                    <?= $this->Form->date('return_date', [
                        'class' => 'form-control',
                        'required' => true
                    ]) ?>
                </div>

                <div class="form-group mb-3">
                    <?= $this->Form->label('fine', 'Fine Amount') ?>
                    <?= $this->Form->number('fine', [
                        'class' => 'form-control',
                        'step' => '0.01',
                        'min' => '0'
                    ]) ?>
                </div>

                <div class="form-group mb-3">
                    <?= $this->Form->label('status', 'Status') ?>
                    <?= $this->Form->select('status', 
                        ['Pending' => 'Pending', 'Cleared' => 'Cleared'],
                        ['class' => 'form-control', 'required' => true]
                    ) ?>
                </div>

                <!-- Display other fields as read-only -->
                <div class="form-group mb-3">
                    <?= $this->Form->label('book_title', 'Book Title') ?>
                    <?= $this->Form->text('book_title', ['class' => 'form-control', 'readonly' => true]) ?>
                </div>

                <div class="form-group mb-3">
                    <?= $this->Form->label('member', 'Member Name') ?>
                    <?= $this->Form->text('member', ['class' => 'form-control', 'readonly' => true]) ?>
                </div>

                <div class="form-group mb-3">
                    <?= $this->Form->label('issue_date', 'Issue Date') ?>
                    <?= $this->Form->text('issue_date', [
                        'class' => 'form-control', 
                        'readonly' => true,
                        'value' => $returned->issue_date->format('Y-m-d')
                    ]) ?>
                </div>

                <div class="form-group mb-3">
                    <?= $this->Form->label('due_date', 'Due Date') ?>
                    <?= $this->Form->text('due_date', [
                        'class' => 'form-control', 
                        'readonly' => true,
                        'value' => $returned->due_date->format('Y-m-d')
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
</style>