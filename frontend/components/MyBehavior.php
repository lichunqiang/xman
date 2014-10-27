<?php
namespace frontend\components;

use yii\base\Behavior;
use yii\db\ActiveRecord;

class MyBehavior extends Behavior
{
    public $prop1;

    private $_prop2;

    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_VALIDATE => 'beforeValidate'
        ];
    }

    public function beforeValidate()
    {

    }

    public function setProp2($value)
    {
        $this->_prop2 = $value;
    }
    public function getProp2()
    {
        return $this->_prop2;
    }

    public function foo()
    {
        var_dump($this->owner);
    }
}
