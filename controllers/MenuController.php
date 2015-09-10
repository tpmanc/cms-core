<?php

namespace tpmanc\cmscore\controllers;

use Yii;
use tpmanc\cmscore\models\Menu;
use tpmanc\cmscore\models\Category;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class MenuController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $menu = Menu::getMenuRoot()->children()->all();
        $categories = Category::find()->all();

        return $this->render('index', [
            'menu' => $menu,
            'categories' => $categories,
        ]);
    }

    public function actionNewElement()
    {
        $this->checkRoot();
        Yii::$app->response->format = Response::FORMAT_JSON;
        if (Yii::$app->request->isAjax) {
            $menuItems = $this->getAllElements();
            return [
                'menuItems' => $menuItems,
            ];
        } else {
            throw new NotFoundHttpException('Not Found');
        }
    }

    public function actionGetCategories()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $options = '';
        $categories = Category::find()->where(['isDisabled' => Category::IS_ENABLED])->all();
        foreach ($categories as $category) {
            $options .= "<option value='{$category->id}'>{$category->title}</option>";
        }
        return [
            'categories' => $options
        ];
    }

    private function checkRoot()
    {
        $root = Menu::getMenuRoot();
        if ($root === null) {
            $fields = [
                'name' => 'Menu Root',
                'link' => '',
                'isCategory' => 0,
                'categoryId' => 0,
            ];
            $elem = new Menu($fields);
            $elem->makeRoot();
        }
    }
}
