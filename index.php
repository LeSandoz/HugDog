<?php
//後台預設首頁

session_start();

//如果有session代表有登入,導入登入後台首頁
if (isset($_SESSION['username']) && $_SESSION['username'] != '') {
?>
    <script>
        location.href = "./pages/public/index.php";
    </script>
<?php
} else {
    //導回登入頁
?>
    <script>
        location.href = "./pages/public/login.php";
    </script>
<?php
}
?>