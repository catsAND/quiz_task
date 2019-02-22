<?php

namespace Api\Provider;

use Doctrine\Common\Annotations\AnnotationReader;
// use Doctrine\Common\Cache\FilesystemCache;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\ORM\Tools\Setup;
use Api\Settings;

/**
 * Initizalize doctrine class
 */
class Doctrine
{
    protected $em;
    /**
     * Initialize doctrine
     *
     * @param Settings $settings Settings object
     */
    public function __construct(Settings $settings)
    {
        $config = $settings->get('doctrine');

        $doctrine = Setup::createAnnotationMetadataConfiguration(
            $config['metadata_dirs'],
            $config['dev_mode']
        );
        $doctrine->setMetadataDriverImpl(
            new AnnotationDriver(
                new AnnotationReader,
                $config['metadata_dirs']
            )
        );
        // $doctrine->setMetadataCacheImpl(
        //     new FilesystemCache(
        //         $config['cache_dir']
        //     )
        // );

        $this->em = EntityManager::create(
            $config['connection'],
            $doctrine
        );
    }

    /**
     * Get entity manager
     *
     * @return EntityManager
     */
    public function getEntityManager()
    {
        return $this->em;
    }
}
