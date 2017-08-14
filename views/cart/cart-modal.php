

<?php if(!empty($session['cart'])): ?>

<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<th class="image">Фото</th>
							<th class="description">Наименование</th>
							<th class="price">Цена</th>
							<th class="quantity">Количество</th>
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
								<h4><?= $item['name'] ?></h4>
							</td>
							<td class="cart_price">
								<p>$ <?= $item['price'] ?></p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<a class="cart_quantity_up" id="plus" data-id="<?= $id ?>"> + </a>
									<input class="cart_quantity_input" readonly="true" type="text" name="quantity" value="<?= $item['qty'] ?>" autocomplete="off" size="2">
									<a class="cart_quantity_down" id="minus" data-id="<?= $id ?>"> - </a>
								</div>
							</td>
							<td>
								<span class="glyphicon glyphicon-remove text-danger del-item" data-id="<?= $id;?>" aria-hidden="true"></span></a>
							</td>
						</tr>
					<?php endforeach; ?>
					<tr>
						<td colspan="4">Итого: </td>
						<td ><?= $session['cart.qty']?> товаров</td>
					</tr>
					<tr>
						<td colspan="4">На сумму: </td>
						<td >$ <?= $session['cart.sum']?></td>
					</tr>
					</tbody>
				</table>
			</div>
<?php else: ?>
	<h3>Корзина пуста</h3>
<?php endif;?>