<?php

namespace tpmanc\cmscore\controllers;

use Yii;
use tpmanc\cmscore\models\Product;
use tpmanc\cmscore\models\ProductCategories;
use tpmanc\cmscore\models\Category;
use tpmanc\cmscore\models\StaticPage;
use tpmanc\cmscore\models\Menu;
use tpmanc\cmscore\models\search\ProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


class FillController extends Controller
{
    public function actionPages()
    {
        $dbh2 = mysql_connect('localhost', 'root', '');
        mysql_select_db('medserdce', $dbh2);
        $q = mysql_query('select * from pages', $dbh2);
        while ($r = mysql_fetch_array($q)) {
            $page = new StaticPage();
            $page->title = $r['title'];
            $page->text = $r['des'];
            $page->seoTitle = $r['seo_title'];
            $page->seoKeywords = $r['seo_key'];
            $page->chpu = $r['chpu'];
            $page->seoDescription = $r['seo_des'];
            $page->save();
        }
    }

    public function actionCats()
    {
        $dbh2 = mysql_connect('localhost', 'root', '');
        mysql_select_db('medserdce', $dbh2);
        $q = mysql_query('select * from cat', $dbh2);
        while ($r = mysql_fetch_array($q)) {
            $c = new Category();
            $c->scenario = 'create';
            $c->title = $r['title'];
            $c->seoTitle = $r['seo_title'];
            $c->seoDescription = $r['seo_des'];
            $c->seoKeywords = $r['seo_key'];
            $c->seoText = $r['seo_text'];
            $chpu = str_replace("'", '', $r['chpu']);
            $chpu = str_replace(" ", '-', $chpu);
            $c->chpu = $chpu;
            $c->productCount = 0;
            $c->position = 0;
            $c->isDisabled = 0;
            $r = $c->save();
            if (!$r) {
                var_dump($c->errors);
                die();
            }
        }
        $q = mysql_query('select * from tags', $dbh2);
        while ($r = mysql_fetch_array($q)) {
            $c = new Category();
            $c->scenario = 'create';
            $c->title = $r['title'];
            $c->seoTitle = $r['seo_title'];
            $c->seoDescription = $r['seo_description'];
            $c->seoKeywords = $r['seo_key'];
            $c->seoText = $r['seo_text'];
            $chpu = str_replace("'", '', $r['chpu']);
            $chpu = str_replace(" ", '-', $chpu);
            $c->chpu = $chpu;
            $c->productCount = 0;
            $c->position = 0;
            $c->isDisabled = 0;
            $r = $c->save();
            if (!$r) {
                var_dump($c->errors);
                die();
            }
        }
    }

