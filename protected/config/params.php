<?php
// FIXME modify it
$testMode = true;

// FIXME modify it
// 此处回调url要和后台设置的回调url相同
$redirect_uri = 'http://127.0.0.1/kfsoft/index.php';

if ($testMode) {
	// FIXME modify it
	$client_id = '1021594899';
	$client_secret = 'sandboxb679435b6605bdd6c189ce03d';
	// 沙箱环境提交URL
	$oauthAuthorizeUrl = 'https://oauth.tbsandbox.com/authorize?response_type=code&client_id=' . $client_id . '&redirect_uri=' . $redirect_uri . '&state=1';
	// 沙箱环境获取AccessToekn
	$oauthTokenUrl = 'https://oauth.tbsandbox.com/token';
} else {
	// real environment
	// FIXME modify it
	$client_id = '';
	$client_secret = '';
	
	// 正式环境提交URL
	$oauthAuthorizeUrl = 'https://oauth.taobao.com/authorize?response_type=code&client_id=' . $client_id . '&redirect_uri=' . $redirect_uri . '&state=1';
	// 正式环境获取AccessToekn
	$oauthTokenUrl = 'https://oauth.taobao.com/token';
}

return array (
		'adminEmail' => 'webmaster@example.com',
		'client_id' => $client_id,
		'client_secret' => $client_secret,
		'oauthAuthorizeUrl' => $oauthAuthorizeUrl,
		'oauthTokenUrl' => $oauthTokenUrl,
		'redirect_uri' => $redirect_uri 
);
?>