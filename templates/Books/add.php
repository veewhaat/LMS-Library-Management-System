<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Book $book
 */
?>
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="books form content">
            <?= $this->Form->create($book) ?>
            <fieldset>
                <legend><?= __('Add New Book') ?></legend>
                <div class="form-group mb-3">
                    <?= $this->Form->label('isbn', 'ISBN No') ?>
                    <?= $this->Form->text('isbn', [
                        'class' => 'form-control',
                        'required' => true,
                        'maxlength' => '13',
                        'minlength' => '13',
                        'pattern' => '[0-9]{13}',
                        'title' => 'Please enter exactly 13 digits',
                        'placeholder' => 'Enter 13-digit ISBN number'
                    ]) ?>
                    <?php if ($this->Form->isFieldError('isbn')): ?>
                        <div class="error-message"><?= $this->Form->error('isbn') ?></div>
                    <?php endif; ?>
                </div>

                <div class="form-group mb-3">
                    <?= $this->Form->label('title', 'Book Title') ?>
                    <?= $this->Form->text('title', [
                        'class' => 'form-control',
                        'required' => true,
                        'placeholder' => 'Enter book title'
                    ]) ?>
                </div>

                <div class="form-group mb-3">
                    <?= $this->Form->label('book_type', 'Book Type') ?>
                    <?= $this->Form->text('book_type', [
                        'class' => 'form-control',
                        'required' => true,
                        'placeholder' => 'Enter book type'
                    ]) ?>
                </div>

                <div class="form-group mb-3">
                    <?= $this->Form->label('author_name', 'Author Name') ?>
                    <?= $this->Form->text('author_name', [
                        'class' => 'form-control',
                        'required' => true,
                        'placeholder' => 'Enter author name'
                    ]) ?>
                </div>

                <div class="form-group mb-3">
                    <?= $this->Form->label('quantity', 'Quantity') ?>
                    <?= $this->Form->number('quantity', [
                        'class' => 'form-control',
                        'min' => '0',
                        'required' => true,
                        'placeholder' => 'Enter quantity'
                    ]) ?>
                </div>

                <div class="form-group mb-3">
                    <?= $this->Form->label('purchase_date', 'Purchase Date') ?>
                    <?= $this->Form->date('purchase_date', [
                        'class' => 'form-control',
                        'required' => true
                    ]) ?>
                </div>

                <div class="form-group mb-3">
                    <?= $this->Form->label('edition', 'Edition') ?>
                    <?= $this->Form->text('edition', [
                        'class' => 'form-control',
                        'placeholder' => 'Enter edition (optional)'
                    ]) ?>
                </div>

                <div class="form-group mb-3">
                    <?= $this->Form->label('price', 'Price') ?>
                    <?= $this->Form->number('price', [
                        'class' => 'form-control',
                        'step' => '0.01',
                        'min' => '0',
                        'required' => true,
                        'placeholder' => 'Enter price'
                    ]) ?>
                </div>

                <div class="form-group mb-3">
                    <?= $this->Form->label('pages', 'Pages') ?>
                    <?= $this->Form->number('pages', [
                        'class' => 'form-control',
                        'min' => '1',
                        'required' => true,
                        'placeholder' => 'Enter number of pages'
                    ]) ?>
                </div>

                <div class="form-group mb-3">
                    <?= $this->Form->label('publisher', 'Publisher') ?>
                    <?= $this->Form->text('publisher', [
                        'class' => 'form-control',
                        'required' => true,
                        'placeholder' => 'Enter publisher name'
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
.books.form {
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

.btn-primary {
    background-color: #4e73df;
    border-color: #4e73df;
}

.btn-primary:hover {
    background-color: #2e59d9;
    border-color: #2e59d9;
}

.error-message {
    color: #e74a3b;
    font-size: 0.875em;
    margin-top: 0.25rem;
}

label {
    font-weight: 600;
    color: #4a5568;
    display: block;
    margin-bottom: 0.5rem;
}

.mb-3 {
    margin-bottom: 1rem !important;
}

.mt-4 {
    margin-top: 1.5rem !important;
}

.text-center {
    text-align: center;
}
</style>