<?php
// foreach ($_GET as $key => $value) {
//     $$key = $value;
// }
// foreach ($_POST as $key => $value) {
//     $$key = $value;
// }

//資料交叉查詢組合
function crossquery($where = "")
{
    $wherevar = "";
    foreach ($where as $key => $val) {
        $wherevar .= $val;
    }

    $wherevar = !empty($wherevar) ? " where " . $wherevar . "" : ''; // get TRUE

    //去除最後字元
    $wherevar = substr($wherevar, 0, -4);
    return $wherevar;
}
