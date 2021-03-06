<section class="header-nav">
  <nav class="navbar navbar-default">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <?php echo $this->Html->image('logo1.png',['url' => ['controller' => 'Forms', 'action' => 'index'],'class' => 'navbartop logo-img']); ?>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <div class="nav navbar-nav navbar-right navbar-right-top-margin">
            <ul class="nav navbar-nav navbar-left">
              <li class="navitem">
                  <?php
                        echo $this->Html->link(__('Post'),['controller' => 'Posts','action' =>'index']);
                  ?>
              </li>
              <li class="navitem">
                  <?php
                        echo $this->Html->link(__('Company'),['controller' => 'Companies','action' =>'index']);
                  ?>
              </li>
              <li class="navitem">
                  <?php
                        echo $this->Html->link(__('Branch'),['controller' => 'Branches','action' =>'index']);
                  ?>
              </li>
              <li>
                  <?php
                        echo $this->Html->link(__('Blog'),['controller' => 'Blogs','action' =>'index']);
                  ?>
              </li>
              <li>
                  <?php
                        echo $this->Html->link(__('Theme Change'),['controller' => 'Settings','action' =>'index']);
                  ?>
              </li>
              <?php 
                if($this->request->session()->read('Auth.User.username')){
              ?>    
                   <li>
                     <?php
                        echo $this->Html->link(__('Logout'),['controller' => 'Users','action' =>'logout']);
                     ?>   
                    </li>

                    <li class="navcolor">
                     <?php
                        echo 'Welcome '.$this->request->session()->read('Auth.User.username');
                     ?>   
                    </li>
                    <li /*class="navitem_img"*/ ><?php if(!empty($this->request->session()->read('Auth.User.user_image'))){
                        echo $this->Html->image('user_img/'.$this->request->session()->read('Auth.User.user_image'),['class' => 'img-responsive img-circle user-image navitem_img']);}?>
                    </li>  
              <?php 
                }else{ 
              ?>
              <div class="navbar-form navbar-right">
                  <li class="col-md-5">
                    <?php 
                      echo $this->Html->link(__('Login'),['controller' => 'Users','action' =>'Login'],['class' => 'btn btn-log-in']);
                    ?>
                  </li>
                  <li class="col-md-6">
                    <?php 
                      echo $this->Html->link(__('Sign up'),['controller' => 'Users','action' =>'add'],['class' => 'btn btn-register']);
                    ?>
                  </li>
              </div>
              <?php    
                }
              ?>
            </ul>
          </div>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container -->
  </nav> <!-- navbar navbar-default -->
</section>  <!-- header-nav -->
