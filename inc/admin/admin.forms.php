<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}


// Registro de contactos

function b_f_forms_menu() {
	add_submenu_page('bilnea', 'Formularios', 'Formularios', 'manage_options', 'contact_forms', 'b_p_forms');
}

add_action('admin_menu', 'b_f_forms_menu');

if (!function_exists('b_p_forms')) {

	function b_p_forms() {

		// Variables globales
		global $wpdb;
		global $b_g_languages;

		// Variables locales
		$url = explode('?', $_SERVER['REQUEST_URI'], 2)[0];

		(isset($_GET['order']) && $_GET['order'] == 'asc') ? $order = 'des' : $order = 'asc';

		if (isset($_GET['orderby'])) {
			$sorts = array('date' => 'sortable asc', 'email' => 'sortable asc', 'data' => 'sortable asc', 'formname' => 'sortable asc');
			$sorts[$_GET['orderby']] = 'sorted '.$order;
		} else {
			$sorts = array('date' => 'sorted '.$order, 'email' => 'sortable asc', 'data' => 'sortable asc', 'formname' => 'sortable asc');
		}

		(isset($_GET['orderby']) && $_GET['orderby'] != '') ? $orderby = ' ORDER BY '.$_GET['orderby'] : $orderby = ' ORDER BY `date`';
		($order == 'des') ? $ordered = ' DESC' : $ordered = ' ASC';

		// Conexión a la base de datos
		$table = $wpdb->prefix.'form_users';

		if (isset($_GET['delete']) && $_GET['delete'] != '') {
			$data = $wpdb->get_results('SELECT * FROM '.$table.' WHERE id = '.$_GET['delete'], ARRAY_A)[0];
			foreach (unserialize($data['attachments']) as $attachment) {
				if ($attachment != '') {
					$file = ABSPATH.'wp-content/mail'.explode('/uploads/mail/', $attachment)[1];
					unlink($file);
				}
			}
			$wpdb->delete($table, array('id' => $_GET['delete']));
		}

		$users = $wpdb->get_results('SELECT * FROM '.$table.$orderby.$ordered, ARRAY_A);

		// Respuesta

		if (isset($_POST['response_date']) && $_POST['response_date'] != '') {

			if (b_f_option('b_opt_smtp') == 1) {
				add_action('phpmailer_init', 'b_f_smtp_server');
			}

			$data = array();
			$data['subject'] = $_POST['subject'];
			$data['message'] = $_POST['message'];
			$data['date'] = $_POST['response_date'];

			$data = array('response' => serialize($data));

			// Variables locales
			$headers = 'From: '.get_bloginfo('name').' <'.b_f_option('b_opt_form-email').'>'."\r\n";
			$headers .= 'charset=UTF-8';

			// Envío del formulario
			if (wp_mail($_POST['email'], $_POST['subject'], $_POST['message'], $headers)) {
				$wpdb->update($table, $data, array('id' => $_GET['contact']));
			}
		}

		if (isset($_GET['contact']) && $_GET['contact'] != '') {

			$user = $wpdb->get_row('SELECT * FROM '.$table.' WHERE id = '.$_GET['contact'], ARRAY_A);

			$wpdb->update($table, array('read' => date('d/m/Y H:i', strtotime((substr(get_option('gmt_offset'), 0, 1) == '-' ? '' : '+').get_option('gmt_offset').' hours'))), array('id' => $_GET['contact'], 'read' => 'no'));

			?>

			<div class="wrap">
				<h1>Mensaje</h1>
				<div id="poststuff">
					<div id="post-body" class="columns-2">
						<div id="postbox-container-2" class="postbox-container">
							<div id="normal-sortables" class="meta-box-sortables ui-sortable">
								<div id="message_info" class="postbox">
									<h2 class="hndle ui-sortable-handle">
										<span>Detalles del mensaje</span>
									</h2>
									<div class="inside">

										<?php

										$data = unserialize($user['data']);

										foreach ($data as $key => $value) {
											$key = ucfirst($key);
											if (trim($key) != '') {
												echo '<strong style="display: block; vertical-align: top;">'.$key.'</strong><div style="display: block; vertical-align: top; margin-bottom: 16px;">'.$value.'</div>';
											}

										}

										?>

									</div>
								</div>
								<div id="contact-sender" class="postbox">
									<h2 class="hndle ui-sortable-handle">
										<span>Contactar con el usuario</span>
									</h2>
									<form style="margin: 0;" action="" method="post">
										<div class="inside">

											<?php

											if ($user['response'] != '') {

												$response = unserialize($user['response']);

												?>

												<strong>Asunto</strong>
												<div style="display: block; font-size: 12px; margin-bottom: 16px; width: 100%;"><?= $response['subject'] ?></div>
												<strong>Mensaje</strong>
												<div style="display: block; font-size: 12px; width: 100%;"><?= $response['message'] ?></div>

												<?php

											} else {

												?>

												<input name="subject" type="text" value="<?php printf(__('Response to the message sent from &quot;%s&quot; website ', 'bilnea'), get_bloginfo('name')); ?>" style="font-size: 12px; border: 1px solid #ddd; width: 100%; border-radius: 5px; margin-bottom: 16px;">
												<strong>Mensaje</strong>
												<textarea name="message" rows="6" style="font-size: 12px; border: 1px solid #ddd; border-radius: 5px; resize: none; box-shadow: none; width: 100%; outline: 0;"></textarea>
												<input type="hidden" name="response_date" value="<?= date('c') ?>" />
												<input type="hidden" name="email" value="<?= $user['email'] ?>" />

												<?php

											}

											?>

										</div>
										<div id="major-publishing-actions">

											<?php

											if ($user['response'] != '') {

												$response = unserialize($user['response']);

												?>

												<div id="delete-action">
													Respuesta enviada el <?= date('j M \d\e Y \@ G:i', strtotime($response['date'])) ?>
												</div>

												<?php

											}

											?>

											<div id="publishing-action">
												<span class="spinner"></span>

												<?php

												if ($user['response'] != '') {
													echo '<input name="save" type="submit" class="button button-primary button-large" id="publish" value="Enviar mensaje" disabled>';
												} else {
													echo '<input name="save" type="submit" class="button button-primary button-large" id="publish" value="Enviar mensaje">';
												}

												?>

											</div>
											<div class="clear"></div>
										</div>
									</form>
								</div>
							</div>
						</div>
						<div id="postbox-container-1" class="postbox-container">
							<div id="side-sortables" class="">
								<div id="submitdiv" class="postbox">
									<h2 class="hndle ui-sortable-handle">
										<span>Información</span>
									</h2>
									<div class="inside">
										<div class="submitbox" id="submitpost">
											<div id="minor-publishing">
												<div id="misc-publishing-actions">
													<div class="misc-pub-section misc-pub-post-status">
														<label for="post_status">Estado:</label>
														<span id="post-status-display"><?php echo ($user['status'] == 'sent') ? 'Enviado sin errores' : 'Error al enviar'; ?></span>
													</div>
													<div class="misc-pub-section misc-pub-visibility" id="visibility"> Leído: <span id="post-visibility-display"><?php echo ($user['read'] == 'no') ? 'No leído' : 'Leído'; ?></span>
													</div>
													<div class="misc-pub-section curtime misc-pub-curtime">
														<span id="timestamp"> Enviado el: <b><?= date('j M \d\e Y \@ G:i', strtotime($user['date'])) ?></b></span>
													</div>
												</div>
												<div class="clear"></div>
											</div>
											<div id="major-publishing-actions">
												<div id="delete-action">
													<a class="submitdelete deletion" href="<?= site_url('wp-admin/admin.php') ?>?page=contact_forms&delete=<?= $user['id'] ?>">Eliminar mensaje</a>
												</div>
												<div class="clear"></div>
											</div>
										</div>
									</div>
								</div>
								<div id="senderdiv" class="postbox">
									<h2 class="hndle ui-sortable-handle">
										<span>Remitente</span>
									</h2>
									<div class="inside">
										<p>
											<strong>Idioma</strong><br />
											<?= $b_g_languages[$user['lang']]['nativeName'] ?>
										</p>
										<p>
											<strong>Correo electrónico</strong><br />
											<a href="mailto:<?= $user['email'] ?>"><?= $user['email'] ?></a>
										</p>
										<p>
											<strong>Dirección IP</strong><br />
											<?= $user['ip'] ?>
										</p>
									</div>
								</div>
								<div id="senderdiv" class="postbox">
									<h2 class="hndle ui-sortable-handle">
										<span>Datos del formulario</span>
									</h2>
									<div class="inside">
										<p>
											<strong>Ubicación</strong><br />
											<a href="<?= get_permalink($user['page']) ?>"><?= get_the_title($user['page']) ?></a>
										</p>
										<p>
											<strong>Nombre</strong><br />
											<?= $user['formname'] ?>
										</p>
									</div>
								</div>

								<?php

								if (count(unserialize($user['attachments'])) > 0) {

									?>

									<div id="attachments" class="postbox">
										<h2 class="hndle ui-sortable-handle">
											<span>Archivos adjuntos</span>
										</h2>
										<div class="inside">

											<?php

											foreach (unserialize($user['attachments']) as $file_url) {

												switch (end(explode('.', $file_url))) {
													case 'pdf':
													case 'doc':
													case 'docx':
													case 'odt':
														$media = 'text';
														break;
													case 'xls':
													case 'xlsx':
														$media = 'spreadsheet';
														break;
													case 'ppt':
													case 'pptx':
														$media = 'interactive';
														break;
													case 'zip':
													case 'rar':
													case 'ace':
													case '7z':
													case 'gz':
														$media = 'archive';
														break;
													case 'wav':
													case 'mp3':
													case 'm4a':
													case 'oga':
														$media = 'audio';
														break;
													case 'mov':
													case 'mpeg':
													case 'mpg':
													case 'avi':
													case 'asf':
													case 'mp4':
													case 'm4v':
													case 'm2v':
													case 'vob':
														$media = 'video';
														break;
													default:
														$media = 'default';
														break;
												}
												echo '<p><a class="dashicons dashicons-media-'.$media.'" href="'.$file_url.'" target="_blank"></a><a href="'.$file_url.'" target="_blank"><strong>'.end(explode('/', $file_url)).'</strong></a><br />'.number_format((filesize(ABSPATH.'/wp-content'.explode('/wp-content', $file_url)[1])/1024), 2, '\'', '.').' Kb</p>';
											}

											?>
										</div>
									</div>

									<?php

								}

								?>

							</div>
						</div>
					</div>
				</div>
			</div>

			<?php

		} else {

			if (isset($_GET['form']) && $_GET['form'] != '') {

				$fingerprint = base64_decode(urldecode($_GET['form']));

				$users = $wpdb->get_results('SELECT * FROM `'.$table.'` WHERE CONCAT(`formname`, `lang`) = "'.$fingerprint.'" '.$orderby.$ordered, ARRAY_A);

				$page = 1;

				if (isset($_GET['index']) && $_GET['index'] != '') {
					$page = (int)$_GET['index'];
				}

				$i = 0;

				$all = $seen = $unseen = $error = 0;

				foreach ($users as $index => $user) {

					$unset = 0;

					if ($_GET['start'] != '' || $_GET['end'] != '') {

						$date = date('Ymd', strtotime($user['date']));

						if ($_GET['start'] != '' && $date < date('Ymd', strtotime($_GET['start']))) {
							$unset++;
						}

						if ($_GET['end'] != '' && $date > date('Ymd', strtotime($_GET['end']))) {
							$unset++;
						}

					}

					if (isset($_GET['seen']) && $user['read'] != 'yes') {
						$unset++;
					}

					if (isset($_GET['unseen']) && $user['read'] == 'yes') {
						$unset++;
					}

					if (isset($_GET['warning']) && $user['status'] != 'error') {
						$unset++;
					}

					if ($user['read'] == 'yes') {
						$seen++;
					} else {
						$unseen++;
					}

					if ($user['status'] == 'error') {
						$error++;
					}

					$all++;

					if ($unset > 0) {
						unset($users[$index]);
						continue;
					} else {
						$i++;
						if ($i < (($page-1)*50) || $i > ($page*50)) {
							unset($users[$index]);
							continue;
						}
					}

					$users[$index]['data'] = unserialize($user['data']);

				}

				?>

				<div class="wrap">
					<h1>Formularios de contacto</h1>
					<ul class="subsubsub">
						<li class="all">
							<a href="<?= site_url('wp-admin/admin.php?page=contact_forms') ?>" class="current" aria-current="page">Volver</a> |
						</li>
						<li>
							<a href="<?= site_url('wp-admin/admin.php') ?>?page=contact_forms&form=<?= $_GET['form'] ?>&orderby=date&order=<?= $order ?>">Todos <span class="count">(<?= $all ?>)</span></a> |
						</li>
						<li>
							<a href="<?= site_url('wp-admin/admin.php') ?>?page=contact_forms&form=<?= $_GET['form'] ?>&orderby=date&order=<?= $order ?>&seen">Leídos <span class="count">(<?= $seen ?>)</span></a> |
						</li>
						<li>
							<a href="<?= site_url('wp-admin/admin.php') ?>?page=contact_forms&form=<?= $_GET['form'] ?>&orderby=date&order=<?= $order ?>&unseen">No leídos <span class="count">(<?= $unseen ?>)</span></a> |
						</li>
						<li>
							<a href="<?= site_url('wp-admin/admin.php') ?>?page=contact_forms&form=<?= $_GET['form'] ?>&orderby=date&order=<?= $order ?>&warning">Error <span class="count">(<?= $error ?>)</span></a>
						</li>
					</ul>
					<div class="tablenav top" style="padding-bottom: 10px;">
						<div class="alignleft actions">
							<form mhetod="get">
								<?php
								foreach ($_GET as $index => $value) {
									if (!in_array($index, array('start', 'end'))) {
										echo '<input type="hidden" name="'.$index.'" value="'.$value.'">';
									}
								}
								?>
								<span>Desde</span>
								<input type="date" name="start" value="<?= ($_GET['start'] ? $_GET['start'] : '') ?>">
								<span>Hasta</span>
								<input type="date" name="end" value="<?= ($_GET['end'] ? $_GET['end'] : '') ?>">
								<input type="submit" class="button action" value="Filtrar">
								<input type="submit" name="csv" class="button action" value="Descargar CSV">
							</form>
						</div>
						<div class="tablenav-pages">
							<span class="displaying-num"><?= $all ?> elementos</span>
							<span class="pagination-links">
								<?php
									$gets = array();
									foreach ($_GET as $key => $value) {
										if ($key != 'index') {
											array_push($gets, $key.'='.$value);
										}
									}
									$url = site_url('wp-admin/admin.php').'?'.implode('&', $gets);
									if ($page == 1) {
										?>
										<span class="tablenav-pages-navspan" aria-hidden="true">«</span>
										<span class="tablenav-pages-navspan" aria-hidden="true">‹</span>
										<?php
									} else {
										?>
										<a class="first-page" href="<?= $url ?>">
											<span aria-hidden="true">«</span>
										</a>
										<a class="prev-page" href="<?= $url.($page > 1 ? '&index='.($page-1) : '') ?>">
											<span aria-hidden="true">‹</span>
										</a>
										<?php
									}
								?>
								<span class="paging-input">
									<label for="current-page-selector" class="screen-reader-text">Página actual</label>
									<input class="current-page" id="current-page-selector" type="text" name="paged" value="<?= $page ?>" size="1" aria-describedby="table-paging">
									<span class="tablenav-paging-text"> de <span class="total-pages"><?= ceil($all/50) ?></span></span>
								</span>
								<?php
									if ($page == ceil($all/50)) {
										?>
										<span class="tablenav-pages-navspan" aria-hidden="true">›</span>
										<span class="tablenav-pages-navspan" aria-hidden="true">»</span>
										<?php
									} else {
										?>
										<a class="next-page" href="<?= $url.($page < ceil($all/50) ? '&index='.($page+1) : '') ?>">
											<span aria-hidden="true">›</span>
										</a>
										<a class="last-page" href="<?= $url.'&index='.ceil($all/50) ?>">
											<span aria-hidden="true">»</span>
										</a>
										<?php
									}
								?>
							</span>
						</div>
					</div>
					<table class="wp-list-table widefat fixed striped pages">
						<thead>
							<tr>
								<th style="width: 30px;">
									&nbsp;
								</th>
								<th scope="col" id="date" class="manage-column column-date <?= $sorts['date'] ?>">
									<a href="<?= site_url('wp-admin/admin.php') ?>?page=contact_forms&form=<?= $_GET['form'] ?>&orderby=date&order=<?= $order ?>">
										<span>Fecha</span>
										<span class="sorting-indicator"></span>
									</a>
								</th>
								<th scope="col" id="date" class="manage-column column-email <?= $sorts['email'] ?>">
									<a href="<?= site_url('wp-admin/admin.php') ?>?page=contact_forms&form=<?= $_GET['form'] ?>&orderby=email&order=<?= $order ?>">
										<span>Correo electrónico</span>
										<span class="sorting-indicator"></span>
									</a>
								</th>
								<th scope="col" id="page" class="manage-columns column-page">
									<span>Ubicación</span>
								</th>
								<th scope="col" id="date" class="manage-column column-status <?= $sorts['status'] ?>">
									<span>Estado</span>
								</th>
								<th scope="col" id="fields" class="manage-column column-fields">
									<span>Número de campos</span>
								</th>
								<th style="width: 30px;">
									&nbsp;
								</th>
							</tr>
						</thead>
						<tbody>

							<?php

							if (count($users) == 0) {

								echo '<tr><td colspan="5">No se han encontrado registros.</td></tr>';

							} else {

								foreach ($users as $user) {

									?>
									<tr id="subscriber-<?= $user['id'] ?>" class="iedit author-self level-0 post-<?= $user['id'] ?> status-publish hentry">
										<td>
											<?php

											if ($user['status'] == 'error') {
												echo '<span class="dashicons dashicons-warning"></span>&nbsp;';
											}

											?>
										</td>
										<td class="date column-date" data-colname="Fecha">
											<a href="<?= site_url('wp-admin/admin.php') ?>?page=contact_forms&contact=<?= $user['id'] ?>">
											<?= date('d/m/Y G:i', strtotime($user['date'])) ?>
											</a>
										</td>
										<td class="date column-email" data-colname="Correo electrónico">
											<?php if ($user['email'] == '') { ?>
												Sin correo electrónico
											<?php } else { ?>
												<a href="mailto:<?= $user['email'] ?>">
												<?= $user['email'] ?>
												</a>
											<?php } ?>
										</td>
										<td>
											<a href="<?= get_permalink($user['page']) ?>">
												<span><?= get_the_title($user['page']) ?></span>
											</a>
										</td>
										<td>
											<?php
											if ($user['read'] == 'no') {
												echo 'No leído';
											} else {
												echo 'Leído '.$user['read'];
											}
											?>
										</td>
										<td>
											<?= count($user['data']) ?>
										</td>
										<td>
											<a class="submitdelete deletion" href="<?= site_url('wp-admin/admin.php') ?>?page=contact_forms&delete=<?= $user['id'] ?>"><span class="dashicons dashicons-trash"></span></a>
										</td>
									</tr>

									<?php
								}

							}

							?>

						</tbody>
						<tfoot>
							<tr>
								<th style="width: 30px;">
									&nbsp;
								</th>
								<th scope="col" id="date" class="manage-column column-date <?= $sorts['date'] ?>">
									<a href="<?= site_url('wp-admin/admin.php') ?>?page=contact_forms&form=<?= $_GET['form'] ?>&orderby=date&order=<?= $order ?>">
										<span>Fecha</span>
										<span class="sorting-indicator"></span>
									</a>
								</th>
								<th scope="col" id="date" class="manage-column column-email <?= $sorts['email'] ?>">
									<a href="<?= site_url('wp-admin/admin.php') ?>?page=contact_forms&form=<?= $_GET['form'] ?>&orderby=email&order=<?= $order ?>">
										<span>Correo electrónico</span>
										<span class="sorting-indicator"></span>
									</a>
								</th>
								<th scope="col" id="page" class="manage-columns column-page">
									<span>Ubicación</span>
								</th>
								<th scope="col" id="date" class="manage-column column-status <?= $sorts['status'] ?>">
									<span>Estado</span>
								</th>
								<th scope="col" id="fields" class="manage-column column-fields">
									<span>Número de campos</span>
								</th>
								<th style="width: 30px;">
									&nbsp;
								</th>
							</tr>
						</tfoot>
					</table>
				</div>

				<?php

			} else {

				$order = (isset($_GET['order']) && $_GET['order'] == 'des') ? 'asc' : 'des';

				$sorts = array(
					'title' => 'sortable asc',
					'page' 	=> 'sortable asc',
					'lang' 	=> 'sortable asc',
					'date' 	=> 'sortable asc',
					'count' => 'sortable asc'
				);

				if (isset($_GET['orderby'])) {

					$sorts[$_GET['orderby']] = 'sorted '.$order;

				} else {

					$sorts['count'] = 'sorted '.$order;

				}

				$orderby = (isset($_GET['orderby']) && $_GET['orderby'] != '') ? ' ORDER BY `'.$_GET['orderby'].'`' : ' ORDER BY `count`';

				$orderby .= ($order == 'des') ? ' ASC' : ' DESC';

				?>

				<div class="wrap">
					<h1>Formularios de contacto</h1>
					<table class="wp-list-table widefat fixed striped pages">
						<thead>
							<tr>
								<th scope="col" id="title" class="column-title <?= $sorts['title'] ?>">
									<a><span>Formulario</span></a>
								</th>
								<th scope="col" id="language" class="manage-column column-language">
									<span>Idioma</span>
								</th>
								<th scope="col" id="date" class="manage-column column-date <?= $sorts['date'] ?>">
									<a href="<?= site_url('wp-admin/admin.php') ?>?page=contact_forms&orderby=date&order=<?= $order ?>">
										<span>Último registro</span>
										<span class="sorting-indicator"></span>
									</a>
								</th>
								<th scope="col" id="count" class="manage-column column-date <?= $sorts['count'] ?>">
									<a href="<?= site_url('wp-admin/admin.php') ?>?page=contact_forms&orderby=count&order=<?= $order ?>">
										<span>Registros</span>
										<span class="sorting-indicator"></span>
									</a>
								</th>
							</tr>
						</thead>
						<tbody>

							<?php

							global $b_g_languages;

							$forms = $wpdb->get_results('SELECT `date`, `page` AS "page_id", `post_title` AS "page", `formname` AS "title", `lang`, COUNT(*) AS "count", MAX(`date`) as "date", CONCAT(`formname`, `lang`) AS "uid" FROM `'.$table.'` AS t1 LEFT JOIN `'.$wpdb->prefix.'posts` AS t2 ON t1.page = t2.id GROUP BY `uid`'.$orderby, ARRAY_A);

							if (count($forms) == 0) {

								echo '<tr><td colspan="4">No se han encontrado formularios.</td></tr>';

							} else {

								foreach ($forms as $id => $form) {

									?>

									<tr class="iedit author-self level-0 form-<?= substr($id, 2) ?> status-publish hentry">
										<td class="date column-name" data-colname="Nombre">
											<a href="<?= site_url('wp-admin/admin.php') ?>?page=contact_forms&form=<?= base64_encode($form['uid']) ?>">
												<strong><?= $form['title'] ?></strong>
											</a>
										</td>
										<td class="title column-language" data-colname="Idioma">
											<?php

											if (function_exists('icl_object_id')) {
												echo apply_filters( 'wpml_post_language_details', NULL, $form['page_id'])['display_name'];
											} else if (function_exists('pll_the_languages')) {
												echo get_term_by('slug', $form['lang'], 'language')->name;
											} else {
												echo 'Español';
											}

											?>
										</td>
										<td class="date column-date" data-colname="Fecha">
											<?= date('d/m/Y H:i', strtotime($form['date'])) ?>
										</td>
										<td class="date column-date" data-colname="Formulario">
											<?= $form['count'] ?>
										</td>
									</tr>

									<?php
								}

							}

							?>

						</tbody>
						<tfoot>
							<tr>
								<th scope="col" id="title" class="manage-column column-title <?= $sorts['title'] ?>">
									<a><span>Formulario</span></a>
								</th>
								<th scope="col" id="language" class="manage-column column-language">
									<span>Idioma</span>
								</th>
								<th scope="col" id="date" class="manage-column column-date <?= $sorts['date'] ?>">
									<a href="<?= site_url('wp-admin/admin.php') ?>?page=contact_forms&orderby=date&order=<?= $order ?>">
										<span>Último registro</span>
										<span class="sorting-indicator"></span>
									</a>
								</th>
								<th scope="col" id="count" class="manage-column column-posts <?= $sorts['count'] ?>">
									<a href="<?= site_url('wp-admin/admin.php') ?>?page=contact_forms&orderby=count&order=<?= $order ?>">
										<span>Registros</span>
										<span class="sorting-indicator"></span>
									</a>
								</th>
							</tr>
						</tfoot>
					</table>
				</div>

				<?php

			}

		}

	}

}

