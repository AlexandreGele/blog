<?php /* Smarty version Smarty-3.1.12, created on 2013-01-22 13:29:31
         compiled from "templates/index.phtml" */ ?>
<?php /*%%SmartyHeaderCode:12495709850fd41987ad743-16745053%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '08faf69b271b86f72f89a09ab87fd855a7c9fe9e' => 
    array (
      0 => 'templates/index.phtml',
      1 => 1358857757,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12495709850fd41987ad743-16745053',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_50fd419894ebf2_43431621',
  'variables' => 
  array (
    'articles' => 0,
    'article' => 0,
    'connecte' => 0,
    'page' => 0,
    'rech' => 0,
    'nb_pages' => 0,
    'i' => 0,
    'rech_encode' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50fd419894ebf2_43431621')) {function content_50fd419894ebf2_43431621($_smarty_tpl) {?> <html>
	<head>
		
	</head>
	<body>
			<?php  $_smarty_tpl->tpl_vars['article'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['article']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['articles']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['article']->key => $_smarty_tpl->tpl_vars['article']->value){
$_smarty_tpl->tpl_vars['article']->_loop = true;
?>
				<h3><?php echo $_smarty_tpl->tpl_vars['article']->value['titre'];?>
</h3>
					<p><?php echo $_smarty_tpl->tpl_vars['article']->value['texte'];?>
</p>
                    <img src="img/vign/<?php echo $_smarty_tpl->tpl_vars['article']->value['id'];?>
.jpg">
					 ecrit le : <?php echo $_smarty_tpl->tpl_vars['article']->value['date'];?>

					
				<?php if (($_smarty_tpl->tpl_vars['connecte']->value)){?>
					<br><br>
					<a href="article.php?id=<?php echo $_smarty_tpl->tpl_vars['article']->value['id'];?>
" class="btn btn-primary">Modifier</a>
					<a href="supprimer-article.php?id=<?php echo $_smarty_tpl->tpl_vars['article']->value['id'];?>
" class="btn btn-danger"> Supprimer</a>  
				 
				<?php }?>
				
				<hr>
			<?php } ?>
			
			<div class="pagination">
				<ul>
					<li class="prev<?php if ($_smarty_tpl->tpl_vars['page']->value<=1){?> disabled<?php }?>">
						<a href="<?php if ($_smarty_tpl->tpl_vars['page']->value<=1){?>#null<?php }else{ ?>?p=<?php echo $_smarty_tpl->tpl_vars['page']->value-1;?>
<?php }?>&r=<?php echo $_smarty_tpl->tpl_vars['rech']->value;?>
">&larr;Precedent</a>
					</li> <!-- reprensente des "left-arrow" -->
									
					<?php $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int)ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? $_smarty_tpl->tpl_vars['nb_pages']->value+1 - (1) : 1-($_smarty_tpl->tpl_vars['nb_pages']->value)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0){
for ($_smarty_tpl->tpl_vars['i']->value = 1, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++){
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration == 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration == $_smarty_tpl->tpl_vars['i']->total;?><!-- On boucle jusqu a l'avant dernier page-->
						<li<?php if ($_smarty_tpl->tpl_vars['page']->value==$_smarty_tpl->tpl_vars['i']->value){?> class="active"<?php }?>>
							<a href="?p=<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
&r=<?php echo $_smarty_tpl->tpl_vars['rech']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['i']->value;?>
</a>
						</li>						
					<?php }} ?><!-- On arrete de boucler --> 
					<?php echo $_smarty_tpl->tpl_vars['rech_encode']->value;?>

					<li class="next<?php if ($_smarty_tpl->tpl_vars['page']->value>=$_smarty_tpl->tpl_vars['nb_pages']->value){?> disabled<?php }?>">
						<a href="<?php if ($_smarty_tpl->tpl_vars['page']->value>=$_smarty_tpl->tpl_vars['nb_pages']->value){?>#null<?php }else{ ?>?p=<?php echo $_smarty_tpl->tpl_vars['page']->value+1;?>
<?php }?>&r=<?php echo $_smarty_tpl->tpl_vars['rech']->value;?>
">Suivant&rarr;</a>
					</li>
				</ul>
			</div>			
	</body>
</html>
<?php }} ?>