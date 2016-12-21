<!doctype html>
<html lang="<?php echo I18n::$lang ?>">
    <head>
        <link rel="shortcut icon" type="image/x-icon" href="/treasure/media/img/icon.ico">
        <meta charset="utf-8">
        <title><?php echo $title ?></title>
        <?php foreach ($styles as $file => $type) echo HTML::style($file, array('media' => $type)), PHP_EOL ?>
        <?php foreach ($scripts as $file) echo HTML::script($file), PHP_EOL ?>
    </head>
    <body>
		<div class="container">
			<div class="span-24 content_container">
				<div class="span-24 content">
					<div class="prepend-10 span-12">
						<div class="span-12 login">&nbsp;</div>
					</div>
					<div class="span-24 ">
						<?php echo $content ?>
					</div>
				</div>
			</div>
		</div>
    </body>
</html>