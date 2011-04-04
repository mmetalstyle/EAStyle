<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{$title}</title>
<meta name='keywords' content="{$page_keys}" />
<link rel="stylesheet" type="text/css" href="{$templateDir}/css/style.css" />
<link rel="stylesheet" href="{$templateDir}/css/featureCarousel.css" charset="utf-8" />
{$links}
<script src="/include/js/jquery-1.4.4.js" type="text/javascript" charset="utf-8"></script>
<script src="/include/js/jquery-ui-1.8.9.custom.min.js" type="text/javascript"></script>
<script src="/include/js/engine.js" type="text/javascript"></script>
<script src="{$templateDir}/js/jquery.featureCarousel.js" type="text/javascript" charset="utf-8"></script>
</head>

<body>
<div id='mainblock' >

{* top-menu-1 *}
{if $topMenu1}
<div id='top-menu-1'>
{include file='first/top-menu-1.tpl'}
</div>
{/if}

{* header *}
{if $staticHeader}
<div id='static-header'>
{include file='first/header.tpl'}
</div>
{/if}

{* top-menu-2 *}
{if $topMenu2}
<div id='top-menu-2'>
{include file='first/top-menu-2.tpl'}
</div>
{/if}

{* left-menu-1 *}
{if $leftMenu1}
<div id='left-menu-1'>
{include file='first/left-menu-1.tpl'}
</div>
{/if}

{* left-menu-2 *}
{if $leftMenu2}
<div id='left-menu-2'>
{include file='first/left-menu-2.tpl'}
</div>
{/if}

{* block-1 *}
{if $block1}
<div id='block-1'>
{include file='first/block-1.tpl'}
</div>
{/if}

{* content *}
{if $content}
<div id='content'>
{include file='first/content.tpl'}
</div>
{/if}

{* block-2 *}
{if $block2}
<div id='block-2'>
{include file='first/block-2.tpl'}
</div>
{/if}

{* right-menu-1 *}
{if $rightPanel1}
<div id='right-panel-1'>
{include file='first/right-panel-1.tpl'}
</div>
{/if}

{* right-panel-2 *}
{if $rightPanel2}
<div id='right-panel-2'>
{include file='first/right-panel-2.tpl'}
</div>
{/if}

{* block-3 *}
{if $block3}
<div id='block-3'>
{include file='first/block-3.tpl'}
</div>
{/if}

{* bottom-menu-1 *}
{if $bottomMenu1}
<div id='bottom-menu-1'>
{include file='first/bottom-menu-1.tpl'}
</div>
{/if}

{* footer *}
{if $footer}
<div id='footer'>
{include file='first/footer.tpl'}
</div>
{/if}

{* bottom-menu-2 *}
{if $bottomMenu2}
<div id='bottom-menu-2'>
{include file='first/bottom-menu-2.tpl'}
</div>
{/if}












</div>
</body>