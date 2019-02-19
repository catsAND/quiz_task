<?php

namespace Api\Provider;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\Common\Cache\FilesystemCache;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\ORM\Tools\Setup;

/**
 * Initizalize doctrine class
 */
class Doctrine
{
    /**
     * Initialize doctrine
     *
     * @param array $settings
     */
    public function __construct(array $settings)
    {
        $config = Setup::createAnnotationMetadataConfiguration(
            $settings['doctrine']['metadata_dirs'],
            $settings['doctrine']['dev_mode']
        );
        $config->setMetadataDriverImpl(
            new AnnotationDriver(
                new AnnotationReader,
                $settings['doctrine']['metadata_dirs']
            )
        );
        // $config->setMetadataCacheImpl(
        //     new FilesystemCache(
        //         $settings['doctrine']['cache_dir']
        //     )
        // );

        return EntityManager::create(
            $settings['doctrine']['connection'],
            $config
        );
    }
}