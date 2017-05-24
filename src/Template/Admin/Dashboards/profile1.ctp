<?php
/**
  * @var \App\View\AppView $this
  */
?>
<h2 class="h2class">Dashboard</h2>
<div class="row-fluid">
    <div class="block">
            <div class="navbar navbar-inner block-header">
                <div class="muted pull-left">Profile</div>
            </div>
          
            <div class="large-5 medium-6 block-content collapse in ">
                <?php 
                              echo $this->Html->image('user_img/'.$user->user_image,['class' => 'img-thumbnail']);?>
            </div>
                 <div class="large-11 medium-11 block-content collapse in ">
                <!-- form start -->
                     <table class="vertical-table col-md-6">
                        <tr>
                            <th scope="row"><?= __('Name') ?></th>
                            <td><?= h($user->username) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Email') ?></th>
                            <td><?= h($user->username) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Number') ?></th>
                            <td><?= h($user->username) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Address') ?></th>
                            <td><?= h($user->username) ?></td>
                        </tr>

                     </table>
                     <?= $this->Html->link(__('Edit'), ['action' => 'editprofile', $user->id]) ?>
                </div>
                
    </div>
</div>