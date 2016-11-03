<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}

if (strpos($_SERVER['HTTP_REFERER'], 'page=bilnea') === false) {
	$var_options = get_option('bilnea_settings');
	$var_options['tab'] = 1;
	update_option('bilnea_settings', $var_options);
}


// Página de administración

function b_f_options_page() {

	// Variables globales
	global $b_g_version;

	// Variables locales
	$var_dir = get_template_directory_uri();

	?>

	<script type="text/javascript">
		var img_url = '<?php echo $var_dir; ?>/img/icono-imagen.png';
	</script>
	
	<form action="options.php" method="post" id="bilnea">

		<!-- Otras oociones -->
		<input type="hidden" value="<?= b_f_option('b_opt_newsl_list') ?>" name="bilnea_settings[b_opt_newsl_list]" />

		<h2>Opciones del tema</h2>
		<div id="bilset">

			<!-- Bloque lateral -->
			<div class="lateral">
				<h3 <?php if (b_f_option('tab') === null || b_f_option('tab') == 1) { echo 'class="active"'; }?>>Opciones Generales</h3>
				<h3 <?php if (b_f_option('tab') == 2) { echo 'class="active"'; }?>>Desarrollo</h3>
				<h3 <?php if (b_f_option('tab') == 3) { echo 'class="active"'; }?>>Estilos tipográficos</h3>
				<h3 <?php if (b_f_option('tab') == 4) { echo 'class="active"'; }?>>Adaptación responsive</h3>
				<h3 <?php if (b_f_option('tab') == 5) { echo 'class="active"'; }?>>Logotipo e iconos</h3>
				<h3 <?php if (b_f_option('tab') == 6) { echo 'class="active"'; }?>>Cabecera</h3>
				<h3 <?php if (b_f_option('tab') == 7) { echo 'class="active"'; }?>>Pie de página</h3>
				<h3 <?php if (b_f_option('tab') == 8) { echo 'class="active"'; }?>>Blog</h3>
				<?php
				if (function_exists('icl_object_id')) {
				?>
				<h3 <?php if (b_f_option('tab') == 9) { echo 'class="active"'; }?>>Multidioma</h3>
				<?php
				}
				?>
				<h3 <?php if (b_f_option('tab') == 10) { echo 'class="active"'; }?>>Textos legales</h3>
				<h3 <?php if (b_f_option('tab') == 11) { echo 'class="active"'; }?>>Redirecciones y SEO</h3>
				<h3 <?php if (b_f_option('tab') == 12) { echo 'class="active"'; }?>>Ayuda</h3>
				<h3 <?php if (b_f_option('tab') == 13) { echo 'class="active"'; }?>>Créditos</h3>
			</div>

			<!-- Bloque central -->
			<div class="central">

				<!-- Opciones Generales -->
				<div <?php if (!isset($opt['tab']) || $opt['tab'] == 1) { echo 'class="active"'; }?> id="tab1">
					<?php include('panel/panel.general.php'); ?>
				</div>

				<!-- Opciones Generales -->
				<div <?php if ($opt['tab'] == 2) { echo 'class="active"'; }?> id="tab2">
					<?php include('panel/panel.development.php'); ?>
				</div>

				<!-- Estilos tipográficos -->
				<div <?php if ($opt['tab'] == 3) { echo 'class="activo"'; }?> id="tab3">
					<?php include('panel/panel.fonts.php'); ?>
				</div>

				<!-- Adaptación responsive -->
				<div <?php if ($opt['tab'] == 4) { echo 'class="activo"'; }?> id="tab4">
					<?php include('panel/panel.responsive.php'); ?>
				</div>

				<!-- Logotipo e iconos -->
				<div <?php if ($opt['tab'] == 5) { echo 'class="activo"'; }?> id="tab5">
					<?php include('panel/panel.images.php'); ?>
				</div>

				<!-- Cabecera -->
				<div <?php if ($opt['tab'] == 6) { echo 'class="activo"'; }?> id="tab6">
					<?php include('panel/panel.header.php'); ?>
				</div>

				<!-- Pie de página -->
				<div <?php if ($opt['tab'] == 7) { echo 'class="activo"'; }?> id="tab7">
					<?php include('panel/panel.footer.php'); ?>
				</div>

				<!-- Blog -->
				<div <?php if ($opt['tab'] == 8) { echo 'class="activo"'; }?> id="tab8">
					<?php include('panel/panel.blog.php'); ?>
				</div>

				<!-- Multidioma -->
				<?php if (function_exists('icl_object_id')) { ?>
					<div <?php if ($opt['tab'] == 9) { echo 'class="activo"'; }?> id="tab9">
						<?php include('panel/panel.language.php'); ?>
					</div>
				<?php } ?>

				<!-- Textos legales -->
				<div <?php if ($opt['tab'] == 10) { echo 'class="activo"'; } ?> id="tab10">
					<?php include('panel/panel.legal.php'); ?>
				</div>

				<!-- Redirecciones y SEO -->
				<div <?php if ($opt['tab'] == 11) { echo 'class="activo"'; } ?> id="tab11">
					<?php include('panel/panel.seo.php'); ?>
				</div>

				<!-- Ayuda -->
				<div <?php if ($opt['tab'] == 11) { echo 'class="activo"'; } ?> id="tab11">
					<?php include('panel/panel.help.php'); ?>
				</div>

				<!-- Créditos -->
				<div <?php if ($opt['tab'] == 11) { echo 'class="activo"'; } ?> id="tab11">
					<?php include('panel/panel.credits.php'); ?>
				</div>

			</div>
		</div>
		<input type="hidden" id="tab" name="bilnea_settings[tab]" value="<?= b_f_option('tab'); ?>">
		
		<?php

		settings_fields('pluginPage');
		do_settings_sections('pluginPage');
		submit_button();

		?>
		
	</form>

	<?php
	
}

