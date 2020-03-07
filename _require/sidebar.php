<?php
//顯示目前資料夾控制收合
//目前資料夾
$explodeDir = explode('/', $_SERVER['REQUEST_URI']);
$thisDir = $explodeDir[3];
//目前頁面
$thisPageUrl = explode('?', $explodeDir[4]);
$thisPageFile = $thisPageUrl[0];
?>

<script>
  function isHidden(oDiv) {
    var vDiv = document.getElementById(oDiv); //div id用于折疊主體
    vDiv.style.display = (vDiv.style.display == 'none') ? 'block' : 'none'; //反轉
  }
</script>

<div class="sidebar" data-color="blue" data-active-color="info">
  <div class="logo">
    <!-- <a href="javascript:void(0)" class="simple-text logo-mini">
      <div class="logo-image-small">
        <img src="./assets/img/logo-small.png">
      </div>
    </a> -->
    <a href="javascript:void(0)" class="simple-text text-center logo-normal">
      <?php echo (($_SESSION['username'] == 'admin') ? "管理者(admin)" : $_SESSION['username']) . " 您好"; ?>
    </a>
  </div>
  <div class="sidebar-wrapper">
    <div class="nav">
      <!-- admin -->
      <?php if ($_SESSION['username'] == 'admin') { ?>
        <fieldset>
          <legend style="cursor:hand" onclick="isHidden('div_first_part18')">
            最高權限管理
            <span style='float:left; display:none;' id='div_first_part19'> <img class="paws" src="../../images/paws.png" alt=""> </span>
            <span style='float:left; display:block;' id='div_first_part20'><img class="paws" src="../../images/paws.png" alt=""></span>
          </legend>
          <div style='display:block;' id='div_first_part18'>

            <fieldset>
              <legend style="cursor:hand" onclick="isHidden('div_first_part')">
                &nbsp會員管理
                <span style='float:left; display:none;' id='div_first_part1'> <img class="paws1" src="../../images/paws4.png" alt=""> </span>
                <span style='float:left; display:block;' id='div_first_part2'><img class="paws1" src="../../images/paws4.png" alt=""></span>
              </legend>
              <div style='display:<?php echo ($thisDir == 'member') ? 'block' : 'none' ?>;' id='div_first_part'>
                <ul>
                  <li class="<?php echo ($thisPageFile == 'member.php') ? 'active' : '' ?>"><a href="../member/member.php">會員列表管理</a></li>
                  <li class="<?php echo ($thisPageFile == 'dog.php') ? 'active' : '' ?>"><a href="../member/dog.php">狗狗列表管理</a></li>
                  <li class="<?php echo ($thisPageFile == 'member-new.php') ? 'active' : '' ?>"><a href="../member/member-new.php">新增會員</a></li>
                  <li class="<?php echo ($thisPageFile == 'dog-new.php') ? 'active' : '' ?>"><a href="../member/dog-new.php">新增狗狗</a></li>
                </ul>
              </div>
            </fieldset>

            <fieldset>
              <legend style="cursor:hand" onclick="isHidden('div_first_part3')">
                &nbsp業者管理
                <span style='float:left; display:none;' id='div_first_part4'><img class="paws1" src="../../images/paws4.png" alt=""></span>
                <span style='float:left; display:block;' id='div_first_part5'><img class="paws1" src="../../images/paws4.png" alt=""></span>
              </legend>
              <div style='display:<?php echo ($thisDir == 'service') ? 'block' : 'none' ?>;' id='div_first_part3'>
                <ul>
                  <li class="<?php echo ($thisPageFile == 'service-info.php') ? 'active' : '' ?>"><a href="../service/service-info.php">業者列表管理</a></li>
                  <li class="<?php echo ($thisPageFile == 'service-type.php') ? 'active' : '' ?>"><a href="../service/service-type.php">業者類別管理</a></li>
                  <li class="<?php echo ($thisPageFile == 'service-list.php') ? 'active' : '' ?>"><a href="../service/service-list.php">服務項目管理</a></li>
                  <li class="<?php echo ($thisPageFile == 'service-pay.php') ? 'active' : '' ?>"><a href="../service/service-pay.php">付款方式管理</a></li>
                </ul>
              </div>
            </fieldset>
            <fieldset>
              <legend style="cursor:hand" onclick="isHidden('div_first_part6')">
                &nbsp廠商管理
                <span style='float:left; display:none;' id='div_first_part7'><img class="paws1" src="../../images/paws4.png" alt=""></span>
                <span style='float:left; display:block;' id='div_first_part8'><img class="paws1" src="../../images/paws4.png" alt=""></span>
              </legend>
              <div style='display:<?php echo ($thisDir == 'vendor') ? 'block' : 'none' ?>;' id='div_first_part6'>
                <ul>
                  <li class="<?php echo ($thisPageFile == 'vendor_list.php') ? 'active' : '' ?>"><a href="../vendor/vendor_list.php">廠商列表</a></li>
                  <li class="<?php echo ($thisPageFile == 'vendor_new.php') ? 'active' : '' ?>"><a href="../vendor/vendor_new.php">新增廠商</a></li>
                </ul>
              </div>
            </fieldset>
            <fieldset>
              <legend style="cursor:hand" onclick="isHidden('div_first_part9')">
                &nbsp商品管理
                <span style='float:left; display:none;' id='div_first_part10'><img class="paws1" src="../../images/paws4.png" alt=""></span>
                <span style='float:left; display:block;' id='div_first_part11'><img class="paws1" src="../../images/paws4.png" alt=""></span>
              </legend>
              <div style='display:<?php echo ($thisDir == 'product') ? 'block' : 'none' ?>;' id='div_first_part9'>
                <ul>
                  <li class="<?php echo ($thisPageFile == 'productList.php') ? 'active' : '' ?>"><a href="../product/productList.php">商品管理</a></li>
                  <li class="<?php echo ($thisPageFile == 'productCategory.php') ? 'active' : '' ?>"><a href="../product/productCategory.php">新增類別</a></li>
                  <li class="<?php echo ($thisPageFile == 'productNew.php') ? 'active' : '' ?>"><a href="../product/productNew.php">新增商品</a></li>
                  <li class="<?php echo ($thisPageFile == 'paymentType.php') ? 'active' : '' ?>"><a href="../product/paymentType.php">付款方式</a></li>
                </ul>
              </div>
            </fieldset>
            <fieldset>
              <legend style="cursor:hand" onclick="isHidden('div_first_part15')">
                &nbsp活動管理
                <span style='float:left; display:none;' id='div_first_part16'><img class="paws1" src="../../images/paws4.png" alt=""></span>
                <span style='float:left; display:block;' id='div_first_part17'><img class="paws1" src="../../images/paws4.png" alt=""></span>
              </legend>
              <div style='display:<?php echo ($thisDir == 'blog') ? 'block' : 'none' ?>;' id='div_first_part15'>
                <ul>
                  <li class="<?php echo ($thisPageFile == 'blog.php') ? 'active' : '' ?>"><a href="../blog/blog.php">BLOG管理</a></li>
                  <li class="<?php echo ($thisPageFile == 'list.php') ? 'active' : '' ?>"><a href="../blog/list.php">講座/聚會管理</a></li>
                  <li class="<?php echo ($thisPageFile == 'adopt.php') ? 'active' : '' ?>"><a href="../blog/adopt.php">認養管理</a></li>
                </ul>
              </div>
            </fieldset>
          </div>
        </fieldset>
      <?php } ?>
      <!-- 廠商權限 -->
      <fieldset>
        <legend style="cursor:hand" onclick="isHidden('div_first_part21')">
          廠商管理
          <span style='float:left; display:none;' id='div_first_part22'> <img class="paws" src="../../images/paws.png" alt=""> </span>
          <span style='float:left; display:block;' id='div_first_part23'><img class="paws" src="../../images/paws.png" alt=""></span>
        </legend>
        <div style='display:block;' id='div_first_part21'>
          <fieldset>
            <legend style="cursor:hand" onclick="isHidden('div_first_part12')">
              &nbsp廠商商品管理
              <span style='float:left; display:none;' id='div_first_part13'><img class="paws1" src="../../images/paws4.png" alt=""></span>
              <span style='float:left; display:block;' id='div_first_part14'><img class="paws1" src="../../images/paws4.png" alt=""></span>
            </legend>
            <div style='display:<?php echo ($thisDir == 'vendor') ? 'block' : 'none' ?>;' id='div_first_part12'>
              <ul>
                <li class="<?php echo ($thisPageFile == 'vendor_product_list.php') ? 'active' : '' ?>"><a href="../vendor/vendor_product_list.php">商品列表</a></li>
                <li class="<?php echo ($thisPageFile == 'vendor_product_editCategory.php') ? 'active' : '' ?>"><a href="../vendor/vendor_product_editCategory.php">商品類別</a></li>
                <li class="<?php echo ($thisPageFile == 'vendor_product_new.php') ? 'active' : '' ?>"><a href="../vendor/vendor_product_new.php">新增商品</a></li>
              </ul>
            </div>
          </fieldset>
          <fieldset>
            <legend style="cursor:hand" onclick="isHidden('div_first_part24')">
              &nbsp行銷管理
              <span style='float:left; display:none;' id='div_first_part25'><img class="paws1" src="../../images/paws4.png" alt=""></span>
              <span style='float:left; display:block;' id='div_first_part26'><img class="paws1" src="../../images/paws4.png" alt=""></span>
            </legend>
            <div style='display:<?php echo ($thisDir == 'marketing') ? 'block' : 'none' ?>;' id='div_first_part24'>
              <ul>
                <li class="<?php echo ($thisPageFile == 'marketing.php') ? 'active' : '' ?>"><a href="../marketing/marketing.php">行銷活動管理</a></li>
                <li class="<?php echo ($thisPageFile == 'marketing-mt.php') ? 'active' : '' ?>"><a href="../marketing/marketing-mt.php">優惠種類列表</a></li>
                <li class="<?php echo ($thisPageFile == 'marketing-new.php') ? 'active' : '' ?>"><a href="../marketing/marketing-new.php">新增行銷活動</a></li>
                <li class="<?php echo ($thisPageFile == 'marketing-new-mt.php') ? 'active' : '' ?>"><a href="../marketing/marketing-new-mt.php">新增優惠</a></li>
              </ul>
            </div>
          </fieldset>

        </div>
      </fieldset>
      <!-- <fieldset>
        <legend style="cursor:hand">
          <a class="text-light" href="../public/login.php?logout=Y"><img class="paws" src="../../images/paws.png" alt="">&nbspLOG OUT</a>
        </legend>
      </fieldset> -->
    </div>
  </div>
</div>