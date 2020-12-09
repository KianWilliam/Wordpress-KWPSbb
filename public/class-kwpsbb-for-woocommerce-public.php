<?php

/**
 * The public-facing functionality of the plugin.
 * @link       https://extensions.kwproductions121.com
 * @since      1.0.0
 *
 * @package    Kwpsbb_for_woocommerce
 * @subpackage Kwpsbb_for_woocommerce/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Kwpsbb_for_woocommerce
 * @subpackage Kwpsbb_for_woocommerce/public
 * @author     Kian William Nowrouzian<webarchitect@kwproductions121.com>
 */
class Kwpsbb_for_woocommerce_Public {

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
	
	protected $myscript;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $kwpsbb_woocommerce, $version ) {

		$this->kwpsbb_woocommerce = $kwpsbb_woocommerce;
		$this->version = $version;
		add_action('wp', array($this, 'kwpsbb_add_button'));
		add_action( 'wp_enqueue_scripts', array($this, 'kwpsbb_add_my_script' ));

	}
	public function kwpsbb_add_button()
	{
		 if (session_status() == PHP_SESSION_NONE) { session_start(); }
		
		if(preg_match('/product_cat/', $_SERVER['REQUEST_URI'])||preg_match('/product-category/', $_SERVER['REQUEST_URI']))
		{
			if(preg_match('/product_cat/', $_SERVER['REQUEST_URI'])){
			if( isset( $_GET['product_cat'] ) ) 
         			$_SESSION['product_cat'] = 	sanitize_text_field( $_GET['product_cat'] ) ;
					


			if(!empty($_GET['product-page']) ){
				         			
				$_SESSION['product_page'] = intval($_GET['product-page']);
			}
			else
				$_SESSION['product_page'] = 1;
			}
			else
			{
				$urldata = wp_parse_url($_SERVER['REQUEST_URI']);
				
				//preg_match('/product-category\/[A-Za-z0-9]+\//', $urldata['path'], $matches);
				$fi = strpos($urldata['path'], 'product-category');
				$val = substr($urldata['path'], $fi+17);
				if(strpos($val, '/')){
				$ffi = strpos($val, '/');
				
				$val = substr($val, 0, $ffi);
				}
					$_SESSION['product_cat'] = 	sanitize_text_field( $val ) ;
				
					if(!empty($urldata['query']) && preg_match('/product-page/', $urldata['query'])){
						$si = strpos($urldata['query'], 'product-page');
						$val = substr($urldata['query'], $si+13);
						if(strpos($val, '&')){
				$si = strpos($val, '&');
				$val = substr($val, 0, $si);
						}
						else
							$val = substr($val, 0);
							
				$_SESSION['product_page'] = intval($val);
			}
			else
				$_SESSION['product_page'] = 1;
			}
		}
		if(preg_match('/product/', $_SERVER['REQUEST_URI']) || preg_match('/shop/', $_SERVER['REQUEST_URI']))
		{
		
				
		

			$addscript = "
			jQuery(document).ready(function(){
				jQuery('.woocommerce-product-gallery__wrapper').append('<a href=\"".esc_url(get_home_url()."/?product_cat=".$_SESSION['product_cat']."&product-page=".$_SESSION['product_page'])."\" class=\"button sbb\">Back to Store  </a>');
			});
			";
							

		wp_register_script('myscript', '');
		wp_enqueue_script('myscript');
		wp_add_inline_script('myscript', $addscript);
		
	
		}
	}
	public function kwpsbb_add_my_script()
	{
		  if (!is_front_page()) {

            $kwpsbb = get_option('kwpsbb_option');
			


            /* Typography Styling */
            $fs = $kwpsbb['kwpsbb_fs'];

            $ff = $kwpsbb['kwpsbb_ff'];

            $tc = $kwpsbb['kwpsbb_tc'];

            $bc = $kwpsbb['kwpsbb_bc'];
			
			$mystyle="
			
			     .sbb {
                    background-color:".esc_attr( $bc )." !important;".
					"color:".esc_attr( $tc )."  !important;".
					"font-family:". esc_attr( $ff )." !important;".
				 "font-size:". esc_attr( $fs )."px !important;}";
				 
				 
		wp_register_style('mystyle', false);
		wp_enqueue_style('mystyle');
		wp_add_inline_style('mystyle', $mystyle);
                
			
			

           
        }
		
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->kwpsbb_woocommerce, plugin_dir_url( __FILE__ ) . 'css/kwpsbb-for-woocommerce-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->kwpsbb_woocommerce, plugin_dir_url( __FILE__ ) . 'js/kwpsbb-for-woocommerce-public.js', array( 'jquery' ), $this->version, false );

	}

}

