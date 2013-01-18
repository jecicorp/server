<!DOCTYPE html>
<html>
	<head>
		<title><?php echo isset($_['application']) && !empty($_['application'])?$_['application'].' | ':'' ?>ownCloud <?php echo OC_User::getUser()?' ('.OC_User::getUser().') ':'' ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="shortcut icon" href="<?php echo image_path('', 'favicon.png'); ?>" /><link rel="apple-touch-icon-precomposed" href="<?php echo image_path('', 'favicon-touch.png'); ?>" />
		<?php foreach($_['cssfiles'] as $cssfile): ?>
			<link rel="stylesheet" href="<?php echo $cssfile; ?>" type="text/css" media="screen" />
		<?php endforeach; ?>
		<script type="text/javascript">
			var oc_debug = <?php echo (defined('DEBUG') && DEBUG) ? 'true' : 'false'; ?>;
			var oc_webroot = '<?php echo OC::$WEBROOT; ?>';
			var oc_appswebroots = <?php echo $_['apps_paths'] ?>;
			var oc_current_user = '<?php echo OC_User::getUser() ?>';
			var oc_requesttoken = '<?php echo $_['requesttoken']; ?>';
			var datepickerFormatDate = <?php echo json_encode($l->l('jsdate', 'jsdate')) ?>;
			var dayNames = <?php echo json_encode(array((string)$l->t('Sunday'), (string)$l->t('Monday'), (string)$l->t('Tuesday'), (string)$l->t('Wednesday'), (string)$l->t('Thursday'), (string)$l->t('Friday'), (string)$l->t('Saturday'))) ?>;
			var monthNames = <?php echo json_encode(array((string)$l->t('January'), (string)$l->t('February'), (string)$l->t('March'), (string)$l->t('April'), (string)$l->t('May'), (string)$l->t('June'), (string)$l->t('July'), (string)$l->t('August'), (string)$l->t('September'), (string)$l->t('October'), (string)$l->t('November'), (string)$l->t('December'))) ?>;
			var firstDay = <?php echo json_encode($l->l('firstday', 'firstday')) ?>;
		</script>
		<?php foreach($_['jsfiles'] as $jsfile): ?>
			<script type="text/javascript" src="<?php echo $jsfile; ?>"></script>
		<?php endforeach; ?>
		<script type="text/javascript">
			requesttoken = '<?php echo $_['requesttoken']; ?>';
			OC.EventSource.requesttoken=requesttoken;
			$(document).bind('ajaxSend', function(elm, xhr, s) {
				xhr.setRequestHeader('requesttoken', requesttoken);
			});
		</script>
		<?php foreach($_['headers'] as $header): ?>
			<?php
				echo '<'.$header['tag'].' ';
				foreach($header['attributes'] as $name=>$value) {
					echo "$name='$value' ";
				};
				echo '/>';
			?>
		<?php endforeach; ?>
	</head>

	<body id="<?php echo $_['bodyid'];?>">
		<header><div id="header">
			<a href="<?php echo link_to('', 'index.php'); ?>" title="" id="owncloud"><img class="svg" src="<?php echo image_path('', 'logo-wide.svg'); ?>" alt="ownCloud" /></a>

			<ul id="settings" class="svg">
				<span id="expand">
					<?php echo OC_User::getUser()?OC_User::getUser():'' ?>
					<img class="svg" src="<?php echo image_path('', 'actions/caret.svg'); ?>" />
				</span>
				<div id="expanddiv" <?php if($_['bodyid'] == 'body-user') echo 'style="display:none;"'; ?>>
				<?php foreach($_['settingsnavigation'] as $entry):?>
					<li>
						<a href="<?php echo $entry['href']; ?>" title="" <?php if( $entry["active"] ): ?> class="active"<?php endif; ?>>
							<img src="<?php echo $entry['icon']; ?>">
							<?php echo $entry['name'] ?>
						</a>
					</li>
				<?php endforeach; ?>
					<li>
						<a id="logout" href="<?php echo link_to('', 'index.php'); ?>?logout=true">
							<img class="svg" alt="<?php echo $l->t('Log out');?>" title="<?php echo $l->t('Log out');  echo OC_User::getUser()?' ('.OC_User::getUser().') ':'' ?>" src="<?php echo image_path('', 'actions/logout.svg'); ?>" /> Log out
						</a>
					</li>
				</div>
			</ul>

			<form class="searchbox" action="#" method="post">
				<input id="searchbox" class="svg" type="search" name="query" value="<?php if(isset($_POST['query'])) {echo OC_Util::sanitizeHTML($_POST['query']);};?>" autocomplete="off" x-webkit-speech />
			</form>
		</div></header>

		<nav><div id="navigation">
			<ul id="apps" class="svg">
				<?php foreach($_['navigation'] as $entry): ?>
					<li data-id="<?php echo $entry['id']; ?>">
						<a href="<?php echo $entry['href']; ?>" title="" <?php if( $entry['active'] ): ?> class="active"<?php endif; ?>>
							<img class="icon" src="<?php echo $entry['icon']; ?>"/>
							<?php echo $entry['name']; ?>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		</div></nav>

		<div id="content-wrapper">
			<div id="content">
				<?php echo $_['content']; ?>
			</div>
		</div>
	</body>
</html>
