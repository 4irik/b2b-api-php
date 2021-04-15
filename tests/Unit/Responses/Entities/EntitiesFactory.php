<?php

declare(strict_types = 1);

namespace Avtocod\B2BApi\Tests\Unit\Responses\Entities;

use DateTimeImmutable;
use InvalidArgumentException;
use Avtocod\B2BApi\DateTimeFactory;
use Avtocod\B2BApi\Responses\Entities\User;
use Avtocod\B2BApi\Responses\Entities\Group;
use Avtocod\B2BApi\Responses\Entities\Domain;
use Avtocod\B2BApi\Responses\Entities\Report;
use Avtocod\B2BApi\Responses\Entities\Balance;
use Avtocod\B2BApi\Responses\Entities\ReportMade;
use Avtocod\B2BApi\Responses\Entities\ReportType;
use Avtocod\B2BApi\Responses\Entities\ReportQuery;
use Avtocod\B2BApi\Responses\Entities\ReportState;
use Avtocod\B2BApi\Responses\Entities\CleanOptions;
use Avtocod\B2BApi\Responses\Entities\ReportContent;
use Avtocod\B2BApi\Responses\Entities\ReportSourceState;
use Avtocod\B2BApi\Responses\Entities\ReportTypeContent;

class EntitiesFactory
{
    /**
     * @var callable[]|array
     */
    private static $factories = [];

    /**
     * @param string $entity_class
     * @param array  $attributes
     * @param bool   $as_array
     *
     * @throws InvalidArgumentException
     *
     * @return object|array
     */
    public static function make(string $entity_class, array $attributes = [], bool $as_array = false)
    {
        if (\count(static::$factories) === 0) {
            static::bootUpFactories();
        }

        if (! isset(static::$factories[$entity_class])) {
            throw new InvalidArgumentException("Unknown factory [{$entity_class}]");
        }

        /** @var callable $factory */
        $factory = static::$factories[$entity_class];

        return $factory($attributes, $as_array);
    }

