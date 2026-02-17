<?php
	define('SITE_URL', 'https://reactheme.com/products/license');


	add_action( 'wp_head', 'check_reactheme_license' );
	function check_reactheme_license(){

		

		$current_domain = site_url();
		$license_code = get_option( 'reacthemes_license_code', true );
		$url = SITE_URL . '/wp-json/reacthemes/v2/check_license_domain/?relation=and&code='.$license_code.'&domain='.$current_domain;
		$response = wp_remote_post( $url, array(
			'method' => 'GET',
			'timeout' => 45,
			'redirection' => 5,
			'httpversion' => '1.0',
			'blocking' => true,
			'headers' => array(),
			'body' => array( 'code' => $license_code ),
			'cookies' => array()
			)
		);
	
		$status = json_decode(wp_remote_retrieve_body( $response ) );
		
		
	
		if($status === '404'){
			delete_option( 'reacthemes_license_status' );
			delete_option( 'reacthemes_license_code' );
			if(get_page_by_title( 'Reacthemes licence', 'page' ) == NULL) {
				$createPage = array(
					'post_title'    => 'Reacthemes licence',
					'post_content'  => '<h2 class="wp-block-heading has-text-align-center has-vivid-red-color has-text-color has-link-color wp-elements-6c820cef03ffd0c09683f73666742809">Your theme is not registered! Please register your theme to use all features.</h2>',
					'post_status'   => 'publish',
					'post_type'     => 'page',
					'post_name'     => 'Reacthemes licence'
				  );
				  // Insert the post into the database
				  wp_insert_post( $createPage );
			}
			if(get_page_by_title( 'Reacthemes licence', 'page' ) != NULL) {
				if(get_the_title() != 'Reacthemes licence'){
					wp_redirect( site_url().'/reacthemes-licence' );
				}
			}
		}
	}

	if(get_option( 'reacthemes_license_status') != "activated"){

		add_action( 'admin_notices', 'reacthemes_admin_notice_warn' );
		remove_action( 'tgmpa_register', 'unipix_register_required_plugins' );


		global $pagenow;

		if ( is_admin() && 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {

			wp_redirect( get_admin_url() . 'admin.php?page=reacthemes-license' ); // Your admin page URL
			
		}	
		
	}

	// delete domain from license
	add_action( 'rest_api_init', function () {

		register_rest_route( 'reacthemes/v2', '/remove_license_domain', array(

		'methods' => 'POST',
		'callback' => 'remove_license_domain',
		'args' => array(),
		'permission_callback' => '__return_true',
		) );
		
	
	} );  

	function remove_license_domain(){
		delete_option( 'reacthemes_license_status' );
		delete_option( 'reacthemes_license_code' );
		return '200';
	}	

	function reacthemes_admin_notice_warn() {
		echo '<div class="notice notice-warning is-dismissible">
			<p>Important: Your theme is not registered! Please register your theme to upload demo and use all features.</p>
			</div>'; 
	}

	class ReacthemesLicense {
		private $reacthemes_license_options;
		public function __construct() {
			add_action( 'admin_menu', array( $this, 'reacthemes_license_add_plugin_page' ) );
			add_action( 'admin_init', array( $this, 'reacthemes_license_page_init' ) );

		}

		public function reacthemes_license_add_plugin_page() {
			add_menu_page(
				'Reacthemes License', // page_title
				'Reacthemes License', // menu_title
				'manage_options', // capability
				'reacthemes-license', // menu_slug
				array( $this, 'reacthemes_license_create_admin_page' ), // function
				'dashicons-admin-generic', // icon_url
				2 // position
			);
		}

		public function getPurchaseCode($code) {
			$personalToken = "gWGKjUyOQq6HxvYLgeGvs4lK9xUthYIQ";
		
			// Surrounding whitespace can cause a 404 error, so trim it first
			$code = trim($code);
		
			// Make sure the code looks valid before sending it to Envato
			// This step is important - requests with incorrect formats can be blocked!
			if (!preg_match("/^([a-f0-9]{8})-(([a-f0-9]{4})-){3}([a-f0-9]{12})$/i", $code)) {
				throw new Exception("Invalid purchase code");
			}
		
			$url = "https://api.envato.com/v3/market/author/sale?code={$code}";
			
			$response = wp_remote_get($url, array(
				"headers" => array(
					"Authorization" => "Bearer {$personalToken}",
					"User-Agent" => "Purchase code verification script"
				)
			));
		
			if (is_wp_error($response)) {
				throw new Exception("Failed to look up purchase code");
			}
		
			$responseCode = wp_remote_retrieve_response_code($response);
		
			switch ($responseCode) {
				case 404: throw new Exception("Invalid purchase code");
				case 403: throw new Exception("The personal token is missing the required permission for this script");
				case 401: throw new Exception("The personal token is invalid or has been deleted");
			}
		
			if ($responseCode !== 200) {
				throw new Exception("Got status {$responseCode}, try again shortly");
			}
		
			$body = @json_decode(wp_remote_retrieve_body($response));
		
			if ($body === false && json_last_error() !== JSON_ERROR_NONE) {
				throw new Exception("Error parsing response, try again");
			}
		
			return $body;
		}

		public function reacthemes_license_create_admin_page() {
			
			$err_msg = '';
			$license_code = '';

			

			if(isset($_POST['reacthemes_license_options'])){

				isset($_POST['reacthemes_license_options']['license_code']) ? $license_code = $_POST['reacthemes_license_options']['license_code'] : '';

			
				try {
					// $purchase_data = $this->getPurchaseCode($license_code);
					// $purchase_data = json_decode(json_encode($purchase_data), true);

					$admin_email = get_option('admin_email');
					$admin = get_user_by( 'email', $admin_email );
					$first_name = $admin->first_name;
					$last_name = $admin->last_name;
					$domain = site_url();
					
					if(isset($_POST['reacthemes_license_options']['activate_license'])){

					
							$url = SITE_URL . '/wp-json/reacthemes/v2/activate_license/?code='.$license_code.'&domain='.$domain;
							$response = wp_remote_post( $url, array(
								'method' => 'GET',
								'timeout' => 45,
								'redirection' => 5,
								'httpversion' => '1.0',
								'blocking' => true,
								'headers' => array(),
								'body' => array( 
									'code' => $license_code, 
									'admin_email' => $admin_email,
									'first_name' => $first_name,
									'last_name' => $last_name,
								),
								'cookies' => array()
								)
							);
							
							

							if ( is_wp_error( $response ) ) {
							$error_message = $response->get_error_message();
							echo "Something went wrong: $error_message";
							} else {
								
								$activation_request_response = json_decode(wp_remote_retrieve_body( $response ) );



								if($activation_request_response == 'success' || $activation_request_response == 'updated'){
									update_option( 'reacthemes_license_status', 'activated' );
									update_option( 'reacthemes_license_code', $license_code );
								}
								
								if($activation_request_response == 'success'){
									$err_msg = '<h4 style="color:green;text-align:center">License activated!.</p>';
								}else if($activation_request_response == 'updated'){
									$err_msg = '<h4 style="color:green;text-align:center">License updated!.</p>';
								}else if($activation_request_response == 'existng'){
									$err_msg = '<h4 style="color:red;text-align:center">Already activated with another domain!.</p>';
								}else{
									$err_msg = '<h4 style="color:red;text-align:center">Ops! License can\'t be activated. Please contact to theme support.</p>';
								}

								

							} 

					}else if($_POST['reacthemes_license_options']['deactivate_license']){

						delete_option( 'reacthemes_license_status' );
						delete_option( 'reacthemes_license_code' );


						// remove license from installed from main server
						$url = SITE_URL . '/wp-json/reacthemes/v2/remove_license_domain_by_user/?code='.$license_code.'&domain='.$domain;
						$response = wp_remote_post( $url, array(
						'method' => 'GET',
						'timeout' => 45,
						'redirection' => 5,
						'httpversion' => '1.0',
						'blocking' => true,
						'headers' => array(),
						'body' => array( 'code' => $license_code ),
						'cookies' => array()
						)
						);			  
						
					}

							
					
				}catch (Exception $ex) {
					// Print the error so the user knows what's wrong
					// echo $ex->getMessage();
					$err_msg = '<h3 style="color:red; text-align:center">This is Wrong Purchase key!!</h3><p style="text-align:center">Enter correct purcahse code.</p>';
				}
		
			
			}


			
			?>

			<div class="wrap">
				
				<?php settings_errors(); ?>
				<div class="reacthemes-license-activator-form-wrapper">
					<div class="reacthemes-license-activator-form-header">
						<h1>Activate your Licence</h1>
						<p>Thank you for Using Our Themes! <br> This theme need to be activated to allow demo data import and customer support.</p>
					</div>
					
					<form method="POST">
						<?php
					
							$current_license_Status = get_option( 'reacthemes_license_status' );
							$license_code = get_option( 'reacthemes_license_code' );

							if($current_license_Status === 'activated'){
								echo '<h3 style="color:green;text-align: center">Registered!.</h3>';
							}

							settings_fields( 'reacthemes_license_option_group' );
							do_settings_sections( 'reacthemes-license-admin' ); 
							
							echo $err_msg;
							if($current_license_Status != 'activated'){
								echo '<p class="submit"><input type="submit" name="reacthemes_license_options[activate_license]" id="submit" class="button button-primary" value="Activate"></p>';
							}else{
								echo '<p class="submit"><input type="submit" name="reacthemes_license_options[deactivate_license]" id="submit" class="button button-primary" value="Deactivate"></p>';
							}
						?>
					</form>
					<div class="reacthemes-license-activator-form-footer">
						<a href="https://themeforest.net/user/reacthemes/portfolio" target="_blank">Check our portofolio if you want to buy more license code.</a>
					</div>
				</div>
				
			</div>
		<?php 
		

	}

	public function reacthemes_license_page_init() {
		register_setting(
			'reacthemes_license_option_group', // option_group
			'reacthemes_license_options', // option_name
			array( $this, 'reacthemes_license_sanitize' ) // sanitize_callback
		);

		add_settings_section(
			'reacthemes_license_setting_section', // id
			'', // title
			array( $this, 'reacthemes_license_section_info' ), // callback
			'reacthemes-license-admin' // page
		);

		add_settings_field(
			'license_code', // id
			'', // title
			array( $this, 'license_code_callback' ), // callback
			'reacthemes-license-admin', // page
			'reacthemes_license_setting_section' // section
		);
	}

	public function reacthemes_license_sanitize($input) {
		$sanitary_values = array();
		if ( isset( $input['license_code'] ) ) {
			$sanitary_values['license_code'] = sanitize_text_field( $input['license_code'] );
		}

		return $sanitary_values;
	}

	public function reacthemes_license_section_info() {
		
	}

	public function license_code_callback() {

		

	
		$current_license_Status = get_option( 'reacthemes_license_status' ); 
		$license_code = get_option( 'reacthemes_license_code' ); 

		if( $current_license_Status === "activated" ){
			?>
				<input class="regular-text"  type="hidden" name="reacthemes_license_options[license_code]" id="license_code" value="<?php echo $license_code ? $license_code : '' ?>" placeholder="Enter your purchase code here">
			<?php
		}

		?>

		<input class="regular-text" <?php echo $current_license_Status === "activated" ?  "disabled" : '' ?> type="text" name="reacthemes_license_options[license_code]" id="license_code" value="<?php echo $license_code ? $license_code : '' ?>" placeholder="Enter your purchase code here">

		
		
		<p>Example: 86781236-23d0-4b3c-7dfa-c1c147e0dece <b> See how to <a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-" target="_blank">get Purchase code</a>?</b> </p>
			
           
		<?php

        
	}

}
if ( is_admin() )
	$reacthemes_license = new ReacthemesLicense();