<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.orderwizard.co.uk
 * @since      1.0.0
 *
 * @package    Orderwizard
 * @subpackage Orderwizard/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Orderwizard
 * @subpackage Orderwizard/admin
 * @author     Arbutus Ridge <info@orderwizard.co.uk>
 */
class Orderwizard_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		add_action( 'admin_menu', array( $this, 'wpa_add_menu' ));

	}


    /*
      * Actions perform at loading of admin menu
      */
    function wpa_add_menu() {


        add_menu_page( 'Order Wizard', 'Order Wizard', 'manage_options', 'orderwizard_admin', array(
                          __CLASS__,
                         'wpa_page_file_path'
                        ), plugins_url('images/orderwizard-icon.png', __FILE__),26);
    }	

    /*
     * Actions perform on loading of menu pages
     */
    function wpa_page_file_path() {

		// Error message for the key
		

		// See if a key has been submitted
		if(isset($_POST['orderwizard_key'])){
			$error="You have not submitted a valid key";
			// sanitize key
			$new_key = sanitize_text_field($_POST['orderwizard_key']);
		
			// check only contains uppercase, lowercase and numbers
			if (preg_match('/[A-Za-z0-9]+/', $new_key))
			{
				// check length is 32
				if (strlen( $new_key ) == 32){
					$error="";
					update_option('orderwizard_key',santize_text_field( $_POST['orderwizard_key'] ) );

				}

			}			
			
		}else{
			$error="";
		}


		$orderwizard_key = get_option('orderwizard_key');
		$response="";
		$valid_key=false;
		// If there is a key available then check to see if it is valid
		if($orderwizard_key!=""){
			$check_url="https://orderwizard.net/api/sites/valid?access-token=$orderwizard_key";
			$response=wp_remote_get($check_url);
			if(isset($response['body']) && $response['body']=="TRUE"){
				$valid_key=true;
			}
		}




		$content = '
		
		<div style="max-width: 800px;">
		<h1>Order Wizard for Wordpress</h1>
		<p>Looking to grow your restaurant and takeaway business? Order Wizard finds and keeps more customers, and increases your average order value.</p>

		<div style="margin-top: 1em; float: right; width: 235px; box-shadow: 0 0 2px #ddd; border-radius: 6px; background-color: #fff; border: solid 1px #ddd; padding: 25px;">
		<div style="text-align: center">
		<a href="https://www.orderwizard.co.uk/"><img width="100%" src="'.plugins_url('images/orderwizard-logo-white.png', __FILE__).'" alt="Order Wizard Restaurant Marketing" /></a><br />
		<br />
		</div>
		<br />
		<br />
		</div>


<h3>Quick Start</h3>
<ul style="font-size: 16px">
<li style="padding: 5px 0; line-height: 25px;"><strong style="margin-right: 10px; background-color: #ccc; border-radius: 20px; clear: none; color: #000; display: inline-block; float: left; font-style: normal; font-weight: bold; line-height: 25px;font-size:14px; text-align: center; width: 25px;">1</strong> Sign up to  <a href="https://www.orderwizard.co.uk/wordpress/" target="_blank">Order Wizard</a>.</li>

<li style="padding: 5px 0; line-height: 25px;"><strong style="margin-right: 10px; background-color: #ccc; border-radius: 20px; clear: none; color: #000; display: inline-block; float: left; font-style: normal; font-weight: bold; line-height: 25px;font-size:14px; text-align: center; width: 25px;">2</strong> Once your account is setup we will email your key or you can login to your <a href="https://admin.orderwizard.net" target="_blank">admin area</a> and find your access key.</li>

<li style="padding: 5px 0; line-height: 25px;"><strong style="margin-right: 10px; background-color: #ccc; border-radius: 20px; clear: none; color: #000; display: inline-block; float: left; font-style: normal; font-weight: bold; line-height: 25px;font-size:14px; text-align: center; width: 25px;">3</strong> Enter your access key in the form below</li>

<li style="padding: 5px 0; line-height: 25px;"><strong style="margin-right: 10px; background-color: #ccc; border-radius: 20px; clear: none; color: #000; display: inline-block; float: left; font-style: normal; font-weight: bold; line-height: 25px;font-size:14px; text-align: center; width: 25px;">4</strong> Create a new page and add the <a href="#shortcode">short code</a> you created.</li>

<li style="padding: 5px 0; line-height: 25px;"><strong style="margin-right: 10px; background-color: #ccc; border-radius: 20px; clear: none; color: #000; display: inline-block; float: left; font-style: normal; font-weight: bold; line-height: 25px;font-size:14px; text-align: center; width: 25px;">5</strong> Start accepting online table bookings and takeaway orders.</li>

<li style="padding: 5px 0; line-height: 25px;"><strong style="margin-right: 10px; background-color: #ccc; border-radius: 20px; clear: none; color: #000; display: inline-block; float: left; font-style: normal; font-weight: bold; line-height: 25px;font-size:14px; text-align: center; width: 25px;">6</strong> Have questions?  <a href="https://www.orderwizard.co.uk/contact">We\'re here to help</a>.</li>
</ul>

<br style="clear: both" />
<form method="post" action="">
	<div class="metabox-holder meta-box-sortables pointer">
		<div class="postbox">
			<h3 class="hndle">Setup</h3>
			<div class="inside" style="padding: 0 10px">
				<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row"><label for="orderwizard_key">Order Wizard Key:</label></th>
						<td nowrap><input name="orderwizard_key" style="width: 330px;font-weight: bold" id="orderwizard_key" value="'.$orderwizard_key.'" class="regular-text" type="text" /><br /><em style="color: #888">Eg: FYVCCV40TTZ1KWXXWTJL29BUGM21G3FN</em> 
						';
						if($error!=""){
							$content.='<br/><p style="color: #bf0000"><b>'.$error.'</b></p>';
						}

						$content.='
						</td>
						<td id="key_status">';

						if($valid_key){
							$content.='<img src="'.plugins_url('images/green-tick.png', __FILE__).'" alt="Green tick"> Valid key';
						}elseif(!$valid_key && $orderwizard_key!=""){
							$content.='<img src="'.plugins_url('images/red-cross.png', __FILE__).'" alt="Green tick"> Invalid key';
						}
						
						$content.='</td>
					</tr>
					<tr>
					<td>
						<input type="submit" name="submit" class="button-primary" value="Update Key" /> 
</td><td>
Don\'t have a Order Wizard account?
 <a href="https://www.orderwizard.co.uk/signup/" target="_blank">Get started with Order Wizard</a>.</em></td>
				</td>
					</tr>
				</tbody>
			</table>
			</div>
		</div>
	</div>
</form>
<div>

	<div class="metabox-holder meta-box-sortables pointer">
		<div class="postbox">
			<h3 class="hndle">Quick Setup Guide and Shortcodes</h3>
		<a name="shortcode"></a>
			<div class="inside" style="padding: 0 10px">
				<table class="form-table">
				<tbody>
					</tr>
									<tr><td colspan="3" style="font-style: normal; line-height: 25px;font-size:14px;">
Once your key is valid, all you need to do is use one of the following <b>shortcodes</b> on your page:<br/>		
[owbooking] - add the reservation form to a wordpress page <br/>	
[owtakeaway] - add the takeaway menu to a wordpress page<br/><br/>								
</td></tr>
	<tr>
					<td><strong>Require more help?</strong>  Please <a href="https://www.orderwizard.co.uk/contact">contact us</a> and we\'d be happy to help.</td>
					</td>
					</tr>
				</tbody>
			</table>
			</div>
		</div>
	</div>

		</div>




		';

		echo $content;
    }
}
