<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $block->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $block->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Blocks'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Block Regions'), ['controller' => 'BlockRegions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Block Region'), ['controller' => 'BlockRegions', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Roles'), ['controller' => 'Roles', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Role'), ['controller' => 'Roles', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="blocks form large-10 medium-9 columns">
    <?= $this->Form->create($block) ?>
    <fieldset>
        <legend><?= __('Edit Block') ?></legend>
        <?php
            echo $this->Form->input('copy_id');
            echo $this->Form->input('handler');
            echo $this->Form->input('title');
            echo $this->Form->input('description');
            echo $this->Form->input('body');
            echo $this->Form->input('visibility');
            echo $this->Form->input('pages');
            echo $this->Form->input('locale');
            echo $this->Form->input('settings');
            echo $this->Form->input('status');
            echo $this->Form->input('roles._ids', ['options' => $roles]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
