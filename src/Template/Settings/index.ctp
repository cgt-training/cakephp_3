<h1>Themes Options</h1>
<?php //print_r($post);
    echo $this->Form->create($post,['id' => 'submittheme']);
?>
    <div class="col-lg-12 select_button">
    <?php 
    echo $this->Form->input('name', array(
        'label' => 'Change Theme',
        'options' => array(1 => 'Default', 2 => 'Readystate'),
        'values' => array(1,2),
        'empty' => '(choose one)',
        'id' => 'themeschange'
        ));
    ?>
    </div>
    <div class="col-lg-12 select_button">
    <?php 
    echo $this->Form->input('language', array(
       'label' => 'Change language',
       'options' => array('en_FR' => 'French', 'en_US' => 'English', 'en_HI' => 'Hindi'),
       'values' => array(1,2,3),
       'empty' => '(choose one)',
       'id' => 'themeschange'
    ));
    ?>
    </div>
<?php 
    echo $this->Form->button(__('Save Theme'));
    echo $this->Form->end();
?>
<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('change','#themeschange',function(){
          $( "#submittheme" ).submit();
        });
    });
</script>