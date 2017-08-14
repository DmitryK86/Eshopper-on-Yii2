<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>

<div class="container">

<?php if(Yii::$app->session->hasFlash('success')):?>
<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <?php echo Yii::$app->session->getFlash('success');?>
</div>
	<?php endif;?>

<?php if(Yii::$app->session->hasFlash('error')):?>
<div class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <?php echo Yii::$app->session->getFlash('error');?>
</div>
	<?php endif;?>
	

<?php if(!empty($session['cart'])): ?>

<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<th class="image">Фото</th>
							<th class="description">Наименование</th>
							<th class="price">Цена</th>
							<th class="quantity">Количество</th>
							<th class="price">Сумма</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
					<?php foreach($session['cart'] as $id => $item): ?>
						<tr>
							<td class="cart_product">
								<?= yii\helpers\Html::img('@web/images/products/' . $item['img']) ?>
							</td>
							<td class="cart_description">
								<h4><a href="<?= Url::to(['product/view', 'id' => $id]) ?>"><?= $item['name'] ?></a></h4>
							</td>
							<td class="cart_price">
								<p>$ <?= $item['price'] ?></p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<input class="cart_quantity_input" readonly="true" type="text" name="quantity" value="<?= $item['qty'] ?>" autocomplete="off" size="2">
								</div>
							</td>
							<td class="cart_price">
								<p>$ <?= $item['qty'] * $item['price'] ?></p>
							</td>
							<td>
								<span class="glyphicon glyphicon-remove text-danger del-item" data-id="<?= $id;?>" aria-hidden="true"></span></a>
							</td>
						</tr>
					<?php endforeach; ?>
					<tr>
						<td colspan="5">Итого: </td>
						<td ><?= $session['cart.qty']?> товаров</td>
					</tr>
					<tr>
						<td colspan="5">На сумму: </td>
						<td >$ <?= $session['cart.sum']?></td>
					</tr>
					</tbody>
				</table>
			</div>
			<hr>
			<?php $form = ActiveForm::begin(['id' => 'order_form']); ?>
			<?= $form->field($order, 'name');?>
			<?= $form->field($order, 'email');?>
			<?= $form->field($order, 'phone');?>
			<?= $form->field($order, 'address');?>
			<?= Html::submitButton('Заказать', ['class' => 'btn btn-success']);?>
			<?php ActiveForm::end(); ?>
<?php else: ?>
	<h3>Корзина пуста</h3>
<?php endif;?>
</div>
<br>