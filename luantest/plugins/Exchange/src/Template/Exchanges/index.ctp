<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Exchange'), ['action' => 'add']) ?></li>
    </ul>
</div>
<div class="exchanges index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('exchange_type_id') ?></th>
            <th><?= $this->Paginator->sort('currency') ?></th>
            <th><?= $this->Paginator->sort('cur_buy') ?></th>
            <th><?= $this->Paginator->sort('cur_sell') ?></th>
            <th><?= $this->Paginator->sort('slug') ?></th>
            <th><?= $this->Paginator->sort('created') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($exchanges as $exchange): ?>
        <tr>
            <td><?= $this->Number->format($exchange->id) ?></td>
            <td><?= $this->Number->format($exchange->exchange_type_id) ?></td>
            <td><?= h($exchange->currency) ?></td>
            <td><?= $this->Number->format($exchange->cur_buy) ?></td>
            <td><?= $this->Number->format($exchange->cur_sell) ?></td>
            <td><?= h($exchange->slug) ?></td>
            <td><?= h($exchange->created) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $exchange->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $exchange->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $exchange->id], ['confirm' => __('Are you sure you want to delete # {0}?', $exchange->id)]) ?>
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
