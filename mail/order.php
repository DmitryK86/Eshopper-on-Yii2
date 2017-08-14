
<div class="table-responsive cart_info">
	<table style="width: 100%; border: 1px solid #ddd; border-collapse: collapse;">
		<thead>
			<tr style="background: #f9f9f9;">
				<th style="padding: 8px; border: 1px solid #ddd;">Наименование</th>
				<th style="padding: 8px; border: 1px solid #ddd;">Цена</th>
				<th style="padding: 8px; border: 1px solid #ddd;">Количество</th>
				<th style="padding: 8px; border: 1px solid #ddd;">Сумма</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($session['cart'] as $id => $item): ?>
			<tr>
				<td style="padding: 8px; border: 1px solid #ddd; text-align: center;">
					<h4><a href=<?= \yii\helpers\Url::to(['product/view', 'id' => $id, true])?>><?= $item['name'] ?></a></h4>
				</td>
				<td style="padding: 8px; border: 1px solid #ddd; text-align: center;">
					<p>$ <?= $item['price'] ?></p>
				</td>
				<td style="padding: 8px; border: 1px solid #ddd; text-align: center;">
					<?= $item['qty'] ?>
				</td>
				<td style="padding: 8px; border: 1px solid #ddd; text-align: center;">
					<p>$ <?= $item['price'] * $item['qty'] ?></p>
				</td>
			</tr>
		<?php endforeach; ?>
		<tr>
			<td colspan="3">Итого: </td>
			<td style="text-align: right;"><?= $session['cart.qty']?> товаров</td>
		</tr>
		<tr>
			<td colspan="3">На сумму: </td>
			<td style="text-align: right;">$ <?= $session['cart.sum']?></td>
		</tr>
		</tbody>
	</table>
</div>
