<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title"><i class="glyphicon glyphicon-shopping-cart"></i> Pedidos</h3>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead style="background-color: #EEE">
                    <tr>
                        <th>Código Pedido</th>
                        <th>Código Produto</th>
                        <th>Produto</th>
                        <th>Preço</th>
                        <th>Quantidade</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $totalPrice = 0;
                        $subtotalPrice = 0;
                        $totalQuantity = 0;
                    ?>
                    <?php foreach ($orders as $order): ?>
                        <?php
                        $subtotalPrice = $order->product_quantity * $order->product_price;
                        $totalPrice += $subtotalPrice;
                        $totalQuantity += $order->product_quantity;
                        ?>
                        <tr>
                            <td><?= $order->order_code; ?></td>
                            <td><?= $order->product_id; ?></td>
                            <td>
                                <a href="<?= site_url('store/product/'.url_title($order->product_name).'/'
                                    .$order->product_id);
                                ?>">
                                    <?= $order->product_name; ?>
                                </a>
                            </td>
                            <td><?= currency_format($order->product_price); ?></td>
                            <td><?= $order->product_quantity; ?></td>
                            <td><?= currency_format($subtotalPrice); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tbody>
                    <tr style="background-color: #EEE">
                        <td colspan="4"></td>
                        <td><strong>Total: <?= $totalQuantity; ?></strong></td>
                        <td><strong>Total: <?= currency_format($totalPrice); ?></strong></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