function bilnea_subscribers_page() {
	if (b_f_option('b_opt_newsl_service') == 'wordpress') {
		$b_s_url = explode('?', $_SERVER['REQUEST_URI'], 2)[0];
		(isset($_GET['order']) && $_GET['order'] == 'asc') ? $order = 'des' : $order = 'asc';
		if (isset($_GET['orderby'])) {
			$sorts = array('b_s_date' => 'sortable asc', 'b_s_email' => 'sortable asc', 'b_s_name' => 'sortable asc', 'b_s_last_name' => 'sortable asc');
			$sorts[$_GET['orderby']] = 'sorted '.$order;
		}
		?>
		<div class="wrap">
			<h1>Boletín de noticias</h1>
			<table class="wp-list-table widefat fixed striped pages">
				<thead>
					<tr>
						<td id="cb" class="manage-column column-cb check-column">
							<label class="screen-reader-text" for="cb-select-all-1">Seleccionar todos</label>
							<input id="cb-select-all-1" type="checkbox">
						</td>
						<th style="width: 30px;"></th>
						<th scope="col" id="b_s_date" class="manage-column column-title <?= $sorts['b_s_date'] ?>">
							<a href="<?= 'http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$b_s_url}" ?>?page=subscribers&orderby=b_s_date&order=<?= $order ?>">
								<span>Fecha</span>
								<span class="sorting-indicator"></span>
							</a>
						</th>
						<th scope="col" id="b_s_email" class="manage-column column-title <?= $sorts['b_s_email'] ?>">
							<a href="<?= 'http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$b_s_url}" ?>?page=subscribers&orderby=email&order=<?= $order ?>">
								<span>Correo electrónico</span>
								<span class="sorting-indicator"></span>
							</a>
						</th>
						<th scope="col" id="b_s_name" class="manage-column column-title <?= $sorts['b_s_name'] ?>">
							<a href="<?= 'http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$b_s_url}" ?>?page=subscribers&orderby=name&order=<?= $order ?>">
								<span>Nombre</span>
								<span class="sorting-indicator"></span>
							</a>
						</th>
						<th scope="col" id="b_s_last_name" class="manage-column column-title <?= $sorts['b_s_last_name'] ?>">
							<a href="<?= 'http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$b_s_url}" ?>?page=subscribers&orderby=last_name&order=<?= $order ?>">
								<span>Apellidos</span>
								<span class="sorting-indicator"></span>
							</a>
						</th>
						<th style="width: 30px;">
						</th>
					</tr>
				</thead>
				<tbody>
					<?php
					global $wpdb;
					$table = $wpdb->prefix.'subscribers';
					if (isset($_GET['post_id']) && isset($_GET['visibility'])) {
						$wpdb->update($table, array('active' => $_GET['visibility']), array('id' => $_GET['post_id']));
					}
					$subs = $wpdb->get_results('SELECT * FROM '.$table, ARRAY_A);
					foreach ($subs as $subscriber) {
						?>
						<tr id="subscriber-<?= $subscriber['id'] ?>" class="iedit author-self level-0 post-<?= $subscriber['id'] ?> status-publish hentry">
							<th scope="row" class="check-column">
								<label class="screen-reader-text" for="cb-select-<?= $subscriber['id'] ?>">Elige suscriptor</label>
								<input id="cb-select-<?= $subscriber['id'] ?>" type="checkbox" name="post[]" value="<?= $subscriber['id'] ?>">
								<div class="locked-indicator"></div>
							</th>
							<th scope="row" class="check-column-2" style="text-align: center;">
								<?php
								$gets = array();
								$temps = explode('&', explode('?', $_SERVER['REQUEST_URI'], 2)[1]);
								foreach ($temps as $temp) {
									$args = explode('=', $temp);
									$gets[$args[0]] = $args[1];
								}
								$gets['post_id'] = $subscriber['id'];
								if ($subscriber['active'] == 1) {
									$gets['visibility'] = 0;
								?>
									<a href="<?= 'http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$b_s_url}" ?>?<?= http_build_query($gets) ?>"><span class="dashicons dashicons-visibility"></span></a>
								<?php
								} else {
									$gets['visibility'] = 1;
								?>
									<a href="<?= 'http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$b_s_url}" ?>?<?= http_build_query($gets) ?>"><span class="dashicons dashicons-hidden"></span></a>
								<?php
								}
								?>
							</th>
							<td class="date column-date" data-colname="Fecha">
								<?= $subscriber['date'] ?>
							</td>
							<td class="title column-email has-row-actions column-primary page-title" data-colname="Correo electrónico">
								<a class="row-email" href="mailto:<?= $subscriber['email'] ?>"><?= $subscriber['email'] ?></a>
							</td>
							<td class="date column-date" data-colname="Nombre">
								<?= $subscriber['name'] ?>
							</td>
							<td class="date column-date" data-colname="Apellidos">
								<?= $subscriber['last_name'] ?>
							</td>
							<td style="text-align: center;">

								<a href="<?= 'http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$b_s_url}" ?>?<?= http_build_query($gets) ?>">
									<span class="dashicons dashicons-trash"></span>
								</a>
							</td>
						</tr>
						<?php
					}
					?>
				</tbody>
			</table>
		</div>
	<?php
	} else if (b_f_option('b_opt_newsl_service') == 'benchmark') {
		if (isset($_POST['list_selector'])) {
			$options = get_option('bilnea_settings');
			$options['b_opt_newsl_list'] = $_POST['list_selector'];
			update_option('bilnea_settings', $options);
		}
		$b_s_url = explode('?', $_SERVER['REQUEST_URI'], 2)[0];
		include_once( ABSPATH.WPINC.'/class-IXR.php');
		$client = new IXR_Client( 'https://api.benchmarkemail.com/1.3', false, 443, 20);
		$args = array('login', b_f_option('b_opt_newsl_username'), b_f_option('b_opt_newsl_password'));
		call_user_func_array(array($client, 'query'), $args);
		$token = $client->getResponse();
		if (isset($_GET['delete'])) {
			$args = array('listDeleteContacts', $token, $_GET['list'], $_GET['delete']);
			call_user_func_array(array($client, 'query'), $args);
		}
		(isset($_GET['paged'])) ? $paged = $_GET['paged']  : $paged = 1;
		(isset($_GET['view'])) ? $view = $_GET['view']  : $view = 50;
		$args = array('listGet', $token, '', 1, 1000, 'name', 'asc');
		call_user_func_array(array($client, 'query'), $args);
		$lists = $client->getResponse();
		if (count($lists) > 0) {
			(isset($_GET['list'])) ? $c = $_GET['list'] : $c = $lists[0]['id'];
			?>
			<div class="wrap">
				<h1>Boletín de noticias</h1>
				<ul class="subsubsub" style="float: none;">
					<?php
						$i = 1;
						foreach ($lists as $list) {
							$gets = array();
							$temps = explode('&', explode('?', $_SERVER['REQUEST_URI'], 2)[1]);
							foreach ($temps as $temp) {
								$args = explode('=', $temp);
								$gets[$args[0]] = $args[1];
							}
							$gets['list'] = $list['id'];
							?>
							<li class="list-<?= $list['id'] ?>">
								<a href="<?= 'http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$b_s_url}" ?>?<?= http_build_query($gets) ?>"<?= ($list['id'] == $c) ? ' class="current"' : '' ?>><?= $list['listname'] ?> <span class="count">(<?= $list['contactcount'] ?>)</span></a><?= ($i == count($lists)) ? '' : ' |' ?>
							</li>
							<?php
							$i++;
						}
						(isset($_GET['order']) && $_GET['order'] == 'asc') ? $order = 'des' : $order = 'asc';
						$sorts = array('date' => 'sorted '.$order, 'email' => 'sortable '.$order);
						$orderby = 'date';
						if (isset($_GET['orderby'])) {
							$sorts[$_GET['orderby']] = 'sorted '.$order;
							$orderby = $_GET['orderby'];
						}
					?>
				</ul>
				<div>
					<?php
					$args = array('listGet', $token, '', 1, 1000, 'name', 'asc');
					call_user_func_array(array($client, 'query'), $args);
					$lists = $client->getResponse();
					?>
					<label>Lista por defecto: </label>
					<form action="#" method="post" name="list_form">
						<select id="list_selector" name="list_selector">
							<option selected disabled>Selecciona una lista</option>
							<?php
							foreach ($lists as $list) {
								(b_f_option('b_opt_newsl_list') == $list['id']) ? $seld = ' selected="selected"' : $seld = '';
								echo '<option value="'.$list['id'].'"'.$seld.'>'.$list['listname'].'</option>';
							}
							?>
						</select>
					</form>
					<script type="text/javascript">
						jQuery(function() {
							jQuery('#list_selector').change(function() {
								this.form.submit();
							})
						})
					</script>
				</div>
				<table class="wp-list-table widefat fixed striped pages">
				<thead>
					<tr>
						<td id="cb" class="manage-column column-cb check-column">
							<label class="screen-reader-text" for="cb-select-all-1">Seleccionar todos</label>
							<input id="cb-select-all-1" type="checkbox">
						</td>
						<th scope="col" id="b_s_date" class="manage-column column-title <?= $sorts['date'] ?>">
							<a href="<?= 'http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$b_s_url}" ?>?list=<?= $c ?>&page=subscribers&orderby=date&order=<?= $order ?>">
								<span>Fecha</span>
								<span class="sorting-indicator"></span>
							</a>
						</th>
						<th scope="col" id="b_s_email" class="manage-column column-title <?= $sorts['email'] ?>">
							<a href="<?= 'http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$b_s_url}" ?>?list=<?= $c ?>&page=subscribers&orderby=email&order=<?= $order ?>">
								<span>Correo electrónico</span>
								<span class="sorting-indicator"></span>
							</a>
						</th>
						<th scope="col" id="b_s_name" class="manage-column column-title <?= $sorts['b_s_name'] ?>">
							<span>Nombre</span>
						</th>
						<th scope="col" id="b_s_last_name" class="manage-column column-title <?= $sorts['b_s_last_name'] ?>">
							<span>Apellidos</span>
						</th>
						<th style="width: 30px;">
						</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$args = array('listGetContactsAllFields', $token, $c, '', (int)$paged, (int)$view, $orderby, $order);
					call_user_func_array(array($client, 'query'), $args);
					$lists = $client->getResponse();
					foreach ($lists as $list) {
						?>
						<tr id="subscriber-<?= $list['id'] ?>" class="iedit author-self level-0 post-<?= $list['id'] ?> status-publish hentry">
							<th scope="row" class="check-column">
								<label class="screen-reader-text" for="cb-select-<?= $list['id'] ?>">Elige suscriptor</label>
								<input id="cb-select-<?= $list['id'] ?>" type="checkbox" name="post[]" value="<?= $list['id'] ?>">
								<div class="locked-indicator"></div>
							</th>
							<td class="date column-date" data-colname="Fecha">
								<?php
								$date = explode(' ', $list['timestamp']);
								$months = array('Jan' => 'enero',
												'Feb' => 'febrero',
												'Mar' => 'marzo',
												'Apr' => 'abril',
												'May' => 'mayo',
												'Jun' => 'junio',
												'Jul' => 'julio',
												'Aug' => 'agosto',
												'Sep' => 'septiembre',
												'Oct' => 'octubre',
												'Nov' => 'noviembre',
												'Dec' => 'diciembre'
												);
								echo str_replace(',', '', $date[1]).' '.$months[$date[0]].' '.$date[2];
								?>
							</td>
							<td class="title column-email has-row-actions column-primary page-title" data-colname="Correo electrónico">
								<a class="row-email" href="mailto:<?= $list['email'] ?>"><?= $list['email'] ?></a>
							</td>
							<td class="date column-date" data-colname="Nombre">
								<?= $list['First Name'] ?>
							</td>
							<td class="date column-date" data-colname="Apellidos">
								<?= $list['Last Name'] ?>
							</td>
							<td style="text-align: center;">
								<?php
								$gets = array();
								$temps = explode('&', explode('?', $_SERVER['REQUEST_URI'], 2)[1]);
								foreach ($temps as $temp) {
									$args = explode('=', $temp);
									$gets[$args[0]] = $args[1];
								}
								$gets['delete'] = $list['id'];
								?>
								<a href="<?= 'http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$b_s_url}" ?>?<?= http_build_query($gets) ?>">
									<span class="dashicons dashicons-trash"></span>
								</a>
							</td>
						</tr>
						<?php
					}
					?>
				</tbody>
			</table>
			<div class="tablenav bottom">
				<div class="alignleft actions bulkactions">
					<label for="bulk-action-selector-bottom" class="screen-reader-text">Selecciona acción en lote</label>
					<select name="action2" id="bulk-action-selector-bottom">
						<option value="-1">Acciones en lote</option>
						<option value="delete" class="hide-if-no-js">Eliminar</option>
					</select>
					<input type="submit" id="doaction2" class="button action" value="Aplicar">
					</div>
						<div class="alignleft actions">
					</div>
					<?php
					$args = array('listGet', $token, '', 1, 1000, 'name', 'asc');
					call_user_func_array(array($client, 'query'), $args);
					$lists = $client->getResponse();
					$total;
					foreach ($lists as $list) {
						if ($list['id'] == $c) {
							$total =  $list['contactcount'];
							$total_pages = ceil((int)$total/(int)$view);
						}
					}
					?>
					<div class="tablenav-pages">
						<span class="displaying-num"><?= $total ?> elementos</span>
							<span class="pagination-links">
								<?php
								$paged = (int)$paged;
								if ($paged <= 2) {
									echo '<span class="tablenav-pages-navspan" aria-hidden="true">«</span>';
								} else {
									$gets = array();
									$temps = explode('&', explode('?', $_SERVER['REQUEST_URI'], 2)[1]);
									foreach ($temps as $temp) {
										$args = explode('=', $temp);
										$gets[$args[0]] = $args[1];
									}
									$gets['paged'] = 1;
									echo '<a class="first-page" href="http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$b_s_url}".'?'.http_build_query($gets).'"><span class="screen-reader-text">Primera página</span><span aria-hidden="true">«</span></a>';
								}
								echo '&nbsp;';
								if ($paged <= 1) {
									echo '<span class="tablenav-pages-navspan" aria-hidden="true">‹</span>';
								} else {
									$gets = array();
									$temps = explode('&', explode('?', $_SERVER['REQUEST_URI'], 2)[1]);
									foreach ($temps as $temp) {
										$args = explode('=', $temp);
										$gets[$args[0]] = $args[1];
									}
									$gets['paged'] = $paged-1;
									echo '<a class="prev-page" href="http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$b_s_url}".'?'.http_build_query($gets).'"><span class="screen-reader-text">Página anterior</span><span aria-hidden="true">‹</span></a>';
								}
								?>
								<span class="screen-reader-text">Página actual</span>
								<span id="table-paging" class="paging-input">
									<span class="tablenav-paging-text"><?= $paged ?> de <span class="total-pages"><?= $total_pages ?></span></span>
								</span>
								<?php
								if ($paged >= $total_pages-1) {
									echo '<span class="tablenav-pages-navspan" aria-hidden="true">›</span>';
								} else {
									$gets = array();
									$temps = explode('&', explode('?', $_SERVER['REQUEST_URI'], 2)[1]);
									foreach ($temps as $temp) {
										$args = explode('=', $temp);
										$gets[$args[0]] = $args[1];
									}
									$gets['paged'] = $paged+1;
									echo '<a class="next-page" href="http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$b_s_url}".'?'.http_build_query($gets).'"><span class="screen-reader-text">Página anterior</span><span aria-hidden="true">›</span></a>';
								}
								echo '&nbsp;';
								if ($paged >= $total_pages-2) {
									echo '<span class="tablenav-pages-navspan" aria-hidden="true">»</span>';
								} else {
									$gets = array();
									$temps = explode('&', explode('?', $_SERVER['REQUEST_URI'], 2)[1]);
									foreach ($temps as $temp) {
										$args = explode('=', $temp);
										$gets[$args[0]] = $args[1];
									}
									$gets['paged'] = $total_pages;
									echo '<a class="last-page" href="http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$b_s_url}".'?'.http_build_query($gets).'"><span class="screen-reader-text">Última página</span><span aria-hidden="true">»</span></a>';
								}
								?>
							</span>
					</div>
					<br class="clear">
				</div>
		</div>
		<?php
		}
	} else if (b_f_option('b_opt_newsl_service') == 'mailchimp') {
		$api_key = b_f_option('b_opt_newsl_api');
		$b_s_url = explode('?', $_SERVER['REQUEST_URI'], 2)[0];
		if (isset($_POST['list_selector'])) {
			$options = get_option('bilnea_settings');
			$options['b_opt_newsl_list'] = $_POST['list_selector'];
			update_option('bilnea_settings', $options);
		}
		function b_mailchimp($url, $request_type, $api_key, $data = array()) {
			if ($request_type == 'GET') {
				$url .= '?' . http_build_query($data);
			}
			$mch = curl_init();
			$headers = array(
				'Content-Type: application/json',
				'Authorization: Basic '.base64_encode( 'user:'. $api_key )
			);
			curl_setopt($mch, CURLOPT_URL, $url);
			curl_setopt($mch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($mch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($mch, CURLOPT_CUSTOMREQUEST, $request_type);
			curl_setopt($mch, CURLOPT_TIMEOUT, 10);
			curl_setopt($mch, CURLOPT_SSL_VERIFYPEER, false);
			if($request_type != 'GET') {
				curl_setopt($mch, CURLOPT_POST, true);
				curl_setopt($mch, CURLOPT_POSTFIELDS, json_encode($data));
			}	 
			return curl_exec($mch);
		}
		if (isset($_GET['visibility'])) {
			switch ($_GET['visibility']) {
				case '0':
					$result = json_decode( b_mailchimp_member_status($_GET['email'], 'unsubscribed', $_GET['list_id'], $api_key, 'PATCH' ) );
					if( $result->status == 400 ) {
						foreach( $result->errors as $error ) {
							echo '<p>Error: ' . $error->message . '</p>';
						}
					}
					break;
				case '1':
					$result = json_decode( b_mailchimp_member_status($_GET['email'], 'subscribed', $_GET['list_id'], $api_key, 'PATCH' ) );
					if( $result->status == 400 ) {
						foreach( $result->errors as $error ) {
							echo '<p>Error: ' . $error->message . '</p>';
						}
					}
					break;
			}
		}
		if (isset($_GET['delete'])) {
			$result = json_decode( b_mailchimp_member_status($_GET['delete'], 'unsubscribed', $_GET['list_id'], $api_key, 'DELETE' ) );
			if( $result->status == 400 ) {
				foreach( $result->errors as $error ) {
					echo '<p>Error: ' . $error->message . '</p>';
				}
			}
		}
		if (isset($_POST['action2']) && $_POST['action2'] == delete) {
			$users = explode(',', $_POST['c_ids']);
			foreach ($users as $user) {
				$userdata = explode('::', $user);
				$result = json_decode( b_mailchimp_member_status($userdata[0], 'unsubscribed', $userdata[1], $api_key, 'DELETE' ) );
			}
		}
		$url = 'https://'.substr($api_key,strpos($api_key,'-')+1).'.api.mailchimp.com/3.0/lists/';
		$data = array(
			'fields' => 'lists'
		);
		$result = json_decode(b_mailchimp($url, 'GET', $api_key, $data));
		$lists = $result->lists;
		if (count($lists) > 0) {
			(isset($_GET['list'])) ? $c = $_GET['list'] : $c = $lists[0]->id;
			?>
			<div class="wrap">
				<h1>Boletín de noticias</h1>
				<ul class="subsubsub" style="float: none;">
					<li class="all">
						<a class="current" href="<?= 'http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$b_s_url}" ?>?page=subscribers">Todos <span class="count">(0)</span></a>
					</li>
					<?php
						if(!empty($lists)) {
							$total = 0;
							foreach($lists as $list) {
								$total_members = $list->stats->member_count;
								$total = $total+$total_members;
								$gets = array();
								$temps = explode('&', explode('?', $_SERVER['REQUEST_URI'], 2)[1]);
								$gets['page'] = 'subscribers';
								$gets['list_view'] = $list->id;
								?>
								<li class="list-<?= $list->id ?>">
									|&nbsp;<a href="<?= 'http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$b_s_url}" ?>?<?= http_build_query($gets) ?>"><?= $list->name ?> <span class="count">(<?= $total_members ?>)</span></a>
								</li>
								<?php
								$i++;
							}
							(isset($_GET['order']) && $_GET['order'] == 'asc') ? $order = 'desc' : $order = 'asc';
							$sorts = array('date' => 'sortable '.$order, 'email' => 'sortable '.$order, 'status' => 'sortable '.$order);
							$orderby = 'date';
							if (isset($_GET['orderby'])) {
								$sorts[$_GET['orderby']] = 'sorted '.$order;
								$orderby = $_GET['orderby'];
							}
							?>
							<script type="text/javascript">
								jQuery(function() {
									<?php if (isset($_GET['list_view'])) : ?>
									jQuery('.subsubsub a.current').removeClass('current');
									jQuery('.subsubsub a[href*="<?= $_GET['list_view'] ?>"]').addClass('current');
									<?php endif; ?>
									jQuery('.subsubsub .all a span').text('(<?= $total ?>)');
								})
							</script>
							<?php
						}
						?>
				</ul>
				<div class="tablenav top">
					<div style="display: inline-block;">
						<form action="#" method="post" name="list_form">
							<label>Lista por defecto: </label>
							<select id="list_selector" name="list_selector" style="margin: 4px 0 8px 0;">
								<option selected disabled>Selecciona una lista</option>
								<?php
								foreach ($lists as $list) {
									(b_f_option('b_opt_newsl_list') == $list->id) ? $seld = ' selected="selected"' : $seld = '';
									echo '<option value="'.$list->id.'"'.$seld.'>'.$list->name.'</option>';
								}
								?>
							</select>
						</form>
						<script type="text/javascript">
							jQuery(function() {
								jQuery('#list_selector').change(function() {
									this.form.submit();
								})
							})
						</script>
					</div>
					<?php
					(isset($_GET['count'])) ? $view = $_GET['count'] : $view = 25;
					(isset($_GET['paged'])) ? $paged = $_GET['paged'] : $paged = 1;
					$total;
					foreach ($lists as $list) {
						if ($list->id == $c) {
							$total = $list->stats->member_count;
							$total_pages = ceil((int)$total/(int)$view);
						}
					}
					?>
					<div class="tablenav-pages">
						<span class="displaying-num"><?= $total ?> suscriptores</span>
							<span class="pagination-links">
								<?php
								$paged = (int)$paged;
								if ($paged <= 2) {
									echo '<span class="tablenav-pages-navspan" aria-hidden="true">«</span>';
								} else {
									$gets = array();
									$temps = explode('&', explode('?', $_SERVER['REQUEST_URI'], 2)[1]);
									foreach ($temps as $temp) {
										$args = explode('=', $temp);
										$gets[$args[0]] = $args[1];
									}
									$gets['paged'] = 1;
									echo '<a class="first-page" href="http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$b_s_url}".'?'.http_build_query($gets).'"><span class="screen-reader-text">Primera página</span><span aria-hidden="true">«</span></a>';
								}
								echo '&nbsp;';
								if ($paged <= 1) {
									echo '<span class="tablenav-pages-navspan" aria-hidden="true">‹</span>';
								} else {
									$gets = array();
									$temps = explode('&', explode('?', $_SERVER['REQUEST_URI'], 2)[1]);
									foreach ($temps as $temp) {
										$args = explode('=', $temp);
										$gets[$args[0]] = $args[1];
									}
									$gets['paged'] = $paged-1;
									echo '<a class="prev-page" href="http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$b_s_url}".'?'.http_build_query($gets).'"><span class="screen-reader-text">Página anterior</span><span aria-hidden="true">‹</span></a>';
								}
								?>
								<span class="screen-reader-text">Página actual</span>
								<span id="table-paging" class="paging-input">
									<span class="tablenav-paging-text"><?= $paged ?> de <span class="total-pages"><?= $total_pages ?></span>
								</span>
							</span>
							<?php
							if ($paged >= $total_pages-1) {
								echo '<span class="tablenav-pages-navspan" aria-hidden="true">›</span>';
							} else {
								$gets = array();
								$temps = explode('&', explode('?', $_SERVER['REQUEST_URI'], 2)[1]);
								foreach ($temps as $temp) {
									$args = explode('=', $temp);
									$gets[$args[0]] = $args[1];
								}
								$gets['paged'] = $paged+1;
								echo '<a class="next-page" href="http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$b_s_url}".'?'.http_build_query($gets).'"><span class="screen-reader-text">Página anterior</span><span aria-hidden="true">›</span></a>';
							}
							echo '&nbsp;';
							if ($paged >= $total_pages-2) {
								echo '<span class="tablenav-pages-navspan" aria-hidden="true">»</span>';
							} else {
								$gets = array();
								$temps = explode('&', explode('?', $_SERVER['REQUEST_URI'], 2)[1]);
								foreach ($temps as $temp) {
									$args = explode('=', $temp);
									$gets[$args[0]] = $args[1];
								}
								$gets['paged'] = $total_pages;
								echo '<a class="last-page" href="http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$b_s_url}".'?'.http_build_query($gets).'"><span class="screen-reader-text">Última página</span><span aria-hidden="true">»</span></a>';
							}
							?>
						</span>
					</div>
				</div>
				<table class="wp-list-table widefat fixed striped pages">
				<thead>
					<tr>
						<td id="cb" class="manage-column column-cb check-column">
							<label class="screen-reader-text" for="cb-select-all-1">Seleccionar todos</label>
							<input id="cb-select-all-1" type="checkbox">
						</td>
						<td style="width: 30px;"></td>
						<th scope="col" id="b_s_date" class="manage-column column-title <?= $sorts['date'] ?>">
							<a href="<?= 'http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$b_s_url}" ?>?list=<?= $c ?>&page=subscribers&orderby=date&order=<?= $order ?>">
								<span>Fecha</span>
								<span class="sorting-indicator"></span>
							</a>
						</th>
						<th scope="col" id="b_s_email" class="manage-column column-title <?= $sorts['email'] ?>">
							<a href="<?= 'http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$b_s_url}" ?>?list=<?= $c ?>&page=subscribers&orderby=email&order=<?= $order ?>">
								<span>Correo electrónico</span>
								<span class="sorting-indicator"></span>
							</a>
						</th>
						<th scope="col" id="b_s_name" class="manage-column column-title <?= $sorts['b_s_name'] ?>">
							<span>Nombre</span>
						</th>
						<th scope="col" id="b_s_last_name" class="manage-column column-title <?= $sorts['b_s_last_name'] ?>">
							<span>Boletín de noticias</span>
						</th>
						<th scope="col" id="b_s_status" class="manage-column column-title <?= $sorts['status'] ?>">
							<a href="<?= 'http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$b_s_url}" ?>?list=<?= $c ?>&page=subscribers&orderby=status&order=<?= $order ?>">
								<span>Estado</span>
								<span class="sorting-indicator"></span>
							</a>
						</th>
						<th style="width: 30px;">
						</th>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach ($lists as $list) {
						$url .= $list->id.'/members/';
						(isset($_GET['view'])) ? $count = $_GET['view'] : $count = 25;
						(isset($_GET['paged'])) ? $offset = $_GET['paged']*$count : $offset = 0;
						$total_members = $list->stats->member_count;
						($total_members > 500) ? $steps = ceil($total_members/500) : $steps = 1;
						$members = array();
						for ($i = 0; $i < $steps; $i++) { 
							$data = array(
								'fields' => 'members',
								'count' => 500,
								'offset' => $i*500
							);
							$result = json_decode(b_mailchimp($url, 'GET', $api_key, $data));
							foreach ($result->members as $member) {
								array_push($members, array(
									'id' => $member->id,
									'timestamp_signup' => $member->timestamp_signup,
									'email_address' => $member->email_address,
									'name' => $member->merge_fields->FNAME.' '.$member->merge_fields->LNAME,
									'status' => $member->status
								));
							};
						}
						if (isset($_GET['orderby'])) {
							switch ($_GET['orderby']) {
								case 'date':
									function sort_members($x, $y) {
										return strcasecmp($x['timestamp_signup'], $y['timestamp_signup']);
									}
									usort($members, 'sort_members');
									break;
								case 'email':
									function sort_members($x, $y) {
										return strcasecmp($x['email_address'], $y['email_address']);
									}
									usort($members, 'sort_members');
									break;
								case 'name':
									function sort_members($x, $y) {
										return strcasecmp($x['name'], $y['name']);
									}
									usort($members, 'sort_members');
									break;
								case 'status':
									function sort_members($x, $y) {
										return strcasecmp($x['status'], $y['status']);
									}
									usort($members, 'sort_members');
									break;
							}
						}
						if (isset($_GET['order']) && $_GET['order'] == 'desc') {
							$members = array_reverse($members);
						}
						(isset($_GET['view'])) ? $view = $_GET['view'] : $view = 25;
						(isset($_GET['paged'])) ? $paged = $_GET['paged'] : $paged = 1;
						$x = ($paged-1)*$view;
						for ($i = $x; $i < ($view*$paged); $i++) { 
							?>
							<tr id="subscriber-<?= $members[$i]['id'] ?>" class="iedit author-self level-0 post-<?= $members[$i]['id'] ?> status-publish hentry">
								<th scope="row" class="check-column">
									<label class="screen-reader-text" for="cb-select-<?= $members[$i]['id'] ?>">Elige suscriptor</label>
									<input id="cb-select-<?= $members[$i]['id'] ?>" type="checkbox" name="post[]" value="<?= $members[$i]['email_address'] ?>::<?= $list->id ?>">
									<div class="locked-indicator"></div>
								</th>
								<th scope="row" class="check-column-2" style="text-align: center;">
									<?php
									$gets = array();
									$temps = explode('&', explode('?', $_SERVER['REQUEST_URI'], 2)[1]);
									foreach ($temps as $temp) {
										$args = explode('=', $temp);
										$gets[$args[0]] = $args[1];
									}
									$gets['email'] = $members[$i]['email_address'];
									$gets['list_id'] = $members[$i]['id'];
									if ($members[$i]['status'] == 'subscribed') {
										$gets['visibility'] = 0;
									?>
										<a href="<?= 'http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$b_s_url}" ?>?<?= http_build_query($gets) ?>"><span class="dashicons dashicons-visibility"></span></a>
									<?php
									} else {
										$gets['visibility'] = 1;
									?>
										<a href="<?= 'http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$b_s_url}" ?>?<?= http_build_query($gets) ?>"><span class="dashicons dashicons-hidden"></span></a>
									<?php
									}
									?>
								</th>
								<td class="date column-date" data-colname="Fecha">
									<?php
									$date = explode('-', explode('T', $members[$i]['timestamp_signup'])[0]);
									$months = array('01' => 'enero',
													'02' => 'febrero',
													'03' => 'marzo',
													'04' => 'abril',
													'05' => 'mayo',
													'06' => 'junio',
													'07' => 'julio',
													'08' => 'agosto',
													'09' => 'septiembre',
													'10' => 'octubre',
													'11' => 'noviembre',
													'12' => 'diciembre'
													);
									echo str_replace(',', '', $date[2]).' '.$months[$date[1]].' '.$date[0];
									?>
								</td>
								<td class="title column-email has-row-actions column-primary page-title" data-colname="Correo electrónico">
									<a class="row-email" href="mailto:<?= $members[$i]['email_address'] ?>"><?= $members[$i]['email_address'] ?></a>
								</td>
								<td class="name column-name" data-colname="Nombre">
									<?= $members[$i]['name'] ?>
								</td>
								<td class="list column-list" data-colname="Boletín de noticias">
									<?= $list->name ?> 
								</td>
								<td class="list column-list" data-colname="Estado">
									<?php
									switch ($members[$i]['status']) {
										case 'pending':
											echo 'Sin confirmar';
											break;
										case 'subscribed':
											echo 'Suscrito';
											break;
										case 'unsubscribed':
											echo 'Dado de baja';
											break;
										case 'cleaned':
											echo 'Baneado';
											break;
									}
									?>
								</td>
								<td style="text-align: center;">
									<?php
									$gets = array();
									$temps = explode('&', explode('?', $_SERVER['REQUEST_URI'], 2)[1]);
									foreach ($temps as $temp) {
										$args = explode('=', $temp);
										$gets[$args[0]] = $args[1];
									}
									unset($gets['list_view']);
									$gets['delete'] = $members[$i]['email_address'];
									?>
									<a href="<?= 'http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$b_s_url}" ?>?<?= http_build_query($gets) ?>">
										<span class="dashicons dashicons-trash"></span>
									</a>
								</td>
							</tr>
							<?php
						}
					}
					?>
				</tbody>
			</table>
			<div class="tablenav bottom">
				<div class="alignleft actions bulkactions">
					<label for="bulk-action-selector-bottom" class="screen-reader-text">Selecciona acción en lote</label>
					<form action="" method="post" name="actions" id="form_actions">
						<select name="action2" id="bulk-action-selector-bottom">
							<option value="-1">Acciones en lote</option>
							<option value="delete" class="hide-if-no-js">Eliminar</option>
						</select>
						<input type="hidden" id="c_ids" name="c_ids" />
						<input type="submit" id="doaction2" class="button action" value="Aplicar" />
					</form>
					<script type="text/javascript">
						function update_checkboxes() {
							var all_checkboxes = [];
							jQuery('[name="post[]"]:checked').each(function() {
								all_checkboxes.push(jQuery(this).val());
							});
							jQuery('#c_ids').val(all_checkboxes.join(','));
						}
						jQuery(function() {
							jQuery('#cb-select-all-1').click(function() {
								if (this.checked) {
									jQuery('[name="post[]"]').each(function() {
										this.checked = true;                        
									});
								} else {
									jQuery('[name="post[]"]').each(function() {
										this.checked = false;                        
									});
								}
							});
							jQuery('[id*="cb-select"]').click(update_checkboxes);
							jQuery('#doaction2').click(function(event) {
								event.preventDefault();
								if (jQuery('#bulk-action-selector-bottom').val() != '-1') {
									switch (jQuery('#bulk-action-selector-bottom').val()) {
										case 'delete':
											update_checkboxes;
											jQuery('#form_actions').submit();
											break;
									}
								};
							});
						});
					</script>
				</div>
				<?php
				(isset($_GET['count'])) ? $view = $_GET['count'] : $view = 25;
				(isset($_GET['paged'])) ? $paged = $_GET['paged'] : $paged = 1;
				$total;
				foreach ($lists as $list) {
					if ($list->id == $c) {
						$total = $list->stats->member_count;
						$total_pages = ceil((int)$total/(int)$view);
					}
				}
				?>
				<div class="tablenav-pages">
					<span class="displaying-num"><?= $total ?> suscriptores</span>
							<span class="pagination-links">
								<?php
								$paged = (int)$paged;
								if ($paged <= 2) {
									echo '<span class="tablenav-pages-navspan" aria-hidden="true">«</span>';
								} else {
									$gets = array();
									$temps = explode('&', explode('?', $_SERVER['REQUEST_URI'], 2)[1]);
									foreach ($temps as $temp) {
										$args = explode('=', $temp);
										$gets[$args[0]] = $args[1];
									}
									$gets['paged'] = 1;
									echo '<a class="first-page" href="http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$b_s_url}".'?'.http_build_query($gets).'"><span class="screen-reader-text">Primera página</span><span aria-hidden="true">«</span></a>';
								}
								echo '&nbsp;';
								if ($paged <= 1) {
									echo '<span class="tablenav-pages-navspan" aria-hidden="true">‹</span>';
								} else {
									$gets = array();
									$temps = explode('&', explode('?', $_SERVER['REQUEST_URI'], 2)[1]);
									foreach ($temps as $temp) {
										$args = explode('=', $temp);
										$gets[$args[0]] = $args[1];
									}
									$gets['paged'] = $paged-1;
									echo '<a class="prev-page" href="http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$b_s_url}".'?'.http_build_query($gets).'"><span class="screen-reader-text">Página anterior</span><span aria-hidden="true">‹</span></a>';
								}
								?>
								<span class="screen-reader-text">Página actual</span>
								<span id="table-paging" class="paging-input">
									<span class="tablenav-paging-text"><?= $paged ?> de <span class="total-pages"><?= $total_pages ?></span></span>
								</span>
								<?php
								if ($paged >= $total_pages-1) {
									echo '<span class="tablenav-pages-navspan" aria-hidden="true">›</span>';
								} else {
									$gets = array();
									$temps = explode('&', explode('?', $_SERVER['REQUEST_URI'], 2)[1]);
									foreach ($temps as $temp) {
										$args = explode('=', $temp);
										$gets[$args[0]] = $args[1];
									}
									$gets['paged'] = $paged+1;
									echo '<a class="next-page" href="http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$b_s_url}".'?'.http_build_query($gets).'"><span class="screen-reader-text">Página anterior</span><span aria-hidden="true">›</span></a>';
								}
								echo '&nbsp;';
								if ($paged >= $total_pages-2) {
									echo '<span class="tablenav-pages-navspan" aria-hidden="true">»</span>';
								} else {
									$gets = array();
									$temps = explode('&', explode('?', $_SERVER['REQUEST_URI'], 2)[1]);
									foreach ($temps as $temp) {
										$args = explode('=', $temp);
										$gets[$args[0]] = $args[1];
									}
									$gets['paged'] = $total_pages;
									echo '<a class="last-page" href="http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$b_s_url}".'?'.http_build_query($gets).'"><span class="screen-reader-text">Última página</span><span aria-hidden="true">»</span></a>';
								}
								?>
							</span>
					</div>
					<br class="clear">
				</div>
		</div>
		<?php
		}
	}
}

?>