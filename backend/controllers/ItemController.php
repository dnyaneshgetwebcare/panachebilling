<?php

namespace backend\controllers;

use backend\models\CategoryMaster;
use backend\models\TypeMaster;
use backend\models\VendorMaster;
use Yii;
use backend\models\ItemMaster;
use backend\models\BookingItem;
use backend\models\ColorMaster;
use backend\models\ItemMasterSearch;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
   use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\filters\AccessControl;
/**
 * ItemController implements the CRUD actions for ItemMaster model.
 */
class ItemController extends Controller
{
    /**
     * {@inheritdoc}
     */
     public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }
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
                        'actions' => ['logout', 'index','view','create','update','delete','vendor-list','get-type','file-upload','upload','remove','create-popup'],
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
    public function actionRemove(){
        
        /*if(!Yii::$app->user->can("create_company")){
            return array('errors'=>array($model_labels->attributeLabels()["NOT_ALLOW_TO_PERFORM_ACTION"]));
        }*/
       
            $rand_no = $_POST['logo'];
            
            
           
            
            $path = realpath(dirname(__FILE__).'/../../img');
            
            
            
           
                if(file_exists($path."\\".$rand_no)){ //If File Exist at the path enter in loop
                    unlink($path."\\".$rand_no); //Delete File
                }
                
      
        
    }
    public function actionUpload(){
        
        /*if(!Yii::$app->user->can("create_company")){
            return array('errors'=>array($model_labels->attributeLabels()["NOT_ALLOW_TO_PERFORM_ACTION"]));
        }*/
        $rand_no = rand(1000, 9999);
        //define('SITE_ROOT', realpath(dirname(__FILE__)));
        $flag = isset($_POST['flag'])?$_POST['flag']:'';
        $path=realpath(dirname(__FILE__).'/../../uploads');
       // print_r($path);
        if((isset($_POST['old_file']) && $_POST['old_file']!='') && file_exists($path."\\".$_POST['old_file'])){
            unlink($path."\\".$_POST['old_file']);
        }
        
        $asset_path=realpath(dirname(__FILE__).'/../../uploads');
        if (!file_exists(Yii::getAlias('@webroot').'/uploads/')) {
              mkdir(Yii::getAlias('@webroot').'/uploads/', 0777, true);
             }
    

        if(file_exists($path."\\".$rand_no)){
            $rand_no = rand(1000, 9999);
        }
         
            if($flag==1){
                
                if(is_array($_FILES)) {
                if(is_uploaded_file($_FILES['file']['tmp_name'])) {
                $id = substr($_FILES['file']['name'], strrpos($_FILES['file']['name'], '.') + 1);
                $sourcePath = $_FILES['file']['tmp_name'];

                $targetPath = $asset_path."\\".$rand_no.'.'.$id;
                // echo move_uploaded_file($sourcePath, $targetPath); die;
                 // echo $targetPath;die;
                if(move_uploaded_file($sourcePath, $targetPath)) {
                    return $rand_no.'.'.$id;
                    //print_r($targetPath);
                   }
                 }
                }
            }else{
                if(is_array($_FILES)) {
                    //echo $_FILES['file']['tmp_name'];die;
                    if(is_uploaded_file($_FILES['file']['tmp_name'])) {
                   $id = substr($_FILES['file']['name'], strrpos($_FILES['file']['name'], '.') + 1);
                   $sourcePath = $_FILES['file']['tmp_name'];

                   $targetPath = $path."/".$rand_no.'.'.$id;
                   
                   if(move_uploaded_file($sourcePath, $targetPath)) {

                    return $rand_no.'.'.$id;
                    
                    }
                  }
                 }
                }       
        }
    /**
     * Lists all ItemMaster models.
     * @return mixed
     */
    public function actionIndex()
    {
        $type_master = ArrayHelper::map(TypeMaster::find()->all(),'id','name');
        $model_category = ArrayHelper::map(CategoryMaster::find()->all(),'id','name');
        $searchModel = new ItemMasterSearch();
        $searchModel->delete_status=0;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
       // $dataProvider->pagination=false;
        $item_summary=ItemMaster::find()->select(['type_id','count(*) total_items'])->where(['scrab_status'=>'No','delete_status'=>0])->groupBy('type_id')->orderBy(['total_items'=>SORT_DESC])->limit(10)->asArray()->all();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'type_master' => $type_master,
            'model_category' => $model_category,
            'dataProvider' => $dataProvider,
            'item_summary'=>$item_summary,
        ]);
    }

    /**
     * Displays a single ItemMaster model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
         $booking_items=BookingItem::find()->where(['product_id'=>$id])->all();
        return $this->render('view', [
            'model' => $this->findModel($id),
            'booking_items'=>$booking_items,
        ]);
    }
public function actionFileUpload($value='')
{
   $target_dir = "uploads/".$_POST['item_id']."/";
   //print_r($_FILES);die;
    $target_file = $target_dir . basename($_FILES["ItemMaster"]["name"]['images'][0]);
    $return_array=array();
   if (file_exists($target_file)) {
       unlink($target_file);
    }
    if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}
    if (move_uploaded_file($_FILES["ItemMaster"]["tmp_name"]['images'][0], $target_file)) {
        $return_array=array();
    } else {
        $return_array=array('error'=>"Sorry, there was an error uploading your file.");
    }
    return json_encode($return_array);
   
}
    /**
     * Creates a new ItemMaster model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
     public function dateFormat($request_date){
         return ($request_date!='')?date('Y-m-d',strtotime($request_date)):'';
    }
    public function actionCreate()
    {
        $model = new ItemMaster();
        $model_category = ArrayHelper::map(CategoryMaster::find()->all(),'id','name');
       // $model_type= ArrayHelper::map(TypeMaster::find()->all(),'id','name');
       
        $model_vendor=ArrayHelper::map(VendorMaster::find()->all(),'id','name');
        $color_model=ArrayHelper::map(ColorMaster::find()->all(),'id','name');
        $model->setScenario('create_new');
        if ($model->load(Yii::$app->request->post())) {
       
            $path=realpath(dirname(__FILE__).'/../../uploads');
            $rand_no = rand(1000, 9999);
          if(file_exists($path."\\".$rand_no)){
            $rand_no = rand(1000, 9999);
        }
        if($_POST["delete_status"]=="1"){
            $model->images= "";
        }
             if(is_array($_FILES)) {
                   
                    if(is_uploaded_file($_FILES['fileToUpload']['tmp_name'])) {
                   $id = substr($_FILES['fileToUpload']['name'], strrpos($_FILES['fileToUpload']['name'], '.') + 1);
                   $sourcePath = $_FILES['fileToUpload']['tmp_name'];

                   $targetPath = $path."/".$rand_no.'.'.$id;
                   
                   if(move_uploaded_file($sourcePath, $targetPath)) {

                    $model->images= $rand_no.'.'.$id;
                    
                    }
                  }
                  //=$targetPath;
                 }
            
              $model->item_code=$model->getNextCode();
              //print_r($model);die;
             $model->purchase_date=$this->dateFormat($model->purchase_date);
            if($model->save()){
            return $this->redirect(['update', 'id' => $model->id]);
        }
        }

        return $this->render('create', [
            'model' => $model,
            'model_category'=>$model_category,
            'model_vendor'=>$model_vendor,
            'color_model'=>$color_model,

            
        ]);
    }

public function actionCreatePopup()
    {
        $model = new ItemMaster();
        $model_category = ArrayHelper::map(CategoryMaster::find()->all(),'id','name');
       // $model_type= ArrayHelper::map(TypeMaster::find()->all(),'id','name');
       
        $model_vendor=ArrayHelper::map(VendorMaster::find()->all(),'id','name');
        $color_model=ArrayHelper::map(ColorMaster::find()->all(),'id','name');
        $id_pass=isset($_POST['id'])?$_POST['id']:null;
        if ($model->load(Yii::$app->request->post())) {

        Yii::$app->response->format = Response::FORMAT_JSON;
        $result= ActiveForm::validate($model);
           $all_validate=array_merge($result);
         if($all_validate!=null){
            //echo "<pre>";print_r( array('errors'=>$all_validate));die;
                return array('errors'=>$all_validate);
           }else{
            $path=realpath(dirname(__FILE__).'/../../uploads');
            $rand_no = rand(1000, 9999);
          if(file_exists($path."\\".$rand_no)){
            $rand_no = rand(1000, 9999);
        }
        if($_POST["delete_status"]=="1"){
            $model->images= "";
        }
             if(is_array($_FILES)) {
                   
               if(is_uploaded_file($_FILES['fileToUpload']['tmp_name'])) {
                   $id = substr($_FILES['fileToUpload']['name'], strrpos($_FILES['fileToUpload']['name'], '.') + 1);
                   $sourcePath = $_FILES['fileToUpload']['tmp_name'];

                   $targetPath = $path."/".$rand_no.'.'.$id;
                   
                   if(move_uploaded_file($sourcePath, $targetPath)) {

                    $model->images= $rand_no.'.'.$id;
                    
                    }
                  }
                  //=$targetPath;
                 }
            
              $model->item_code=$model->getNextCode();
              //print_r($model);die;
             $model->purchase_date=$this->dateFormat($model->purchase_date);
            if($model->save()){
                if($model['images']){ 
             $image_path= Yii::getAlias('@web').'/uploads/'.$model['images'];
           
            
            }else{ 
             $image_path= Yii::getAlias('@web').'/img/no-image.jpg';
             }
            return array(['flag'=>true, 'item_id' => $model->id,'id'=>$id_pass,'item_details'=>$model->name,'item_category'=>$model->category_id,'item_type'=>$model->type_id,'purchase_amount'=>$model->purchase_amount,'img_path'=>$image_path]);
        }else{
            return array(['flag'=>fasle, 'id' => 0]);
        }
    }
        }

        return $this->renderPartial('create_popup', [
            'model' => $model,
            'model_category'=>$model_category,
            'model_vendor'=>$model_vendor,
            'color_model'=>$color_model,
            'id_pass'=>$id_pass,
            
        ]);
    }

public function actionVendorList($q = null) {
    $query = VendorMaster::find()->where('name LIKE "%' . $q .'%"')
        ->orderBy('name');
    $command = $query->createCommand();
    $data = $command->queryAll();
    $out = [];
    foreach ($data as $d) {
        $out[] = ['value' => $d['name']];
    }
    echo Json::encode($out);
}
    /**
     * Updates an existing ItemMaster model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model_category = ArrayHelper::map(CategoryMaster::find()->all(),'id','name');
       // $model_type= ArrayHelper::map(TypeMaster::find()->all(),'id','name');
      $color_model=ArrayHelper::map(ColorMaster::find()->all(),'id','name');
        $model_vendor=ArrayHelper::map(VendorMaster::find()->all(),'id','name');
        if ($model->load(Yii::$app->request->post()) ) {

 $path=realpath(dirname(__FILE__).'/../../uploads');
            $rand_no = rand(1000, 9999);
          if(file_exists($path."\\".$rand_no)){
            $rand_no = rand(1000, 9999);
        }
            if($_POST["delete_status"]=="1"){
                $model->images= "";
            }
             if(is_array($_FILES)) {
                 
                    if(is_uploaded_file($_FILES['fileToUpload']['tmp_name'])) {
                   $id = substr($_FILES['fileToUpload']['name'], strrpos($_FILES['fileToUpload']['name'], '.') + 1);
                   $sourcePath = $_FILES['fileToUpload']['tmp_name'];

                   $targetPath = $path."/".$rand_no.'.'.$id;
                  
                   if(move_uploaded_file($sourcePath, $targetPath)) {

                    $model->images= $rand_no.'.'.$id;
                    
                    }
                     
                  }
                   
                 }
            $model->purchase_date=$this->dateFormat($model->purchase_date);
            if($model->save()){
            return $this->redirect(['update', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'model_category'=>$model_category,
            'model_vendor'=>$model_vendor,
             'color_model'=>$color_model,
        ]);
    }

    /**
     * Deletes an existing ItemMaster model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
       $model= $this->findModel($id);
       $model->delete_status=1;
       $model->save();
        return $this->redirect(['index']);
    }

    public function actionGetType(){
        $out = [];
//print_r($_POST);die;
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $cat_id = $parents[0];

                $out = TypeMaster::find()->select(['id','name'])->where(['category_id'=>$cat_id])->all();
             //  print_r($out);die;
// the getSubCatList function will query the database based on the
// cat_id and return an array like below:
// [
// ['id'=>'<sub-cat-id-1>', 'name'=>'<sub-cat-name1>'],
// ['id'=>'<sub-cat_id_2>', 'name'=>'<sub-cat-name2>']
// ]
                echo Json::encode(['output'=>$out, 'selected'=>'']);
                return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }
    /**
     * Finds the ItemMaster model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ItemMaster the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ItemMaster::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
