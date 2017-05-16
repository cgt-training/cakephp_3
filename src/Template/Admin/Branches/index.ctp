<?php
/**
  * @var \App\View\AppView $this
  */
?>
<div class="branches index large-12 medium-12 columns content">
    <h3><?= __('Branches') ?></h3><div div class="pull-right"><?= $this->Html->link(__('Add New Branch'), ['action' => 'add']) ?></div>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('branch_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('company_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('company_fk_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('branch_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('branch_created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($branches as $branch): ?>
            <tr>
                <td><?= $branch->has('branch') ? $this->Html->link($branch->branch->branch_id, ['controller' => 'Branches', 'action' => 'view', $branch->branch->branch_id]) : '' ?></td>
                 <td><?= h($branch->company->Company_name) ?></td>
                <td><?= $branch->has('company') ? $this->Html->link($branch->company->Company_id, ['controller' => 'Companies', 'action' => 'view', $branch->company->Company_id]) : '' ?></td>
                <td><?= h($branch->branch_name) ?></td>
                <td><?= h($branch->branch_created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $branch->branch_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $branch->branch_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $branch->branch_id], ['confirm' => __('Are you sure you want to delete # {0}?', $branch->branch_id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
