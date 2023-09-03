<?php

namespace app\controllers;

use app\models\Picture;
use Yii;
use app\models\Property;
use app\models\PropertySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * PropertyController implements the CRUD actions for Property model.
 */
class PropertyController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Property models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PropertySearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Property model.
     * @param int $propertyID Property ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($propertyID)
    {

        $model = $this->findModel($propertyID);


        return $this->render('view', [
            'model' => $model,

        ]);
    }

    /**
     * Creates a new Property model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Property();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'propertyID' => $model->propertyID]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Property model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $propertyID Property ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($propertyID)
    {
        $model = $this->findModel($propertyID);
        $pictures = new Picture;

        if ($this->request->isPost) {
            $model->load($this->request->post());

            // Handle the uploaded image
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile'); // Assuming 'imageFile' is the name of the file input in your form
            
            if ($model->validate()) {
                if ($model->imageFile) {
            // Rename the image file
            $imageName = $model->propertyID . '_' . Yii::$app->security->generateRandomString(8) . '.' . $model->imageFile->extension;
            
            // Save the image to the uploads folder
            
            
            // Update the model with the image URL and caption
            
           
            // Set the model's pictureID attribute
            
            $pictures->propertyID = $propertyID;
            $pictures->imageURL = $imageName;
            $pictures->caption = $imageName;
            if ($pictures->save()) {
                // Record saved successfully
            } else {
                // Handle validation errors
                $errors = $pictures->errors;
                // Log or display the errors
                Yii::error($errors);
                echo '<pre>';
                var_dump($errors);
                die();
            }
            }
                if ($model->save()) {
                    $model->imageFile->saveAs(Yii::getAlias('@app/web/uploads/') . $imageName);
                    return $this->redirect(['view', 'propertyID' => $model->propertyID]);
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Property model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $propertyID Property ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($propertyID)
    {
        $this->findModel($propertyID)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Property model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $propertyID Property ID
     * @return Property the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($propertyID)
    {
        if (($model = Property::findOne(['propertyID' => $propertyID])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}