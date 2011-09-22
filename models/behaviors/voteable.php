<?php

class VoteableBehavior extends ModelBehavior {
    
    function beforeSave(&$Model) {
        $this->unbindModel(array(
            'belongsTo' => array('Vote')
        ));

        $this->bindModel(array(
                'hasOne' => array(
                    'Vote' =>array(
                        'foreignKey' => 'parent_id'
                    )
                )
        ));
    }
    
}