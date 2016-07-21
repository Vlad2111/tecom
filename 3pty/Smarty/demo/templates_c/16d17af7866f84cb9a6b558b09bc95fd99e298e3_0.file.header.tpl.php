<?php
/* Smarty version 3.1.28, created on 2016-07-21 16:55:47
  from "C:\Users\ershov.v\workspace\tecom\3pty\Smarty\demo\templates\header.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.28',
  'unifunc' => 'content_5790d463af8a38_73983669',
  'file_dependency' => 
  array (
    '16d17af7866f84cb9a6b558b09bc95fd99e298e3' => 
    array (
      0 => 'C:\\Users\\ershov.v\\workspace\\tecom\\3pty\\Smarty\\demo\\templates\\header.tpl',
      1 => 1469106200,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5790d463af8a38_73983669 ($_smarty_tpl) {
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Tecomgroup | <?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
		<link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
		<link rel="stylesheet" href="../dist/css/skins/skin-blue.min.css">
		<!--[if lt IE 9]>
			<?php echo '<script'; ?>
 src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"><?php echo '</script'; ?>
>
			<?php echo '<script'; ?>
 src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"><?php echo '</script'; ?>
>
		<![endif]-->
	</head>
	<body class="hold-transition skin-blue layout-top-nav">
		<div class="wrapper">
			<header class="main-header">
				<nav class="navbar navbar-static-top">
					<div class="container">
						<div class="navbar-header">
							<a href="http://www.tecomgroup.com/" class="navbar-brand"><b>Tecom</b>group</a>
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
								<i class="fa fa-bars"></i>
							</button>
						</div>
						<?php if ($_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'role') == 'admin') {?>
							<div class="collapse navbar-collapse pull-left" id="navbar-collapse">
								<ul class="nav navbar-nav">
									<li class="dropdown">
										<a class="dropdown-toggle" data-toggle="dropdown">Admin<span class="caret"></span></a>
										<ul class="dropdown-menu" role="menu">
											<li><b>Role:</b></li>
											<li><a href="#">New Role</a></li>
											<li><a href="#">Change Role</a></li>
											<li><a href="#">Delete Role</a></li>
										</ul>
									</li>
								</ul>
							</div>
						<?php }?>
						<div class="navbar-custom-menu">
							<ul class="nav navbar-nav">
								<li>
									<a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
								</li>
							</ul>
						</div>
					</div> 
				</nav>
			</header><?php }
}
