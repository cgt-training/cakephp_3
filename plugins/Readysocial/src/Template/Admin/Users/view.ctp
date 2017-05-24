<?php
/**
  * @var \App\View\AppView $this
  */
?>
<div class="companies view large-11 medium-10 columns content">
    <h3><?= h($user->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= h($user->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User Name') ?></th>
            <td><?= h($user->username) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User Password') ?></th>
            <td><?= h($user->password) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User Created') ?></th>
            <td><?= h($user->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User Modified') ?></th>
            <td><?= h($user->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User role') ?></th>
            <td><?= h($user->role) ?></td>
        </tr>
        <tr>
            <td><?php if(!empty($user->user_image)){ 
                    echo $this->Html->image('user_img/'.$user->user_image); } ?></td>
        </tr>
    </table>
</div>
