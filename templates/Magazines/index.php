<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Magazine[]|\Cake\Collection\CollectionInterface $magazines
 */
?>
<div class="magazines index content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3><?= __('Magazines') ?></h3>
        <?= $this->Html->link(__('Add New Magazine'), ['action' => 'add'], ['class' => 'btn btn-primary']) ?>
    </div>
    
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('type', 'Type') ?></th>
                    <th><?= $this->Paginator->sort('name', 'Name') ?></th>
                    <th><?= $this->Paginator->sort('date_of_receipt', 'Date of Receipt') ?></th>
                    <th><?= $this->Paginator->sort('date_published', 'Date Published') ?></th>
                    <th><?= $this->Paginator->sort('pages', 'Pages') ?></th>
                    <th><?= $this->Paginator->sort('price', 'Price') ?></th>
                    <th><?= $this->Paginator->sort('publisher', 'Publisher') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($magazines as $magazine): ?>
                <tr>
                    <td><?= $this->Number->format($magazine->id) ?></td>
                    <td><?= h($magazine->type) ?></td>
                    <td><?= h($magazine->name) ?></td>
                    <td><?= h($magazine->date_of_receipt->format('Y-m-d')) ?></td>
                    <td><?= h($magazine->date_published->format('Y-m-d')) ?></td>
                    <td><?= $this->Number->format($magazine->pages) ?></td>
                    <td><?= $this->Number->currency($magazine->price) ?></td>
                    <td><?= h($magazine->publisher) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $magazine->id], ['class' => 'btn btn-sm btn-warning']) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $magazine->id], [
                            'confirm' => __('Are you sure you want to delete this magazine: {0}?', $magazine->name),
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
.magazines.index {
    padding: 20px;
}

.table {
    background: white;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.table th {
    background: #f8f9fa;
}

.actions .btn {
    margin-right: 5px;
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

.btn-sm {
    padding: .25rem .5rem;
    font-size: .875rem;
}
</style>