<?php

declare(strict_types = 1);

namespace Avtocod\B2BApi\Tests\Unit\Params;

use Avtocod\B2BApi\Tests\AbstractTestCase;
use Avtocod\B2BApi\Params\UserReportTypesParams;

/**
 * @covers \Avtocod\B2BApi\Params\UserReportTypesParams
 */
class UserReportTypesParamsTest extends AbstractTestCase
{
    /**
     * @return void
     */
    public function testSettedOptionalProperties(): void
    {
        $params = new UserReportTypesParams;
        $params
            ->setCanGenerate($can_generate = (bool)\random_int(0,1))
            ->setQuery($query = 'query')
            ->setPage($page = \random_int(1, PHP_INT_MAX))
            ->setPerPage($per_page = \random_int(1, PHP_INT_MAX))
            ->setOffset($offset = \random_int(1, PHP_INT_MAX))
            ->setSortBy($sort_by = 'column-name')
            ->setWithContent($include_content = (bool)\random_int(0,1))
            ->setCalcTotal($calc_total = (bool)\random_int(0,1));

        $this->assertSame($can_generate, $params->isCanGenerate());
        $this->assertSame($query, $params->getQuery());
        $this->assertSame($page, $params->getPage());
        $this->assertSame($per_page, $params->getPerPage());
        $this->assertSame($offset, $params->getOffset());
        $this->assertSame($sort_by, $params->getSortBy());
        $this->assertSame($include_content, $params->isWithContent());
        $this->assertSame($calc_total, $params->isCalcTotal());
    }

    /**
     * @return void
     */
    public function testNotSettedOptionalProperties(): void
    {
        $params = new UserReportTypesParams;

        $this->assertNull($params->isCanGenerate());
        $this->assertNull($params->getQuery());
        $this->assertNull($params->getPage());
        $this->assertNull($params->getPerPage());
        $this->assertNull($params->getOffset());
        $this->assertNull($params->getSortBy());
        $this->assertNull($params->isWithContent());
        $this->assertNull($params->isCalcTotal());
    }
}
