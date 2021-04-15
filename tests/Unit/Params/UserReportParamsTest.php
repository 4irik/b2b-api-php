<?php

declare(strict_types = 1);

namespace Avtocod\B2BApi\Tests\Unit\Params;

use Avtocod\B2BApi\Tests\AbstractTestCase;
use Avtocod\B2BApi\Params\UserReportParams;

/**
 * @covers \Avtocod\B2BApi\Params\UserReportParams
 */
class UserReportParamsTest extends AbstractTestCase
{
    /**
     * @return void
     */
    public function testRequiredProperties(): void
    {
        $params = new UserReportParams(
            $report_uid = 'report_uid'
        );

        $this->assertSame($report_uid, $params->getReportUid());
    }

    /**
     * @return void
     */
    public function testSettedOptionalProperties(): void
    {
        $params = new UserReportParams('report_uid');
        $params
            ->setIncludeContent($is_include_content = (bool)\random_int(0,1))
            ->setDetailed($is_detailed = (bool)\random_int(0,1));

        $this->assertSame($is_include_content, $params->isIncludeContent());
        $this->assertSame($is_detailed, $params->isDetailed());
    }

    /**
     * @return void
     */
    public function testNotSettedOptionalProperties(): void
    {
        $params = new UserReportParams('report_uid');

        $this->assertNull($params->isIncludeContent());
        $this->assertNull($params->isDetailed());
    }
}
