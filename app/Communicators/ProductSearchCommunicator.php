<?php
namespace App\Communicators;


interface ProductSearchCommunicator
{
    /**
     * @param array $parameters
     * @return string
     */
    public function communicate (array $parameters) : string;
}
