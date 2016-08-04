<?php
/* Smarty version 3.1.28, created on 2016-08-04 13:36:16
  from "C:\Users\ershov.v\workspace\tecom\3pty\Smarty\demo\templates\footer.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.28',
  'unifunc' => 'content_57a31aa0cfa9e5_02983507',
  'file_dependency' => 
  array (
    '1c233ebc25c0c7769cdc165396cd383ae828348f' => 
    array (
      0 => 'C:\\Users\\ershov.v\\workspace\\tecom\\3pty\\Smarty\\demo\\templates\\footer.tpl',
      1 => 1470225271,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57a31aa0cfa9e5_02983507 ($_smarty_tpl) {
?>
			<footer class="main-footer">
				<div class="pull-right hidden-xs">
					Anything you want
				</div>
			<strong>Copyright &copy; 2016 <a href="#">Company</a>.</strong> All rights reserved.
			</footer>
			<aside class="control-sidebar control-sidebar-dark">
				<ul class="nav nav-tabs nav-justified control-sidebar-tabs">
					<li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
					<li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="control-sidebar-home-tab">
						<h2 class="control-sidebar-heading">Info about employee:</h2>
						<h4 class="control-sidebar-heading"><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</h4>
						<p><h4 class="control-sidebar-heading"><?php echo $_smarty_tpl->tpl_vars['role']->value;?>
</h4></p>
					</div>
					<div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
					<div class="tab-pane" id="control-sidebar-settings-tab">
						<form method="post">
							<h3 class="control-sidebar-heading">General Settings</h3>
							<div class="form-group">
								<label class="control-sidebar-subheading">
									Report panel usage
									<input type="checkbox" class="pull-right" checked>
								</label>
								<p>Some information about this general settings option</p>
							</div>
						</form>
					</div>
				</div>
			</aside>
		</div>
		
		<!-- REQUIRED JS SCRIPTS -->
		
		<?php echo '<script'; ?>
 src="../plugins/jQuery/jquery-2.2.3.min.js"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="../bootstrap/js/bootstrap.min.js"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="../dist/js/app.min.js"><?php echo '</script'; ?>
>

	</body>
</html><?php }
}
