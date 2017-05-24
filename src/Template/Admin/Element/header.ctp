<div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="#">Admin Panel</a>
                    <div class="nav-collapse collapse">
                        <ul class="nav pull-right">
                            <li class="dropdown">
                            <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"> 
                                <?php if(!empty($this->request->session()->read('Auth.User.user_image'))){ 
                                    echo $this->Html->image('user_img/'.$this->request->session()->read('Auth.User.user_image'),['class' => 'img-responsive img-circle user-image navitem_img','alt'=>'myimage']);
                                     }else{ ?>
                                    <i class="fa fa-user"></i>
                               |<?php }
                                    echo " ".$this->request->session()->read('Auth.User.username');
                               ?>
                               <i class="caret" style="margin-top: 17px;"></i>
                            </a>
                                
                                <ul class="dropdown-menu">
                                    <li>
                                        <?php  echo $this->Html->link(__('Profile'),['controller' => 'Dashboards','action' =>'profile']); ?>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                       <?php  echo $this->Html->link(__('Logout'),['controller' => 'Users','action' =>'logout']); ?>  
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="nav">
                            <li class="active">
                               <?php  echo $this->Html->link(__('Dashboard'),['controller' => 'Dashboards','action' =>'index']); ?>
                            </li>
                            <li class="dropdown">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle">Settings <b class="caret"></b>

                                </a>
                                <ul class="dropdown-menu" id="menu1">
                                    <li>
                                        <?php  echo $this->Html->link(__('Change language'),['controller' => 'Settings','action' =>'index']); ?>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!--/.nav-collapse -->
                </div>
            </div>
        </div>