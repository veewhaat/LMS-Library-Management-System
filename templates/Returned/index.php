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

    <!-- Search and Filter Form -->
    <div class="card mb-4">
        <div class="card-body">
            <?= $this->Form->create(null, [
                'type' => 'get',
                'class' => 'row g-3 align-items-end'
            ]) ?>
                <div class="col-md-4">
                    <?= $this->Form->control('search', [
                        'label' => 'Search Returns',
                        'class' => 'form-control',
                        'placeholder' => 'Search by member, book number, or title...',
                        'value' => $this->request->getQuery('search'),
                        'div' => false
                    ]) ?>
                </div>
                <div class="col-md-3">
                    <?= $this->Form->control('status', [
                        'label' => 'Filter by Status',
                        'class' => 'form-control',
                        'empty' => '(All Statuses)',
                        'options' => array_combine($statuses, $statuses),
                        'value' => $this->request->getQuery('status'),
                        'div' => false
                    ]) ?>
                </div>
                <div class="col-md-3">
                    <?= $this->Form->control('date_range', [
                        'label' => 'Date Range',
                        'class' => 'form-control',
                        'type' => 'select',
                        'options' => [
                            'all' => 'All Time',
                            'today' => 'Today',
                            'week' => 'Last 7 Days',
                            'month' => 'Last 30 Days'
                        ],
                        'value' => $this->request->getQuery('date_range', 'all'),
                        'div' => false
                    ]) ?>
                </div>
                <div class="col-md-2">
                    <?= $this->Form->button(__('Search & Filter'), ['class' => 'btn btn-primary me-2']) ?>
                    <?= $this->Html->link(
                        __('Reset'),
                        ['action' => 'index'],
                        ['class' => 'btn btn-secondary']
                    ) ?>
                </div>
            <?= $this->Form->end() ?>
        </div>
    </div>

    <!-- Display search results message if searching -->
    <?php if ($this->request->getQuery('search') || $this->request->getQuery('status') || ($this->request->getQuery('date_range') && $this->request->getQuery('date_range') !== 'all')): ?>
        <div class="alert alert-info">
            <?php
                $criteria = [];
                if ($this->request->getQuery('search')) {
                    $criteria[] = 'search term "' . h($this->request->getQuery('search')) . '"';
                }
                if ($this->request->getQuery('status')) {
                    $criteria[] = 'status "' . h($this->request->getQuery('status')) . '"';
                }
                $dateRange = $this->request->getQuery('date_range');
                if ($dateRange && $dateRange !== 'all') {
                    $ranges = [
                        'today' => 'today',
                        'week' => 'last 7 days',
                        'month' => 'last 30 days'
                    ];
                    if (isset($ranges[$dateRange])) {
                        $criteria[] = 'date range "' . $ranges[$dateRange] . '"';
                    }
                }
                echo !empty($criteria) ? 'Showing results for ' . implode(' and ', $criteria) : '';
            ?>
        </div>
    <?php endif; ?>
    
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

    .card {
    background: white;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    margin-bottom: 1.5rem;
}

.form-control:focus {
    box-shadow: 0 0 0 0.2rem rgba(0,123,255,0.25);
    border-color: #80bdff;
}

.alert {
    margin-bottom: 1rem;
}

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