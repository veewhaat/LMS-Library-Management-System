<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Book $book
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Books'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Add Book'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Edit Book'), ['action' => 'edit', $book->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Book'), ['action' => 'delete', $book->id], ['confirm' => __('Are you sure you want to delete # {0}?', $book->id), 'class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="books view content">
            <h3><?= h($book->title) ?></h3>
            <table>
                <tr>
                    <th><?= __('Book No') ?></th>
                    <td><?= h($book->book_no) ?></td>
                </tr>
                <tr>
                    <th><?= __('Title') ?></th>
                    <td><?= h($book->title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Book Type') ?></th>
                    <td><?= h($book->book_type) ?></td>
                </tr>
                <tr>
                    <th><?= __('Author Name') ?></th>
                    <td><?= h($book->author_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Quantity') ?></th>
                    <td><?= $this->Number->format($book->quantity) ?></td>
                </tr>
                <tr>
                    <th><?= __('Purchase Date') ?></th>
                    <td><?= h($book->purchase_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Edition') ?></th>
                    <td><?= h($book->edition) ?></td>
                </tr>
                <tr>
                    <th><?= __('Price') ?></th>
                    <td><?= $this->Number->format($book->price) ?></td>
                </tr>
                <tr>
                    <th><?= __('Pages') ?></th>
                    <td><?= $this->Number->format($book->pages) ?></td>
                </tr>
                <tr>
                    <th><?= __('Publisher') ?></th>
                    <td><?= h($book->publisher) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($book->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($book->modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>