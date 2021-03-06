<?php

namespace app\controllers;

use app\models\Category;
use app\models\Product;
use yii\web\HttpException;
use Yii;

/**
* 
*/
class ProductController extends AppController
{
	
	public function actionView(){
		$id = Yii::$app->request->get('id');
		$product = Product::findOne($id);
		if (empty($product)) {
			throw new HttpException(404);	
		}

		$hits = Product::find()->where(['hit' => 1])->limit(6)->all();
		$this->setMeta('E-SHOPPER | '. $product->name, $product->keywords, $product->description );

		return $this->render('view', compact('product', 'hits'));
	}
}