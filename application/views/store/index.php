<div class="row">
    <?php if (count($products) > 0): ?>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3">
                    <?= form_open(site_url('store/index/page'),'method="get" class="navbar-form navbar-left"'); ?>
                    <?= form_dropdown('orderBy',array(
                        0 => 'Selecione',
                        1 => "Maior preço",
                        2 => "Menor preço",
                        3 => "Produto"
                    ),array(),'class="form-control" onchange="return submit();"'); ?>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
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
                               class="btn btn-primary btn-sm">
                                <i class="glyphicon glyphicon-plus-sign"></i> Detalhes
                            </a>
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