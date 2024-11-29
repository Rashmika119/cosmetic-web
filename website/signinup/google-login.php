
<?php
require_once 'vendor/autoload.php';

session_start();

// Google Client Configuration
$client = new Google_Client();
$client->setClientId('363303836182-itgj6kbqek75c6utelvh2pnndre460id.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('http://localhost/web_project_cosmatics_website/google-login.php');
$client->addScope("email");
$client->addScope("profile");


// Check if we have a Google code back from the login
if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token['access_token']);

    // Get user info
    $google_oauth = new Google_Service_Oauth2($client);
    $google_account_info = $google_oauth->userinfo->get();

    // Save user info in session
    $_SESSION['user_email'] = $google_account_info->email;
    $_SESSION['user_name'] = $google_account_info->name;

    // Redirect to home or dashboard
    header('Location: signIn.php'); // Adjust to your landing page
    exit();
}

// Create login URL
$login_url = $client->createAuthUrl();

if (!isset($_SESSION['user_email'])) {
    // User is not logged in, show login link
    header('Location: ' . filter_var($login_url, FILTER_SANITIZE_URL));

} else {
    // User is logged in, display welcome message
    echo 'Welcome, ' . htmlspecialchars($_SESSION['user_name']);
    
    echo '<br><a href="logout.php">Logout</a>'; // Add logout link
}
?>

