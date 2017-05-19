<div class="span3" id="sidebar">
                    <ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">
                        <li class="active">
                            <?php  echo $this->Html->link(__('Dashboard'),['controller' => 'Dashboards','action' =>'index']); ?>
                        </li>
                        <li>
                            <?php  echo $this->Html->link(__('Companies'),['controller' => 'Companies','action' =>'index']); ?>
                        </li>
                        <li>
                            <?php  echo $this->Html->link(__('Branches'),['controller' => 'Branches','action' =>'index']); ?>
                        </li>
                        <li>
                            <?php  echo $this->Html->link(__('Posts'),['controller' => 'Posts','action' =>'index']); ?>
                        </li>
                    </ul>
                </div>