<?php
	

require_once "/home/website.com/private/vendor/autoload.php";

$provider = new \League\OAuth2\Client\Provider\GenericProvider([
    'clientId'                => 'xxx',    // The client ID assigned to you by the provider
    'clientSecret'            => 'yyy',    // The client password assigned to you by the provider
    'redirectUri'             => '',
    'urlAuthorize'            => 'https://dev-oauth.hydrofarm.com/connect/authorize',
    'urlAccessToken'          => 'https://dev-oauth.hydrofarm.com/connect/token',
    'urlResourceOwnerDetails' => 'https://dev-oauth.hydrofarm.com/resources',

]);

try {

    // Try to get an access token using the client credentials grant.
    

    $accessToken = $provider->getAccessToken('client_credentials', array("scope" => 'hydrofarmApi read'));
   //  echo 'Access Token: ' . $accessToken->getToken() . "<br>";

} catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {

    // Failed to get the access token
    exit($e->getMessage());

}?>
