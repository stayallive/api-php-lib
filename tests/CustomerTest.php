<?php

/**
 * @group customer
 */
class CustomerTest extends TestCase
{
    private $customerProperties = [
        'cname'       => 'Plesk',
        'pname'       => 'John Smith',
        'login'       => 'john-unit-test',
        'passwd'      => 'simple-password',
        'email'       => 'john@smith.com',
        'external-id' => 'link:12345',
        'description' => 'Good guy',
    ];

    public function testCanCreateCustomer()
    {
        $customer = static::$_client->customer()->create($this->customerProperties);

        $this->assertInternalType('integer', $customer->id);
        $this->assertGreaterThan(0, $customer->id);
    }

    public function testCanGetCustomerGeneralInfo()
    {
        $customerInfo = static::$_client->customer()->get('login', $this->customerProperties['login']);

        $this->assertEquals('Plesk', $customerInfo->company);
        $this->assertEquals('John Smith', $customerInfo->personalName);
        $this->assertEquals('john-unit-test', $customerInfo->login);
        $this->assertEquals('john@smith.com', $customerInfo->email);
        $this->assertEquals('Good guy', $customerInfo->description);
        $this->assertEquals('link:12345', $customerInfo->externalId);
    }

    public function testCanRetrieveCustomerStats()
    {
        $stats = static::$_client->customer()->getStats('login', $this->customerProperties['login']);

        $this->assertEquals(0, $stats->activeDomains);
    }

    public function testCanGetAllCustomers()
    {
        static::$_client->customer()->create([
            'pname'  => 'Mike Black',
            'login'  => 'mike-unit-test',
            'passwd' => 'simple-password',
        ]);

        $customersInfo = static::$_client->customer()->getAll();

        $this->assertCount(2, $customersInfo);
        $this->assertEquals('John Smith', $customersInfo[0]->personalName);
        $this->assertEquals('john-unit-test', $customersInfo[0]->login);
        $this->assertEquals('Mike Black', $customersInfo[1]->personalName);
        $this->assertEquals('mike-unit-test', $customersInfo[1]->login);

        static::$_client->customer()->delete('login', 'mike-unit-test');
    }

    public function testCanDeleteCustomer()
    {
        $result = static::$_client->customer()->delete('login', $this->customerProperties['login']);

        $this->assertTrue($result);
    }
}
