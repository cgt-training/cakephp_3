<?php
/**
  * @var \App\View\AppView $this
  */
?>
<div class="branches view large-11 medium-10 columns content">
    <h3><?= h($branch->branch_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Branch') ?></th>
            <td><?= $branch->has('branch') ? $this->Html->link($branch->branch->branch_id, ['controller' => 'Branches', 'action' => 'view', $branch->branch->branch_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Company') ?></th>
            <td><?= $branch->has('company') ? $this->Html->link($branch->company->Company_id, ['controller' => 'Companies', 'action' => 'view', $branch->company->Company_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Branch Name') ?></th>
            <td><?= h($branch->branch_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Branch Created') ?></th>
            <td><?= h($branch->branch_created) ?></td>
        </tr>
    </table>
</div>