    public function actionMenu()
    {
        $dbh2 = mysql_connect('localhost', 'root', '');
        mysql_select_db('medserdce', $dbh2);
        $q = mysql_query('select * from menuleft where pod=0', $dbh2);
        while ($r = mysql_fetch_array($q)) {
            $chpu = str_replace("'", '', $r['chpu']);
            $chpu = str_replace(" ", '-', $chpu);
            $chpu = strtolower($chpu);
            $fields = [
                'name' => $r['title'],
                'link' => $chpu,
                'isCategory' => 0,
                'categoryId' => 0,
            ];
            $rootE = Menu::findOne(['name' => 'Menu Root', 'depth' => 0]);
            $root = new Menu($fields);
            $root->appendTo($rootE);

            $q1 = mysql_query('select menuleft.*, cat.title as cat_title ,
                                tags.title as tag_title
                                from menuleft 
                                LEFT JOIN cat on cat.id=menuleft.cat_id
                                LEFT JOIN tags on tags.id=menuleft.tag_id
                                where menuleft.pod='.$r['id'].' and menuleft.cat_id<>0 order by rang asc', $dbh2);
            while ($r1 = mysql_fetch_array($q1)) {
                if ($r1['tag_title'] == null || $r1['tag_title'] == '') {
                    $c = Category::find()->where(['title' => $r1['cat_title']])->asArray()->one();
                    if ($c !== null) {
                        $fields = [
                            'name' => $r1['title'],
                            'link' => '',
                            'isCategory' => 1,
                            'categoryId' => $c['id'],
                        ];
                        $elem = new Menu($fields);
                        $e = $elem->appendTo($root);
                    }
                } else {
                    $chpu = str_replace("'", '', $r1['chpu']);
                    $chpu = str_replace(" ", '-', $chpu);
                    $chpu = strtolower($chpu);
                    $c = Category::find()->where(['chpu' => $chpu])->asArray()->one();
                    if ($c['id'] !== null) {
                        $fields = [
                            'name' => $r1['title'],
                            'link' => '',
                            'isCategory' => 1,
                            'categoryId' => $c['id'],
                        ];
                        $elem = new Menu($fields);
                        $e = $elem->appendTo($root);
                    }
                }
            }
        }
    }

    public function actionTags()
    {
        $co=0;
        $transaction = Category::getDb()->beginTransaction();
        $dbh2 = mysql_connect('localhost', 'root', '');
        mysql_select_db('medserdce', $dbh2);
        $q = mysql_query('select title, chpu, 
                            (SELECT title from cat where id=cat_id ) as cat_title
                            from tags', $dbh2);
        while ($r = mysql_fetch_array($q)) {
            $c = Category::find()->orWhere(['title' => $r['title'], 'chpu' => $r['chpu']])->one();
            if ($c === null) {
                echo 'pizda ';var_dump($r['title']);
            }
            $parent = Menu::findOne(['name' => $r['cat_title']]);
            if ($parent === null) {
                var_dump($r['cat_title']);
            } else {
                $co++;
                $fields = [
                    'name' => $c->title,
                    'link' => '',
                    'isCategory' => 1,
                    'categoryId' => $c->id,
                ];
                $elem = new Menu($fields);
                $e = $elem->appendTo($parent);
            }
        }
        var_dump($co);
        $transaction->commit();
    }

    public function actionProducts()
    {
        $transaction = Product::getDb()->beginTransaction();
        $dbh2 = mysql_connect('localhost', 'root', '');
        mysql_select_db('medserdce', $dbh2);
        $q = mysql_query('SELECT catalog.*, cat.title as cat_title from catalog 
                            LEFT JOIN cat on cat.id = catalog.cat', $dbh2);
        while ($r = mysql_fetch_array($q)) {
            $c = Category::find()->where(['title' => $r['cat_title']])->one();
            $pr = new Product();
            $chpu = str_replace("'", '', $r['chpu']);
            $chpu = str_replace(" ", '-', $chpu);
            $chpu = str_replace(".", '', $chpu);
            $chpu = str_replace("+", '', $chpu);
            $chpu = strtolower($chpu);
            $pr->title = $r['title'];
            $pr->mainCategory = $c->id;
            $pr->description = $r['des'];
            $pr->shortDescription = '';
            $pr->netCost = $r['net_cost'];
            $pr->price = $r['price_after_discount'];
            $pr->discount = $r['discount_value'];
            $pr->nomenclature = $r['nomencl_10med'];
            $pr->length = $r['length'];
            $pr->width = $r['width'];
            $pr->height = $r['height'];
            $pr->weight = $r['weight'];
            $pr->seoTitle = $r['seo_title'];
            $pr->seoDescription = $r['seo_des'];
            $pr->seoKeywords = $r['seo_key'];
            $pr->chpu = $chpu;
            $pr->fakeInStock = $r['fake_in_stock'];
            $pr->isDisabled = 0;
            $r = $pr->save();
            if (!$r) {
                $transaction->rollBack();
                var_dump($pr->chpu);
                var_dump($pr->errors);
                die();
            }
        }
        $transaction->commit();
    }

    public function actionPacts()
    {
        set_time_limit(0);
        // $transaction = ProductCategories::getDb()->beginTransaction();
        $dbh2 = mysql_connect('localhost', 'root', '');
        mysql_select_db('medserdce', $dbh2);
        $q = mysql_query('select catalog_2_cat.*, catalog.title as pr_title,
                            cat.title as c_title
                            from catalog_2_cat 
                            LEFT JOIN catalog on catalog.id = catalog_2_cat.catalog_id
                            LEFT JOIN cat on cat.id = catalog_2_cat.cat_id', $dbh2);
        $inStr = 'insert into productCategories(productId, categoryId, isMainCategory) values';
        $inArr = [];
        while ($r = mysql_fetch_array($q)) {
            $p = Product::find()->where(['title' => $r['pr_title']])->one();
            $c = Category::find()->where(['title' => $r['c_title']])->one();
            if ($p === null || $c === null) {
                continue;
            }
            $inArr[] = '('.$p->id.', '.$c->id.', 0)';
            // $pr = new ProductCategories();
            // $pr->categoryId = $c->id;
            // $pr->productId = $p->id;
            // $pr->isMainCategory = 0;
            // $r = $pr->save();
            // if (!$r) {
            //     $transaction->rollBack();
            //     var_dump($pr->errors);
            //     die();
            // }
        }
        // $transaction->commit();
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand($inStr . implode(',', $inArr))->execute();
    }
}
