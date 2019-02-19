<?php

namespace Api\Controller;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;

abstract class ControllerAbstract
{
    protected $em;
    protected $request;

    public function __construct(EntityManager $em, Request $request)
    {
        $this->em = $em;
        $this->request = $request;
    }
}
