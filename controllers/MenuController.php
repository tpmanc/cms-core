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
        // $menu = Menu::find()->orderBy(['lft' => SORT_ASC])->all();
        $menu = $this->getMenuRoot()->children()->all();
        $categories = Category::find()->all();

        return $this->render('index', [
            'menu' => $menu,
            'categories' => $categories,
        ]);
    }

    public function actionSaveElement()
    {
        $this->checkRoot();
        Yii::$app->response->format = Response::FORMAT_JSON;
        if (Yii::$app->request->isAjax) {
            if (empty(Yii::$app->request->post())) {
                return [
                    'error' => true,
                    'msg' => 'bad request',
                ];
            }
            $post = Yii::$app->request->post();
            $parentId = $post['parentId'];
            $name = $post['name'];
            $link = $post['link'];
            $isCategory = $post['isCategory'];
            $categoryId = $post['categoryId'];
            if ($post['elementId'] == 0) {
                if ($isCategory == 1) {
                    $fields = [
                        'name' => $name,
                        'link' => '',
                        'isCategory' => 1,
                        'categoryId' => $categoryId,
                    ];
                } else {
                    $fields = [
                        'name' => $name,
                        'link' => $link,
                        'isCategory' => 0,
                        'categoryId' => 0
                    ];
                }
                if ($parentId == 0) {
                    $root = $this->getMenuRoot();
                    $elem = new Menu($fields);
                    $elem->appendTo($root);
                } else {
                    $parent = Menu::findOne(['id' => $parentId]);
                    $elem = new Menu($fields);
                    $elem->appendTo($parent);
                }
            } else {
                $elem = Menu::findOne(['id' => $post['elementId']]);
                if ($elem === null) {
                    return ['error' => true];
                }
                $elem->name = $name;
                $elem->link = $link;
                $elem->isCategory = $isCategory;
                $elem->categoryId = $categoryId;
                $elem->save();
                // sorting
                $first = Menu::findOne(['id' => $post['sorting'][0]]);
                $first->prependTo($elem);
                $count = count($post['sorting']);
                for ($i = 1; $i < $count; $i++) {
                    $sub = Menu::findOne(['id' => $post['sorting'][$i]]);
                    $sub->appendTo($elem);
                }
            }

            // TODO: return new elements
            return [];
        } else {
            throw new NotFoundHttpException('Not Found');
        }
    }

    /**
     * Save root elements sorting
     */
    public function actionRootSorting()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        if (Yii::$app->request->isAjax) {
            if (empty(Yii::$app->request->post())) {
                return [
                    'error' => true,
                    'msg' => 'bad request',
                ];
            }
            $post = Yii::$app->request->post();
            $first = Menu::findOne(['id' => $post['sorting'][0]]);
            $count = count($post['sorting']) - 1;
            for ($i = $count; $i >= 1; $i--) {
                $sub = Menu::findOne(['id' => $post['sorting'][$i]]);
                $sub->insertAfter($first);
            }

            // TODO: return new elements
            return [];
        } else {
            throw new NotFoundHttpException('Not Found');
        }
    }

    /**
     * Edit existing element
     */
    public function actionEditElement()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        if (Yii::$app->request->isAjax) {
            if (empty(Yii::$app->request->post())) {
                return [
                    'error' => true,
                    'msg' => 'bad request',
                ];
            }
            $post = Yii::$app->request->post();
            $menuItems = $this->getAllElements();
            $info = $this->getSubAndCurrentElements($post['itemId']);
            $subElements = $info['children'];
            $current = $info['current'];
            return [
                'current' => $current,
                'menuItems' => $menuItems,
                'subElements' => $subElements,
            ];
        } else {
            throw new NotFoundHttpException('Not Found');
        }
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

    private function getAllElements()
    {
        $root = $this->getMenuRoot();
        $menu = $root->children()->all();
        $menuItems = '<option value="' . $root->id . '">' . Yii::t('core/menu', $root->name) . '</option>';
        foreach ($menu as $elem) {
            $menuItems .= "<option value='{$elem->id}'>" . str_repeat('/..', $elem->depth) . "{$elem->name}</option>";
        }
        return $menuItems;
    }

    private function getSubAndCurrentElements($itemId)
    {
        $res = [];
        $item = Menu::findOne(['id' => $itemId]);
        $parent = $item->parents(1)->one();
        if ($parent === null) {
            $parentId = 0;
        } else {
            $parentId = $parent->id;
        }
        $children = $item->children(1)->all();
        foreach ($children as $c) {
            $res[] = '<div class="element" data-id="'.$c->id.'">'.$c->name.'</div>';
        }
        return [
            'current' => [
                'id' => $item->id,
                'parentId' => $parentId,
                'name' => $item->name,
                'link' => $item->link,
                'isCategory' => $item->isCategory,
                'categoryId' => $item->categoryId,
            ],
            'children' => $res,
        ];
    }

    private function checkRoot()
    {
        $root = $this->getMenuRoot();
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

    private function getMenuRoot()
    {
        return Menu::findOne(['name' => 'Menu Root', 'depth' => 0]);
    }
}