function b_i_csv() {

	if (isset($_GET['csv']) && $_GET['csv'] != '') {

		header('Content-Type: text/csv');
		header('Content-Disposition: attachment; filename="Form '.date('y-m-d-H-i').'.csv"');

		global $wpdb, $b_g_languages;

		(isset($_GET['orderby']) && $_GET['orderby'] != '') ? $orderby = ' ORDER BY '.$_GET['orderby'] : $orderby = ' ORDER BY `date`';
		($order == 'des') ? $ordered = ' DESC' : $ordered = ' ASC';

		// Conexión a la base de datos
		$table = $wpdb->prefix.'form_users';

		$fingerprint = base64_decode(urldecode($_GET['form']));

		$users = $wpdb->get_results('SELECT * FROM `'.$table.'` WHERE CONCAT(`formname`, `lang`) = "'.$fingerprint.'" '.$orderby.$ordered, ARRAY_A);

		$columns = array('ID', 'Procedencia', 'Idioma', 'Fecha', 'Hora');

		$i = 1;

		foreach ($users as $index => $user) {

			$unset = 0;

			if ($_GET['start'] != '' || $_GET['end'] != '') {

				$date = date('Ymd', strtotime($user['date']));

				if ($_GET['start'] != '' && $date < date('Ymd', strtotime($_GET['start']))) {
					$unset++;
				}

				if ($_GET['end'] != '' && $date > date('Ymd', strtotime($_GET['end']))) {
					$unset++;
				}

			}

			if (isset($_GET['seen']) && $user['read'] != 'yes') {
				$unset++;
			}

			if (isset($_GET['unseen']) && $user['read'] == 'yes') {
				$unset++;
			}

			if (isset($_GET['warning']) && $user['status'] != 'error') {
				$unset++;
			}

			foreach (unserialize($user['data']) as $key => $value) {
				if (!in_array($key, $columns) && $key != '') {
					array_push($columns, $key);
				}
			}


			$users[$index]['ID'] = $i;

			$i++;

			if ($unset > 0) {
				unset($users[$index]);
				continue;
			}

			$users[$index]['data'] = unserialize($user['data']);

		}

		$csv = array($columns);

		foreach ($users as $user) {

			if (function_exists('icl_object_id')) {
				echo apply_filters( 'wpml_post_language_details', NULL, $form['page_id'])['display_name'];
			} else if (function_exists('pll_the_languages')) {
				echo get_term_by('slug', $form['lang'], 'language')->name;
			} else {
				echo 'Español';
			}

			$temp = array($user['ID'], get_the_title($user['page']), $b_g_languages[$user['lang']]['nativeName'], date('d/m/Y', strtotime($user['date'])), date('H:i', strtotime($user['date'])));
			foreach ($columns as $column) {
				if (!in_array($column, array('ID', 'Procedencia', 'Idioma', 'Fecha', 'Hora'))) {
					if (!isset($user['data'][$column])) {
						array_push($temp, '');
					} else {
						array_push($temp, $user['data'][$column]);
					}
				}
			}
			array_push($csv, $temp);
			$i++;
		}

		$fp = fopen('php://output', 'wb');

		fputs($fp, $bom = (chr(0xEF).chr(0xBB).chr(0xBF)));

		foreach ($csv as $line) {

			fputcsv($fp, $line, ';');

		}

		fclose($fp);

		die();

	}

}

add_action('admin_init', 'b_i_csv');

?>