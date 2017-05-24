<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Company'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="companies index large-9 medium-8 columns content">
 <?= $this->Flash->render() ?>
    <h3><?= __('Companies') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('Company_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Company_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Company_email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Company_address') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Company_profile') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($companies as $company): ?>
            <tr>
                <td><?= $company->has('company') ? $this->Html->link($company->company->Company_id, ['controller' => 'Companies', 'action' => 'view', $company->company->Company_id]) : '' ?></td>
                <td><?= h($company->Company_name) ?></td>
                <td><?= h($company->Company_email) ?></td>
                <td><?= h($company->Company_address) ?></td>
                <td><?= h($company->Company_profile) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $company->Company_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $company->Company_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $company->Company_id], ['confirm' => __('Are you sure you want to delete # {0}?', $company->Company_id)]) ?>
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
