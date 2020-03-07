<?php
require_once('./_require/checkSession.php');
require_once('./_require/db.inc.php');
?>
<!DOCTYPE html>
<html lang="zh-tw">

<head>
    <?php require_once('./_require/header.php'); ?>
</head>

<body>
    <div class="wrapper">

        <?php require_once('./_require/sidebar.php'); ?>

        <div class="main-panel">
            <!-- Navbar -->
            <?php require_once('./_require/nav.php') ?>
            <!-- End Navbar -->

            <div class="content">
                <?php if ($_SESSION['username'] == 'admin') { ?>
                    <!-- 最高權限管理 -->
                    <h4><i class="fas fa-user-cog"></i> 最高權限管理</h4>
                    <div class="row">
                        <div class="col">
                            <div class="card-deck">
                                <div class="card">
                                    <div class="card-img">
                                        <img src="../../images/index/adorable-3344414_640.jpg" alt="">
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">會員管理</h5>
                                        <ul>
                                            <li>會員列表管理</li>
                                            <li>狗狗列表管理</li>
                                            <li>新增會員</li>
                                            <li>新增狗狗</li>
                                        </ul>
                                    </div>
                                    <div class="card-footer">
                                        <a href="../member/member.php" class="btn btn-primary btn-block ml-auto">前往</a>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-img">
                                        <img src="../../images/index/dog-1123016_640.jpg" alt="">
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">業者管理</h5>
                                        <ul>
                                            <li>業者列表管理</li>
                                            <li>業者類別管理</li>
                                            <li>服務項目管理</li>
                                            <li>付款方式管理</li>
                                        </ul>
                                    </div>
                                    <div class="card-footer">
                                        <a href="../service/service-info.php" class="btn btn-primary btn-block ml-auto">前往</a>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-img">
                                        <img src="../../images/index/dog-1224267_640.jpg" alt="">
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">廠商管理</h5>
                                        <ul>
                                            <li>廠商列表</li>
                                            <li>新增廠商</li>
                                        </ul>
                                    </div>
                                    <div class="card-footer">
                                        <a href="../vendor/vendor_list.php" class="btn btn-primary btn-block ml-auto">前往</a>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-img">
                                        <img src="../../images/index/dog-2785074_640.jpg" alt="">
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">商品管理</h5>
                                        <ul>
                                            <li>商品管理</li>
                                            <li>新增類別</li>
                                            <li>新增商品</li>
                                            <li>付款方式</li>
                                        </ul>
                                    </div>
                                    <div class="card-footer">
                                        <a href="../product/productList.php" class="btn btn-primary btn-block ml-auto">前往</a>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-img">
                                        <img src="../../images/index/puppy-1903313_640.jpg" alt="">
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">活動管理</h5>
                                        <ul>
                                            <li>BLOG管理</li>
                                            <li>講座/聚會管理</li>
                                            <li>認養管理</li>
                                        </ul>
                                    </div>
                                    <div class="card-footer">
                                        <a href="../blog/blog.php" class="btn btn-primary btn-block ml-auto">前往</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <!-- 廠商管理權限 -->
                <h4><i class="fas fa-store"></i> 廠商管理</h4>
                <div class="row">
                    <div class="col-5">
                        <div class="card-deck">
                            <div class="card">
                                <div class="card-img">
                                    <img src="../../images/index/snuggle-4713013_640.jpg" alt="">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">廠商商品管理</h5>
                                    <ul>
                                        <li>商品列表</li>
                                        <li>商品類別</li>
                                        <li>新增商品</li>
                                    </ul>
                                </div>
                                <div class="card-footer">
                                    <a href="../vendor/vendor_product_list.php" class="btn btn-primary btn-block ml-auto">前往</a>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-img">
                                    <img src="../../images/index/rottweiler-1785760_640.jpg" alt="">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">行銷管理</h5>
                                    <ul>
                                        <li>行銷活動管理</li>
                                        <li>優惠種類列表</li>
                                        <li>新增行銷活動</li>
                                        <li>新增優惠</li>
                                    </ul>
                                </div>
                                <div class="card-footer">
                                    <a href="../marketing/marketing.php" class="btn btn-primary btn-block ml-auto">前往</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php require_once('./_require/footer.php') ?>
        </div>
    </div>
    <!--   Core JS Files   -->
    <?php require_once('./_require/js.php') ?>
</body>

</html>