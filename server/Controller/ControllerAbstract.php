<?php

namespace Api\Controller;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;

abstract class ControllerAbstract
{
    protected $em;
    protected $request;

    /**
     * Construct for controllers
     *
     * @param EntityManager $em
     * @param Request $request
     */
    public function __construct(EntityManager $em, Request $request)
    {
        $this->em = $em;
        $this->request = $request;
    }

    /**
     * Generate unique id
     *
     * @return string
     */
    protected function generateId() : string
    {
        return strtoupper(substr(hash_hmac('md5', openssl_random_pseudo_bytes(16), ''), 0, 16));
    }
}
