<?php
//----------------------------------------------------------------

function encrypt($toEncrypt) {
	$cryptKey  = '3d299313a9f349e73f58e4c9c7d35268';//md5('UNPHUVIRTUAL')
	$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
	$encrypted = openssl_encrypt($toEncrypt, 'aes-256-cbc', $cryptKey, 0, $iv);
	return base64_encode($encrypted . '::' . $iv);
}

function decrypt($toDecrypt) {
	$cryptKey  = '3d299313a9f349e73f58e4c9c7d35268';//md5('UNPHUVIRTUAL')
    list($encrypted_data, $iv) = explode('::', base64_decode($toDecrypt), 2);
    return openssl_decrypt($encrypted_data, 'aes-256-cbc', $cryptKey, 0, $iv);
}
/*/Prueba
	$toEncrypt = "password";
	echo $toEncrypt;
	echo '</p>';
	$toEncrypt = encrypt($toEncrypt);
	echo $toEncrypt;
	echo '</p>';
	$toEncrypt = decrypt($toEncrypt);
	echo $toEncrypt;
//*/

//----------------------------------------------------------------
