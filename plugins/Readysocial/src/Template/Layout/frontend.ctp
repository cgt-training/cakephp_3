<!DOCTYPE html>
<html lang="en">
  <head>
       <?= $this->element('head') ?>
       <title>Ready For Social</title>
  </head>
  <body>
      <?= $this->element('header') ?>
      
      <div class="container clearfix">
          <?= $this->fetch('content') ?>
      </div>
      
      <?= $this->element('footer') ?>
      <?= $this->element('bottomhead') ?>
  </body>
</html>