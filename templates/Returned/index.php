<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Returned[]|\Cake\Collection\CollectionInterface $returned
 */
?>
<div class="returned index content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3><?= __('Returned Books') ?></h3>
        <?= $this->Html->link(__('Add Return Record'), ['action' => 'add'], ['class' => 'btn btn-primary']) ?>
    </div>
    
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('book_number') ?></th>
                    <th><?= $this->Paginator->sort('book_title') ?></th>
                    <th><?= $this->Paginator->sort('issue_date') ?></th>
                    <th><?= $this->Paginator->sort('due_date') ?></th>
                    <th><?= $this->Paginator->sort('return_date') ?></th>
                    <th><?= $this->Paginator->sort('member') ?></th>
                    <th><?= $this->Paginator->sort('number') ?></th>
                    <th><?= $this->Paginator->sort('fine') ?></th>
                    <th><?= $this->Paginator->sort('status') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($returned as $return): ?>
                <tr>
                    <td><?= $this->Number->format($return->id) ?></td>
                    <td><?= h($return->book_number) ?></td>
                    <td><?= h($return->book_title) ?></td>
                    <td><?= h($return->issue_date->format('Y-m-d')) ?></td>
                    <td><?= h($return->due_date->format('Y-m-d')) ?></td>
                    <td><?= $return->return_date ? h($return->return_date->format('Y-m-d')) : '' ?></td>
                    <td><?= h($return->member) ?></td>
                    <td><?= h($return->number) ?></td>
                    <td><?= $this->Number->currency($return->fine) ?></td>
                    <td>
                        <span class="badge bg-<?= $return->status === 'Pending' ? 'warning' : 'success' ?>">
                            <?= h($return->status) ?>
                        </span>
                    </td>
                    <td class="actions">
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $return->id], ['class' => 'btn btn-sm btn-warning']) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $return->id], [
                            'confirm' => __('Are you sure you want to delete this return record?'),
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
.returned.index {
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

.badge {
    padding: 0.5em 0.8em;
}

.bg-warning {
    background-color: #ffc107 !important;
    color: #000;
}

.bg-success {
    background-color: #28a745 !important;
    color: #fff;
}
</style>