    /**
     * @return void
     */
    protected static function bootUpFactories(): void
    {
        /**
         * @param array $attributes
         * @param bool  $as_array
         *
         * @return array|Domain
         */
        static::$factories[Domain::class] = function (
            array $attributes = [],
            bool $as_array = false
        ) {
            $attributes = \array_replace([
                'uid'         => 'wade55',
                'comment'     => 'Expedita at beatae voluptatibus nulla omnis.',
                'name'        => 'Sit vitae voluptas sint non voluptates.',
                'state'       => 'DRAFT',
                'roles'       => $as_array
                    ? 'CLIENT,USER'
                    : ['CLIENT', 'USER'],
                'tags'        => $as_array
                    ? 'site,robot'
                    : ['site', 'robot'],
                'created_at'  => $as_array
                    ? DateTimeFactory::toIso8601Zulu(new \DateTime())
                    : DateTimeImmutable::createFromMutable(new \DateTime()),
                'created_by'  => 'iddqd',
                'updated_at'  => $as_array
                    ? DateTimeFactory::toIso8601Zulu(new \DateTime())
                    : DateTimeImmutable::createFromMutable(new \DateTime()),
                'updated_by'  => 'iuser',
                'active_from' => $as_array
                    ? DateTimeFactory::toIso8601Zulu(new \DateTime())
                    : DateTimeImmutable::createFromMutable(new \DateTime()),
                'active_to'   => $as_array
                    ? DateTimeFactory::toIso8601Zulu(new \DateTime())
                    : DateTimeImmutable::createFromMutable(new \DateTime()),
                'id'          => null,
                'deleted'     => null,
            ], $attributes);

            return $as_array === true
                ? $attributes
                : new Domain(
                    $attributes['uid'],
                    $attributes['comment'],
                    $attributes['name'],
                    $attributes['state'],
                    $attributes['roles'],
                    $attributes['tags'],
                    $attributes['created_at'],
                    $attributes['created_by'],
                    $attributes['updated_at'],
                    $attributes['updated_by'],
                    $attributes['active_from'],
                    $attributes['active_to'],
                    $attributes['id'],
                    $attributes['deleted']
                );
        };

        /**
         * @param array $attributes
         * @param bool  $as_array
         *
         * @return array|User
         */
        static::$factories[User::class] = function (
            array $attributes = [],
            bool $as_array = false
        ) {
            $attributes = \array_replace([
                'uid'         => $uid = ($user_in_domain_name = 'user123')
                                        . '@'
                                        . ($domain_uid = 'feeney'),
                'comment'     => 'Optio quos qui illo error.',
                'contacts'    => '439 Karley Loaf Suite 897',
                'email'       => 'tkshlerin@collins.com',
                'login'       => $uid,
                'name'        => $user_in_domain_name,
                'state'       => 'ACTIVATION_REQUIRED',
                'domain_uid'  => $domain_uid,
                'domain'      => static::make(Domain::class, [], $as_array),
                'roles'       => $as_array
                    ? 'ADMIN,DOMAIN,DOMAIN_ADMIN'
                    : ['ADMIN', 'DOMAIN', 'DOMAIN_ADMIN'],
                'tags'        => $as_array
                    ? ''
                    : [],
                'created_at'  => $as_array
                    ? DateTimeFactory::toIso8601Zulu(new \DateTime())
                    : new \DateTime(),
                'created_by'  => 'user234',
                'updated_at'  => $as_array
                    ? DateTimeFactory::toIso8601Zulu(new \DateTime())
                    : new \DateTime(),
                'updated_by'  => 'user345',
                'active_from' => $as_array
                    ? DateTimeFactory::toIso8601Zulu(new \DateTime())
                    : new \DateTime(),
                'active_to'   => $as_array
                    ? DateTimeFactory::toIso8601Zulu(new \DateTime())
                    : new \DateTime(),
                'id'          => \random_int(1, PHP_INT_MAX),
                'deleted'     => (bool)\random_int(0,1),
                'pass_hash'   => 'de99a620c50f2990e87144735cd357e7',
            ], $attributes);

            return $as_array === true
                ? $attributes
                : new User(
                    $attributes['uid'],
                    $attributes['comment'],
                    $attributes['contacts'],
                    $attributes['email'],
                    $attributes['login'],
                    $attributes['name'],
                    $attributes['state'],
                    $attributes['domain_uid'],
                    $attributes['domain'],
                    $attributes['roles'],
                    $attributes['tags'],
                    $attributes['created_at'],
                    $attributes['created_by'],
                    $attributes['updated_at'],
                    $attributes['updated_by'],
                    $attributes['active_from'],
                    $attributes['active_to'],
                    $attributes['id'],
                    $attributes['deleted'],
                    $attributes['pass_hash']
                );
        };

        /**
         * @param array $attributes
         * @param bool  $as_array
         *
         * @return array|Group
         */
        static::$factories[Group::class] = function (
            array $attributes = [],
            bool $as_array = false
        ) {
            $attributes = \array_replace([
                'uid'         => ($group_name = 'user123') . '@' . 'domain',
                'comment'     => '',
                'name'        => '',
                'users'       => [static::make(User::class, [], $as_array), static::make(User::class, [], $as_array)],
                'roles'       => $as_array
                    ? 'ADMIN,USER'
                    : ['ADMIN', 'USER'],
                'tags'        => $as_array
                    ? ''
                    : [],
                'created_at'  => $as_array
                    ? DateTimeFactory::toIso8601Zulu(new \DateTime())
                    : new \DateTime(),
                'created_by'  => 'user123',
                'updated_at'  => $as_array
                    ? DateTimeFactory::toIso8601Zulu(new \DateTime())
                    : new \DateTime(),
                'updated_by'  => 'user234',
                'active_from' => $as_array
                    ? DateTimeFactory::toIso8601Zulu(new \DateTime())
                    : new \DateTime(),
                'active_to'   => $as_array
                    ? DateTimeFactory::toIso8601Zulu(new \DateTime())
                    : new \DateTime(),
                'id'          => null,
                'deleted'     => null,
            ], $attributes);

            return $as_array === true
                ? $attributes
                : new Group(
                    $attributes['uid'],
                    $attributes['comment'],
                    $attributes['name'],
                    $attributes['users'],
                    $attributes['roles'],
                    $attributes['tags'],
                    $attributes['created_at'],
                    $attributes['created_by'],
                    $attributes['updated_at'],
                    $attributes['updated_by'],
                    $attributes['active_from'],
                    $attributes['active_to'],
                    $attributes['id'],
                    $attributes['deleted']
                );
        };

        /**
         * @param array $attributes
         * @param bool  $as_array
         *
         * @return array|Report
         */
        static::$factories[Report::class] = function (
            array $attributes = [],
            bool $as_array = false
        ) {
            $attributes = \array_replace([
                'uid'             => ($group_name = 'user123') . '@' . ($domain = 'domain'),
                'comment'         => '',
                'name'            => '',
                'content'         => static::make(ReportContent::class, [], $as_array),
                'query'           => static::make(ReportQuery::class, [], $as_array),
                'vehicle_id'      => $vehicle_id = '5TDDKRFH80S073711',
                'report_type_uid' => 'word' . '@' . $domain,
                'domain_uid'      => $domain,
                'tags'            => $as_array
                    ? ''
                    : [],
                'created_at'      => $as_array
                    ? DateTimeFactory::toIso8601Zulu(new \DateTime())
                    : DateTimeImmutable::createFromMutable(new \DateTime()),
                'created_by'      => 'user234',
                'updated_at'      => $as_array
                    ? DateTimeFactory::toIso8601Zulu(new \DateTime())
                    : DateTimeImmutable::createFromMutable(new \DateTime()),
                'updated_by'      => 'user345',
                'active_from'     => $as_array
                    ? DateTimeFactory::toIso8601Zulu(new \DateTime())
                    : DateTimeImmutable::createFromMutable(new \DateTime()),
                'active_to'       => $as_array
                    ? DateTimeFactory::toIso8601Zulu(new \DateTime())
                    : DateTimeImmutable::createFromMutable(new \DateTime()),
                'progress_ok'     => \random_int(0, 15),
                'progress_wait'   => \random_int(0, 15),
                'progress_error'  => \random_int(0, 15),
                'state'           => static::make(ReportState::class, [], $as_array),
                'id'              => null,
                'deleted'         => null,
            ], $attributes);

            return $as_array === true
                ? $attributes
                : new Report(
                    $attributes['uid'],
                    $attributes['comment'],
                    $attributes['name'],
                    $attributes['content'],
                    $attributes['query'],
                    $attributes['vehicle_id'],
                    $attributes['report_type_uid'],
                    $attributes['domain_uid'],
                    $attributes['tags'],
                    $attributes['created_at'],
                    $attributes['created_by'],
                    $attributes['updated_at'],
                    $attributes['updated_by'],
                    $attributes['active_from'],
                    $attributes['active_to'],
                    $attributes['progress_ok'],
                    $attributes['progress_wait'],
                    $attributes['progress_error'],
                    $attributes['state'],
                    $attributes['id'],
                    $attributes['deleted']
                );
        };

        /**
         * @param array $attributes
         * @param bool  $as_array
         *
         * @return array|Balance
         */
        static::$factories[Balance::class] = function (
            array $attributes = [],
            bool $as_array = false
        ) {
            $attributes = \array_replace([
                'report_type_uid' => 'user123@domain',
                'balance_type'    => 'DAY',
                'quote_init'      => \random_int(0, PHP_INT_MAX),
                'quote_up'        => \random_int(0, PHP_INT_MAX),
                'quote_use'       => \random_int(0, PHP_INT_MAX),
                'created_at'      => $as_array
                    ? DateTimeFactory::toIso8601Zulu(new \DateTime())
                    : new \DateTime(),
                'updated_at'      => $as_array
                    ? DateTimeFactory::toIso8601Zulu(new \DateTime())
                    : new \DateTime(),
            ], $attributes);

            return $as_array === true
                ? $attributes
                : new Balance(
                    $attributes['report_type_uid'],
                    $attributes['balance_type'],
                    $attributes['quote_init'],
                    $attributes['quote_up'],
                    $attributes['quote_use'],
                    $attributes['created_at'],
                    $attributes['updated_at']
                );
        };

        /**
         * @param array $attributes
         * @param bool  $as_array
         *
         * @return array|ReportContent
         */
        static::$factories[ReportContent::class] = function (
            array $attributes = [],
            bool $as_array = false
        ) {
            $data = [
                'string' => 'fasdfa',
                'number' => \random_int(0, PHP_INT_MAX),
                'bool'   => (bool)\random_int(0,1),
                'array'  => [
                    'string' => 'word',
                    'number' => \random_int(0, PHP_INT_MAX),
                    'bool'   => (bool)\random_int(0,1),
                ],
            ];

            return $as_array === true
                ? $data
                : new ReportContent($data);
        };

        /**
         * @param array $attributes
         * @param bool  $as_array
         *
         * @return array|ReportQuery
         */
        static::$factories[ReportQuery::class] = function (
            array $attributes = [],
            bool $as_array = false
        ) {
            $attributes = \array_replace([
                'type' => 'BODY',
                'body' => 'Z94C241BAKR127472',
                'data' => ['foo' => 'bar'],
            ], $attributes);

            return $as_array === true
                ? $attributes
                : new ReportQuery(
                    $attributes['type'],
                    $attributes['body'],
                    $attributes['data']
                );
        };

        /**
         * @param array $attributes
         * @param bool  $as_array
         *
         * @return ReportState|mixed
         */
        static::$factories[ReportState::class] = function (
            array $attributes = [],
            bool $as_array = false
        ) {
            $data = [static::make(ReportSourceState::class, [], $as_array)];

            return $as_array === true
                ? $data
                : new ReportState($data);
        };

        /**
         * @param array $attributes
         * @param bool  $as_array
         *
         * @return array|CleanOptions
         */
        static::$factories[CleanOptions::class] = function (
            array $attributes = [],
            bool $as_array = false
        ) {
            $attributes = \array_replace([
                'process_response' => \random_int(0, PHP_INT_MAX),
                'process_request'  => \random_int(0, PHP_INT_MAX),
                'report_log'       => \random_int(0, PHP_INT_MAX),
            ], $attributes);

            return $as_array === true
                ? $attributes
                : new CleanOptions(
                    $attributes['process_response'],
                    $attributes['process_request'],
                    $attributes['report_log']
                );
        };

        /**
         * @param array $attributes
         * @param bool  $as_array
         *
         * @return array|ReportSourceState
         */
        static::$factories[ReportSourceState::class] = function (
            array $attributes = [],
            bool $as_array = false
        ) {
            $attributes = \array_replace([
                '_id'   => 'base',
                'state' => 'ERROR',
                'data'  => ['foo' => 'bar'],
            ], $attributes);

            return $as_array === true
                ? $attributes
                : new ReportSourceState(
                    $attributes['_id'],
                    $attributes['state'],
                    $attributes['data']
                );
        };

        /**
         * @param array $attributes
         * @param bool  $as_array
         *
         * @return array|ReportMade
         */
        static::$factories[ReportMade::class] = function (
            array $attributes = [],
            bool $as_array = false
        ) {
            $attributes = \array_replace([
                'report_uid'          => ($user = 'user123') . '@' . ($domain = 'domain'),
                'is_new'              => (bool)\random_int(0, 1),
                'process_request_uid' => null,
                'suggest_get'         => $as_array
                    ? DateTimeFactory::toIso8601Zulu(new \DateTime())
                    : new \DateTime(),
            ], $attributes);

            return $as_array === true
                ? $attributes
                : new ReportMade(
                    $attributes['report_uid'],
                    $attributes['is_new'],
                    $attributes['process_request_uid'],
                    $attributes['suggest_get']
                );
        };

        /**
         * @param array $attributes
         * @param bool  $as_array
         *
         * @return array|ReportTypeContent
         */
        static::$factories[ReportTypeContent::class] = function (
            array $attributes = [],
            bool $as_array = false
        ) {
            $attributes = \array_replace([
                'sources' => ['porro', 'sed', 'magni'],
                'fields'  => ['field_1', 'field_2', 'field_3'],
            ], $attributes);

            return $as_array === true
                ? $attributes
                : new ReportTypeContent(
                    $attributes['sources'],
                    $attributes['fields']
                );
        };

        /**
         * @param array $attributes
         * @param bool  $as_array
         *
         * @return array|ReportType
         */
        static::$factories[ReportType::class] = function (
            array $attributes = [],
            bool $as_array = false
        ) {
            $attributes = \array_replace([
                'uid'              => 'word@domain',
                'comment'          => '------',
                'name'             => 'Sit vitae voluptas sint non voluptates.',
                'state'            => 'DRAFT',
                'tags'             => $as_array
                    ? ''
                    : [],
                'max_age'          => \random_int(0, PHP_INT_MAX),
                'domain_uid'       => 'domain',
                'content'          => static::make(ReportTypeContent::class, [], $as_array),
                'day_quote'        => \random_int(0, PHP_INT_MAX),
                'month_quote'      => \random_int(0, PHP_INT_MAX),
                'total_quote'      => \random_int(0, PHP_INT_MAX),
                'min_priority'     => \random_int(0, PHP_INT_MAX),
                'max_priority'     => \random_int(0, PHP_INT_MAX),
                'period_priority'  => \random_int(0, PHP_INT_MAX),
                'max_request'      => \random_int(0, PHP_INT_MAX),
                'created_at'       => $as_array
                    ? DateTimeFactory::toIso8601Zulu(new \DateTime())
                    : new \DateTime(),
                'created_by'       => 'user123',
                'updated_at'       => $as_array
                    ? DateTimeFactory::toIso8601Zulu(new \DateTime())
                    : new \DateTime(),
                'updated_by'       => 'user234',
                'active_from'      => $as_array
                    ? DateTimeFactory::toIso8601Zulu(new \DateTime())
                    : new \DateTime(),
                'active_to'        => $as_array
                    ? DateTimeFactory::toIso8601Zulu(new \DateTime())
                    : new \DateTime(),
                'clean_options'    => static::make(CleanOptions::class, [], $as_array),
                'report_make_mode' => 'TRANSACTIONAL',
                'id'               => null,
                'deleted'          => null,
            ], $attributes);

            return $as_array === true
                ? $attributes
                : new ReportType(
                    $attributes['uid'],
                    $attributes['comment'],
                    $attributes['name'],
                    $attributes['state'],
                    $attributes['tags'],
                    $attributes['max_age'],
                    $attributes['domain_uid'],
                    $attributes['content'],
                    $attributes['day_quote'],
                    $attributes['month_quote'],
                    $attributes['total_quote'],
                    $attributes['min_priority'],
                    $attributes['max_priority'],
                    $attributes['period_priority'],
                    $attributes['max_request'],
                    $attributes['created_at'],
                    $attributes['created_by'],
                    $attributes['updated_at'],
                    $attributes['updated_by'],
                    $attributes['active_from'],
                    $attributes['active_to'],
                    $attributes['clean_options'],
                    $attributes['report_make_mode'],
                    $attributes['id'],
                    $attributes['deleted']
                );
        };
    }
}
