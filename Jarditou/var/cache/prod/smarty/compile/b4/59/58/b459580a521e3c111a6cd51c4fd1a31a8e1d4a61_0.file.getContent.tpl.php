<?php
/* Smarty version 3.1.34-dev-7, created on 2021-02-22 16:11:40
  from 'C:\wamp64\www\Cours-PrestaShop\Jarditou\modules\mymodecomments\views\templates\hook\getContent.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_6033c9ac7a2207_67965538',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b459580a521e3c111a6cd51c4fd1a31a8e1d4a61' => 
    array (
      0 => 'C:\\wamp64\\www\\Cours-PrestaShop\\Jarditou\\modules\\mymodecomments\\views\\templates\\hook\\getContent.tpl',
      1 => 1525681520,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6033c9ac7a2207_67965538 (Smarty_Internal_Template $_smarty_tpl) {
if (isset($_smarty_tpl->tpl_vars['confirmation']->value)) {?>
    <div class="alert alert-success">La configuration a bien été mise à jour</div>
<?php }?>

<form method="post" action="" class="defaultForm form-horizontal">
    <div class="panel">
        <div class="panel-heading">
            <i class="icon-cogs"></i> La configuration de mon module
        </div>
        <div class="form-wrapper">
            <div class="form-group">
                <label class="control-label col-lg-3">Activer les notes :</label>
                <div class="col-lg-9">
                    <img src="../img/admin/enabled.gif" alt="" />
                    <input type="radio" id="enable_grades_1" name="enable_grades" value="1" <?php if ($_smarty_tpl->tpl_vars['enable_grades']->value == '1') {?>checked<?php }?> />
                    <label class="t" for="enable_grades_1">Oui</label>
                    <img src="../img/admin/disabled.gif" alt="" />
                    <input type="radio" id="enable_grades_0" name="enable_grades" value="0" <?php if ($_smarty_tpl->tpl_vars['enable_grades']->value != '1') {?>checked<?php }?> />
                    <label class="t" for="enable_grades_0">Non</label>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-lg-3">Activer les commentaires :</label>
                <div class="col-lg-9">
                    <img src="../img/admin/enabled.gif" alt="" />
                    <input type="radio" id="enable_comments_1" name="enable_comments" value="1" <?php if ($_smarty_tpl->tpl_vars['enable_comments']->value == '1') {?>checked<?php }?> />
                    <label class="t" for="enable_comments_1">Oui</label>
                    <img src="../img/admin/disabled.gif" alt="" />
                    <input type="radio" id="enable_comments_0" name="enable_comments" value="0" <?php if ($_smarty_tpl->tpl_vars['enable_comments']->value != '1') {?>checked<?php }?> />
                    <label class="t" for="enable_comments_0">Non</label>
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <button class="btn btn-default pull-right" name="submit_mymodcomments_form" value="1" type="submit">
                <i class="process-icon-save"></i> Enregistrer
            </button>
        </div>
    </div>
</form>




<?php }
}
