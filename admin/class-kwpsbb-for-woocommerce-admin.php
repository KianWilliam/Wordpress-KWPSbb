<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://extensions.kwproductions121.com
 * @since      1.0.0
 *
 * @package    Kwpsbb_for_woocommerce
 * @subpackage Kwpsbb_for_woocommerce/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Kwpsbb_for_woocommerce
 * @subpackage Kwpsbb_for_woocommerce/admin
 * @author     Kian William Nowrouzian<webarchitect@kwproductions121.com>
 */
 

	
class Kwpsbb_for_woocommerce_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $kwpsbb_woocommerce;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;
	protected $kwpsbb_defaults;
	protected $fsflag;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->kwpsbb_woocommerce = 'kwpsbb-for-woocommerce';
		$this->version = $version;
			$this->kwpsbb_defaults = array(
			'kwpsbb_fs' => 12,
			'kwpsbb_ff' => ' arial ',
			'kwpsbb_tc' => '#fff',
			'kwpsbb_bc' => '#337ab7'			
			);
			
	    add_action('admin_menu', array($this, 'kwpsbb_page_menu'), 13);
		        add_filter('admin_menu', array($this, 'kwpsbb_tab_menu'), 20);
				add_action('admin_init', array( $this, 'kwpsbb_settings_init' ));

	}
	
	public function kwpsbb_page_menu()
	{
		     add_menu_page('KWPsbb', 'KWPsbb', 'manage_options', 'kwpsbb', array($this, 'kwpsbb_page_html'), plugins_url('kwpsbb.png', __FILE__) );
  
	}
	
    public function kwpsbb_tab_menu($tabs) {
        $tabs = esc_html__('General', 'kwpsbb-for-woocommerce');
        return $tabs;
    }
	
			public function kwpsbb_settings_init() {

        
      $settings_args = array(
            'type' => 'array', 
            'sanitize_callback' => array( $this, 'kwpsbb_sanitize_options' ),
            'show_in_rest' => false,
            'default' => $this->kwpsbb_defaults,
            ); 
		
      add_settings_section(
      'kwpsbb_settings_section', 
      'KWPSBB for WooCommerce',  
       array( $this, 'kwpsbb_settings_section' ),    
      'kwpsbb'                   
    );
	
	
		  
		  $data_r = array('kwpsbb_fs' => '12', 'kwpsbb_ff' => 'arial', 'kwpsbb_tc' => '#fff', 'kwpsbb_bc' => '#337ab7');
add_option('kwpsbb_option', $data_r);	
		  
		   register_setting(
            'kwpsbb',
            'kwpsbb_option',
			$settings_args
            );
			
	
		  
    add_settings_field(
      'kwpsbb_fs',
        __( 'Font Size', 'kwpsbb' ),
      array( $this, 'kwpsbb_fs' ),
      'kwpsbb',
      'kwpsbb_settings_section',
	    array(
            'label_for'         => 'kwpsbb_fs',
            'class'             => 'kwpsbb_row',
            'kwpsbb_custom_data' => 'custom',
        )
    );


 
		  
    add_settings_field(
      'kwpsbb_ff',
      'Font Family',
      array( $this, 'kwpsbb_ff' ),
      'kwpsbb',
      'kwpsbb_settings_section',
	    array(
            'label_for'         => 'kwpsbb_ff',
            'class'             => 'kwpsbb_row',
            'kwpsbb_custom_data' => 'custom',
        )
    );
	
		  
    add_settings_field(
      'kwpsbb_tc',
      'Button Text Color',
      array( $this, 'kwpsbb_tc' ),
      'kwpsbb',
      'kwpsbb_settings_section',
	    array(
            'label_for'         => 'kwpsbb_tc',
            'class'             => 'kwpsbb_row',
            'kwpsbb_custom_data' => 'custom',
        )
    );
	 
		  
    add_settings_field(
      'kwpsbb_bc',
      'Button Backcolor',
      array( $this, 'kwpsbb_bc' ),
      'kwpsbb',
      'kwpsbb_settings_section',
	    array(
            'label_for'         => 'kwpsbb_bc',
            'class'             => 'kwpsbb_row',
            'kwpsbb_custom_data' => 'custom',
        )
    );
			
	
}

	public function kwpsbb_settings_section($args)
	{
	   echo '<p id="'.esc_html($args['id']).'">These settings apply to all KWP-SBB for woocommerce functionality.(For font-size, do not add px, just input number!)</p>';

	}
	public function kwpsbb_sanitize_options($input)
	{

				$valid = array();
				$valid = $input;
				$error = "";
				
				$valid['kwpsbb_fs']=wp_kses_post($input['kwpsbb_fs']);
				if(empty($valid['kwpsbb_fs']) || !preg_match('/^[0-9]+$/' , $valid['kwpsbb_fs']))
				{
					add_settings_error('kwpsbb', esc_attr('mycode121'), __("font-size can not be empty , add no px and only input numbers, we return its value to default!", "wpse"), 'error' );
					//$error = "font-size can not be empty , add no px and only input numbers, we return its value to default!";
					$valid['kwpsbb_fs'] = wp_kses_post($this->kwpsbb_defaults['kwpsbb_fs']);
				}
				$valid['kwpsbb_ff']=wp_kses_post($input['kwpsbb_ff']);
				if(empty($valid['kwpsbb_ff']) || !preg_match('/^[A-Za-z\s]+$/' , $valid['kwpsbb_ff']))
				{
					add_settings_error('kwpsbb', esc_attr('mycode121'), __("font-family can not be empty and no integer in this field! its value is returned to default!", "wpse"), 'error' );
					//$error .="font-family can not be empty and no integer in this field! its value is returned to default!";
					$valid['kwpsbb_ff'] = wp_kses_post($this->kwpsbb_defaults['kwpsbb_ff']);
				}
				$valid['kwpsbb_tc']=wp_kses_post($input['kwpsbb_tc']);
				if(empty($valid['kwpsbb_tc']) || !preg_match('/^#[a-z0-9]{3,6}$/' , $valid['kwpsbb_tc']))
				{
					add_settings_error('kwpsbb', esc_attr('mycode121'), __("your color syntax is wrong for text color, it is returned to default!", "wpse"), 'error' );
					//$error.="text-color can not be empty and also check its syntax, we returned the value to default!";
					$valid['kwpsbb_tc'] = wp_kses_post($this->kwpsbb_defaults['kwpsbb_tc']);
				}
				$valid['kwpsbb_bc']=wp_kses_post($input['kwpsbb_bc']);
				if(empty($valid['kwpsbb_bc']) || !preg_match('/^#[a-z0-9]{3,6}$/' , $valid['kwpsbb_bc']))
				{
					add_settings_error('kwpsbb', esc_attr('mycode121'), __("your color syntax is wrong for back color, it is returned to default!", "wpse"), 'error' );
					//$error.="text-color can not be empty and also check its syntax, we returned the value to default!";
					$valid['kwpsbb_bc'] = wp_kses_post($this->kwpsbb_defaults['kwpsbb_bc']);
				}
						
				//	add_settings_error('kwpsbb', 'mycode121', __($error, "wpse"), 'error' );

				return $valid;

	}
	
	public function kwpsbb_fs($args)
	{
		
		$setting = get_option('kwpsbb_option');
		
		?>
		<input type="text" id="kwpsbb_option[kwpsbb_fs]" data-custom="<?php echo esc_attr($args['kwpsbb_custom_data']) ?>" name="kwpsbb_option[kwpsbb_fs]" value="<?php echo isset($setting) ? esc_attr($setting['kwpsbb_fs']) : ''; ?>" />
		<?php
		
	}
	public function kwpsbb_ff($args)
	{
		$setting = get_option('kwpsbb_option');
		?>
		<input type="text" id="kwpsbb_option[kwpsbb_ff]" data-custom="<?php echo esc_attr($args['kwpsbb_custom_data']) ?>" name="kwpsbb_option[kwpsbb_ff]" value="<?php echo isset($setting) ? esc_attr($setting['kwpsbb_ff']) : ''; ?>" />
		<?php
	}
	public function kwpsbb_tc($args)
	{
		$setting = get_option('kwpsbb_option');
		?>
		<input type="text" id="kwpsbb_option[kwpsbb_tc]" data-custom="<?php echo esc_attr($args['kwpsbb_custom_data']) ?>" class="tccolor" name="kwpsbb_option[kwpsbb_tc]" data-alpha="true" data-default-color="#fff" value="<?php echo isset($setting) ? esc_attr($setting['kwpsbb_tc']) : ''; ?>" />
		<?php
	}
	public function kwpsbb_bc($args)
	{
		$setting = get_option('kwpsbb_option');
		?>
		<input type="text" id="kwpsbb_option[kwpsbb_bc]" data-custom="<?php echo esc_attr($args['kwpsbb_custom_data']) ?>" class="bccolor" name="kwpsbb_option[kwpsbb_bc]" data-alpha="true" data-default-color="#337ab7" value="<?php echo isset($setting) ? esc_attr($setting['kwpsbb_bc']) : ''; ?>" />
		<?php
	}
	public function kwpsbb_page_html()
	{
		
			if( !is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
			$message = __('Your woocommerce plugin should be activated first to be able to use this plugin!', 'kwpsbb_for_woocommerce' );
			add_settings_error( 'kwpsbb', esc_attr( 'kwpsbb_woocommerce_disabled' ), $message, 'error' );
		}
		
			


		if(!current_user_can('manage_options'))
		{
			return;
		}
			if(isset($_GET['settings-updated']))
		{
			add_settings_error('kwpsbb', 'kwpsbb_message', __('Settings Saved', 'kwpsbb'), 'update');
		}
			
			
	
			settings_errors('kwpsbb');
			?>
			<div class="wrap">
			<h1><?php echo esc_html(get_admin_page_title()); ?></h1>
			<form method="post" action="options.php">
			 <?php 

			 settings_fields('kwpsbb');
			  do_settings_sections('kwpsbb');

			 submit_button('Save Settings');
			 ?>
			</form>
			<?php
		
	}
	
	

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_Name_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->kwpsbb_woocommerce, plugin_dir_url( __FILE__ ) . 'css/kwpsbb-for-woocommerce-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_Name_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		         global $wp_version;

        if (is_admin()) {

		wp_enqueue_script( $this->kwpsbb_woocommerce, plugin_dir_url( __FILE__ ) . 'js/kwpsbb-for-woocommerce-admin.js', array( 'jquery' ), $this->version, false );
				wp_register_script( $this->kwpsbb_woocommerce. '-wp-color-picker-alpha', plugin_dir_url(__FILE__) . 'js/wp-color-picker-alpha.min.js', array( 'wp-color-picker' ), '1.2.2', TRUE);

		wp_enqueue_script( $this->kwpsbb_woocommerce. '-wp-color-picker-alpha', plugin_dir_url(__FILE__) . 'js/wp-color-picker-alpha.min.js', array( 'wp-color-picker' ), '1.2.2', TRUE);

             if ( $wp_version >= 5.5 ) {
               
                wp_localize_script(
                    $this->kwpsbb_woocommerce. '-wp-color-picker-alpha', 'wpColorPickerL10n', array(
                    'clear' => __('Clear'),
                    'clearAriaLabel' => __('Clear color'),
                    'defaultString' => __('Default'),
                    'defaultAriaLabel' => __('Select default color'),
                    'pick' => __('Select Color'),
                    'defaultLabel' => __('Color value'),
                ));
            } 

		}
	}

}
