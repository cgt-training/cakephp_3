<nav class="navbar navbar-default">
<div class="head">
  <div class="container">
  <div class="col-md-4">
       <div class="logo"><?php echo $this->Html->image('logo.png',['url' => ['controller' => 'Forms', 'action' => 'index']]); ?></div>
  </div>
  <div class="col-md-8">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <div class="nav1">
      <ul class="nav navbar-nav pull-right">
        <li class="navitem"><?php echo $this->Html->link(
            'Posts',
            array(
                'controller' => 'Posts',
                'action' => 'index',
                'full_base' => true
            )
        ); ?></li>
        <li>
                  <?php
                        echo $this->Html->link(__('Blog'),['controller' => 'Blogs','action' =>'index']);
                  ?>
        </li>
        <li class="navitem">
            <?php
                  echo $this->Html->link(__('Theme Change'),['controller' => 'Settings','action' =>'index']);
            ?>
        </li>
        <?php 
          if($this->request->session()->read('Auth.User.username')){
         ?>    
             <li class="navitem">
               <?php
                  echo $this->Html->link(__('Logout'),['controller' => 'Users','action' =>'logout']);
               ?>   
              </li>

              <li class="navitem3" style="color:#FF8C00;font-size: 14px;">
               <?php
                  echo 'Welcome '.$this->request->session()->read('Auth.User.username');
               ?>   
              </li>
             
             <li><?php if(!empty($product->user_image)){
                        echo $this->Html->image('user_img/'.$this->request->session()->read('Auth.User.user_image'));}?>
              </li> 
          <?php    
            }else{
          ?>
            <li class="navitem">
              <?php 
                echo $this->Html->link(__('Login'),['controller' => 'Users','action' =>'Login']);
              ?>
            </li>
            <li class="navitem">
              <?php 
                echo $this->Html->link(__('Sign up'),['controller' => 'Users','action' =>'add']);
              ?>
            </li>
          <?php    
          }
          ?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div>
  </div><!-- /.container-fluid -->
</div><!-- /.head -->
</nav>
<div class="background1">
</div>
