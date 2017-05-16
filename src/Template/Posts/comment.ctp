<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Post'), ['action' => 'edit', $post->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Post'), ['action' => 'delete', $post->id], ['confirm' => __('Are you sure you want to delete # {0}?', $post->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Posts'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Post'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="posts view large-9 medium-8 columns content">
<?= $this->Flash->render() ?>

    <h3><?= h($post->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($post->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($post->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($post->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Updated') ?></th>
            <td><?= h($post->updated) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($post->description)); ?>
    </div>

</div>
 
<div class="posts large-9 medium-8 columns content">
<?php
    $userid = $this->request->session()->read('Auth.User.id');
    foreach ($result as $row) { 
        $comment_id =$row->id;
    ?>
    <div class="commdiv">
        <div class="row">
            <div class="col-md-8 heading1"><?php echo $row->user->username; ?></div>
            <div class="col-md-4 pull-right">
               <?php if($userid == $row->user_id){
                       ?><?php echo $this->Form->postLink(__('Delete'), ['controller' => 'Comments','action' => 'delete',$row->id,$post->id],['type' => 'button','class' => 'button cancel'], ['confirm' => __('Are you sure you want to delete # {0}?', $row->id)]); ?>
                 <?php  }
                   else{ ?>
                        <?php echo $this->Form->postLink(__('Delete'),['controller' => 'Posts','action' => 'comment',$post->id],['type' => 'button','class' => 'button cancel'], ['error' => __('You are not authorised to delete')]); ?>
                 <?php   }
               ?>
                <?= $this->Form->button(__('Edit'),['id'=>'commeditid']) ?>
            </div>
        </div>
        <div class="date"><?php echo $row->created; ?></div>
        <div class="comments" id="comments"><?php echo $row->comment; ?></div>  
        <div id="editform" class="commeditid">
           <?php 
                echo $this->Form->create(null, ['url' => ['controller' => 'Comments', 'action' => 'editcomment',$post->id,$row->id]]);
                echo $this->Form->textarea('comment',['id'=>'inputid']);
               
                echo $this->Form->button(__('Submit'),['id'=>'submitedit','class'=>'floatright']);
                echo " "." ";
                echo $this->Form->end() ?>
           <?=  $this->Html->link(__('Cancel'),['controller' => 'Posts','action' => 'comment',$post->id,$comment_id],['type' => 'button','class' => 'button cancel']);
           ?> 
        </div>  
    </div>
<?php } unset($row);?>
    
    <?php echo $this->Form->create(null, ['url' => ['controller' => 'Comments', 'action' => 'add',$post->id]],['id'=>'commaddform']);?>
    <fieldset>
        <legend><?= __('Add Comment') ?></legend>
        <?php
            echo $this->Form->textarea('comment');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'),['id'=>'commsubmit']) ?>
    <?= $this->Form->end() ?>
</div>
