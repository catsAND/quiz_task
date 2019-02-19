<?php

namespace Api\Controller;

use Api\Provider\Doctrine;
use Symfony\Component\HttpFoundation\Request;

abstract class ControllerAbstract
{
    protected $em;
    protected $request;

    public function __construct(Doctrine $em, Request $request)
    {
        $this->em = $em;
        $this->request = $request;
    }

    abstract public function execute($vars);
}
