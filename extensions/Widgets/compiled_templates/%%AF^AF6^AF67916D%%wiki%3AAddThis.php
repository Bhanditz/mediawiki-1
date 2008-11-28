<?php /* Smarty version 2.6.18-dev, created on 2008-11-28 21:24:59
         compiled from wiki:AddThis */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'wiki:AddThis', 5, false),)), $this); ?>

<!-- AddThis Button BEGIN -->
<script type="text/javascript">var addthis_pub  = "Steren";</script>

<a href="http://www.addthis.com/bookmark.php" onmouseover="return addthis_open(this, '', '<?php echo ((is_array($_tmp=$this->_tpl_vars['page_url'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'quotes') : smarty_modifier_escape($_tmp, 'quotes')); ?>
', '<?php echo ((is_array($_tmp=$this->_tpl_vars['page_name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'quotes') : smarty_modifier_escape($_tmp, 'quotes')); ?>
')" onmouseout="addthis_close()" onclick="return addthis_sendto()"><img src="http://s7.addthis.com/button1-share.gif" width="125" height="16" border="0" alt="" /></a>

<!-- AddThis Rollover BEGIN -->
<script type="text/javascript">
addthis_pub     = '<?php echo ((is_array($_tmp=$this->_tpl_vars['account_id'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'quotes') : smarty_modifier_escape($_tmp, 'quotes')); ?>
';
addthis_logo    = '<?php echo ((is_array($_tmp=$this->_tpl_vars['logo_url'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'quotes') : smarty_modifier_escape($_tmp, 'quotes')); ?>
';
addthis_logo_color = '<?php echo ((is_array($_tmp=$this->_tpl_vars['logo_color'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'quotes') : smarty_modifier_escape($_tmp, 'quotes')); ?>
';
addthis_logo_background = '<?php echo ((is_array($_tmp=$this->_tpl_vars['logo_background'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'quotes') : smarty_modifier_escape($_tmp, 'quotes')); ?>
';
addthis_brand   = '<?php echo ((is_array($_tmp=$this->_tpl_vars['brand'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'quotes') : smarty_modifier_escape($_tmp, 'quotes')); ?>
';
addthis_options = '<?php echo ((is_array($_tmp=$this->_tpl_vars['options'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'quotes') : smarty_modifier_escape($_tmp, 'quotes')); ?>
';
</script><script type="text/javascript" src="http://s7.addthis.com/js/152/addthis_widget.js"></script>
<!-- AddThis Rollover END -->
<!-- AddThis Button END -->