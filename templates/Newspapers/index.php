<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Newspaper[]|\Cake\Collection\CollectionInterface $newspapers
 */
?>
<div class="newspapers index content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3><?= __('Newspapers') ?></h3>
        <?= $this->Html->link(__('Add New Newspaper'), ['action' => 'add'], ['class' => 'btn btn-primary']) ?>
    </div>
    
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('language') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('date_of_receipt', 'Date of Receipt') ?></th>
                    <th><?= $this->Paginator->sort('date_published', 'Date Published') ?></th>
                    <th><?= $this->Paginator->sort('pages') ?></th>
                    <th><?= $this->Paginator->sort('price') ?></th>
                    <th><?= $this->Paginator->sort('type') ?></th>
                    <th><?= $this->Paginator->sort('publisher') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($newspapers as $newspaper): ?>
                <tr>
                    <td><?= $this->Number->format($newspaper->id) ?></td>
                    <td><?= h($newspaper->language) ?></td>
                    <td><?= h($newspaper->name) ?></td>
                    <td><?= h($newspaper->date_of_receipt->format('Y-m-d')) ?></td>
                    <td><?= h($newspaper->date_published->format('Y-m-d')) ?></td>
                    <td><?= $this->Number->format($newspaper->pages) ?></td>
                    <td><?= $this->Number->currency($newspaper->price) ?></td>
                    <td><?= h($newspaper->type) ?></td>
                    <td><?= h($newspaper->publisher) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $newspaper->id], ['class' => 'btn btn-sm btn-warning']) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $newspaper->id], [
                            'confirm' => __('Are you sure you want to delete this newspaper: {0}?', $newspaper->name),
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
.newspapers.index {
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