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

		// Variables locales
		$var_url = explode('?', $_SERVER['REQUEST_URI'], 2)[0];

		(isset($_GET['order']) && $_GET['order'] == 'asc') ? $var_order = 'des' : $var_order = 'asc';

		if (isset($_GET['orderby'])) {
			$var_sorts = array('b_s_date' => 'sortable asc', 'b_s_email' => 'sortable asc', 'b_s_name' => 'sortable asc', 'b_s_last_name' => 'sortable asc');
			$var_sorts[$_GET['orderby']] = 'sorted '.$var_order;
		}

		$var_table = $wpdb->prefix.'forms_users';
		$var_users = $wpdb->get_results('SELECT * FROM '.$var_table, ARRAY_A);

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
						<th scope="col" id="b_s_name" class="manage-column column-title <?= $var_sorts['b_s_name'] ?>">
							<a href="<?= 'http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$var_url}" ?>?page=contact_forms&orderby=name&order=<?= $var_order ?>">
								<span>Nombre</span>
								<span class="sorting-indicator"></span>
							</a>
						</th>
						<th scope="col" id="b_s_email" class="manage-column column-title <?= $var_sorts['b_s_email'] ?>">
							<a href="<?= 'http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$var_url}" ?>?page=contact_forms&orderby=email&order=<?= $var_order ?>">
								<span>Correo electrónico</span>
								<span class="sorting-indicator"></span>
							</a>
						</th>
						<th scope="col" id="b_s_date" class="manage-column column-title <?= $var_sorts['b_s_date'] ?>">
							<a href="<?= 'http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$var_url}" ?>?page=contact_forms&orderby=date&order=<?= $var_order ?>">
								<span>Fecha</span>
								<span class="sorting-indicator"></span>
							</a>
						</th>
						<th scope="col" id="b_s_form" class="manage-column column-title <?= $var_sorts['b_s_last_name'] ?>">
							<a href="<?= 'http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$var_url}" ?>?page=contact_forms&orderby=form&order=<?= $var_order ?>">
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

					foreach ($var_users as $user) {

						?>

						<tr id="subscriber-<?= $user['id'] ?>" class="iedit author-self level-0 post-<?= $user['id'] ?> status-publish hentry">
							<th scope="row" class="check-column">
								<label class="screen-reader-text" for="cb-select-<?= $user['id'] ?>">Elige usuario</label>
								<input id="cb-select-<?= $user['id'] ?>" type="checkbox" name="post[]" value="<?= $user['id'] ?>">
								<div class="locked-indicator"></div>
							</th>
							<td class="date column-name" data-colname="Nombre">
								<a href="">
									<?php

									$var_data = unserialize($user['data']);

									$out = $var_data['name'];
									if ($var_data['last name'] != '') {
										$out .= ' '.$var_data['last name'];
									}

									echo $out;
									
									?>
								</a>
							</td>
							<td class="title column-email has-row-actions column-primary page-title" data-colname="Correo electrónico">
								<a class="row-email" href="mailto:<?= $user['email'] ?>">
									<?= $user['email'] ?>
								</a>
							</td>
							<td class="date column-date" data-colname="Fecha">
								<?php

								if ($user['status'] == 'error') {
									echo '<span class="dashicons dashicons-warning"></span>&nbsp;';
								}

								echo date('d/m/Y G:i', strtotime($user['date']));
								
								?>
							</td>
							<td class="date column-form" data-colname="Formulario">
								<?= $user['formname'] ?>
							</td>
							<td>
								<a href=""><span class="dashicons dashicons-trash"></span></a>
							</td>
						</tr>

						<?php
					}

					?>

				</tbody>
			</table>
		</div>

		<?php
	}

}

?>