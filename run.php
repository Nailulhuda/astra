<?php 
function decrypt($msg_encrypted_bundle, $password){
	$password = sha1($password);

	$components = explode( ':', $msg_encrypted_bundle );;
	$iv            = $components[0];
	$salt          = hash('sha256', $password.$components[1]);
	$encrypted_msg = $components[2];

	$decrypted_msg = openssl_decrypt(
	  $encrypted_msg, 'aes-256-cbc', $salt, null, $iv
	);

	if ( $decrypted_msg === false )
		return false;

	$msg = substr( $decrypted_msg, 41 );
	return $decrypted_msg;
}

echo "(i) Support me with buy a Coffee \n";
echo "(i) Send to GoPay/OVO 0818-0296-9463\n\n";
echo "[?] Enter Password :";
$password = trim(fgets(STDIN));
$d = decrypt(file_get_contents('hayo.txt'), $password);
if(empty($d)) {
	echo "[!] Password salah!\n\n";
} else {
	eval("?>".$d);
}