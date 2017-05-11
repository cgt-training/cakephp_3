<!DOCTYPE html>
<html lang="en">
  <head>
       <?= $this->element('head1') ?>
       <title>Admin Home Page</title>
  </head>
  <body>

    <?= $this->element('header') ?>
    <div class="container-fluid">
      <div class="row-fluid">
      <?= $this->element('leftpanel') ?>
            <?= $this->Flash->render() ?>
           <div class="span9" id="content">
                <div class="row-fluid">
                    <?= $this->fetch('content') ?>
                </div>
            </div>
      </div>
    </div>
    <?= $this->element('bottomhead1') ?>
  </body>
</html>