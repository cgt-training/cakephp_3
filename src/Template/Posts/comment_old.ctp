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
    $username = $this->request->session()->read('Auth.User.username');
     //
    foreach ($result as $row) { 
         // print_r($username == $row->user_id);exit;
       
    ?>
    <div class="commdiv">
        <div class="row">
        <div class="col-md-10 heading1"><?php echo $row->user_id; ?></div>
        <div class="col-md-2 pull-right">
           <?php if($username == $row->user_id){
                   ?><?php echo $this->Form->postLink(__('Delete'), ['controller' => 'Comments','action' => 'delete',$row->id,$post->id], ['confirm' => __('Are you sure you want to delete # {0}?', $row->id)]); ?>
             <?php  }
               else{ ?>
                    <?php echo $this->Form->postLink(__('Delete'),['controller' => 'Posts','action' => 'comment',$post->id], ['error' => __('You are not authorised to delete')]); ?>
             <?php   }
           ?>
           
             <!-- <a href="<?php // echo $this->Url->build([ 'controller' => 'Comments', 'action' => 'index','id'=>'commeditid',$row->id,$post->id]);?>">Edit</a> -->
             <div id='commeditid'>Edit</div>
        </div>
    </div>
    <div class="date"><?php echo $row->created; ?></div>
    <div class="comments"><?php echo $row->comment; ?></div>            
    </div>
<?php } unset($row);?>

    <?= $this->Form->create($comment,['id'=>'commaddform']) ?>
    <fieldset>
        <legend><?= __('Add Comment') ?></legend>
        <?php
            echo $this->Form->textarea('comment');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'),['id'=>'commsubmit']) ?>
    <?= $this->Form->end() ?>
</div>
<!-- <i class="fa fa-trash-o social1" aria-hidden="true"></i> -->
<!-- <i class="fa fa-pencil-square-o social1"></i> -->
