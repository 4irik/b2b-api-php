<?php

declare(strict_types = 1);

namespace Avtocod\B2BApi\Tests\Unit\Params;

use Avtocod\B2BApi\Tests\AbstractTestCase;
use Avtocod\B2BApi\Params\UserReportsParams;

/**
 * @covers \Avtocod\B2BApi\Params\UserReportsParams
 */
class UserReportsParamsTest extends AbstractTestCase
{
    /**
     * @return void
     */
    public function testSettedOptionalProperties(): void
    {
        $params = new UserReportsParams;
        $params
            ->setDetailed($is_detailed = (bool)\random_int(0,1))
            ->setQuery($query = 'query')
            ->setPage($page = \random_int(1, PHP_INT_MAX))
            ->setPerPage($per_page = \random_int(1, PHP_INT_MAX))
            ->setOffset($offset = \random_int(1, PHP_INT_MAX))
            ->setSortBy($sort_by = 'column-name')
            ->setWithContent($include_content = (bool)\random_int(0,1))
            ->setCalcTotal($calc_total = (bool)\random_int(0,1));

        $this->assertSame($is_detailed, $params->isDetailed());
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
        $params = new UserReportsParams;

        $this->assertNull($params->isDetailed());
        $this->assertNull($params->getQuery());
        $this->assertNull($params->getPage());
        $this->assertNull($params->getPerPage());
        $this->assertNull($params->getOffset());
        $this->assertNull($params->getSortBy());
        $this->assertNull($params->isWithContent());
        $this->assertNull($params->isCalcTotal());
    }
}
