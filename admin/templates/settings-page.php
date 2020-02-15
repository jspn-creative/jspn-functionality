			<div class="wrap">
				<h1><?php esc_html_e(get_admin_page_title());?></h1>
				<form method="post" action="options.php">
					<?php settings_fields(JSPN_Add_Settings::general_settings_section());?>
					<?php do_settings_sections('jspn');?>
					<?php submit_button();?>
				</form>
			</div>