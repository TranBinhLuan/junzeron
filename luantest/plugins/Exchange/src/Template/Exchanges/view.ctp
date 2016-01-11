<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Exchange'), ['action' => 'edit', $exchange->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Exchange'), ['action' => 'delete', $exchange->id], ['confirm' => __('Are you sure you want to delete # {0}?', $exchange->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Exchanges'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Exchange'), ['action' => 'add']) ?> </li>
    </ul>
</div>
<div class="exchanges view large-10 medium-9 columns">
    <h2><?= h($exchange->id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Currency') ?></h6>
            <p><?= h($exchange->currency) ?></p>
            <h6 class="subheader"><?= __('Slug') ?></h6>
            <p><?= h($exchange->slug) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($exchange->id) ?></p>
            <h6 class="subheader"><?= __('Exchange Type Id') ?></h6>
            <p><?= $this->Number->format($exchange->exchange_type_id) ?></p>
            <h6 class="subheader"><?= __('Cur Buy') ?></h6>
            <p><?= $this->Number->format($exchange->cur_buy) ?></p>
            <h6 class="subheader"><?= __('Cur Sell') ?></h6>
            <p><?= $this->Number->format($exchange->cur_sell) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Created') ?></h6>
            <p><?= h($exchange->created) ?></p>
            <h6 class="subheader"><?= __('Deleted At') ?></h6>
            <p><?= h($exchange->deleted_at) ?></p>
        </div>
    </div>
</div>
