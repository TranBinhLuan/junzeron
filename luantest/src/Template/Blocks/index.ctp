<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Block'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Block Regions'), ['controller' => 'BlockRegions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Block Region'), ['controller' => 'BlockRegions', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Roles'), ['controller' => 'Roles', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Role'), ['controller' => 'Roles', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="blocks index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('copy_id') ?></th>
            <th><?= $this->Paginator->sort('handler') ?></th>
            <th><?= $this->Paginator->sort('title') ?></th>
            <th><?= $this->Paginator->sort('description') ?></th>
            <th><?= $this->Paginator->sort('visibility') ?></th>
            <th><?= $this->Paginator->sort('status') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($blocks as $block): ?>
        <tr>
            <td><?= $this->Number->format($block->id) ?></td>
            <td><?= $this->Number->format($block->copy_id) ?></td>
            <td><?= h($block->handler) ?></td>
            <td><?= h($block->title) ?></td>
            <td><?= h($block->description) ?></td>
            <td><?= h($block->visibility) ?></td>
            <td><?= h($block->status) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $block->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $block->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $block->id], ['confirm' => __('Are you sure you want to delete # {0}?', $block->id)]) ?>
            </td>
        </tr>

    <?php endforeach; ?>
    </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
