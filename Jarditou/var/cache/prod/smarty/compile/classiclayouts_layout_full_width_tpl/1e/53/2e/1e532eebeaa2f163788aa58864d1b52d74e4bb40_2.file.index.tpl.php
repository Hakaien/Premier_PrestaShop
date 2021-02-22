<?php
/* Smarty version 3.1.34-dev-7, created on 2021-02-22 10:25:02
  from 'C:\wamp64\www\Cours-PrestaShop\Jarditou\themes\classic\templates\index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_6033786e706c66_10032358',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1e532eebeaa2f163788aa58864d1b52d74e4bb40' => 
    array (
      0 => 'C:\\wamp64\\www\\Cours-PrestaShop\\Jarditou\\themes\\classic\\templates\\index.tpl',
      1 => 1610363806,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6033786e706c66_10032358 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_17668588606033786e6f2055_06288501', 'page_content_container');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, 'page.tpl');
}
/* {block 'page_content_top'} */
class Block_3000610576033786e6f4806_63467141 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'page_content_top'} */
/* {block 'hook_home'} */
class Block_7821052996033786e6faaa5_39465737 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

            <?php echo $_smarty_tpl->tpl_vars['HOOK_HOME']->value;?>

          <?php
}
}
/* {/block 'hook_home'} */
/* {block 'page_content'} */
class Block_11235086896033786e6f83d6_83762968 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_7821052996033786e6faaa5_39465737', 'hook_home', $this->tplIndex);
?>

        <?php
}
}
/* {/block 'page_content'} */
/* {block 'page_content_container'} */
class Block_17668588606033786e6f2055_06288501 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'page_content_container' => 
  array (
    0 => 'Block_17668588606033786e6f2055_06288501',
  ),
  'page_content_top' => 
  array (
    0 => 'Block_3000610576033786e6f4806_63467141',
  ),
  'page_content' => 
  array (
    0 => 'Block_11235086896033786e6f83d6_83762968',
  ),
  'hook_home' => 
  array (
    0 => 'Block_7821052996033786e6faaa5_39465737',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <section id="content" class="page-home">
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_3000610576033786e6f4806_63467141', 'page_content_top', $this->tplIndex);
?>


        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_11235086896033786e6f83d6_83762968', 'page_content', $this->tplIndex);
?>

      </section>
    <?php
}
}
/* {/block 'page_content_container'} */
}
