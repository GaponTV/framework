<?php
namespace Fw\Core;
use Fw\Core\Type\Dictionary as Dictionary;

class Server extends Dictionary
{
    public function __construct()
    {
        $this->coontainer = $_SERVER;
    }

}