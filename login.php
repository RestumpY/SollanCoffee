<?php
require 'db_connection.php';

if(isset($_SESSION['login_id'])){
    header('Location: home.php');
    exit;
}

require 'google-api/vendor/autoload.php';

// Creating new google client instance
$client = new Google_Client();

// Enter your Client ID
$client->setClientId('27979820237-bqp51h3865po2evqhjdn4qemjd5hlp3b.apps.googleusercontent.com');
// Enter your Client Secrect
$client->setClientSecret('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');
// Enter the Redirect URL
$client->setRedirectUri('http://localhost/sollancoffee/login.php');

// Adding those scopes which we want to get (email & profile Information)
$client->addScope("email");
$client->addScope("profile");


if(isset($_GET['code'])):

    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

    if(!isset($token["error"])){

        $client->setAccessToken($token['access_token']);

        // getting profile information
        $google_oauth = new Google_Service_Oauth2($client);
        $google_account_info = $google_oauth->userinfo->get();
    
        // Storing data into database
        $id = mysqli_real_escape_string($db_connection, $google_account_info->id);
        $full_name = mysqli_real_escape_string($db_connection, trim($google_account_info->name));
        $email = mysqli_real_escape_string($db_connection, $google_account_info->email);
        $profile_pic = mysqli_real_escape_string($db_connection, $google_account_info->picture);
        $totalCoffee = mysqli_real_escape_string($db_connection, $google_account_info->totalCoffee);

        // checking user already exists or not
        $get_user = mysqli_query($db_connection, "SELECT `google_id`, `totalCoffee` FROM `users` WHERE `google_id`='$id'");
        if(mysqli_num_rows($get_user) > 0){

            $_SESSION['login_id'] = $id; 
            header('Location: home.php');
            exit;

        }
        else{

            // if user not exists we will insert the user
            $insert = mysqli_query($db_connection, "INSERT INTO `users`(`google_id`,`name`,`email`,`profile_image`,`totalCoffee`) VALUES('$id','$full_name','$email','$profile_pic',NULL)");

            if($insert){
                $_SESSION['login_id'] = $id; 
                header('Location: home.php');
                exit;
            }
            else{
                echo "Sign up failed!(Something went wrong).";
            }

        }

    }
    else{
        header('Location: login.php');
        exit;
    }
    
else: 
    // Google Login Url = $client->createAuthUrl(); 
?>

    <a class="login-btn" href="<?php echo $client->createAuthUrl(); ?>">Login</a>

<?php endif; ?>