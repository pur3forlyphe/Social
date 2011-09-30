<div class="layout">
	<div class="menu-bar">				
		<div class="add">
                    <?php echo $this->Html->link(__('<span class="post">+</span>', true), array('controller' => 'topics', 'action' => 'add'), array('escape' => false)); ?>
                </div>
	</div>
	
	<div class="cpanel">			
	<form>

                <?php 
                
                    echo $form->input("Search", array('controller' => 'posts', 'action' => 'search', 'value' => 'Search', 'onblur' => 'if(this.value=="")this.value=this.defaultValue;', 'onfocus' => 'if(this.value==this.defaultValue)this.value="";', 'label' => false), array('escape' => false)); 
                    echo $form->submit("Search", array('class' => 'blue'));
                
                ?>
	</form>
		<div class="topic">
            <ul>
                    <?php foreach ($topics as $topic): ?>
				 <li>				
				 		
					<div class="mini-icons">
                      <div class="icon vote"> <?php echo $this->Html->link(__(' ', true ), array('controller' => 'vote', 'action' => 'vote'), array('escape' => false)); ?> </div>
					</div>
                        
                    <div class="topic-title"><?php echo $this->Html->link(__($topic['Topic']['title'], true).'</p>', array('controller' => 'topics', 'action' => 'view', $topic['Topic']['id']), array('escape' => false), false); ?> </div>
					<p class="information"> 
						<?php echo $topic['Topic']['description']; ?>
					</p>
					
				</li>
                   <?php endforeach; ?>
			</ul>
		</div>
	
	</div>
</div>