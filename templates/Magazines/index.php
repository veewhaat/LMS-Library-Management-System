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

    <!-- Search and Filter Form -->
    <div class="card mb-4">
        <div class="card-body">
            <?= $this->Form->create(null, [
                'type' => 'get',
                'class' => 'row g-3 align-items-end'
            ]) ?>
                <div class="col-md-5">
                    <?= $this->Form->control('search', [
                        'label' => 'Search Magazines',
                        'class' => 'form-control',
                        'placeholder' => 'Search by name or publisher...',
                        'value' => $this->request->getQuery('search'),
                        'div' => false
                    ]) ?>
                </div>
                <div class="col-md-4">
                    <?= $this->Form->control('type', [
                        'label' => 'Filter by Type',
                        'class' => 'form-control',
                        'empty' => '(All Types)',
                        'options' => array_combine($magazineTypes, $magazineTypes),
                        'value' => $this->request->getQuery('type'),
                        'div' => false
                    ]) ?>
                </div>
                <div class="col-md-3">
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
    <?php if ($this->request->getQuery('search') || $this->request->getQuery('type')): ?>
        <div class="alert alert-info">
            <?php
                $criteria = [];
                if ($this->request->getQuery('search')) {
                    $criteria[] = 'search term "' . h($this->request->getQuery('search')) . '"';
                }
                if ($this->request->getQuery('type')) {
                    $criteria[] = 'type "' . h($this->request->getQuery('type')) . '"';
                }
                echo 'Showing results for ' . implode(' and ', $criteria);
            ?>
        </div>
    <?php endif; ?>
    
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