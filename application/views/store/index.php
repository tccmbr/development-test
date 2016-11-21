<div class="row">
    <?php if (count($products) > 0): ?>
        <?php foreach($products as $product): ?>
            <div class="col-sm-4 col-md-3">
                <div class="thumbnail">
                    <?= img(array('src' => 'assets/img/image-not-found.png', 'class' => 'img-responsive')); ?>
                    <div class="caption">
                        <h3><?= $product->product_name; ?></h3>
                        <p>
                            <span class="label label-default">Cód. <?= $product->product_id; ?></span>
                            <span class="label label-success">
                                <?= $product->product_stock_quantity; ?> disponíveis
                            </span>
                        </p>
                        <h4 style="color: #3c763d;">
                            <em><?= currency_format($product->product_price); ?></em>
                        </h4>
                        <p>
                            <a href="<?= site_url('store/product/'.url_title($product->product_name).'/'
                                    .$product->product_id); ?>"
                               class="btn btn-primary btn-xs">
                                <i class="glyphicon glyphicon-plus-sign"></i> Detalhes
                            </a>
                            <?php if ($logged_in === TRUE): ?>
                                <a href="<?= site_url('product/edit/'.$product->product_id); ?>"
                                   class="btn btn-warning btn-xs">
                                    <i class="glyphicon glyphicon-edit"></i> Editar
                                </a>
                                <a onclick="return confirm('Tem certeza que quer remover?')"
                                   href="<?= site_url('product/delete/'.$product->product_id); ?>"
                                   class="btn btn-danger btn-xs">
                                    <i class="glyphicon glyphicon-remove-sign"></i> Remover
                                </a>
                            <?php endif; ?>
                        </p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="alert alert-warning">Nenhum produto no momento.</div>
    <?php endif; ?>
    <div class="col-sm-12 col-md-12">
        <?= $links; ?>
    </div>
</div>