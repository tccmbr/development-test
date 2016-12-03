<div class="page-header">
    <h3>
        <i class="text-success glyphicon glyphicon-plus-sign"></i> Novo Produto
    </h3>
</div>
<div class="row">
    <div class="col-md-12">
        <button type="button" id="add" class="btn btn-primary btn-sm">
            <i class="glyphicon glyphicon-plus-sign"></i> Adicionar
        </button>
        <hr>
        <div id="alert"></div>
    </div>
    <?= form_open('','id="form-product"'); ?>
    <template id="inputs-product">
        <div id="fieldset_/__index__/">
            <div class="col-md-3">
                <div class="form-group">
                    <?= form_label('Produto', 'products[/__index__/][product_name]'); ?>
                    <?= form_input('products[/__index__/][product_name]', '',
                        'id="products[/__index__/][product_name]" class="form-control"') ?>
                    <span class="help-block" id="error[/__index__/][product_name]"></span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?= form_label('Preço', 'products[/__index__/][product_price]'); ?>
                    <?= form_input('products[/__index__/][product_price]', '',
                        'id="products[/__index__/][product_price]" class="form-control currency"') ?>
                    <span class="help-block" id="error[/__index__/][product_price]"></span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?= form_label('Quantidade', 'products[/__index__/][product_stock_quantity]'); ?>
                    <?= form_input('products[/__index__/][product_stock_quantity]','',
                        'id="products[/__index__/][product_stock_quantity]" class="form-control"') ?>
                    <span class="help-block" id="error[/__index__/][product_stock_quantity]"></span>
                </div>
            </div>
            <div class="col-md-1">
                <button class="btn btn-danger btn-xs" style="margin-top: 25px;"
                        id="remove_fieldset_/__index__/" type="button">
                    <i class="glyphicon glyphicon-remove-circle"></i>
                </button>
            </div>
            <div class="col-md-12"><hr></div>
        </div>
    </template>
    <?= form_close(); ?>
    <div class="col-md-12">
        <button form="form-product" id="submit" type="submit" class="btn btn-success btn-sm">
            <i class="glyphicon glyphicon-save"></i> Salvar
        </button>
    </div>
</div>