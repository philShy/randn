<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="UTF-8">
<title>三级菜单的制作</title>
<style>
* {
	padding: 0;
	margin: 0;
}

body {
	background: #eee;
	font-size: 14px;
}

a {
	padding: 10px 15px;
	text-decoration: none;
	color: #fff;
	background: #008aff;
}

.menu {
	height: 30px;
	line-height: 30px;
}

.menu li {
	float: left;
	list-style: none;
	padding: 0 15px;
}

.menu li a:hover {
	color: red;
	background: #6dd1da;
}

.sub_menu {
	position: relative;
}

.sub_menu li {
	float: none;
	padding: 0
}

.sub_menu li a {
	display: block;
	height: 10px;
	line-height: 10px;
	text-align: center;
	border-bottom: 1px solid #eee;
}

.sub_menu {
	display: none;
}

.menu li:hover .sub_menu {
	display: block;
}

.sub_menu2 {
	display: none;
}

.sub_menu21 {
	position: absolute;
	top: 0px;
	left: 71px;
}

.sub_menu22 {
	position: absolute;
	top: 31px;
	left: 71px;
}

.sub_menu23 {
	position: absolute;
	top: 62px;
	left: 71px;
}

.sub_menu24 {
	position: absolute;
	top: 93px;
	left: 71px;
}

.menu li:hover .sub_menu li:hover .sub_menu2 {
	display: block;
}
</style>
</head>
<body>
	<div class="contain">
		<ul class="menu">
			<li><a href="javascript:;">菜单一</a>
				<div>
					<ul class="sub_menu">
						<li><a href="javascript:;">111111</a>
							<div class="sub_menu2">
								<ul class="sub_menu21">
									<li><a href="javascript:;">111111</a></li>
									<li><a href="javascript:;">222</a></li>
									<li><a href="javascript:;">333</a></li>
									<li><a href="javascript:;">444</a></li>
								</ul>
							</div></li>
						<li><a href="javascript:;">222</a>
							<div class="sub_menu2">
								<ul class="sub_menu22">
									<li><a href="javascript:;">111111</a></li>
									<li><a href="javascript:;">222</a></li>
									<li><a href="javascript:;">333</a></li>
									<li><a href="javascript:;">444</a></li>
								</ul>
							</div></li>
						<li><a href="javascript:;">333</a>
							<div class="sub_menu2">
								<ul class="sub_menu23">
									<li><a href="javascript:;">111111</a></li>
									<li><a href="javascript:;">222</a></li>
									<li><a href="javascript:;">333</a></li>
									<li><a href="javascript:;">444</a></li>
								</ul>
							</div></li>
						<li><a href="javascript:;">444</a>
							<div class="sub_menu2">
								<ul class="sub_menu24">
									<li><a href="javascript:;">111111</a></li>
									<li><a href="javascript:;">222</a></li>
									<li><a href="javascript:;">333</a></li>
									<li><a href="javascript:;">444</a></li>
								</ul>
							</div></li>
					</ul>
				</div></li>
			<li><a href="javascript:;">菜单二</a></li>
			<li><a href="javascript:;">菜单三</a></li>
			<li><a href="javascript:;">菜单四</a></li>
		</ul>
	</div>
</body>
</html>