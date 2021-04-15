<?php

declare(strict_types = 1);

namespace Avtocod\B2BApi\Tests\Unit\Params;

use Avtocod\B2BApi\Tests\AbstractTestCase;
use Avtocod\B2BApi\Params\UserReportMakeParams;

/**
 * @covers \Avtocod\B2BApi\Params\UserReportMakeParams
 */
class UserReportMakeParamsTest extends AbstractTestCase
{
    /**
     * @return void
     */
    public function testRequiredProperties(): void
    {
        $params = new UserReportMakeParams(
            $report_type_uid = 'some-uid',
            $type = 'VIN',
            $value = 'Z94CB41AAGR323020'
        );

        $this->assertSame($report_type_uid, $params->getReportTypeUid());
        $this->assertSame($type, $params->getType());
        $this->assertSame($value, $params->getValue());
    }

    /**
     * @return void
     */
    public function testSettedOptionalProperties(): void
    {
        $params = new UserReportMakeParams('some-uid', 'VIN', 'Z94CB41AAGR323020');
        $params
            ->setOptions([
                ($key_one = 'key_one') => \random_int(1, PHP_INT_MAX),
                ($key_two = 'key_two') => 'some-word',
            ])
            ->setForce($is_force = (bool)\random_int(0,1))
            ->setOnUpdateUrl($on_update = 'http://some-url.qq/on-update.html')
            ->setOnCompleteUrl($on_complete = 'http://some-url.qq/on-complete.html')
            ->setData($data = [
                'one',
                'two',
                'three'
            ])
            ->setIdempotenceKey($idempotence_key = uniqid());

        $this->assertSame($is_force, $params->isForce());
        $this->assertSame($idempotence_key, $params->getIdempotenceKey());
        $this->assertSame($on_update, $params->getOnUpdateUrl());
        $this->assertSame($on_complete, $params->getOnCompleteUrl());
        $this->assertSame($data, (array) $params->getData());

        $this->assertArrayHasKey($key_one, $params->getOptions());
        $this->assertArrayHasKey($key_two, $params->getOptions());
    }

    /**
     * @return void
     */
    public function testNotSettedOptionalProperties(): void
    {
        $params = new UserReportMakeParams('some-uid', 'VIN', 'Z94CB41AAGR323020');

        $this->assertNull($params->isForce());
        $this->assertNull($params->getIdempotenceKey());
        $this->assertNull($params->getOnUpdateUrl());
        $this->assertNull($params->getOnCompleteUrl());
        $this->assertNull($params->getData());
    }
}
