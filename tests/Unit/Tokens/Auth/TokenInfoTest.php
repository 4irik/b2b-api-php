<?php

declare(strict_types = 1);

namespace Avtocod\B2BApi\Tests\Unit\Tokens\Auth;

use Avtocod\B2BApi\Tokens\Auth\TokenInfo;
use Avtocod\B2BApi\Tests\AbstractTestCase;

/**
 * @covers \Avtocod\B2BApi\Tokens\Auth\TokenInfo<extended>
 */
class TokenInfoTest extends AbstractTestCase
{
    /**
     * @return void
     */
    public function testBasicGetters(): void
    {
        $token_info = new TokenInfo(
            $user = "user123@bogan",
            $timestamp = \random_int(0, PHP_INT_MAX),
            $age = \random_int(0, PHP_INT_MAX),
            $salted_hash = 'f08e7f04ca1a413807ebc47551a40a20a0b4de5c'
        );

        $this->assertSame($user, $token_info->getUser());
        $this->assertSame($timestamp, $token_info->getTimestamp());
        $this->assertSame($age, $token_info->getAge());
        $this->assertSame($salted_hash, $token_info->getSaltedHash());
    }

    /**
     * @return void
     */
    public function testDomainAndUsernameGetters(): void
    {
        foreach (\range(1, 50) as $i) {
            $username = 'username';

            $domain = 'domain';

            $token_info = new TokenInfo(
                "{$username}@{$domain}",
                \random_int(0, PHP_INT_MAX),
                \random_int(0, PHP_INT_MAX),
                'f08e7f04ca1a413807ebc47551a40a20a0b4de5c'
            );

            $this->assertSame($username, $token_info->getUsername());
            $this->assertSame($domain, $token_info->getDomainName());
        }

        $token_info = new TokenInfo(
            'username',
            \random_int(0, PHP_INT_MAX),
            \random_int(0, PHP_INT_MAX),
            'f08e7f04ca1a413807ebc47551a40a20a0b4de5c'
        );

        $this->assertNull($token_info->getUsername());
        $this->assertNull($token_info->getDomainName());
    }
}
