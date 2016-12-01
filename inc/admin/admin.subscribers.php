<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}


// Página de suscriptores

function bilnea_subscribers_page() {

	// Variables globales
	global $sitepress;

	// Variables locales
	$var_api_key = b_f_option('b_opt_newsl_api');
	$var_global_url = explode('?', $_SERVER['REQUEST_URI'], 2)[0];

	if (b_f_option('b_opt_newsl_service') == 'wordpress') {
		$var_global_url = explode('?', $_SERVER['REQUEST_URI'], 2)[0];
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
							<a href="<?= 'http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$var_global_url}" ?>?page=subscribers&orderby=b_s_date&order=<?= $order ?>">
								<span>Fecha</span>
								<span class="sorting-indicator"></span>
							</a>
						</th>
						<th scope="col" id="b_s_email" class="manage-column column-title <?= $sorts['b_s_email'] ?>">
							<a href="<?= 'http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$var_global_url}" ?>?page=subscribers&orderby=email&order=<?= $order ?>">
								<span>Correo electrónico</span>
								<span class="sorting-indicator"></span>
							</a>
						</th>
						<th scope="col" id="b_s_name" class="manage-column column-title <?= $sorts['b_s_name'] ?>">
							<a href="<?= 'http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$var_global_url}" ?>?page=subscribers&orderby=name&order=<?= $order ?>">
								<span>Nombre</span>
								<span class="sorting-indicator"></span>
							</a>
						</th>
						<th scope="col" id="b_s_last_name" class="manage-column column-title <?= $sorts['b_s_last_name'] ?>">
							<a href="<?= 'http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$var_global_url}" ?>?page=subscribers&orderby=last_name&order=<?= $order ?>">
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
						$wpdb->update($table, array('activo' => $_GET['visibility']), array('id' => $_GET['post_id']));
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
								$var_gets = array();
								$var_temps = explode('&', explode('?', $_SERVER['REQUEST_URI'], 2)[1]);
								foreach ($var_temps as $var_temp) {
									$var_args = explode('=', $var_temp);
									$var_gets[$var_args[0]] = $var_args[1];
								}
								$var_gets['post_id'] = $subscriber['id'];
								if ($subscriber['activo'] == 1) {
									$var_gets['visibility'] = 0;
								?>
									<a href="<?= 'http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$var_global_url}" ?>?<?= http_build_query($var_gets) ?>"><span class="dashicons dashicons-visibility"></span></a>
								<?php
								} else {
									$var_gets['visibility'] = 1;
								?>
									<a href="<?= 'http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$var_global_url}" ?>?<?= http_build_query($var_gets) ?>"><span class="dashicons dashicons-hidden"></span></a>
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

								<a href="<?= 'http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$var_global_url}" ?>?<?= http_build_query($var_gets) ?>">
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
		$var_global_url = explode('?', $_SERVER['REQUEST_URI'], 2)[0];
		include_once(ABSPATH.WPINC.'/class-IXR.php');
		$client = new IXR_Client('https://api.benchmarkemail.com/1.3', false, 443, 20);
		$var_args = array('login', b_f_option('b_opt_newsl_username'), b_f_option('b_opt_newsl_password'));
		call_user_func_array(array($client, 'query'), $var_args);
		$token = $client->getResponse();
		if (isset($_GET['delete'])) {
			$var_args = array('listDeleteContacts', $token, $_GET['list'], $_GET['delete']);
			call_user_func_array(array($client, 'query'), $var_args);
		}
		(isset($_GET['paged'])) ? $var_paged = $_GET['paged']  : $var_paged = 1;
		(isset($_GET['view'])) ? $view = $_GET['view']  : $view = 50;
		$var_args = array('listGet', $token, '', 1, 1000, 'name', 'asc');
		call_user_func_array(array($client, 'query'), $var_args);
		$var_lists = $client->getResponse();
		if (count($var_lists) > 0) {
			(isset($_GET['list'])) ? $c = $_GET['list'] : $c = $var_lists[0]['id'];
			?>
			<div class="wrap">
				<h1>Boletín de noticias</h1>
				<ul class="subsubsub" style="float: none;">
					<?php
						$i = 1;
						foreach ($var_lists as $var_list) {
							$var_gets = array();
							$var_temps = explode('&', explode('?', $_SERVER['REQUEST_URI'], 2)[1]);
							foreach ($var_temps as $var_temp) {
								$var_args = explode('=', $var_temp);
								$var_gets[$var_args[0]] = $var_args[1];
							}
							$var_gets['list'] = $var_list['id'];
							?>
							<li class="list-<?= $var_list['id'] ?>">
								<a href="<?= 'http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$var_global_url}" ?>?<?= http_build_query($var_gets) ?>"<?= ($var_list['id'] == $c) ? ' class="current"' : '' ?>><?= $var_list['listname'] ?> <span class="count">(<?= $var_list['contactcount'] ?>)</span></a><?= ($i == count($var_lists)) ? '' : ' |' ?>
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
					$var_args = array('listGet', $token, '', 1, 1000, 'name', 'asc');
					call_user_func_array(array($client, 'query'), $var_args);
					$var_lists = $client->getResponse();
					?>
					<label>Lista por defecto: </label>
					<form action="#" method="post" name="list_form">
						<select id="list_selector" name="list_selector">
							<option selected disabled>Selecciona una lista</option>
							<?php
							foreach ($var_lists as $var_list) {
								(b_f_option('b_opt_newsl_list') == $var_list['id']) ? $seld = ' selected="selected"' : $seld = '';
								echo '<option value="'.$var_list['id'].'"'.$seld.'>'.$var_list['listname'].'</option>';
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
							<a href="<?= 'http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$var_global_url}" ?>?list=<?= $c ?>&page=subscribers&orderby=date&order=<?= $order ?>">
								<span>Fecha</span>
								<span class="sorting-indicator"></span>
							</a>
						</th>
						<th scope="col" id="b_s_email" class="manage-column column-title <?= $sorts['email'] ?>">
							<a href="<?= 'http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$var_global_url}" ?>?list=<?= $c ?>&page=subscribers&orderby=email&order=<?= $order ?>">
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
					$var_args = array('listGetContactsAllFields', $token, $c, '', (int)$var_paged, (int)$view, $orderby, $order);
					call_user_func_array(array($client, 'query'), $var_args);
					$var_lists = $client->getResponse();
					foreach ($var_lists as $var_list) {
						?>
						<tr id="subscriber-<?= $var_list['id'] ?>" class="iedit author-self level-0 post-<?= $var_list['id'] ?> status-publish hentry">
							<th scope="row" class="check-column">
								<label class="screen-reader-text" for="cb-select-<?= $var_list['id'] ?>">Elige suscriptor</label>
								<input id="cb-select-<?= $var_list['id'] ?>" type="checkbox" name="post[]" value="<?= $var_list['id'] ?>">
								<div class="locked-indicator"></div>
							</th>
							<td class="date column-date" data-colname="Fecha">
								<?php
								$var_date = explode(' ', $var_list['timestamp']);
								$var_months = array('Jan' => 'enero',
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
								echo str_replace(',', '', $var_date[1]).' '.$var_months[$var_date[0]].' '.$var_date[2];
								?>
							</td>
							<td class="title column-email has-row-actions column-primary page-title" data-colname="Correo electrónico">
								<a class="row-email" href="mailto:<?= $var_list['email'] ?>"><?= $var_list['email'] ?></a>
							</td>
							<td class="date column-date" data-colname="Nombre">
								<?= $var_list['First Name'] ?>
							</td>
							<td class="date column-date" data-colname="Apellidos">
								<?= $var_list['Last Name'] ?>
							</td>
							<td style="text-align: center;">
								<?php
								$var_gets = array();
								$var_temps = explode('&', explode('?', $_SERVER['REQUEST_URI'], 2)[1]);
								foreach ($var_temps as $var_temp) {
									$var_args = explode('=', $var_temp);
									$var_gets[$var_args[0]] = $var_args[1];
								}
								$var_gets['delete'] = $var_list['id'];
								?>
								<a href="<?= 'http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$var_global_url}" ?>?<?= http_build_query($var_gets) ?>">
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
					$var_args = array('listGet', $token, '', 1, 1000, 'name', 'asc');
					call_user_func_array(array($client, 'query'), $var_args);
					$var_lists = $client->getResponse();
					$var_total;
					foreach ($var_lists as $var_list) {
						if ($var_list['id'] == $c) {
							$var_total =  $var_list['contactcount'];
							$var_total_pages = ceil((int)$var_total/(int)$view);
						}
					}
					?>
					<div class="tablenav-pages">
						<span class="displaying-num"><?= $var_total ?> elementos</span>
							<span class="pagination-links">
								<?php
								$var_paged = (int)$var_paged;
								if ($var_paged <= 2) {
									echo '<span class="tablenav-pages-navspan" aria-hidden="true">«</span>';
								} else {
									$var_gets = array();
									$var_temps = explode('&', explode('?', $_SERVER['REQUEST_URI'], 2)[1]);
									foreach ($var_temps as $var_temp) {
										$var_args = explode('=', $var_temp);
										$var_gets[$var_args[0]] = $var_args[1];
									}
									$var_gets['paged'] = 1;
									echo '<a class="first-page" href="http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$var_global_url}".'?'.http_build_query($var_gets).'"><span class="screen-reader-text">Primera página</span><span aria-hidden="true">«</span></a>';
								}
								echo '&nbsp;';
								if ($var_paged <= 1) {
									echo '<span class="tablenav-pages-navspan" aria-hidden="true">‹</span>';
								} else {
									$var_gets = array();
									$var_temps = explode('&', explode('?', $_SERVER['REQUEST_URI'], 2)[1]);
									foreach ($var_temps as $var_temp) {
										$var_args = explode('=', $var_temp);
										$var_gets[$var_args[0]] = $var_args[1];
									}
									$var_gets['paged'] = $var_paged-1;
									echo '<a class="prev-page" href="http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$var_global_url}".'?'.http_build_query($var_gets).'"><span class="screen-reader-text">Página anterior</span><span aria-hidden="true">‹</span></a>';
								}
								?>
								<span class="screen-reader-text">Página actual</span>
								<span id="table-paging" class="paging-input">
									<span class="tablenav-paging-text"><?= $var_paged ?> de <span class="total-pages"><?= $var_total_pages ?></span></span>
								</span>
								<?php
								if ($var_paged >= $var_total_pages-1) {
									echo '<span class="tablenav-pages-navspan" aria-hidden="true">›</span>';
								} else {
									$var_gets = array();
									$var_temps = explode('&', explode('?', $_SERVER['REQUEST_URI'], 2)[1]);
									foreach ($var_temps as $var_temp) {
										$var_args = explode('=', $var_temp);
										$var_gets[$var_args[0]] = $var_args[1];
									}
									$var_gets['paged'] = $var_paged+1;
									echo '<a class="next-page" href="http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$var_global_url}".'?'.http_build_query($var_gets).'"><span class="screen-reader-text">Página anterior</span><span aria-hidden="true">›</span></a>';
								}
								echo '&nbsp;';
								if ($var_paged >= $var_total_pages-2) {
									echo '<span class="tablenav-pages-navspan" aria-hidden="true">»</span>';
								} else {
									$var_gets = array();
									$var_temps = explode('&', explode('?', $_SERVER['REQUEST_URI'], 2)[1]);
									foreach ($var_temps as $var_temp) {
										$var_args = explode('=', $var_temp);
										$var_gets[$var_args[0]] = $var_args[1];
									}
									$var_gets['paged'] = $var_total_pages;
									echo '<a class="last-page" href="http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$var_global_url}".'?'.http_build_query($var_gets).'"><span class="screen-reader-text">Última página</span><span aria-hidden="true">»</span></a>';
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

		// Mostrar u ocultar al suscriptor
		if (isset($_GET['visibility'])) {
			switch ($_GET['visibility']) {
				case '0':
					$var_result = json_decode(b_f_i_mailchimp_member_status($_GET['email'], 'unsubscribed', $_GET['list_id'], $var_api_key, 'PATCH'));
					if ($var_result->status == 400) {
						foreach($var_result->errors as $var_error) {
							echo '<p>Error: ' . $var_error->message . '</p>';
						}
					}
					break;
				case '1':
					$var_result = json_decode(b_f_i_mailchimp_member_status($_GET['email'], 'subscribed', $_GET['list_id'], $var_api_key, 'PATCH'));
					if ($var_result->status == 400) {
						foreach($var_result->errors as $var_error) {
							echo '<p>Error: ' . $var_error->message . '</p>';
						}
					}
					break;
			}
		}

		// Eliminar al suscriptor
		if (isset($_GET['delete'])) {
			$var_result = json_decode(b_f_i_mailchimp_member_status($_GET['delete'], 'unsubscribed', $_GET['list_id'], $var_api_key, 'DELETE'));
			if ($var_result->status == 400) {
				foreach($var_result->errors as $var_error) {
					echo '<p>Error: ' . $var_error->message . '</p>';
				}
			}
		}

		// Aciones en bloque
		if (isset($_POST['action2']) && $_POST['action2'] == delete) {
			$var_users = explode(',', $_POST['c_ids']);
			foreach ($var_users as $var_user) {
				$var_userdata = explode('::', $var_user);
				$var_result = json_decode(b_f_i_mailchimp_member_status($var_userdata[0], 'unsubscribed', $var_userdata[1], $var_api_key, 'DELETE'));
			}
		}

		// Variables locales
		$var_url = 'https://'.substr($var_api_key,strpos($var_api_key,'-')+1).'.api.mailchimp.com/3.0/lists/';
		$var_data = array(
			'fields' => 'lists'
		);
		$var_result = json_decode(b_f_i_mailchimp($var_url, 'GET', $var_api_key, $var_data));
		$var_lists = $var_result->lists;
		$var_lists_ids = array();

		if (function_exists('icl_object_id')) {
			if (!empty(icl_get_languages('skip_missing=0&orderby=name'))) {
				foreach (icl_get_languages('skip_missing=0&orderby=name') as $var_language) {
					array_push($var_lists_ids, b_f_option('b_opt_newsl_list-'.$var_language['language_code']));
				}
			}
		} else {
			array_push($var_lists_ids, b_f_option('b_opt_newsl_list-es'));
		}

		$var_num = 0;

		foreach ($var_lists as $var_list) {
			if (!in_array($var_list->id, $var_lists_ids)) {
				unset($var_lists[$var_num]);
			}
			$var_num++;
		}

		if (count($var_lists) > 0) {
			(isset($_GET['list'])) ? $c = $_GET['list'] : $c = $var_lists[0]->id;

			?>

			<div class="wrap">
				<h1>Boletín de noticias</h1>
				<ul class="subsubsub" style="float: none;">
					<li class="all">
						<a class="current" href="<?= 'http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$var_global_url}" ?>?page=subscribers">Todos <span class="count">(0)</span></a>
					</li>

					<?php

						if (!empty($var_lists)) {

							$var_total = 0;

							foreach($var_lists as $var_list) {
								$var_total_members = $var_list->stats->member_count;
								$var_total = $var_total+$var_total_members;
								$var_gets = array();
								$var_temps = explode('&', explode('?', $_SERVER['REQUEST_URI'], 2)[1]);
								$var_gets['page'] = 'subscribers';
								$var_gets['list_view'] = $var_list->id;
								?>
								<li class="list-<?= $var_list->id ?>">
									|&nbsp;<a href="<?= 'http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$var_global_url}" ?>?<?= http_build_query($var_gets) ?>"><?= $var_list->name ?> <span class="count">(<?= $var_total_members ?>)</span></a>
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
									jQuery('.subsubsub .all a span').text('(<?= $var_total ?>)');
								})
							</script>

							<?php

						}

						?>

				</ul>
				<div class="tablenav top">

					<?php

					(isset($_GET['count'])) ? $view = $_GET['count'] : $view = 25;
					(isset($_GET['paged'])) ? $var_paged = $_GET['paged'] : $var_paged = 1;

					$var_total;

					$var_total_pages = 1;

					foreach ($var_lists as $var_list) {
						if ($var_list->id == $c) {
							$var_total = $var_list->stats->member_count;
							if ($var_total == '') {
								$var_total = 1;
							}
							$var_total_pages = ceil((int)$var_total/(int)$view);
						}
					}

					$var_pagination = '<div class="tablenav-pages"><span class="displaying-num">'.$var_total.' suscriptores</span><span class="pagination-links">';

					$var_paged = (int)$var_paged;

					if ($var_paged <= 2) {
						$var_pagination .= '<span class="tablenav-pages-navspan" aria-hidden="true">«</span>';
					} else {
						$var_gets = array();

						foreach (explode('&', explode('?', $_SERVER['REQUEST_URI'], 2)[1]) as $var_temp) {
							$var_args = explode('=', $var_temp);
							$var_gets[$var_args[0]] = $var_args[1];
						}

						$var_gets['paged'] = 1;
						$var_pagination .= '<a class="first-page" href="http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$var_global_url}".'?'.http_build_query($var_gets).'"><span class="screen-reader-text">Primera página</span><span aria-hidden="true">«</span></a>';
					}

					$var_pagination .= '&nbsp;';

					if ($var_paged <= 1) {
						$var_pagination .= '<span class="tablenav-pages-navspan" aria-hidden="true">‹</span>';
					} else {
						$var_gets = array();
						$var_temps = explode('&', explode('?', $_SERVER['REQUEST_URI'], 2)[1]);

						foreach ($var_temps as $var_temp) {
							$var_args = explode('=', $var_temp);
							$var_gets[$var_args[0]] = $var_args[1];
						}
						
						$var_gets['paged'] = $var_paged-1;
						$var_pagination .= '<a class="prev-page" href="http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$var_global_url}".'?'.http_build_query($var_gets).'"><span class="screen-reader-text">Página anterior</span><span aria-hidden="true">‹</span></a>';
					}

					$var_pagination .= '<span class="screen-reader-text">Página actual</span><span id="table-paging" class="paging-input"><span class="tablenav-paging-text">'.$var_paged.' de <span class="total-pages">'.$var_total_pages.'</span></span></span>';
							
					if ($var_paged >= $var_total_pages-1) {
						$var_pagination .= '<span class="tablenav-pages-navspan" aria-hidden="true">›</span>';
					} else {
						$var_gets = array();
						$var_temps = explode('&', explode('?', $_SERVER['REQUEST_URI'], 2)[1]);

						foreach ($var_temps as $var_temp) {
							$var_args = explode('=', $var_temp);
							$var_gets[$var_args[0]] = $var_args[1];
						}

						$var_gets['paged'] = $var_paged+1;
						$var_pagination .= '<a class="next-page" href="http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$var_global_url}".'?'.http_build_query($var_gets).'"><span class="screen-reader-text">Página anterior</span><span aria-hidden="true">›</span></a>';
					}

					$var_pagination .= '&nbsp;';

					if ($var_paged >= $var_total_pages-2) {
						$var_pagination .= '<span class="tablenav-pages-navspan" aria-hidden="true">»</span>';
					} else {
						$var_gets = array();
						$var_temps = explode('&', explode('?', $_SERVER['REQUEST_URI'], 2)[1]);

						foreach ($var_temps as $var_temp) {
							$var_args = explode('=', $var_temp);
							$var_gets[$var_args[0]] = $var_args[1];
						}

						$var_gets['paged'] = $var_total_pages;
						$var_pagination .='<a class="last-page" href="http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$var_global_url}".'?'.http_build_query($var_gets).'"><span class="screen-reader-text">Última página</span><span aria-hidden="true">»</span></a>';
					}

					$var_pagination .= '</span></div>';

					echo $var_pagination;

					?>

				</div>
				<table class="wp-list-table widefat fixed striped pages">
				<thead>
					<tr>
						<td id="cb" class="manage-column column-cb check-column">
							<label class="screen-reader-text" for="cb-select-all-1">Seleccionar todos</label>
							<input id="cb-select-all-1" type="checkbox">
						</td>
						<td style="width: 30px;"></td>
						<th scope="col" id="b_s_date" class="manage-column column-title <?= $sorts['date'] ?>" style="width: 200px;">
							<a href="<?= 'http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$var_global_url}" ?>?list=<?= $c ?>&page=subscribers&orderby=date&order=<?= $order ?>">
								<span>Fecha</span>
								<span class="sorting-indicator"></span>
							</a>
						</th>
						<th scope="col" id="b_s_email" class="manage-column column-title <?= $sorts['email'] ?>">
							<a href="<?= 'http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$var_global_url}" ?>?list=<?= $c ?>&page=subscribers&orderby=email&order=<?= $order ?>">
								<span>Correo electrónico</span>
								<span class="sorting-indicator"></span>
							</a>
						</th>
						<th scope="col" id="b_s_name" class="manage-column column-title <?= $sorts['b_s_name'] ?>">
							<span>Nombre</span>
						</th>
						<th scope="col" id="b_s_status" class="manage-column column-title <?= $sorts['status'] ?>">
							<a href="<?= 'http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$var_global_url}" ?>?list=<?= $c ?>&page=subscribers&orderby=status&order=<?= $order ?>">
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

					foreach ($var_lists as $var_list) {

						$var_url .= $var_list->id.'/members/';

						(isset($_GET['view'])) ? $count = $_GET['view'] : $count = 25;
						(isset($_GET['paged'])) ? $offset = $_GET['paged']*$count : $offset = 0;

						$var_total_members = $var_list->stats->member_count;

						$var_data = array(
							'fields' => 'members',
							'count' => 20,
							'offset' => ($var_paged-1)*100
						);
						
						$var_result = json_decode(b_f_i_mailchimp($var_url, 'GET', $var_api_key, $var_data));

						if ($var_total_members == 0) {
							echo '<tr><td colspan="7">Esta lista no contiene suscriptores</td></tr>';
						}
						
						foreach ($var_result->members as $var_member) {

								?>

								<tr id="subscriber-<?= $var_member->id ?>" class="iedit author-self level-0 post-<?= $var_member->id ?> status-publish hentry">
									<th scope="row" class="check-column">
										<label class="screen-reader-text" for="cb-select-<?= $var_member->id ?>">Elige suscriptor</label>
										<input id="cb-select-<?= $var_member->id ?>" type="checkbox" name="post[]" value="<?= $var_member->email_address ?>::<?= $var_member->id ?>">
										<div class="locked-indicator"></div>
									</th>
									<th scope="row" class="check-column-2" style="text-align: center;">

										<?php

										$var_gets = array();
										$var_temps = explode('&', explode('?', $_SERVER['REQUEST_URI'], 2)[1]);

										foreach ($var_temps as $var_temp) {
											$var_args = explode('=', $var_temp);
											$var_gets[$var_args[0]] = $var_args[1];
										}

										$var_gets['email'] = $var_member->email_address;
										$var_gets['list_id'] = $var_member->id;

										if ($var_member->status == 'subscribed') {
											$var_gets['visibility'] = 0;

											?>

											<a href="<?= 'http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$var_global_url}" ?>?<?= http_build_query($var_gets) ?>"><span class="dashicons dashicons-visibility"></span></a>
											
											<?php

										} else {
											$var_gets['visibility'] = 1;

											?>

											<a href="<?= 'http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$var_global_url}" ?>?<?= http_build_query($var_gets) ?>"><span class="dashicons dashicons-hidden"></span></a>
											
											<?php

										}

										?>

									</th>
									<td class="date column-date" data-colname="Fecha">

										<?php
										
										($var_member->timestamp_signup == '') ? $var_timestamp = $var_member->timestamp_opt : $var_timestamp = $var_member->timestamp_signup;

										$var_date = explode('-', explode('T', $var_timestamp)[0]);

										$var_months = array(
											'01' => 'enero',
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

										echo str_replace(',', '', $var_date[2]).' '.$var_months[$var_date[1]].' '.$var_date[0].' '.date('H:i', strtotime($var_timestamp));

										?>

									</td>
									<td class="title column-email has-row-actions column-primary page-title" data-colname="Correo electrónico">
										<a class="row-email" href="mailto:<?= $var_member->email_address ?>"><?= $var_member->email_address ?></a>
									</td>
									<td class="name column-name" data-colname="Nombre">
										<?= $var_member->merge_fields->FNAME.' '.$var_member->merge_fields->LNAME ?>
									</td>
									<td class="list column-list" data-colname="Estado">

										<?php

										switch ($var_member->status) {
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

										$var_gets = array();
										$var_temps = explode('&', explode('?', $_SERVER['REQUEST_URI'], 2)[1]);

										foreach ($var_temps as $var_temp) {
											$var_args = explode('=', $var_temp);
											$var_gets[$var_args[0]] = $var_args[1];
										}

										unset($var_gets['list_view']);

										$var_gets['delete'] = $var_member->email_address;

										?>

										<a href="<?= 'http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$var_global_url}" ?>?<?= http_build_query($var_gets) ?>">
											<span class="dashicons dashicons-trash"></span>
										</a>
									</td>
								</tr>

							<?php

							};
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
				(isset($_GET['paged'])) ? $var_paged = $_GET['paged'] : $var_paged = 1;

				$var_total;

				foreach ($var_lists as $var_list) {
					if ($var_list->id == $c) {
						$var_total = $var_list->stats->member_count;
						$var_total_pages = ceil((int)$var_total/(int)$view);
					}
				}

				echo $var_pagination;
				
				?>
		</div>
		<?php
		}
	}
}

?>