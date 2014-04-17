<?php /* Smarty version Smarty-3.1.17, created on 2014-04-17 20:48:14
         compiled from "/Users/aozisik/Documents/MAMP/crust/app/views/home/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:761101999532c6f8b698fa3-28267531%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b3bf357478e86ccc0066e7203b3c7e3b64e0b37a' => 
    array (
      0 => '/Users/aozisik/Documents/MAMP/crust/app/views/home/index.tpl',
      1 => 1397759483,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '761101999532c6f8b698fa3-28267531',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_532c6f8b6b6733_03114096',
  'variables' => 
  array (
    'CRUST_VERSION' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_532c6f8b6b6733_03114096')) {function content_532c6f8b6b6733_03114096($_smarty_tpl) {?>
<h3>Congrats!</h3>

<div class="alert alert-success">Crust Framework <?php echo $_smarty_tpl->tpl_vars['CRUST_VERSION']->value;?>
 is up and running!</div>
<p>
	
	Well, that was effortless, wasn't it? You have just successfully started using Crust Framework<br />
	to build whatever awesome application you have in mind.
</p>

<b>What is Where:</b>

<ul>
	<li>All config is tucked inside <i>app/config.php</i></li>
	<li>This text is in <i>views/home/index.tpl</i></li>
	<li>All stylesheets, javascripts and images are under <i>public/</i></li> 
	<li>Everything is still under app/bootstrap.php</li>
</ul>

</p><?php }} ?>
