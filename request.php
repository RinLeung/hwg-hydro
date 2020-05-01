

<?php require_once 'inc/oauth.php'; ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>HWG HydroFarm API Rocket</title>
  <link rel="stylesheet" href="css/herewegrow.css" type="text/css">
    <link rel="stylesheet" href="css/uikit.min.css" type="text/css">
	<script src="js/uikit.min.js" type="text/javascript"></script>
	<script src="js/uikit-icons.min.js" type="text/javascript"></script>

  </head>
  <body>
<script type="text/javascript">
	submitForms = function(){
	document.getElementById("searchaction").submit();

    document.getElementById("categorysearch").submit();
}
</script>	  
	  
	  <div class="uk-container">
<nav class="uk-navbar-container uk-margin" uk-navbar>
<?php
// send the GET req for the categories list
$curl1 = curl_init();

curl_setopt_array($curl1, array(
  CURLOPT_URL => "https://dev-api.hydrofarm.com/api/categories/getcategories",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
"Authorization: Bearer ".$accessToken->getToken(),"Content-Type: application/x-www-form-urlencoded"  ),
));

$response1 = curl_exec($curl1);

curl_close($curl1);
// turn JSON to php object
$cats = json_decode($response1);

// set form data variables to compile user entered data to send to the hydrofarm API
$keyword="keyword=".$_POST['searchInput']."&";
function catpre(){
 if(isset($_POST['categories'])) {
    $name = $_POST['categories'];
	$output ="";
	foreach ($name as $category){
    $output = $output.$category.' ';
    }
    return $output;
    
    } // end brace for if(isset

    else {

    //silence is golden

    }
    }

$categories="categories=".catpre()  ;
$pagination= "https://dev-api.hydrofarm.com/api/products/getproducts?pageNo=".
			$_POST['incrementDecrementVal']
			 ."&pageSize=20"
			 ;

// send the POST req for the list of products
$curl2 = curl_init();

curl_setopt_array($curl2, array(
  CURLOPT_URL => "https://dev-api.hydrofarm.com/api/products/getproducts?pageNo=1&pageSize=20",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => $keyword.$categories,
  CURLOPT_HTTPHEADER => array(
    "Authorization: Bearer ".$accessToken->getToken(),"Content-Type: application/x-www-form-urlencoded"  ),
));

$response2 = curl_exec($curl2);

curl_close($curl2);
// turn JSON to php object
$arr = json_decode($response2);

	?>
	
    <div class="uk-navbar-left">

        <a class="uk-navbar-item uk-logo" href="/"><img src="images/logo-bk.png" style="width:100px; height: auto" /></a>

        <ul class="uk-navbar-nav">
            <li>
                <a href="/">
                    <span class="uk-icon uk-margin-small-right" uk-icon="icon: cloud-upload"></span>
                    Exit to Main Site
                </a>
            </li>
        </ul>
		<div class="uk-navbar-item">
        	<div class="uk-inline">
				<button class="uk-button uk-button-default" type="button" uk-tooltip="title:select a category for your search; pos: right">Categories</button>
				<div uk-dropdown>
					<div class="uk-column-1-4@s uk-column-1-2">
					<form method="post" id="categorysearch">
					<ul class="uk-list">
						<?php
							//iterate over categories array and put a row for each category
							foreach ($cats as $cat){
								echo '<li><label><input class="uk-checkbox" name="categories[]" type="checkbox" value="'.$cat->id.'"> '.$cat->name.'</label></li>';
	
								}
							?>
					</ul>

					</form>
					</div>
				</div>
        	</div>
		</div>
		
        <div class="uk-navbar-item">
			<form class="uk-search uk-search-default" method="post" id="searchaction">
				<span uk-search-icon></span>
					<input class="uk-search-input" type="search" placeholder="search products" name="searchInput" value="<?php echo $_POST['searchInput']?>">

			</form>
        </div>
        <div class="uk-navbar-item">
	        <button class="uk-button uk-button-primary" onclick="submitForms()" >Submit</button>
        </div>
        

    </div>
        <div class="uk-navbar-right uk-padding uk-padding-remove-vertical uk-padding-remove-left">
        <a href="#offcanvas" uk-toggle uk-icon="icon: cart"></a>
    </div>
</nav>

<div id="offcanvas" uk-offcanvas="flip: true">
        <div class="uk-offcanvas-bar">

            <button class="uk-offcanvas-close" type="button" uk-close></button>
            <div>
 <div uk-sortable="group: sortable-group" style="padding: 20px 0px; background: lightblue"></div>
            </div>
        </div>
    </div>  
    
    
<div id="load">
	  
	  

<?php 


echo('<div class="uk-child-width-1-4@m uk-child-width-1-2@s" uk-grid uk-sortable="group: sortable-group">');

// iterate over each product entry and, generate lightbox, and expanded modal views 
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
                <strong>'.$val->name.'</strong> 
            </div>
            <div class="uk-card-footer">
            <a class="" href="#'.$val->sku.'" uk-toggle uk-icon="icon: expand"></a>
            </div>
        </div>
		</div>
		
		<div id="'.$val->sku.'" class="uk-modal-full" uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-full uk-close-large" type="button" uk-close></button>
        <div class="uk-grid-collapse uk-child-width-1-2@s uk-flex-middle" uk-grid>
            <div class="uk-padding-large" uk-height-viewport><img src="'.$img.'" /></div>
            <div class="uk-padding-large uk-margin-top">
                <h3>'.$val->name.'</h3>
                <p>'.$val->webdescription.'</p>
            </div>
        </div>
    </div>
</div>
		
		');


}

echo('</div>');

?>
	  	  
	
  </div>
	  </div>
  <!--
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
  <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.21/jquery-ui.min.js" type="text/javascript"></script>
  <script src="js/hydrofarm.js" type="text/javascript"></script>
  -->
  </body>
</html>
