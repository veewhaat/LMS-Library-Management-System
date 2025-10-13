<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Issued[]|\Cake\Collection\CollectionInterface $notReturned
 */
?>
<div class="issued index content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3><?= __('Not Returned Books') ?></h3>
        <?= $this->Html->link(__('Back to All Issues'), ['action' => 'index'], ['class' => 'btn btn-secondary']) ?>
    </div>
    
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('issued_id') ?></th>
                    <th><?= $this->Paginator->sort('member', 'Member Name') ?></th>
                    <th><?= $this->Paginator->sort('number', 'Member Number') ?></th>
                    <th><?= $this->Paginator->sort('book_number') ?></th>
                    <th><?= $this->Paginator->sort('book_title') ?></th>
                    <th><?= $this->Paginator->sort('issue_date') ?></th>
                    <th><?= $this->Paginator->sort('return_date') ?></th>
                    <th><?= $this->Paginator->sort('status') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($notReturned as $issue): ?>
                <tr>
                    <td><?= $this->Number->format($issue->issued_id) ?></td>
                    <td><?= h($issue->member) ?></td>
                    <td><?= h($issue->number) ?></td>
                    <td><?= h($issue->book_number) ?></td>
                    <td><?= h($issue->book_title) ?></td>
                    <td><?= h($issue->issue_date->format('Y-m-d')) ?></td>
                    <td><?= $issue->return_date ? h($issue->return_date->format('Y-m-d')) : '' ?></td>
                    <td>
                        <span class="badge bg-danger">
                            <?= h($issue->status) ?>
                        </span>
                    </td>
                    <td class="actions">
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $issue->issued_id], ['class' => 'btn btn-sm btn-warning']) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $issue->issued_id], [
                            'confirm' => __('Are you sure you want to delete this issue record?'),
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
/* Same styles as index.php */
</style>