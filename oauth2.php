<?php
	

require_once "/home/dh_cvdrjv/hwg.orbital-path.com/private/vendor/autoload.php";

$provider = new \League\OAuth2\Client\Provider\GenericProvider([
    'clientId'                => 'xxx',    // The client ID assigned to you by the provider
    'clientSecret'            => 'xxx',    // The client password assigned to you by the provider
    'redirectUri'             => '',
    'urlAuthorize'            => 'https://dev-oauth.hydrofarm.com/connect/authorize',
    'urlAccessToken'          => 'https://dev-oauth.hydrofarm.com/connect/token',
    'urlResourceOwnerDetails' => 'https://dev-oauth.hydrofarm.com/resources',

]);

try {

    // Try to get an access token using the client credentials grant.

    $accessToken = $provider->getAccessToken('client_credentials');

} catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {

    // Failed to get the access token
    exit($e->getMessage());

}?>
