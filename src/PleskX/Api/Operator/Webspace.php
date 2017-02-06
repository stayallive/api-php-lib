<?php

namespace PleskX\Api\Operator;

use PleskX\Api\CRUDOperator;
use PleskX\Api\Struct\Webspace as Struct;

class Webspace extends CRUDOperator
{
    const GENERAL_INFO  = 'gen_info';
    const HOSTING_INFO  = 'hosting';
    const LIMITS        = 'limits';
    const STATISTICS    = 'stat';
    const PREFERENCES   = 'prefs';
    const DISK_USAGE    = 'disk_usage';
    const PERFORMANCE   = 'performance';
    const SUBSCRIPTIONS = 'subscriptions';
    const MAIL          = 'mail';

    public function getLimitDescriptor()
    {
        $response = $this->request('get-limit-descriptor.filter');

        return new Struct\LimitDescriptor($response);
    }
    public function getPermissionDescriptor()
    {
        $response = $this->request('get-permission-descriptor.filter');

        return new Struct\PermissionDescriptor($response);
    }
    public function getPhysicalHostingDescriptor()
    {
        $response = $this->request('get-physical-hosting-descriptor.filter');

        return new Struct\PhysicalHostingDescriptor($response);
    }

    /**
     * Create a new webspace.
     *
     * @param array      $properties
     * @param array|null $hostingProperties
     *
     * @return Struct\Info
     */
    public function create(array $properties, array $hostingProperties = null)
    {
        $packet = $this->_client->getPacket();
        $info   = $packet->addChild($this->_wrapperTag)->addChild('add');

        $infoGeneral = $info->addChild('gen_setup');
        foreach ($properties as $name => $value) {
            $infoGeneral->addChild($name, $value);
        }

        if ($hostingProperties) {
            $infoHosting = $info->addChild('hosting')->addChild('vrt_hst');
            foreach ($hostingProperties as $name => $value) {
                $property = $infoHosting->addChild('property');
                $property->addChild('name', $name);
                $property->addChild('value', $value);
            }

            if (isset($properties['ip_address'])) {
                $infoHosting->addChild('ip_address', $properties['ip_address']);
            }
        }

        $response = $this->_client->request($packet);

        return new Struct\Info($response);
    }

    /**
     * Get the collection class for this Operator.
     *
     * @return string
     */
    protected function getCollectionClass()
    {
        return Struct\Webspace::class;
    }

    /**
     * Get the available datasets for this Operator.
     *
     * @return array
     */
    protected function getDatasets()
    {
        return [
            self::GENERAL_INFO  => Struct\GeneralInfo::class,
            self::HOSTING_INFO  => Struct\HostingInfo::class,
            self::LIMITS        => Struct\Limits::class,
            self::STATISTICS    => Struct\Statistics::class,
            self::PREFERENCES   => Struct\Preferences::class,
            self::DISK_USAGE    => Struct\DiskUsage::class,
            self::PERFORMANCE   => Struct\Performance::class,
            self::SUBSCRIPTIONS => Struct\Subscription::class,
            self::MAIL          => Struct\Mail::class,
        ];
    }
}
