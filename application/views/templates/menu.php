<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?= site_url('site') ?>">
                Store CI
            </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li <?= link_active($page, 'index'); ?>>
                    <a href="<?= site_url('site') ?>">
                        Home
                    </a>
                </li>
            </ul>
            <?php if(!$this->session->userdata('logged_in')): ?>
                <?= form_open('login/authentication','class="navbar-form navbar-right"'); ?>
                    <div class="form-group">
                        <?= form_input('username','admin','class="form-control" placeholder="Login"'); ?>
                        <?= form_input('password','123456','class="form-control" placeholder="Senha"'); ?>
                    </div>
                    <button type="submit" class="btn btn-success btn-sm">
                        <i class="glyphicon glyphicon-log-in"></i>
                    </button>
                <?= form_close(); ?>
            <?php else: ?>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-haspopup="true" aria-expanded="false">
                            <i class="glyphicon glyphicon-user"></i>
                            <?= $this->session->userdata('username'); ?>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="<?= site_url('login/logout'); ?>">
                                    <i class="glyphicon glyphicon-log-out"></i> Sair
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</nav>