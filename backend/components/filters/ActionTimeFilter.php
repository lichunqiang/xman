<?php
namespace backend\components\filters;

use Yii;
use yii\base\ActionFilter;

/**
 * filter definition
 *
 * @see https://github.com/yiisoft/yii2/blob/master/docs/guide/structure-filters.md
 */
class ActionTimeFilter extends ActionFilter
{
    private $_startTime;

    public function beforeAction($action)
    {
        $this->_startTime = microtime(true);
        return parent::beforeAction($action);
    }

    public function afterAction($action, $result)
    {
        $time = microtime(true) - $this->_startTime;
        Yii::trace("Action '{$action->uniqueId}' spent $time second.");
        return parent::afterAction($action, $result);
    }
}
