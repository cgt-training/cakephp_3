<div class="row adminbg">
      <div class="container">
           <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="row margin0">
                      <div class="loginbody">
                      <?= $this->Flash->render() ?>
                           <h1 class="signup">Sign In</h1>
                           <div class="row margin0 margin15">
                              
                              <?= $this->Form->create() ?>
                                    <?php echo $this->Form->input('username',['type'=>'text','class'=>'logininput','placeholder'=>'Enter username']) ?>
                                    <?php echo $this->Form->input('password',['type'=>'password','class'=>'logininput','placeholder'=>'Enter password']) ?>
                                    <?php echo $this->Form->button(__('Login'),['class'=>'btn btn-info buttonclass']) ?>
                              <?= $this->Form->end() ?>
                           </div>
                      </div>
                </div>
           </div>
           <div class="col-md-4"></div>
      </div>
    </div>
 