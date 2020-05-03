<?php
namespace App\Communicators;

class ProductSearchCommunicatorFactory
{
    public static function getCommunicator() : ProductSearchCommunicator
    {
        // TODO add cached communicator
        return new OnDemandCommunicator();
    }
}
