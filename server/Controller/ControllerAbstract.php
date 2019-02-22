<?php

namespace Api\Controller;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;

/**
 * Main class that extends every controller
 */
abstract class ControllerAbstract
{
    /**
     * Entity manager
     *
     * @var EntityManager
     */
    protected $em;
    /**
     * Request class
     *
     * @var Request
     */
    protected $request;

    /**
     * Construct for controllers
     *
     * @param EntityManager $em      entity manager
     * @param Request       $request request
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
