<?php
// Copyright 1999-2016. Parallels IP Holdings GmbH.

/**
 * @group servicePlan
 */
class ServicePlanTest extends TestCase
{
    public function testGet()
    {
        $servicePlan = static::$_client->servicePlan()->get('name', 'Default Domain');
        $this->assertEquals('Default Domain', $servicePlan->name);
        $this->assertGreaterThan(0, $servicePlan->id);
    }

    public function testGetAll()
    {
        $servicePlans = static::$_client->servicePlan()->getAll();
        $this->assertInternalType('array', $servicePlans);
        $this->assertGreaterThan(0, count($servicePlans));
        $this->assertNotEmpty($servicePlans[0]->name);
    }
}
