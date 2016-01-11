<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Block'), ['action' => 'edit', $block->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Block'), ['action' => 'delete', $block->id], ['confirm' => __('Are you sure you want to delete # {0}?', $block->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Blocks'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Block'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Block Regions'), ['controller' => 'BlockRegions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Block Region'), ['controller' => 'BlockRegions', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Roles'), ['controller' => 'Roles', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Role'), ['controller' => 'Roles', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="blocks view large-10 medium-9 columns">
    <h2><?= h($block->title) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Handler') ?></h6>
            <p><?= h($block->handler) ?></p>
            <h6 class="subheader"><?= __('Title') ?></h6>
            <p><?= h($block->title) ?></p>
            <h6 class="subheader"><?= __('Description') ?></h6>
            <p><?= h($block->description) ?></p>
            <h6 class="subheader"><?= __('Visibility') ?></h6>
            <p><?= h($block->visibility) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($block->id) ?></p>
            <h6 class="subheader"><?= __('Copy Id') ?></h6>
            <p><?= $this->Number->format($block->copy_id) ?></p>
        </div>
        <div class="large-2 columns booleans end">
            <h6 class="subheader"><?= __('Status') ?></h6>
            <p><?= $block->status ? __('Yes') : __('No'); ?></p>
        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Body') ?></h6>
            <?= $this->Text->autoParagraph(h($block->body)) ?>
        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Pages') ?></h6>
            <?= $this->Text->autoParagraph(h($block->pages)) ?>
        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Locale') ?></h6>
            <?= $this->Text->autoParagraph(h($block->locale)) ?>
        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Settings') ?></h6>
            <?= $this->Text->autoParagraph(h($block->settings)) ?>
        </div>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Block Regions') ?></h4>
    <?php if (!empty($block->block_regions)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Block Id') ?></th>
            <th><?= __('Theme') ?></th>
            <th><?= __('Region') ?></th>
            <th><?= __('Ordering') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($block->block_regions as $blockRegions): ?>
        <tr>
            <td><?= h($blockRegions->id) ?></td>
            <td><?= h($blockRegions->block_id) ?></td>
            <td><?= h($blockRegions->theme) ?></td>
            <td><?= h($blockRegions->region) ?></td>
            <td><?= h($blockRegions->ordering) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'BlockRegions', 'action' => 'view', $blockRegions->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'BlockRegions', 'action' => 'edit', $blockRegions->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'BlockRegions', 'action' => 'delete', $blockRegions->id], ['confirm' => __('Are you sure you want to delete # {0}?', $blockRegions->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Roles') ?></h4>
    <?php if (!empty($block->roles)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Slug') ?></th>
            <th><?= __('Name') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($block->roles as $roles): ?>
        <tr>
            <td><?= h($roles->id) ?></td>
            <td><?= h($roles->slug) ?></td>
            <td><?= h($roles->name) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Roles', 'action' => 'view', $roles->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Roles', 'action' => 'edit', $roles->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Roles', 'action' => 'delete', $roles->id], ['confirm' => __('Are you sure you want to delete # {0}?', $roles->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
