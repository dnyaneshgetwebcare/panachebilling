<?php

namespace backend\controllers;

use Yii;
use backend\models\CustomerMaster;
use backend\models\CustomerMasterSearch;
use backend\models\AddressGroup;
use backend\models\BookingHeader;
use backend\models\PaymentMaster;
use backend\models\BookingItem;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
/**
 * CustomerController implements the CRUD actions for CustomerMaster model.
 */
class CustomerController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index','view','create','update','delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all CustomerMaster models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CustomerMasterSearch();
        $searchModel->status='0';
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CustomerMaster model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $booking_ids=BookingHeader::find()->select('booking_id')->where(['customer_id'=>$id]);
        $booking_items=BookingItem::find()->where(['booking_id'=>$booking_ids])->all();
        $payment_historys=PaymentMaster::find()->where(['booking_id'=>$booking_ids])->all();
        return $this->render('view', [
            'model' => $this->findModel($id),
            'booking_items'=>$booking_items,
            'payment_historys'=>$payment_historys,
        ]);
    }

    /**
     * Creates a new CustomerMaster model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CustomerMaster();
        $address_grup=ArrayHelper::map(AddressGroup::find()->all(),'id','name');
        if ($model->load(Yii::$app->request->post())) {
            $model->created_on=$this->dateFormat($model->created_on);
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'address_grup'=>$address_grup,
        ]);
    }

    /**
     * Updates an existing CustomerMaster model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
         $address_grup=ArrayHelper::map(AddressGroup::find()->all(),'id','name');
        if ($model->load(Yii::$app->request->post()) ) {
            $model->created_on=$this->dateFormat($model->created_on);
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'address_grup'=>$address_grup,
        ]);
    }
 public function dateFormat($request_date){
         return ($request_date!='')?date('Y-m-d',strtotime($request_date)):'';
    }
    /**
     * Deletes an existing CustomerMaster model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
       $customer= $this->findModel($id);
       $customer->status=1;
       $customer->save();
        return $this->redirect(['index']);
    }

    /**
     * Finds the CustomerMaster model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CustomerMaster the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CustomerMaster::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
