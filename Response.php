<?php

/**
 * NOTICE OF LICENSE
 * 
 * This file is licensed under the Software License Agreement.
 *
 * With the purchase or the installation of the software in your application
 * you accept the license agreement.
 *
 * You must not modify, adapt or create derivative works of this source code
 *
 * @author Arkonsoft
 * @copyright 2023 Arkonsoft
 */

namespace Arkonsoft\PsModule\Http;

use Exception;

if (!defined('_PS_VERSION_')) {
    exit;
}

class Response {

    public $statusCode;
    public $data;

    public function __construct(int $statusCode, $data)
    {
        $this->statusCode = $statusCode;
        $this->data = $data;
    }

    protected function sendHeaders()
    {
        return true;
    }

    protected function sendStatusCode()
    {
        http_response_code($this->statusCode);
    }

    protected function sendContent()
    {
        if(!$this->isPrintable($this->content)) {
            if(_PS_MODE_DEV_) {
                throw new Exception("Response value is not printable", 1);
            }

            return false;
        }

        echo $this->content;
    }

    public function send()
    {
        $this->sendHeaders();
        $this->sendStatusCode();
        $this->sendContent();

        return $this;
    }

    protected function isPrintable($value)
    {   
        $printableTypes = [
            'boolean',
            'integer',
            'double',
            'float',
            'string',
            'null'
        ];
        
       return in_array(gettype($value), $printableTypes);
    }
}