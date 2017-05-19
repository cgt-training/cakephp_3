<?php
// src/Model/Table/PostsTable.php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class ThemesTable extends Table
{
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');
        
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->notEmpty('name');

        return $validator;
    }
     public function findTheme(Query $query,array $options)
    { 
       
        return $query->where(['id' => $options['id']]);
    }
}