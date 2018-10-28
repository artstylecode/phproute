<?php ?>
<html>
	<head>
		<title>
			用户列表
		</title>
		<style type="text/css">
			ul,li{list-style: none;}
		</style>
	</head>
	<body>
		<ul>
			<?php foreach ($users as $user) {?>
				
			
			<li><label>用户名：<?=$user["name"]?></label><label>年龄：<?=$user["age"]?></label></li>
		<?php }?>
		</ul>

	</body>
</html>

