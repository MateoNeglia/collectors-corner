<?php
namespace Collector\Encryption;

class EmailToken {
    public function generate($length = 32): string {        
        $token = openssl_random_pseudo_bytes($length);        
        return bin2hex($token);
    }
}
