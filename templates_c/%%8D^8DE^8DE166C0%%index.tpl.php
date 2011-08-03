<?php /* Smarty version 2.6.26, created on 2011-05-23 23:28:53
         compiled from /home/yuriy/programming/Web/EAStyle/templates/first/index.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->_tpl_vars['title']; ?>
</title>
<meta name='keywords' content="<?php echo $this->_tpl_vars['page_keys']; ?>
" />
<link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['templateDir']; ?>
/css/style.css" />
<link rel="stylesheet" href="<?php echo $this->_tpl_vars['templateDir']; ?>
/css/featureCarousel.css" charset="utf-8" />
<?php echo $this->_tpl_vars['links']; ?>

<script src="/include/js/jquery-1.4.4.js" type="text/javascript" charset="utf-8"></script>
<script src="/include/js/jquery-ui-1.8.9.custom.min.js" type="text/javascript"></script>
<script src="/include/js/engine.js" type="text/javascript"></script>
<script src="<?php echo $this->_tpl_vars['templateDir']; ?>
/js/jquery.featureCarousel.js" type="text/javascript" charset="utf-8"></script>
</head>

<body>
<div id="admin-panel" style=""><?php echo $this->_tpl_vars['login']; ?>
</div>
<div id='mainblock' >

<?php if ($this->_tpl_vars['topMenu1']): ?>
<div id='top-menu-1'>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'first/top-menu-1.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
<?php endif; ?>

<?php if ($this->_tpl_vars['staticHeader']): ?>
<div id='static-header'>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'first/header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
<?php endif; ?>

<?php if ($this->_tpl_vars['topMenu2']): ?>
<div id='top-menu-2'>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'first/top-menu-2.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
<?php endif; ?>

<?php if ($this->_tpl_vars['leftMenu1']): ?>
<div id='left-menu-1'>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'first/left-menu-1.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
<?php endif; ?>

<?php if ($this->_tpl_vars['leftMenu2']): ?>
<div id='left-menu-2'>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'first/left-menu-2.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
<?php endif; ?>

<?php if ($this->_tpl_vars['block1']): ?>
<div id='block-1'>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'first/block-1.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
<?php endif; ?>

<?php if ($this->_tpl_vars['content']): ?>
<div id='content'>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'first/content.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
<?php endif; ?>

<?php if ($this->_tpl_vars['block2']): ?>
<div id='block-2'>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'first/block-2.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
<?php endif; ?>

<?php if ($this->_tpl_vars['rightPanel1']): ?>
<div id='right-panel-1'>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'first/right-panel-1.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
<?php endif; ?>

<?php if ($this->_tpl_vars['rightPanel2']): ?>
<div id='right-panel-2'>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'first/right-panel-2.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
<?php endif; ?>

<?php if ($this->_tpl_vars['block3']): ?>
<div id='block-3'>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'first/block-3.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
<?php endif; ?>

<?php if ($this->_tpl_vars['bottomMenu1']): ?>
<div id='bottom-menu-1'>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'first/bottom-menu-1.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
<?php endif; ?>

<?php if ($this->_tpl_vars['footer']): ?>
<div id='footer'>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'first/footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
<?php endif; ?>

<?php if ($this->_tpl_vars['bottomMenu2']): ?>
<div id='bottom-menu-2'>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'first/bottom-menu-2.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
<?php endif; ?>












</div>
</body>