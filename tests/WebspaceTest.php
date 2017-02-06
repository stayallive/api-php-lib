<?php

use PleskX\Api\Operator\Webspace;

/**
 * @group webspace
 */
class WebspaceTest extends TestCase
{
    /**
     * @return \PleskX\Api\Struct\Webspace\Info
     */
    private function _createDomain()
    {
        return static::$_client->webspace()->create([
            'name'       => 'example-test.dom',
            'ip_address' => static::_getIpAddress(),
        ]);
    }

    public function testGetPermissionDescriptor()
    {
        $descriptor = static::$_client->webspace()->getPermissionDescriptor();
        $this->assertInternalType('array', $descriptor->permissions);
        $this->assertGreaterThan(0, count($descriptor->permissions));
    }
    public function testGetLimitDescriptor()
    {
        $descriptor = static::$_client->webspace()->getLimitDescriptor();
        $this->assertInternalType('array', $descriptor->limits);
        $this->assertGreaterThan(0, count($descriptor->limits));
    }
    public function testGetPhysicalHostingDescriptor()
    {
        $descriptor = static::$_client->webspace()->getPhysicalHostingDescriptor();
        $this->assertInternalType('array', $descriptor->properties);
        $this->assertGreaterThan(0, count($descriptor->properties));

        $ftpLoginProperty = $descriptor->properties['ftp_login'];
        $this->assertEquals('ftp_login', $ftpLoginProperty->name);
        $this->assertEquals('string', $ftpLoginProperty->type);
    }

    public function testCanCreateWebspace()
    {
        $domain = $this->_createDomain();

        $this->assertInternalType('integer', $domain->id);
        $this->assertGreaterThan(0, $domain->id);

        static::$_client->webspace()->delete('id', $domain->id);
    }

    public function testCanDeleteWebspace()
    {
        $domain = $this->_createDomain();

        $result = static::$_client->webspace()->delete('id', $domain->id);

        $this->assertTrue($result);
    }

    public function testCanGetWebspace()
    {
        $domain = $this->_createDomain();

        /** @var \PleskX\Api\Struct\Webspace\Webspace $webspace */
        $webspace = static::$_client->webspace()->get('id', $domain->id, [
            Webspace::GENERAL_INFO,
        ]);

        $this->assertEquals('example-test.dom', $webspace->info->asciiName);

        static::$_client->webspace()->delete('id', $domain->id);
    }
}
