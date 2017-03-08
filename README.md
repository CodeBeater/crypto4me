# crypto4me: Terseing Layer for OpenSSL in PHP

Usage:
```php
$c4m = new Crypto4me();
$c4m->encypt("String to be encrypted");

$c4m->decrypt("String to be decrypted");
```

Feel free to generate the required keys with this piece of code:
```php
echo("Generating keys..." . PHP_EOL);
$generated = openssl_pkey_new(array(
	"digest_alg" => "sha512", 
	"private_key_bits" => 4096,
	"private_key_type" => OPENSSL_KEYTYPE_RSA
));

//Extracting private key
if ($generated !== false) {
	openssl_pkey_export($generated, $privateKey);
} else {
	echo("Error: OpenSSL couldn't generated keys.". PHP_EOL);
	var_dump(openssl_error_string());
	die();
}

//Extracting public key
$publicKey = openssl_pkey_get_details($generated);
$publicKey = $publicKey['key'];

//Saving them
file_put_contents(realpath("../path/to/crypto4me") . "/key.pub", $publicKey);
file_put_contents(realpath("../path/to/crypto4me") . "/key.pem", $privateKey);
```

Security warning boilerplate:<br>
For security reasons, don't generate the keys at your PC then upload them to the server, generate them on the production server itself. Copy them to as few places as possible.
