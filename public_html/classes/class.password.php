<?php

class Password
{

	function password_hash($password)
	{
		$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
	}

	
		public function password_verify($password, $hash) {
            
            $ret = crypt($password, $hash);
            if (!is_string($ret) || strlen($ret) != strlen($hash) || strlen($ret) <= 13) {
                return false;
            }

            $status = 0;
            for ($i = 0; $i < strlen($ret); $i++) {
                $status |= (ord($ret[$i]) ^ ord($hash[$i]));
            }

            return $status === 0;
        }


}