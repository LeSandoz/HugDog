<style>
  fieldset {
    width: 720px;
    /* border:#000 3px double; */
    padding-top: 0;
    padding-right: 1em;
    padding-bottom: 1em;
    padding-left: 1em;
    color: white;


  }


  legend {
    color: white;
    /* background:#336; */
    padding: 0.2em 1em 0.2em 1em;
    margin: 1em;
    width: 20em;
    transform: translateX(-35px);
    cursor: pointer;
    font-size: 20px;
  }

  legend:hover {
    background: rgb(101, 101, 184);
  }

  label {
    width: 6em;
    float: left;
  }

  .paws {
    width: 26px;
    height: 26px;
  }

  .paws1 {
    width: 20px;
    height: 20px;
  }

  fieldset li {
    /* list-style: url(images/paws2.png); */
    list-style-type: disc;
    /* transform: translateX(-50px); */
  }
</style>
<script>
  function isHidden(oDiv) {
    var vDiv = document.getElementById(oDiv); //div id用于折疊主體
    vDiv.style.display = (vDiv.style.display == 'none') ? 'block' : 'none'; //反轉
    var oDiv1 = oDiv + '1';
    var vDiv1 = document.getElementById(oDiv1); //div id1用于折疊狀态顯示展開的+号
    vDiv1.style.display = (vDiv1.style.display == 'none') ? 'block' : 'none'; //反轉
    var oDiv2 = oDiv + '2';
    var vDiv2 = document.getElementById(oDiv2); //div id2用于展開狀态顯示折疊的-号
    vDiv2.style.display = (vDiv2.style.display == 'none') ? 'block' : 'none'; //反轉

  }
</script>


<div class="logo">
  <a href="javascript:void(0)" class="simple-text logo-mini">
    <div class="logo-image-small">
      <img src="./assets/img/logo-small.png">
    </div>
  </a>
  <a href="javascript:void(0)" class="simple-text logo-normal">
    使用者 您好
    <!-- <div class="logo-image-big">
            <img src="./assets/img/logo-big.png">
          </div> -->
  </a>
</div>
<br><br><br>

