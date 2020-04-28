
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>HWG HydroFarm API test</title>
  <link rel="stylesheet" href="css/hwg.css" type="text/css">
    <link rel="stylesheet" href="css/uikit.min.css" type="text/css">
	<script src="js/uikit.min.js" type="text/javascript"></script>
  </head>
  <body>
	  <h3>Tests Load Below
	  </h3>
	  
 
  <div id="load">
	  
	  

<?php
require_once 'inc/oauth.php';
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://dev-api.hydrofarm.com/api/products/getproducts?pageNo=1&pageSize=20",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_HTTPHEADER => array(
    "Authorization: Bearer ".$accessToken->getToken(),"Content-length: 0", "keyword: Heat Mat"
  ),
));

$response = curl_exec($curl);

curl_close($curl);

$arr = json_decode($response);

echo('<div class="uk-child-width-1-4@m" uk-grid>');

foreach ($arr as $val){
	if(! $val->images[0]->url){
		
	            $img = 'images/exception.png';
                }
                else{
                $img = $val->images[0]->url;
                }

	echo('
	    <div>
        <div class="uk-card uk-card-default">
            <div class="uk-card-media-top uk-text-center" uk-lightbox>
                <a href="'.$img.'" data-caption="'.$val->description.'"><img src="images/exception.png" style="background:url('.
                
                $img
                                
                .') no-repeat center center / contain; width:80%; height:auto;" alt="" /></a> 
            </div>
            <div class="uk-card-body">
                <h4 class="uk-title">'.$val->name.'</h4>
                <p>'.$val->description.'</p>
            </div>
        </div>
    </div>');


}

echo('</div>');

//echo $response;
?>
	  	  
	
  </div>
  <!--
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
  <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.21/jquery-ui.min.js" type="text/javascript"></script>
  <script src="js/hydrofarm.js" type="text/javascript"></script>
  -->
  </body>
</html>
