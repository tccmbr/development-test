<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">
            <i class="glyphicon glyphicon-gift"></i> <?= $product->product_name; ?>
        </h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6">
                <?= img(array('src' => 'assets/img/image-not-found.png', 'class' => 'img-responsive')); ?>
            </div>
            <div class="col-md-6">
                <h2><?= $product->product_name; ?></h2>
                <span class="label label-default">Cód. <?= $product->product_id; ?></span>
                <span class="label <?= $product->product_stock_quantity > 0 ? 'label-success' : 'label-danger'; ?>">
                    <?= $product->product_stock_quantity; ?> disponíveis
                </span>
                <h4 style="color: #3c763d;"><em><?= currency_format($product->product_price); ?></em></h4>
            </div>
        </div>
    </div>
</div>