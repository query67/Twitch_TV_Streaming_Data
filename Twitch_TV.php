<?php

/*
  ┌────────────────────────────────────────────────────────────┐
  |  For More Modules Or Updates Stay Connected to Kodi dot AL |
  └────────────────────────────────────────────────────────────┘
  ┌───────────┬────────────────────────────────────────────────┐
  │ Product   │ Twitch HLS Stream Extractor by Channel Name    │
  │ Version   │ v1.0 PRO-DEV                                   │
  │ Provider  │ https://www.twitch.tv                          │
  │ Support   │ M3U8/VLC/KODI/SMART TV/Xream Codes Panel       │
  │ Licence   │ FREE                                           │
  │ Author    │ Olsion Bakiaj                                  │
  │ Email     │ TRC4@USA.COM                                   │
  │ Author    │ Endrit Pano                                    │
  │ Email     │ INFO@ALBDROID.AL                               │
  │ Website   │ https://kodi.al                                │
  │ Facebook  │ /albdroid.official/                            │
  │ Created   │ Thursday, January 2, 2020                      │
  │ Required  │ PHP 5-XXX - PHP 7-XXX                          │
  └────────────────────────────────────────────────────────────┘
*/

/*
----------------------------------------------------
 Developer Tools For New Applications, API KEY, ETC
 https://dev.twitch.tv/docs/api
 https://dev.twitch.tv/console/apps/create
 https://dev.twitch.tv/docs/authentication/
----------------------------------------------------
------------------------------------------------------------------------------------------------------------------------------------------------------------
 JSON STRUCTURE OUTPUT
http://usher.twitch.tv/api/channel/hls/albdroid.m3u8?player=twitchweb&token={"adblock":false,"authorization":{"forbidden":false,"reason":""},"blackout_enabled":false,"channel":"albdroid","channel_id":229698962,"chansub":{"restricted_bitrates":[],"view_until":1924905600},"ci_gb":false,"geoblock_reason":"","device_id":null,"expires":1577918626,"extended_history_allowed":false,"game":"Music \u0026 Performing Arts","hide_ads":false,"https_required":false,"mature":false,"partner":false,"platform":null,"player_type":null,"private":{"allowed_to_view":true},"privileged":false,"server_ads":true,"show_ads":true,"subscriber":false,"turbo":false,"user_id":null,"user_ip":"109.117.177.126","version":2}&sig=4358d2ca8bc4d27cb1c2de63b716b7336dc1a43e
------------------------------------------------------------------------------------------------------------------------------------------------------------
*/

// GET ROOT DIR AUTO HTTP OR HTTPS
if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === 'off') {
  $protocol = 'http://';
} else {
  $protocol = 'https://';
}
// Get base URL
$ROOT_URL = $protocol . $_SERVER['SERVER_NAME'] . dirname($_SERVER['PHP_SELF']) . "/";
//echo $ROOT_URL;
$EXAMPLE_URL = $ROOT_URL . "Twitch_TV.php?channel=" . "albdroid";
//echo $EXAMPLE_URL;

ob_start();

$CLIENT_ID = "ENTER_CLIENT_ID_HERE"; // CLIENT ID KEY

// CURL FUNCTION
function Curl($url, $header)
{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
	curl_setopt($ch, CURLOPT_TIMEOUT, 1);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
	$response = curl_exec($ch);
	curl_close ($ch);
	return $response;
}

// CHECK FOR GET PARAMETER 'CHANNEL' TO EXIST AND TO BE VALID
if (isset($_GET['channel']) && preg_match("/^[a-zA-Z0-9_]{4,25}$/u", $_GET['channel']))
{
	// LETS REQUEST TO TWITCH TV THE ACCESS TOKEN
$response = Curl("https://api.twitch.tv/api/channels/" . $_GET['channel'] . "/access_token/",
				[
					"Client-ID: $CLIENT_ID",
					"Host: api.twitch.tv",
					"User-Agent: Mozilla/5.0 (Windows NT 6.3; rv:43.0) Gecko/20100101 Firefox/43.0 Seamonkey/2.40",
					"Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8",
				]
			);

// IF REPLY CONTAINS TOKEN
if(strstr($response, "token"))
{
$json = json_decode($response, true); // DECODE JSON ARRAY
// --------------------------------------------------------------------------
/*
  ┌─────────────────────────────────────────────────────────────────────────┐
  |  DOWNLOAD M3U STREAM FOR XTREAM CODES PANEL, VLC, SMART TV ETC          |
  |  NOTE: FOR XTREAM CODES PANEL OPEN THIS HEADER AND CLOSE THE RAW HEADER |
  └─────────────────────────────────────────────────────────────────────────┘
*/

//header('Location: http://usher.twitch.tv/api/channel/hls/' . $_GET['channel'] . '.m3u8?player=twitchweb&token=' . rawurlencode($json['token']) . '&sig=' . $json['sig']);

// --------------------------------------------------------------------------

// --------------------------------------------------------------------------
/*
  ┌──────────────────────────────────────────────┐
  |                  RAW HEADER                  |
  | PRINT M3U STREAM RAW MODE FOR KODI, VLC, ETC |
  └──────────────────────────────────────────────┘
*/

echo('http://usher.twitch.tv/api/channel/hls/' . $_GET['channel'] . '.m3u8?player=twitchweb&token=' . rawurlencode($json['token']) . '&sig=' . $json['sig']);
// --------------------------------------------------------------------------

}
else
{
// PRINT ERROR
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
echo "\n  ┌─────────────────────┐ ";
echo "\n  |  Error To Get Token | ";
echo "\n  │  Try Again          │ ";
echo "\n  └─────────────────────┘ \n";
}
}
else
{
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
// PRINT ERROR
echo "\n  ┌────────────────────────────────────────────────────────────┐ ";
echo "\n  |  For More Modules Or Updates Stay Connected to Kodi dot AL | ";
echo "\n  └────────────────────────────────────────────────────────────┘ ";
echo "\n  ┌───────────┬────────────────────────────────────────────────┐ ";
echo "\n  │ Product   │ Twitch HLS Stream Extractor by Channel Name    │ ";
echo "\n  │ Version   │ v1.0 PRO-DEV                                   │ ";
echo "\n  │ Provider  │ https://www.twitch.tv                          │ ";
echo "\n  │ Support   │ M3U8/VLC/KODI/SMART TV/Xream Codes Panel ETC   │ ";
echo "\n  │ Licence   │ FREE                                           │ ";
echo "\n  │ Author    │ Olsion Bakiaj                                  │ ";
echo "\n  │ Email     │ TRC4@USA.COM                                   │ ";
echo "\n  │ Author    │ Endrit Pano                                    │ ";
echo "\n  │ Email     │ INFO@ALBDROID.AL                               │ ";
echo "\n  │ Website   │ https://kodi.al                                │ ";
echo "\n  │ Facebook  │ /albdroid.official/                            │ ";
echo "\n  │ Created   │ Thursday, January 2, 2020                      │ ";
echo "\n  └────────────────────────────────────────────────────────────┘ \n";
echo "\n  [x] Channel Name Not Provided"."\n";
echo "\n  [!] GET Example: $EXAMPLE_URL";
echo "\n";

}
?>
