
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>台灣地址輸入表單</title>
<link href="font.css" rel="stylesheet" type="text/css">
<script language="Javascript" type="text/javascript" src="./js/addr.js"></script>
<script language="Javascript" type="text/javascript" src="./js/149-01.js"></script>
</head>
<style>
body	{font-family:微軟正黑體;}	
fieldset {
	width:720px;
	border:#000 3px double;
	padding-top:0;
	padding-right:1em;
	padding-bottom:1em;
	padding-left:1em;
}	

legend {
	color:#FFF;
	background:#336;
	padding:0.2em 1em 0.2em 1em;
	margin:1em;
	width:10em;
}

label {
	width:6em;
	float:left;
}
</style>
<body>
<form method="post" name="form1" id="form1">
  <fieldset>
  <legend>業務資料</legend>
  <label for="uName">姓名：</label>
  <input name="uName" type="text" id="uName" value="王小明" size="40" />
  <br />
  <label>性別：</label>
  <input type="radio" name="Sex" id="SexF" value="F">
  女
  <input name="Sex" type="radio" id="SexM" value="M" checked>
  男<br />
  <label for="ID">身份證號：</label>
  <input name="ID" type="text" id="ID" value="A120074329" size="40" maxlength="10" />
  <br />
  <label for="EMail">電子郵件：</label>
  <input name="EMail" type="text" id="EMail" value="smallmin@mail.com" size="40" />
  <br />
  <label for="address">地 址： </label>
  <script>
  	loadAddress(document.form1);
  </script>
  <br />
  <label for="Tel">電話：</label>
  <input name="Tel" id="Tel" size="40" type="text" />
  <br />
  <label>興趣：</label>
  <input type="checkbox" name="habbit" value="網際網路" />網際網路
  <input type="checkbox" name="habbit" value="閱讀" />閱讀
  <input type="checkbox" name="habbit" value="戶外活動" /> 戶外活動
  <input type="checkbox" name="habbit" value="其他" onClick="if (this.checked)this.form.other.focus();" />其他
  <input name="other" type="text" id="other" onFocus="this.form.habbit[this.form.habbit.length-1].checked=true;">
  </fieldset>
  <p>
    <input type="button" name="button" value="送出" onClick="checkForm();" />
  </p>
</form>
</body>
</html>
