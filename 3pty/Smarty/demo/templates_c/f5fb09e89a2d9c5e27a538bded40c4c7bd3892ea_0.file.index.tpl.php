<?php
/* Smarty version 3.1.28, created on 2016-07-21 16:55:47
  from "C:\Users\ershov.v\workspace\tecom\3pty\Smarty\demo\templates\index.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.28',
  'unifunc' => 'content_5790d463a9ae12_42508017',
  'file_dependency' => 
  array (
    'f5fb09e89a2d9c5e27a538bded40c4c7bd3892ea' => 
    array (
      0 => 'C:\\Users\\ershov.v\\workspace\\tecom\\3pty\\Smarty\\demo\\templates\\index.tpl',
      1 => 1469108557,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
),false)) {
function content_5790d463a9ae12_42508017 ($_smarty_tpl) {
$_smarty_tpl->smarty->ext->configLoad->_loadConfigFile($_smarty_tpl, "test.conf", "setup", 0);
?>

<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>'Start Page'), 0, false);
?>


			<div class="content-wrapper">
				<section class="content-header">
					<div align="center">
						<h1>Start page</h1>
						<ol class="breadcrumb">
							<li class="active">Home</li>
						</ol>
					</div>
				</section>
				<section class="content">
					***************************
				</section>
			</div>
<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
