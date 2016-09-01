<?php 
	
	class Crypto4me {

		public function __construct() {

			//Loading keys
			if (file_exists($this->getDir() . "key.pem") && file_exists($this->getDir() . "key.pub")) {

				//Reading public key
				$file = fopen($this->getDir() . "key.pub", "r");
				$this->pubKey = fread($file, 8192);
				fclose($file);

				//Reading private key
				$file = fopen($this->getDir() . "key.pem", "r");
				$this->priKey = fread($file, 8192);
				fclose($file);

			} else {

				throw new Exception("Keys could not be found.");

			}
			
		}

		public function encrypt($data) {

			openssl_public_encrypt($data, $crypted, openssl_get_publickey($this->pubKey));
			return $crypted	;

		}

		public function decrypt($data) {

			openssl_private_decrypt($data, $decrypted, openssl_get_privatekey($this->priKey));
			return $decrypted;

		}

		private function getDir() {

			$ref = new ReflectionClass($this);
			return dirname($ref->getFileName()) . "/";

		}

	}

?>