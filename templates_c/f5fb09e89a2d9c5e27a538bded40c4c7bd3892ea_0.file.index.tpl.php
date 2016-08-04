<?php
/* Smarty version 3.1.28, created on 2016-08-04 13:36:16
  from "C:\Users\ershov.v\workspace\tecom\3pty\Smarty\demo\templates\index.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.28',
  'unifunc' => 'content_57a31aa0c5e626_22170603',
  'file_dependency' => 
  array (
    'f5fb09e89a2d9c5e27a538bded40c4c7bd3892ea' => 
    array (
      0 => 'C:\\Users\\ershov.v\\workspace\\tecom\\3pty\\Smarty\\demo\\templates\\index.tpl',
      1 => 1470142486,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:3pty/Smarty/demo/templates/header.tpl' => 1,
    'file:3pty/Smarty/demo/templates/footer.tpl' => 1,
  ),
),false)) {
function content_57a31aa0c5e626_22170603 ($_smarty_tpl) {
ob_start();
echo ((string)$_smarty_tpl->tpl_vars['title']->value);
$_tmp1=ob_get_clean();
$_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:3pty/Smarty/demo/templates/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>$_tmp1), 0, false);
?>

<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, $_smarty_tpl->tpl_vars['contentPage']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:3pty/Smarty/demo/templates/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
