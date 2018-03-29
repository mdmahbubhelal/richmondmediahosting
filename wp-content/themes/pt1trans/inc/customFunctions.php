<?php 
// Styles and scripts
add_action( 'wp_enqueue_scripts', 'pub_enqueue_scripts_styles' );
function pub_enqueue_scripts_styles() {
	$stylesheetURI = get_stylesheet_directory_uri();
	wp_enqueue_Style( 'bootstrapcss', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css', '', '', 'all' );
	wp_enqueue_Style( 'bootstrapstyle', $stylesheetURI . '/inc/customstyle.css', '', '', 'all' );
    wp_enqueue_script( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', null, null, true );
    wp_enqueue_script( 'customscript', $stylesheetURI . '/inc/customscript.js', array( 'jquery' ), '', true );
}

// Ajax calls
add_action( 'wp_ajax_pub_userLogin', 'pub_userLogin' );
add_action( 'wp_ajax_nopriv_pub_userLogin', 'pub_userLogin' );
function pub_userLogin() {
	$args['user_login'] = isset($_POST['username']) && trim($_POST['username']) ? trim($_POST['username']) : false;
	$args['user_password'] = isset($_POST['password']) && trim($_POST['password']) ? trim($_POST['password']) : false;
	$args['remember'] = isset($_POST['remember']) && trim($_POST['remember']) ? trim($_POST['remember']) : false;
	$response['redirect'] = isset($_POST['redirect']) && trim($_POST['redirect']) ? trim($_POST['redirect']) : false;
	$user = wp_signon( $args, false );
	if ( is_wp_error($user) ){
		$response['status'] = 401;
		$response['message'] = $user->get_error_message();
	} else {
		$response['status'] = 200;
		$response['message'] = "Success!";
	}
	echo json_encode($response);
	wp_die();
}
add_action( 'wp_ajax_pub_userNotLogin', 'pub_userNotLogin' );
add_action( 'wp_ajax_nopriv_pub_userNotLogin', 'pub_userNotLogin' );
function pub_userNotLogin() {
	if (!session_id()) @session_start();
	$_SESSION['guestVisitor'] = true;
	if ($_SESSION['guestVisitor']) echo "success";
	else echo "Failed";
	wp_die();
}