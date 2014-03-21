<?php /* Smarty version Smarty-3.1.17, created on 2014-03-21 02:59:20
         compiled from "/Users/aozisik/Documents/MAMP/crust/app/views/layouts/default.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1889513835532b8c54ca0c48-89664117%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7c4b1a70cec88a3c1a53856ce2f0e439e015193c' => 
    array (
      0 => '/Users/aozisik/Documents/MAMP/crust/app/views/layouts/default.tpl',
      1 => 1395367159,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1889513835532b8c54ca0c48-89664117',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_532b8c54ca21a3_50412531',
  'variables' => 
  array (
    'yield' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_532b8c54ca21a3_50412531')) {function content_532b8c54ca21a3_50412531($_smarty_tpl) {?><?php if (!is_callable('smarty_function_css')) include '/Users/aozisik/Documents/MAMP/crust/libs/templating/smarty/plugins/function.css.php';
?><!doctype html>
<html lang="en">
<head>
	<meta http-equiv="Content-type:text/html;charset=utf-8" />
	<title>Crust Framework</title>
	<?php echo smarty_function_css(array('href'=>"bootstrap.css"),$_smarty_tpl);?>

	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div class="container">
<h1>Crust Framework</h1>
<hr />


	<?php echo $_smarty_tpl->tpl_vars['yield']->value;?>


</div>	
</body>
</html><?php }} ?>
