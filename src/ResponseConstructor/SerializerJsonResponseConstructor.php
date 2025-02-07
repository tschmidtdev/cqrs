<?php

declare(strict_types=1);

namespace DigitalCraftsman\CQRS\ResponseConstructor;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;

final class SerializerJsonResponseConstructor implements ResponseConstructorInterface
{
    /** @codeCoverageIgnore */
    public function __construct(
        private readonly SerializerInterface $serializer,
    ) {
    }

    public function constructResponse($data, Request $request): JsonResponse
    {
        $content = $this->serializer->serialize($data, JsonEncoder::FORMAT);

        return new JsonResponse($content, Response::HTTP_OK, [], true);
    }
}