<div class="sidebar-wrapper">
  <div class="nav">
    <fieldset>
      <legend style="cursor:hand" onclick="isHidden('div_first_part18')">
        &nbspADMINSTRATOR
        <span style='float:left; display:none;' id='div_first_part19'> <img class="paws" src="./images/paws.png" alt=""> </span>
        <span style='float:left; display:block;' id='div_first_part20'><img class="paws" src="./images/paws.png" alt=""></span>
      </legend>
      <div style='display:none;' id='div_first_part18'>

        <fieldset>
          <legend style="cursor:hand" onclick="isHidden('div_first_part')">
            &nbsp會員管理
            <span style='float:left; display:none;' id='div_first_part1'> <img class="paws1" src="./images/paws4.png" alt=""> </span>
            <span style='float:left; display:block;' id='div_first_part2'><img class="paws1" src="./images/paws4.png" alt=""></span>
          </legend>
          <div style='display:none;' id='div_first_part'>
            <ul>
              <li><a href="./member.php">會員列表管理</a></li>
              <li><a href="./dog.php">狗狗列表管理</a></li>
              <li><a href="./member-new.php">新增會員</a></li>
              <li><a href="./dog-new.php">新增狗狗</a></li>
            </ul>
          </div>
        </fieldset>

        <fieldset>
          <legend style="cursor:hand" onclick="isHidden('div_first_part3')">
            &nbsp業者管理
            <span style='float:left; display:none;' id='div_first_part4'><img class="paws1" src="./images/paws4.png" alt=""></span>
            <span style='float:left; display:block;' id='div_first_part5'><img class="paws1" src="./images/paws4.png" alt=""></span>
          </legend>
          <div style='display:none;' id='div_first_part3'>
            <ul>
              <li><a href="./service-info.php">業者列表管理</a></li>
              <li><a href="./service-type.php">業者類別管理</a></li>
              <li><a href="./service-list.php">服務項目管理</a></li>
              <li><a href="./service-pay.php.php">付款方式管理</a></li>
            </ul>
          </div>
        </fieldset>
        <fieldset>
          <legend style="cursor:hand" onclick="isHidden('div_first_part6')">
            &nbsp廠商管理
            <span style='float:left; display:none;' id='div_first_part7'><img class="paws1" src="./images/paws4.png" alt=""></span>
            <span style='float:left; display:block;' id='div_first_part8'><img class="paws1" src="./images/paws4.png" alt=""></span>
          </legend>
          <div style='display:none;' id='div_first_part6'>
            <ul>
              <li><a href="./vender-list.php">廠商列表</a></li>
              <li><a href="./vender-new.php">新增廠商</a></li>
              <li><a href="./member-new.php">服務項目管理</a></li>
              <li><a href="./dog-new.php">付款方式管理</a></li>
            </ul>
          </div>
        </fieldset>
        <fieldset>
          <legend style="cursor:hand" onclick="isHidden('div_first_part9')">
            &nbsp商品管理
            <span style='float:left; display:none;' id='div_first_part10'><img class="paws1" src="./images/paws4.png" alt=""></span>
            <span style='float:left; display:block;' id='div_first_part11'><img class="paws1" src="./images/paws4.png" alt=""></span>
          </legend>
          <div style='display:none;' id='div_first_part9'>
            <ul>
              <li><a href="./productList.php">商品管理</a></li>
              <li><a href="./productCategory.php">新增類別</a></li>
              <li><a href="./productNew.php">新增商品</a></li>
              <li><a href="./paymentType.php">付款方式</a></li>
            </ul>
          </div>
        </fieldset>
        <fieldset>
          <legend style="cursor:hand" onclick="isHidden('div_first_part15')">
            &nbsp活動管理
            <span style='float:left; display:none;' id='div_first_part16'><img class="paws1" src="./images/paws4.png" alt=""></span>
            <span style='float:left; display:block;' id='div_first_part17'><img class="paws1" src="./images/paws4.png" alt=""></span>
          </legend>
          <div style='display:none;' id='div_first_part15'>
            <ul>
              <li><a href="./blog.php">BLOG管理</a></li>
              <li><a href="./list.php">講座/聚會管理</a></li>
              <li><a href="./adopt.php">認養管理</a></li>
            </ul>
          </div>
        </fieldset>
      </div>
    </fieldset>

    <fieldset>
      <legend style="cursor:hand" onclick="isHidden('div_first_part21')">
        &nbspVENDER
        <span style='float:left; display:none;' id='div_first_part22'> <img class="paws" src="./images/paws.png" alt=""> </span>
        <span style='float:left; display:block;' id='div_first_part23'><img class="paws" src="./images/paws.png" alt=""></span>
      </legend>
      <div style='display:none;' id='div_first_part21'>
        <fieldset>
          <legend style="cursor:hand" onclick="isHidden('div_first_part12')">
            &nbsp廠商商品管理
            <span style='float:left; display:none;' id='div_first_part13'><img class="paws1" src="./images/paws4.png" alt=""></span>
            <span style='float:left; display:block;' id='div_first_part14'><img class="paws1" src="./images/paws4.png" alt=""></span>
          </legend>
          <div style='display:none;' id='div_first_part12'>
            <ul>
              <li><a href="./vender_product_list.php">商品列表</a></li>
              <li><a href="./vender_product_edit.php">商品類別</a></li>
              <li><a href="./vender_product_new.php">新增商品</a></li>
            </ul>
          </div>
        </fieldset>
        <fieldset>
          <legend style="cursor:hand" onclick="isHidden('div_first_part24')">
            &nbsp行銷管理
            <span style='float:left; display:none;' id='div_first_part25'><img class="paws1" src="./images/paws4.png" alt=""></span>
            <span style='float:left; display:block;' id='div_first_part26'><img class="paws1" src="./images/paws4.png" alt=""></span>
          </legend>
          <div style='display:none;' id='div_first_part24'>
            <ul>
              <li><a href="./marketing.php">行銷活動管理</a></li>
              <li><a href="./marketing-mt.php">優惠種類列表</a></li>
              <li><a href="./marketing-new.php">新增行銷活動</a></li>
              <li><a href="./marketing-new-mt.php">付款優惠</a></li>
            </ul>
          </div>
        </fieldset>

      </div>
    </fieldset>
    <fieldset>
      <legend style="cursor:hand">
        <div><img class="paws" src="./images/paws.png" alt="">&nbspLOG OUT</div>

      </legend>
    </fieldset>
  </div>
</div>
</div>
<div class="main-panel">