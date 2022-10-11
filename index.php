<?php

if(empty($_GET['submit']))
{
	echo '<script>alert("Enter some text")</script>';
}
else
{
	$text=$_GET['text'];
	$language=$_GET['lang'];
    $curl = curl_init();

    curl_setopt_array($curl, [
	CURLOPT_URL => "https://microsoft-translator-text.p.rapidapi.com/translate?to%5B0%5D=".$language."&api-version=3.0&profanityAction=NoAction&textType=plain",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "POST",
	CURLOPT_POSTFIELDS => "[\r\n    {\r\n        \"Text\": \"".$text."\"\r\n    }\r\n]",
	CURLOPT_HTTPHEADER => [
		"X-RapidAPI-Host: microsoft-translator-text.p.rapidapi.com",
		"X-RapidAPI-Key: 593109c0b0msh7cbdf1909da52c4p19f09djsnb0cf9dc0f3ad",
		"content-type: application/json"
	],
]);

    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    $result = json_decode($response,true);
    echo "<pre>";
    $d= $result[0] ['translations'] [0] ['text'];
    echo "</pre>";

}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Google Translater</title>
	<style type="text/css">
		body{
			background-color: #abb3c7;
		}
		.myform{
			background-color: white;
			width: 300px;
			height: fit-content;
			font-size: 19px;
			line-height: 22px;
			color: #555;
			margin: auto;
			padding: 20px;
		}
		.text{
			width: 280px;
			height: 40px;
			border-radius: 10px;
		}
		.sel{
			height: 30px;
		}
		.sub{
			height: 30px;
			width: 80px;
		}
	</style>
</head>
<body>
	<form method="get" class="myform">
		<input type="text" class="text" name="text" placeholder="Enter text here"/><br/><br/>
		Select Language : <select name="lang" class="sel">
			<option value="nl">Dutch</option>
			<option value="en-GB">English (UK)</option>
			<option value="es">Spanish</option>
			<option value="ru">Russian</option>
			<option value="ja">Japanese</option>
		</select><br/><br/>
		<input type="submit" class="sub" name="submit" value="Enter"/><br/><br/><br/>
		<?php
		if(!empty($d))
		{
			echo $d;
		}
		?>
	</form>

</body>
</html>