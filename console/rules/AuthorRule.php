<?php
namespace console\rules;

use yii\rbac\Rule;

class AuthorRule extends Rule
{
    public $name = 'isAuthor';

    /**
     * @param string|integer $user the user ID
     * @param Item $item the role or permission that this rule is associated with
     * @param array $params paramters passed to ManagerInterface::checkAccess()
     * @return boolean a value indicating  whether the rule permits the role or permission it is associated with.
     */
    public function execute($user, $item, $params)
    {
        return isset($params['post']) ? $params['post']->createBy == $user : false;
    }
}
