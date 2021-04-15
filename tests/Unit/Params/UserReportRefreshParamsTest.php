<?php

declare(strict_types = 1);

namespace Avtocod\B2BApi\Tests\Unit\Params;

use Avtocod\B2BApi\Tests\AbstractTestCase;
use Avtocod\B2BApi\Params\UserReportRefreshParams;

/**
 * @covers \Avtocod\B2BApi\Params\UserReportRefreshParams
 */
class UserReportRefreshParamsTest extends AbstractTestCase
{
    /**
     * @return void
     */
    public function testRequiredProperties(): void
    {
        $params = new UserReportRefreshParams(
            $report_uid = 'report_uid'
        );

        $this->assertSame($report_uid, $params->getReportUid());
    }

    /**
     * @return void
     */
    public function testSettedOptionalProperties(): void
    {
        $params = new UserReportRefreshParams('report_uid');
        $params
            ->setOptions([
                ($key_one = 'key_one') => \random_int(1, PHP_INT_MAX),
                ($key_two = 'key_two') => 'some-value',
            ]);

        $this->assertArrayHasKey($key_one, $params->getOptions());
        $this->assertArrayHasKey($key_two, $params->getOptions());
    }

    /**
     * @return void
     */
    public function testNotSettedOptionalProperties(): void
    {
        $params = new UserReportRefreshParams('report_uid');

        $this->assertNull($params->getOptions());
    }
}
