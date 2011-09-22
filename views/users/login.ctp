
<div class="title">
    <span class="add"><?php echo $this->Html->link(__('create account', true), array('controller' => 'users', 'action' => 'register'), array('class' => 'add user')); ?></span>
</div>
<div class="users-login">
    
    <?php
        
        echo $this->Form->create(array('action' => 'login'));
        echo $this->Form->inputs(array(
                'legend' => false,
                'username' => array('label' => 'Username/Email'),
                'password'
            ));
        echo $this->Form->end(array('label' => 'Login','class' => 'blue'));
    ?>
    
</div>
