<?php

namespace app\controllers;

use app\models\Category;
use app\models\Product;
use app\models\Cart;
use app\models\CartOrder;
use app\models\OrderItems;
use Yii;

/**
* 
*/
class CartController extends AppController
{
	
	public function actionAdd(){
		$id = Yii::$app->request->get('id');
		$qty = (int)Yii::$app->request->get('qty');
		$qty = !$qty ? 1 : $qty;
		$product = Product::findOne($id);
		if (empty($product)) return false;
		$session = Yii::$app->session;
		$session->open();
		$cart = new Cart();
		$cart->addToCart($product, $qty);
		$this->layout = false;
		return $this->render('cart-modal', compact('session'));
	}

	public function actionClear(){
		$session = Yii::$app->session;
		$session->open();
		$session->remove('cart');
		$session->remove('cart.qty');
		$session->remove('cart.sum');
		$this->layout = false;
		return $this->render('cart-modal', compact('session'));
	}

	public function actionDelItem(){
		$id = Yii::$app->request->get('id');
		$sign = Yii::$app->request->get('sign');
		$session = Yii::$app->session;
		$session->open();
		$cart = new Cart();
		if (isset($sign)) {
			$cart->recalcOne($id, $sign);
		}else{
			$cart->recalc($id);
		}
		$this->layout = false;
		return $this->render('cart-modal', compact('session'));
	}
	
	public function actionShow(){
		$session = Yii::$app->session;
		$session->open();
		$this->layout = false;
		return $this->render('cart-modal', compact('session'));
	}

	public function actionView(){
		$session = Yii::$app->session;
		$session->open();
		$order = new CartOrder();
		$this->setMeta('Корзина');
		if ($order->load(Yii::$app->request->post())) {
			$order->qty = $session['cart.qty'];
			$order->sum = $session['cart.sum'];
			if ($order->save()) {
				$this->saveOrderItems($session['cart'], $order->id);
				Yii::$app->session->setFlash('success', 'Ваш заказ принят. Ожидайте звонка от менеджера.');
				Yii::$app->mailer->compose('order', compact('session'))->setFrom(['email@example.com' => 'yii.local'])->setTo($order->email)->setSubject('Заказ')->send();
				Yii::$app->mailer->compose()->setFrom(['email@example.com' => 'yii.local'])->setTo(Yii::$app->params['adminEmail'])->setSubject('Пришел новый заказ от пользователя ' . $order->email)->send();
				$session->remove('cart');
				$session->remove('cart.qty');
				$session->remove('cart.sum');
				return $this->refresh();
			}else{
				Yii::$app->session->setFlash('error', 'Ошибка оформления заказа');
			}
		}
		return $this->render('view', compact('session', 'order'));
	}

	protected function saveOrderItems($items, $order_id) {
		foreach ($items as $id => $item) {
			$order_item = new OrderItems();
			$order_item->order_id = $order_id;
			$order_item->product_id = $id;
			$order_item->name = $item['name'];
			$order_item->price = $item['price'];
			$order_item->qty_item = $item['qty'];
			$order_item->sum_item = $item['price'] * $item['qty'];
			$order_item->save();
		}
	}
}