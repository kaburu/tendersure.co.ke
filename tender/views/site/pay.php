<?php

$api = Yii::$app->params['pesapal_api'];

$token = $params = NULL;
$iframelink = $api . '/API/PostPesapalDirectOrderV4';

//Kenyan keys
$consumer_key = Yii::$app->params['consumer_key'];
$consumer_secret = Yii::$app->params['consumer_secret'];

$signature_method = new OAuthSignatureMethod_HMAC_SHA1();
$consumer = new OAuthConsumer($consumer_key, $consumer_secret);


$desc = 'Tender payment';
$type = 'MERCHANT';
$first_name = $model->contactperson;
$email = $model->email;
$phonenumber = $model->phone;
$currency = 'KES';
$reference = $ref;
$callback_url = Yii::$app->urlManager->createAbsoluteUrl('') . 'completepay';

$post_xml = "<?xml version=\"1.0\" encoding=\"utf-8\"?>
				   <PesapalDirectOrderInfo 
						xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" 
					  	xmlns:xsd=\"http://www.w3.org/2001/XMLSchema\" 
					  	Currency=\"" . $currency . "\" 
					  	Amount=\"" . $amount . "\" 
					  	Description=\"" . $desc . "\" 
					  	Type=\"" . $type . "\" 
					  	Reference=\"" . $reference . "\" 
					  	FirstName=\"" . $first_name . "\"
					  	Email=\"" . $email . "\" 
					  	PhoneNumber=\"" . $phonenumber . "\" 
					  	xmlns=\"http://www.pesapal.com\" />";
$post_xml = htmlentities($post_xml);

//post transaction to pesapal
$iframe_src = OAuthRequest::from_consumer_and_token($consumer, $token, "GET", $iframelink, $params);
$iframe_src->set_parameter("oauth_callback", $callback_url);
$iframe_src->set_parameter("pesapal_request_data", $post_xml);
$iframe_src->sign_request($signature_method, $consumer, $token);
?>
<h4>Step2: Payment form</h4>
<div class="span8">
    <iframe src="<?php echo $iframe_src; ?>" width="100%" height="500px"  scrolling="no" frameBorder="0">
        <p>Browser unable to load iFrame</p>
    </iframe>
</div>


