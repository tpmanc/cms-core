<?php

namespace tpmanc\cmscore\controllers;

use Yii;
use yii\filters\AccessControl;
use tpmanc\cmscore\models\Category;
use tpmanc\cmscore\models\Menu;
use tpmanc\cmscore\models\search\CategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'except' => ['login', 'error'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['manager'],
                    ]
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Download CSV file with categories
     * @return Csv file
     */
    public function actionGetCsv()
    {
        $categories = Category::find()->all();
        $filePath = Yii::getAlias('@backend/web/upload/categories.csv');
        $str = '';
        $fields = [
            'Id',
            'Title',
            'Seo Title',
            'Seo Description',
            'Level',
        ];
        $str .= implode(';', $fields) . ';';
        foreach ($categories as $category) {
            $menuItem = Menu::find()->where(['categoryId' => $category->id])->one();
            if ($menuItem === null) {
                $depth = '';
            } else {
                if ($menuItem->depth === 2) {
                    $depth = 'category';
                } elseif ($menuItem->depth === 3) {
                    $depth = 'tag';
                }
            }

            $fields = [
                $category->id,
                $category->title,
                $category->seoTitle,
                $category->seoDescription,
                $depth,
            ];
            $str .= implode(';', $fields) . ';';
        }
        file_put_contents($filePath, $str);
        Yii::$app->response->sendFile($filePath);
        // return $this->redirect(['index']);
    }

    /**
     * Lists all Category models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Category model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Category();
        $model->scenario = 'create';

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Category model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario = 'update';

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Category model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
