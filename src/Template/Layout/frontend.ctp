<!DOCTYPE html>
<html lang="en">
  <head>
       <?= $this->element('head') ?>
  </head>
  <body>

    <?= $this->element('header') ?>
    <?= $this->Flash->render() ?>
    <div class="container clearfix">
        <?= $this->fetch('content') ?>
    </div>
    <?= $this->element('footer') ?>
    <?= $this->element('bottomhead') ?>
  </body>
</html>