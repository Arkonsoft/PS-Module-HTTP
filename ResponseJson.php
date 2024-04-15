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

if (!defined('_PS_VERSION_')) {
    exit;
}

class ResponseJson extends Response {

    protected function sendHeaders()
    {
        header('Content-Type: application/json');
    }

    protected function sendContent()
    {
        echo json_encode($this->data);
    }

    public function send()
    {
        $this->sendHeaders();
        $this->sendStatusCode();
        $this->sendContent();

        die();
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