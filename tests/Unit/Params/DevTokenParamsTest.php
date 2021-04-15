<?php

declare(strict_types = 1);

namespace Avtocod\B2BApi\Tests\Unit\Params;

use Avtocod\B2BApi\Params\DevTokenParams;
use Avtocod\B2BApi\Tests\AbstractTestCase;

/**
 * @covers \Avtocod\B2BApi\Params\DevTokenParams
 */
class DevTokenParamsTest extends AbstractTestCase
{
    /**
     * @return void
     */
    public function testRequiredProperties(): void
    {
        $params = new DevTokenParams($username = 'username', $password = 'pa$$vvord');

        $this->assertSame($username, $params->getUsername());
        $this->assertSame($password, $params->getPassword());
    }

    /**
     * @return void
     */
    public function testSettedOptionalProperties(): void
    {
        $params = new DevTokenParams('username', 'pa$$vvord');
        $params
            ->setPasswordHashed($is_password_hashed = (bool)\random_int(0,1))
            ->setDateFrom($date = new \DateTime)
            ->setTokenLifetime($token_lifetime = \random_int(1, PHP_INT_MAX));

        $this->assertSame($is_password_hashed, $params->isPasswordHashed());
        $this->assertSame($date, $params->getDateFrom());
        $this->assertSame($token_lifetime, $params->getTokenLifetime());
    }

    /**
     * @return void
     */
    public function testNotSettedOptionalProperties(): void
    {
        $params = new DevTokenParams('username', 'pa$$vvord');

        $this->assertNull($params->isPasswordHashed());
        $this->assertNull($params->getDateFrom());
        $this->assertNull($params->getTokenLifetime());
    }
}
