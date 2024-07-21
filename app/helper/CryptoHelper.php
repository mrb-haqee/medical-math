<?php
// CryptoHelper.php

namespace Helper;

class CryptoHelper
{
    private $cipher = "aes-256-cbc";
    private $iv = 'mrbhaqeemrbhaqee';

    public function Encrypt($plaintext, $key)
    {
        $ivlen = openssl_cipher_iv_length($this->cipher);
        if (strlen($this->iv) !== $ivlen) {
            throw new \InvalidArgumentException('IV length is invalid.');
        }

        // Enkripsi pesan
        $ciphertext = openssl_encrypt($plaintext, $this->cipher, $key, $options = 0, $this->iv);

        if ($ciphertext === false) {
            throw new \RuntimeException('Encryption failed.');
        }

        return $ciphertext;
    }

    public function Decrypt($ciphertext, $key)
    {
        // Validasi panjang IV
        $ivlen = openssl_cipher_iv_length($this->cipher);
        if (strlen($this->iv) !== $ivlen) {
            throw new \InvalidArgumentException('IV length is invalid.');
        }

        // Dekripsi pesan
        $plaintext = openssl_decrypt($ciphertext, $this->cipher, $key, $options = 0,  $this->iv);

        if ($plaintext === false) {
            throw new \RuntimeException('Decryption failed.');
        }

        return $plaintext;
    }


    // public function RequestDBConfig($req_key)
    // {
    //     $url = 'https://mrb-db.onrender.com/db';
    //     $options = array(
    //         'http' => array(
    //             'method'  => 'POST',
    //             'header'  => 'Content-type: application/json',
    //             'content' => json_encode(['key' => $req_key]),
    //         ),
    //     );

    //     $context  = stream_context_create($options);
    //     $resp = file_get_contents($url, false, $context);
    //     $data = json_decode(json_decode(json_encode($resp)), true);

    //     return isset($data["DB_CONFIG"]) ? $data : null;
    // }
}
