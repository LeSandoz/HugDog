<nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
    <div class="container-fluid">
        <div class="navbar-wrapper">
            <div class="navbar-toggle">
                <button type="button" class="navbar-toggler">
                    <span class="navbar-toggler-bar bar1"></span>
                    <span class="navbar-toggler-bar bar2"></span>
                    <span class="navbar-toggler-bar bar3"></span>
                </button>
            </div>
            <?php if ($thisPageFile == 'index.php') { ?>
                <a class="navbar-brand" href="../public/index.php"><img src="../../images/logo.png" class="logo">管理系統平台</a>
            <?php } else { ?>
                <a class="btn btn-sm btn-secondary" href="javascript:history.go(-1)">
                    <i class="fas fa-arrow-left"></i> 回上頁
                </a>
            <?php } ?>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <!-- <form>
                <div class="input-group no-border">
                    <input type="text" value="" class="form-control" placeholder="請輸入關鍵字">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <i class="nc-icon nc-zoom-split"></i>
                        </div>
                    </div>
                </div>
            </form> -->
            <ul class="navbar-nav">
                <!-- <li class="nav-item">
                    <a class="nav-link btn-magnify" href="#pablo">
                        <i class="nc-icon nc-layout-11"></i>
                        <p>
                            <span class="d-lg-none d-md-block">Stats</span>
                        </p>
                    </a>
                </li> -->
                <!-- <li class="nav-item btn-rotate dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="nc-icon nc-settings-gear-65"></i>
                        <p>
                            <span class="d-lg-none d-md-block">Some Actions</span>
                        </p>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">基本資料修改</a>
                    </div>
                </li> -->
                <li class="nav-item mr-3">
                    <a class="btn btn-sm btn-success" href="../public/index.php">
                        <i class="fas fa-home"></i> 回首頁
                        <span class="d-lg-none d-md-block">回首頁</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-sm btn-info" href="../public/login.php?logout=Y">
                        <i class="fas fa-sign-out-alt"></i> 登出
                        <span class="d-lg-none d-md-block">登出</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>