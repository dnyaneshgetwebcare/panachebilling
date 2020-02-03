<?php

namespace backend\controllers;

use Yii;
use backend\models\FormulaMaster;
use backend\models\ExpenseFormulaMaster;
use backend\models\CategoryMaster;
use backend\models\ExpsenseCategory;
use backend\models\ReceiverMaster;
use backend\models\FormulaMasterSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;


/**
 * FormulaController implements the CRUD actions for FormulaMaster model.
 */
class FormulaController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all FormulaMaster models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FormulaMasterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FormulaMaster model.
     * @param integer $category_id
     * @param integer $receiver_name
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($category_id, $receiver_name)
    {
        return $this->render('view', [
            'model' => $this->findModel($category_id, $receiver_name),
        ]);
    }

    /**
     * Creates a new FormulaMaster model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
         $model_category =CategoryMaster::find()->all();
         $model_exp_category =ExpsenseCategory::find()->where(['items_status'=>0])->all();
        $model_reciver = ReceiverMaster::find()->all();
        $model = FormulaMaster::find()->all();
        return $this->render('create', [
           
              'model_category'=>$model_category,
              'model_exp_category'=>$model_exp_category,
            'model_reciver'=>$model_reciver,
        ]);
    }

public function actionCalculate()
{
    $model_category =CategoryMaster::find()->all();
        $model_reciver = ReceiverMaster::find()->all();
        $model_exp_category =ExpsenseCategory::find()->where(['items_status'=>0])->all();
        $model = FormulaMaster::find()->all();
        $total_expense=0;
         return $this->render('calculate', [
            //'model' => $model,
             'model_category'=>$model_category,
             'model_exp_category'=>$model_exp_category,
            'model_reciver'=>$model_reciver,
            'total_expense'=>$total_expense,
        ]);
}
public function actionSaveCalculate()
{
    print_r($_POST);
    $model_category =CategoryMaster::find()->all();
        $model_reciver = ReceiverMaster::find()->all();
        $model = FormulaMaster::find()->all();
        $total_expense=0;
         return $this->render('calculate', [
            //'model' => $model,
             'model_category'=>$model_category,
            'model_reciver'=>$model_reciver,
            'total_expense'=>$total_expense,
        ]);
}
    /**
     * Updates an existing FormulaMaster model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $category_id
     * @param integer $receiver_name
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($category_id, $receiver_name)
    {
        //echo "hello";die;
        $model = $this->findModel($category_id, $receiver_name);
        //print_r($model);die;
       
        $model_category = ArrayHelper::map(CategoryMaster::find()->where(['id'=>$category_id])->all(),'id','name');
        $model_reciver = ArrayHelper::map(ReceiverMaster::find()->where(['id'=>$receiver_name])->all(),'id','name');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['create']);
        }

        return $this->renderPartial('update', [
            'model' => $model,
             'model_category'=>$model_category,
            'model_reciver'=>$model_reciver,
        ]);
    }
     public function actionUpdateExpense($category_id, $expnese_cat)
    {
        //echo "hello";die;
        $model = $this->findExpModel($category_id, $expnese_cat);
        //print_r($model);die;
       
        $model_category = ArrayHelper::map(CategoryMaster::find()->where(['id'=>$category_id])->all(),'id','name');
        $model_exp = ArrayHelper::map(ExpsenseCategory::find()->where(['id'=>$expnese_cat])->all(),'id','name');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['create']);
        }

        return $this->renderPartial('update_exp', [
            'model' => $model,
             'model_category'=>$model_category,
            'model_exp'=>$model_exp,
        ]);
    }

    /**
     * Deletes an existing FormulaMaster model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $category_id
     * @param integer $receiver_name
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($category_id, $receiver_name)
    {
        $this->findModel($category_id, $receiver_name)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the FormulaMaster model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $category_id
     * @param integer $receiver_name
     * @return FormulaMaster the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($category_id, $receiver_name)
    {
        if (($model = FormulaMaster::findOne(['category_id' => $category_id, 'receiver_name' => $receiver_name])) !== null) {
            return $model;
        }
      $model = new FormulaMaster();
      $model->category_id=$category_id;
      $model->receiver_name=$receiver_name;
       return $model;
    }
        protected function findExpModel($category_id, $expnese_cat)
    {
        if (($model = ExpenseFormulaMaster::findOne(['category_id' => $category_id, 'expense_category' => $expnese_cat])) !== null) {
            return $model;
        }
      $model = new ExpenseFormulaMaster();
      $model->category_id=$category_id;
      $model->expense_category=$expnese_cat;
       return $model;
    }
}
