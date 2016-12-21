<!doctype html>
<html lang="<?php echo I18n::$lang ?>">
    <head>
        <meta charset="utf-8">
        <link rel="shortcut icon" type="image/x-icon" href="/treasure/media/img/icon.ico">
        <title><?php echo $title ?></title>
        <?php foreach ($styles as $file => $type) echo HTML::style($file, array('media' => $type)), PHP_EOL ?>
        <?php foreach ($scripts as $file) echo HTML::script($file), PHP_EOL ?>
		<script type="text/javascript">
			var document_root = '<?php echo Url::site();?>';
		</script>
    </head>
    <body>
	<div class="container" id="admin_container">
    	<div class="span-24 general_bg">
		    <div class="span-24 last " style=" padding-top: 5px;">
                <div class="prepend-23 span-1 last admin_banner">
                    <strong><a href="<?php echo Url::site('');?>" style="text-decoration:none; color: black; font-weight: normal;">Salir</a></strong>
                </div>
		    </div>
				
			<div class="span-24 ">
				<?php echo Helper_Manager_Menu::menu(); ?>
			</div>
		</div>
		<div class="span-24 content">
			<div class="prepend-2 span-20 append-2 line last" id="container-flash-messages" style=" padding-top: 15px;">
				<?php FlashMessenger::factory()->get_messages(); ?>	
			</div>
			<?php echo $content ?>
		</div>
        <div id="spinner"  style="display: none;">
			<div id="ajax_loader"></div>
			<div class="ajax_loader_text">Cargando...</div>
		</div>
	</div>
    </body>
</html>