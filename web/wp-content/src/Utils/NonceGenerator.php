<?php

namespace App\Utils;

class NonceGenerator
{

    /** @var String|null */
    private $nonce;

    /**
     * Generates a random nonce parameter.
     *
     * @return string
     */
    public function getNonce(): String
    {
        // generation occurs only when $this->nonce is still null
        if (!$this->nonce) {
            $this->nonce = base64_encode(random_bytes(20));
        }

        return $this->nonce;
    }
}
