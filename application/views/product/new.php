<div class="page-header">
    <h3><i class="text-success glyphicon glyphicon-plus-sign"></i> Novo Produto</h3>
</div>
<div class="row">
    <?= form_open('product/new'); ?>
    <div class="col-md-3">
        <div class="form-group">
            <?= form_label('Produto', 'product_name'); ?>
            <?= form_input('product_name', set_value('product_name'), 'id="product_name" class="form-control"') ?>
            <?= form_error('product_name'); ?>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <?= form_label('Preço', 'product_price'); ?>
            <?= form_input('product_price', set_value('product_price'), 'id="product_price" class="form-control"') ?>
            <?= form_error('product_price'); ?>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <?= form_label('Quantidade', 'product_stock_quantity'); ?>
            <?= form_input('product_stock_quantity', set_value('product_stock_quantity'),
                'id="product_stock_quantity" class="form-control"') ?>
            <?= form_error('product_stock_quantity'); ?>
        </div>
    </div>
    <div class="col-md-12">
        <button type="submit" class="btn btn-success btn-sm">
            <i class="glyphicon glyphicon-save"></i> Salvar
        </button>
    </div>
    <?= form_close(); ?>
</div>