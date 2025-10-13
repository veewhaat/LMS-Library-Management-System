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
                <legend><?= __('Edit Book') ?></legend>
                <?php
                    echo $this->Form->control('title', ['class' => 'form-control', 'label' => 'Book Title']);
                    echo $this->Form->control('book_type', ['class' => 'form-control', 'label' => 'Book Type']);
                    echo $this->Form->control('author_name', ['class' => 'form-control', 'label' => 'Author Name']);
                    echo $this->Form->control('quantity', ['class' => 'form-control', 'type' => 'number', 'min' => '0']);
                    echo $this->Form->control('purchase_date', ['class' => 'form-control', 'type' => 'date']);
                    echo $this->Form->control('edition', ['class' => 'form-control']);
                    echo $this->Form->control('price', ['class' => 'form-control', 'step' => '0.01', 'min' => '0']);
                    echo $this->Form->control('pages', ['class' => 'form-control', 'type' => 'number', 'min' => '1']);
                    echo $this->Form->control('publisher', ['class' => 'form-control']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Save Changes'), ['class' => 'btn btn-primary']) ?>
            <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-secondary']) ?>
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
    margin-top: 20px;
}

.form-control {
    margin-bottom: 15px;
}

legend {
    border-bottom: 2px solid #f8f9fa;
    padding-bottom: 10px;
    margin-bottom: 20px;
}

.btn {
    margin-right: 10px;
}
</style>