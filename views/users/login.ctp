
<div class="menu-bar">
    <div class="add">
        <?php echo $this->Html->link(__('<span class="register">create account</span>', true), array('controller' => 'users', 'action' => 'register'), array('escape' => false)); ?>
    </div>
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
