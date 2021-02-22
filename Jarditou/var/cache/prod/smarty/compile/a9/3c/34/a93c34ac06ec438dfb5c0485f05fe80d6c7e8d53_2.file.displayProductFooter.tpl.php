<?php
/* Smarty version 3.1.34-dev-7, created on 2021-02-22 16:11:59
  from 'C:\wamp64\www\Cours-PrestaShop\Jarditou\modules\mymodecomments\views\templates\hook\displayProductFooter.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_6033c9bf0009f0_93179567',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a93c34ac06ec438dfb5c0485f05fe80d6c7e8d53' => 
    array (
      0 => 'C:\\wamp64\\www\\Cours-PrestaShop\\Jarditou\\modules\\mymodecomments\\views\\templates\\hook\\displayProductFooter.tpl',
      1 => 1613324386,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6033c9bf0009f0_93179567 (Smarty_Internal_Template $_smarty_tpl) {
?><h4 class="page-product-heading">Les commentaires sur le produit</h4>
<div class="rte">

    <div class="rte">
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['comments']->value, 'comment');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['comment']->value) {
?>
        <p>
            <strong>Commentaire #<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['comment']->value['id_mymod_comment'], ENT_QUOTES, 'UTF-8');?>
:</strong>
            <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['comment']->value['comment'], ENT_QUOTES, 'UTF-8');?>
<br>
            <strong>Note:</strong> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['comment']->value['grade'], ENT_QUOTES, 'UTF-8');?>
/5<br>
        </p><br>
    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </div>

<?php if ($_smarty_tpl->tpl_vars['enable_grades']->value == 1 || $_smarty_tpl->tpl_vars['enable_comments']->value == 1) {?>
    <form action="" method="POST" id="comment-form">
    <?php if ($_smarty_tpl->tpl_vars['enable_grades']->value == 1) {?>
        <div class="form-group">
            <label for="grade">Note:</label>
            <div class="row">
                <div class="col-xs-4">
                    <select id="grade" class="form-control"
                            name="grade">
                        <option value="0">-- Choississez --</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
            </div>
        </div>
    <?php }?>
    <?php if ($_smarty_tpl->tpl_vars['enable_comments']->value == 1) {?>
        <div class="form-group">
            <label for="comment">Commentaire:</label>
            <textarea name="comment" id="comment" class="form-control"></textarea>
        </div>
    <?php }?>
        <div class="submit">
            <button type="submit"
                    name="mymod_pc_submit_comment"
                    class="button btw btn-default button-medium">
         <span>Envoyer
           <i class="icon-chevron-right right"></i>
         </span>
            </button>
        </div>
    </form>
<?php }?>

</div>



<?php }
}
