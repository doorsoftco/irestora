<?php 
class Custom{
	function encrypt_decrypt($key, $type){	
			# type = encrypt/decrypt
			$secret = "XxOx*4e!hQqG5b~9a";
			if( !$key ){ return false; }
			
			if($type=='decrypt'){
				$key = strtr(urldecode($key),'-_,','+/=');
				//$original = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($secret), base64_decode($key), MCRYPT_MODE_CBC, md5(md5($secret))), "\0");
				return $key;
				
			}elseif($type=='encrypt'){
				//$verification_key = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($secret), $key, MCRYPT_MODE_CBC, md5(md5($secret))));
				return urlencode(strtr($key,'+/=','-_,'));
			}
			
			return FALSE;	# if function is not used properly
		}
	}


?>