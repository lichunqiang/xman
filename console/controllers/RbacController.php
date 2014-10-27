<?php
namespace console\controllers;

use console\rules\AuthorRule;
use Yii;
use yii\console\Controller;

/**
 * create rbac
 *
 * just test for admin and author role based access control
 * rbac/init
 *
 * @author light
 */
class RbacController extends Controller
{
    /**
     * @inheritdoc
     */
    public $defaultAction = 'init';

    /**
     * init
     *
     * to init this
     * @return type
     */
    public function actionInit()
    {

        $auth = Yii::$app->authManager;
        //如果之前生成过，这里需要清除下
        $auth->removeAll();
        //----rules
        //add update post rule
        $rule = new AuthorRule;
        $auth->add($rule);

        //-----permissions
        //add create post permission
        $createPost = $auth->createPermission('createPost');
        $createPost->description = 'Create a post';
        $auth->add($createPost);

        //add update post permission
        $updatePost = $auth->createPermission('updatePost');
        $updatePost->description = 'Update a post';
        $auth->add($updatePost);

        //add the updateOwnPost permission and associate the rule with it
        $updateOwnPost = $auth->createPermission('updateOwnPost');
        $updateOwnPost->description = 'Update own post';
        $updateOwnPost->ruleName = $rule->name;
        $auth->add($updateOwnPost);

        //----roles
        //add author role and give this role the createPost permission
        $author = $auth->createRole('author');
        $auth->add($author);

        //add admin role and give this role the updatePost permission
        //as well as the permission of the author role
        $admin = $auth->createRole('admin');
        $auth->add($admin);

        //----distribute
        $auth->addChild($author, $createPost);

        $auth->addChild($admin, $updatePost);
        $auth->addChild($admin, $author);

        //updateOwnPost will be used from updatePost
        $auth->addChild($updateOwnPost, $updatePost);

        //allow author to update their own posts
        $auth->addChild($author, $updateOwnPost);

        //assign roles to users, 1 and 2 are IDs returned by IndentityInterface::getId()
        //usually implement in your model
        $auth->assign($author, 2);
        $auth->assign($admin, 10000);

        return self::EXIT_CODE_NORMAL;
    }

    /**
     * clear the datas
     * rbac/clear
     *
     */
    public function actionClear()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();
        return 0;
    }

    /**
     * The command "yii example/create test" will call "actionCreate('test')"
     */
    public function actionCreate($name)
    {
        echo $name;
        return 0;
    }

    /**
     * The command "yii example/index city" will call "actionIndex('city', 'name')"
     * The command "yii example/index city id" will call "actionIndex('city', 'id')"
     */
    public function actionIndex($category, $order = 'name')
    {
        echo $category, $order;
        return 0;
    }

    /**
     * The command "yii example/add test" will call "actionAdd(['test'])"
     * The command "yii example/add test1,test2" will call "actionAdd(['test1', 'test2'])"
     */
    public function actionAdd(array $name)
    {
        print_r($name);
        return 0;
    }
}
