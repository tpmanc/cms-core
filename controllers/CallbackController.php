<?php

namespace tpmanc\cmscore\controllers;

use Yii;
use tpmanc\cmscore\models\Order;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class CallbackController extends Controller
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
     * Lists all Order models.
     * @return mixed
     */
    public function actionIndex($status = 'new')
    {
        if ($status === 'accepted') {
            $orders = Order::find()->where(['status' => Order::STATUS_ACCEPTED])->all();
        } elseif ($status === 'canceled') {
            $orders = Order::find()->where(['status' => Order::STATUS_CANCELED])->all();
        } else {
            $orders = Order::find()->where(['status' => Order::STATUS_NEW])->all();
        }

        return $this->render('index', [
            'orders' => $orders,
        ]);
    }

    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    private function getProductsDropDown()
    {
        return ArrayHelper::map(Product::find()->where(['isDisabled' => 0])->asArray()->all(), 'id', 'title');
    }
}
