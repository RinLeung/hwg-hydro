<?php
	

require_once "/home/dh_cvdrjv/hwg.orbital-path.com/private/vendor/autoload.php";

$provider = new \League\OAuth2\Client\Provider\GenericProvider([
    'clientId'                => '7083-12744-33a07dd2-e20b-46d8-8680-aff6cd39d722',    // The client ID assigned to you by the provider
    'clientSecret'            => '1c114d93-09ab-4be2-83c4-f25141946bae',    // The client password assigned to you by the provider
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

