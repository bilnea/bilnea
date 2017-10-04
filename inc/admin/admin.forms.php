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
		$var_url = explode('?', $_SERVER['REQUEST_URI'], 2)[0];

		(isset($_GET['order']) && $_GET['order'] == 'asc') ? $var_order = 'des' : $var_order = 'asc';

		if (isset($_GET['orderby'])) {
			$var_sorts = array('date' => 'sortable asc', 'email' => 'sortable asc', 'data' => 'sortable asc', 'formname' => 'sortable asc');
			$var_sorts[$_GET['orderby']] = 'sorted '.$var_order;
		} else {
			$var_sorts = array('date' => 'sorted '.$var_order, 'email' => 'sortable asc', 'data' => 'sortable asc', 'formname' => 'sortable asc');
		}

		(isset($_GET['orderby']) && $_GET['orderby'] != '') ? $var_orderby = ' ORDER BY '.$_GET['orderby'] : $var_orderby = ' ORDER BY `date`';
		($var_order == 'des') ? $var_ordered = ' DESC' : $var_ordered = ' ASC';

		// Conexión a la base de datos
		$var_table = $wpdb->prefix.'form_users';

		if (isset($_GET['delete']) && $_GET['delete'] != '') {
			$var_data = $wpdb->get_results('SELECT * FROM '.$var_table.' WHERE id = '.$_GET['delete'], ARRAY_A)[0];
			b_f_i_rmdir(pathinfo(ABSPATH.'wp-content'.explode('/wp-content', unserialize($var_data['attachments'])[0])[1])['dirname']);
			$wpdb->delete($var_table, array('id' => $_GET['delete']));
		}

		$var_users = $wpdb->get_results('SELECT * FROM '.$var_table.$var_orderby.$var_ordered, ARRAY_A);

		// Respuesta

		if (isset($_POST['response_date']) && $_POST['response_date'] != '') {

			if (b_f_option('b_opt_smtp') == 1) {
				add_action('phpmailer_init', 'b_f_smtp_server');
			}

			$var_data = array();
			$var_data['subject'] = $_POST['subject'];
			$var_data['message'] = $_POST['message'];
			$var_data['date'] = $_POST['response_date'];

			$var_data = array('response' => serialize($var_data));

			// Variables locales
			$var_headers = 'From: '.get_bloginfo('name').' <'.b_f_option('b_opt_form-email').'>'."\r\n";
			$var_headers .= 'charset=UTF-8';

			// Envío del formulario
			if (wp_mail($_POST['email'], $_POST['subject'], $_POST['message'], $var_headers)) {
				$wpdb->update($var_table, $var_data, array('id' => $_GET['contact']));
			}
		}

		if (isset($_GET['contact']) && $_GET['contact'] != '') {

			$var_user = $wpdb->get_results('SELECT * FROM '.$var_table.' WHERE id = '.$_GET['contact'], ARRAY_A)[0];

			$wpdb->update($var_table, array('read' => 'yes'), array('id' => $_GET['contact']));
			
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

										$var_data = unserialize($var_user['data']);

										foreach ($var_data as $key => $value) {
											$key = ucfirst($key);
											echo '<strong style="display: block; vertical-align: top;">'.$key.'</strong><div style="display: block; vertical-align: top; margin-bottom: 16px;">'.$value.'</div>';
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

											if ($var_user['response'] != '') {
												
												$var_response = unserialize($var_user['response']);

												?>

												<strong>Asunto</strong>
												<div style="display: block; font-size: 12px; margin-bottom: 16px; width: 100%;"><?= $var_response['subject'] ?></div>
												<strong>Mensaje</strong>
												<div style="display: block; font-size: 12px; width: 100%;"><?= $var_response['message'] ?></div>

												<?php

											} else {

												?>

												<input name="subject" type="text" value="<?php printf(__('Response to the message sent from &quot;%s&quot; website ', 'bilnea'), get_bloginfo('name')); ?>" style="font-size: 12px; border: 1px solid #ddd; width: 100%; border-radius: 5px; margin-bottom: 16px;">
												<strong>Mensaje</strong>
												<textarea name="message" rows="6" style="font-size: 12px; border: 1px solid #ddd; border-radius: 5px; resize: none; box-shadow: none; width: 100%; outline: 0;"></textarea>
												<input type="hidden" name="response_date" value="<?= date('c') ?>" />
												<input type="hidden" name="email" value="<?= $var_user['email'] ?>" />

												<?php

											}

											?>

										</div>
										<div id="major-publishing-actions">

											<?php

											if ($var_user['response'] != '') {
												
												$var_response = unserialize($var_user['response']);

												?>

												<div id="delete-action">
													Respuesta enviada el <?= date('j M \d\e Y \@ G:i', strtotime($var_response['date'])) ?>
												</div>

												<?php

											}

											?>

											<div id="publishing-action">
												<span class="spinner"></span>

												<?php

												if ($var_user['response'] != '') {
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
														<span id="post-status-display"><?php echo ($var_user['status'] == 'sent') ? 'Enviado sin errores' : 'Error al enviar'; ?></span>
													</div>
													<div class="misc-pub-section misc-pub-visibility" id="visibility"> Leído: <span id="post-visibility-display"><?php echo ($var_user['read'] == 'no') ? 'No leído' : 'Leído'; ?></span>
													</div>
													<div class="misc-pub-section curtime misc-pub-curtime">
														<span id="timestamp"> Enviado el: <b><?= date('j M \d\e Y \@ G:i', strtotime($var_user['date'])) ?></b></span>
													</div>
												</div>
												<div class="clear"></div>
											</div>
											<div id="major-publishing-actions">
												<div id="delete-action">
													<a class="submitdelete deletion" href="<?= 'http'.((is_ssl()) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$var_url}" ?>?page=contact_forms&delete=<?= $var_user['id'] ?>">Eliminar mensaje</a>
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
											<?= $b_g_languages[$var_user['lang']]['nativeName'] ?>
										</p>
										<p>
											<strong>Correo electrónico</strong><br />
											<a href="mailto:<?= $var_user['email'] ?>"><?= $var_user['email'] ?></a>
										</p>
										<p>
											<strong>Dirección IP</strong><br />
											<?= $var_user['ip'] ?>
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
											<a href="mailto:<?= get_permalink($var_user['page']) ?>"><?= get_the_title($var_user['page']) ?></a>
										</p>
										<p>
											<strong>Nombre</strong><br />
											<?= $var_user['formname'] ?>
										</p>
									</div>
								</div>
								
								<?php

								if (count(unserialize($var_user['attachments'])) > 0) {
									
									?>

									<div id="attachments" class="postbox">
										<h2 class="hndle ui-sortable-handle">
											<span>Archivos adjuntos</span>
										</h2>
										<div class="inside">

											<?php

											foreach (unserialize($var_user['attachments']) as $file_url) {

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

			?>
			
			<div class="wrap">
				<h1>Formularios de contacto</h1>
				<table class="wp-list-table widefat fixed striped pages">
					<thead>
						<tr>
							<td id="cb" class="manage-column column-cb check-column">
								<label class="screen-reader-text" for="cb-select-all-1">Seleccionar todos</label>
								<input id="cb-select-all-1" type="checkbox">
							</td>
							<th scope="col" id="data" class="manage-column column-title <?= $var_sorts['data'] ?>">
								<a href="<?= 'http'.((is_ssl()) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$var_url}" ?>?page=contact_forms&orderby=data&order=<?= $var_order ?>">
									<span>Nombre</span>
									<span class="sorting-indicator"></span>
								</a>
							</th>
							<th scope="col" id="email" class="manage-column column-title <?= $var_sorts['email'] ?>">
								<a href="<?= 'http'.((is_ssl()) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$var_url}" ?>?page=contact_forms&orderby=email&order=<?= $var_order ?>">
									<span>Correo electrónico</span>
									<span class="sorting-indicator"></span>
								</a>
							</th>
							<th scope="col" id="date" class="manage-column column-title <?= $var_sorts['date'] ?>">
								<a href="<?= 'http'.((is_ssl()) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$var_url}" ?>?page=contact_forms&orderby=date&order=<?= $var_order ?>">
									<span>Fecha</span>
									<span class="sorting-indicator"></span>
								</a>
							</th>
							<th scope="col" id="form" class="manage-column column-title <?= $var_sorts['formname'] ?>">
								<a href="<?= 'http'.((is_ssl()) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$var_url}" ?>?page=contact_forms&orderby=formname&order=<?= $var_order ?>">
									<span>Formulario</span>
									<span class="sorting-indicator"></span>
								</a>
							</th>
							<th style="width: 30px;">
							</th>
						</tr>
					</thead>
					<tbody>

						<?php

						if (count($var_users) == 0) {

							echo '<tr><td colspan="6">No se han encontrado registros.</td></tr>';

						} else {

							foreach ($var_users as $var_user) {

								?>

								<tr id="subscriber-<?= $var_user['id'] ?>" class="iedit author-self level-0 post-<?= $var_user['id'] ?> status-publish hentry">
									<th scope="row" class="check-column">
										<label class="screen-reader-text" for="cb-select-<?= $var_user['id'] ?>">Elige usuario</label>
										<input id="cb-select-<?= $var_user['id'] ?>" type="checkbox" name="post[]" value="<?= $var_user['id'] ?>">
										<div class="locked-indicator"></div>
									</th>
									<td class="date column-name" data-colname="Nombre">
										<a href="<?= 'http'.((is_ssl()) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$var_url}" ?>?page=contact_forms&contact=<?= $var_user['id'] ?>">
											<?php

											$var_data = unserialize($var_user['data']);

											if ($var_user['read'] == 'no') {
												$out = '<strong>';
											} else {
												$out = '';
											}

											if ($var_data['Nombre'] == '' && $var_data['Apellidos'] == '') {
												$out .= '(Sin nombre)';
											} else {
												if ($var_data['Nombre'] != '') {
													$out .= ' '.$var_data['Nombre'];
												}
												
												if ($var_data['Apellidos'] != '') {
													$out .= ' '.$var_data['Apellidos'];
												}
											}

											if ($var_user['read'] == 'no') {
												$out .= '</strong>';
											}

											if (count(unserialize($var_user['attachments'])) > 0) {
												$out .= ' <span class="dashicons dashicons-admin-page"></span>';
											}

											echo $out;
											
											?>
										</a>
									</td>
									<td class="title column-email has-row-actions column-primary page-title" data-colname="Correo electrónico">
										<a class="row-email" href="mailto:<?= $var_user['email'] ?>">
											<?= $var_user['email'] ?>
										</a>
									</td>
									<td class="date column-date" data-colname="Fecha">
										<?php

										if ($var_user['status'] == 'error') {
											echo '<span class="dashicons dashicons-warning"></span>&nbsp;';
										}

										echo date('d/m/Y G:i', strtotime($var_user['date']));
										
										?>
									</td>
									<td class="date column-form" data-colname="Formulario">
										<a href="<?= get_permalink($var_user['page']) ?>"><?= $var_user['formname'] ?></a>
									</td>
									<td>
										<a href="<?= 'http'.((is_ssl()) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$var_url}" ?>?page=contact_forms&delete=<?= $var_user['id'] ?>"><span class="dashicons dashicons-trash"></span></a>
									</td>
								</tr>

								<?php
							}

						}

						?>

					</tbody>
					<tfoot>
						<tr>
							<td id="cb" class="manage-column column-cb check-column">
								<label class="screen-reader-text" for="cb-select-all-1">Seleccionar todos</label>
								<input id="cb-select-all-1" type="checkbox">
							</td>
							<th scope="col" id="data" class="manage-column column-title <?= $var_sorts['data'] ?>">
								<a href="<?= 'http'.((is_ssl()) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$var_url}" ?>?page=contact_forms&orderby=data&order=<?= $var_order ?>">
									<span>Nombre</span>
									<span class="sorting-indicator"></span>
								</a>
							</th>
							<th scope="col" id="email" class="manage-column column-title <?= $var_sorts['email'] ?>">
								<a href="<?= 'http'.((is_ssl()) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$var_url}" ?>?page=contact_forms&orderby=email&order=<?= $var_order ?>">
									<span>Correo electrónico</span>
									<span class="sorting-indicator"></span>
								</a>
							</th>
							<th scope="col" id="date" class="manage-column column-title <?= $var_sorts['date'] ?>">
								<a href="<?= 'http'.((is_ssl()) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$var_url}" ?>?page=contact_forms&orderby=date&order=<?= $var_order ?>">
									<span>Fecha</span>
									<span class="sorting-indicator"></span>
								</a>
							</th>
							<th scope="col" id="form" class="manage-column column-title <?= $var_sorts['formname'] ?>">
								<a href="<?= 'http'.((is_ssl()) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$var_url}" ?>?page=contact_forms&orderby=formname&order=<?= $var_order ?>">
									<span>Formulario</span>
									<span class="sorting-indicator"></span>
								</a>
							</th>
							<th style="width: 30px;">
							</th>
						</tr>
					</tfoot>
				</table>
			</div>

			<?php

		}
	}

}

?>