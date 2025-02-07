<?php

declare(strict_types=1);

namespace DigitalCraftsman\CQRS\Test\Application;

use DigitalCraftsman\CQRS\Command\Command;
use DigitalCraftsman\CQRS\HandlerWrapper\HandlerWrapperInterface;
use DigitalCraftsman\CQRS\Query\Query;
use DigitalCraftsman\CQRS\Test\Utility\ConnectionSimulator;
use Symfony\Component\HttpFoundation\Request;

final class ConnectionTransactionWrapper implements HandlerWrapperInterface
{
    public function __construct(
        private ConnectionSimulator $connectionSimulator,
    ) {
    }

    /** @param null $parameters */
    public function prepare(
        Command|Query $dto,
        Request $request,
        mixed $parameters,
    ): void {
        $this->connectionSimulator->beginTransaction();
    }

    /** @param null $parameters */
    public function catch(
        Command|Query $dto,
        Request $request,
        mixed $parameters,
        \Exception $exception,
    ): ?\Exception {
        $this->connectionSimulator->rollBack();

        return $exception;
    }

    /** @param null $parameters */
    public function then(
        Command|Query $dto,
        Request $request,
        mixed $parameters,
    ): void {
        $this->connectionSimulator->commit();
    }

    // Priorities

    public static function preparePriority(): int
    {
        return 50;
    }

    public static function catchPriority(): int
    {
        return 50;
    }

    public static function thenPriority(): int
    {
        return 50;
    }

    /** @param null $parameters */
    public static function areParametersValid(mixed $parameters): bool
    {
        return $parameters === null;
    }
}
