<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Book[]|\Cake\Collection\CollectionInterface $books
 */
?>
<div class="books index content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3><?= __('Books') ?></h3>
        <?= $this->Html->link(__('Add New Book'), ['action' => 'add'], ['class' => 'btn btn-primary']) ?>
    </div>
    
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('isbn', 'ISBN No') ?></th>
                    <th><?= $this->Paginator->sort('title', 'Book Title') ?></th>
                    <th><?= $this->Paginator->sort('book_type', 'Book Type') ?></th>
                    <th><?= $this->Paginator->sort('author_name', 'Author Name') ?></th>
                    <th><?= $this->Paginator->sort('quantity', 'Quantity') ?></th>
                    <th><?= $this->Paginator->sort('purchase_date', 'Purchase Date') ?></th>
                    <th><?= $this->Paginator->sort('edition', 'Edition') ?></th>
                    <th><?= $this->Paginator->sort('price', 'Price') ?></th>
                    <th><?= $this->Paginator->sort('pages', 'Pages') ?></th>
                    <th><?= $this->Paginator->sort('publisher', 'Publisher') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($books as $book): ?>
                <tr>
                    <td><?= h($book->isbn) ?></td>
                    <td><?= h($book->title) ?></td>
                    <td><?= h($book->book_type) ?></td>
                    <td><?= h($book->author_name) ?></td>
                    <td><?= $this->Number->format($book->quantity) ?></td>
                    <td><?= h($book->purchase_date->format('Y-m-d')) ?></td>
                    <td><?= h($book->edition) ?></td>
                    <td><?= $this->Number->currency($book->price) ?></td>
                    <td><?= $this->Number->format($book->pages) ?></td>
                    <td><?= h($book->publisher) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $book->isbn], ['class' => 'btn btn-sm btn-warning']) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $book->isbn], [
                            'confirm' => __('Are you sure you want to delete this book: {0}?', $book->title),
                            'class' => 'btn btn-sm btn-danger'
                        ]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('First')) ?>
            <?= $this->Paginator->prev('< ' . __('Previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('Next') . ' >') ?>
            <?= $this->Paginator->last(__('Last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>

<style>
.books.index {
    padding: 24px;
}

.table {
    background: white;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.table th {
    background: #f8f9fa;
}

.actions .btn {
    margin-right: 10px;
}

.paginator {
    text-align: center;
    padding: 20px 0;
}

.pagination {
    justify-content: center;
    margin-bottom: 10px;
}

.pagination li {
    margin: 0 2px;
}
</style>