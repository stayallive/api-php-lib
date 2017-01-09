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
        /** @var \PleskX\Api\Struct\Customer\Customer $customer */
        $customer = static::$_client->customer()->get(
            'login', $this->customerProperties['login'], [
                \PleskX\Api\Operator\Customer::GENERAL_INFO,
            ]
        );

        $this->assertEquals('Plesk', $customer->info->company);
        $this->assertEquals('John Smith', $customer->info->personalName);
        $this->assertEquals('john-unit-test', $customer->info->login);
        $this->assertEquals('john@smith.com', $customer->info->email);
        $this->assertEquals('Good guy', $customer->info->description);
        $this->assertEquals('link:12345', $customer->info->externalId);
    }

    public function testCanRetrieveCustomerStats()
    {
        /** @var \PleskX\Api\Struct\Customer\Customer $customer */
        $customer = static::$_client->customer()->get(
            'login', $this->customerProperties['login'], [
                \PleskX\Api\Operator\Customer::STATISTICS,
            ]
        );

        $this->assertEquals(0, $customer->stats->activeDomains);
    }

    public function testCanGetAllCustomers()
    {
        static::$_client->customer()->create([
            'pname'  => 'Mike Black',
            'login'  => 'mike-unit-test',
            'passwd' => 'simple-password',
        ]);

        $customers = static::$_client->customer()->getAll([
            \PleskX\Api\Operator\Customer::GENERAL_INFO,
        ]);

        $this->assertCount(2, $customers);
        $this->assertEquals('John Smith', $customers[0]->info->personalName);
        $this->assertEquals('john-unit-test', $customers[0]->info->login);
        $this->assertEquals('Mike Black', $customers[1]->info->personalName);
        $this->assertEquals('mike-unit-test', $customers[1]->info->login);

        static::$_client->customer()->delete('login', 'mike-unit-test');
    }

    public function testCanDeleteCustomer()
    {
        $result = static::$_client->customer()->delete('login', $this->customerProperties['login']);

        $this->assertTrue($result);
    }
}
