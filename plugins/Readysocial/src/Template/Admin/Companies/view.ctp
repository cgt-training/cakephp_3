<?php
/**
  * @var \App\View\AppView $this
  */
?>
<div class="companies view large-11 medium-10 columns content">
    <h3><?= h($company->Company_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Company') ?></th>
            <td><?= $company->has('company') ? $this->Html->link($company->company->Company_id, ['controller' => 'Companies', 'action' => 'view', $company->company->Company_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Company Name') ?></th>
            <td><?= h($company->Company_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Company Email') ?></th>
            <td><?= h($company->Company_email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Company Address') ?></th>
            <td><?= h($company->Company_address) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Company Profile') ?></th>
            <td><?= h($company->Company_profile) ?></td>
        </tr>
    </table>
</div>
