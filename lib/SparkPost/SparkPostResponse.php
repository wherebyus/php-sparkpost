<?php

namespace SparkPost;

use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\ResponseInterface as ResponseInterface;
use Psr\Http\Message\StreamInterface as StreamInterface;

class SparkPostResponse implements ResponseInterface
{
    /**
     * ResponseInterface to be wrapped by SparkPostResponse.
     */
    private ResponseInterface $response;

    /**
     * Array with the request values sent.
     */
    private array $request;

    public function __construct(ResponseInterface $response, ?array $request = null)
    {
        $this->response = $response;
        $this->request = $request;
    }

    public function getRequest(): ?array
    {
        return $this->request;
    }

    public function getBody(): StreamInterface
    {
        $body = $this->response->getBody();
        $body_string = $body->__toString();

        return json_decode($body_string, true);
    }

    public function getProtocolVersion(): string
    {
        return $this->response->getProtocolVersion();
    }

    public function withProtocolVersion($version): MessageInterface
    {
        return $this->response->withProtocolVersion($version);
    }

    public function getHeaders(): array
    {
        return $this->response->getHeaders();
    }

    public function hasHeader($name): bool
    {
        return $this->response->hasHeader($name);
    }

    public function getHeader($name): array
    {
        return $this->response->getHeader($name);
    }

    public function getHeaderLine($name): string
    {
        return $this->response->getHeaderLine($name);
    }

    public function withHeader($name, $value): MessageInterface
    {
        return $this->response->withHeader($name, $value);
    }

    public function withAddedHeader($name, $value): MessageInterface
    {
        return $this->response->withAddedHeader($name, $value);
    }

    public function withoutHeader($name): MessageInterface
    {
        return $this->response->withoutHeader($name);
    }

    public function withBody(StreamInterface $body): MessageInterface
    {
        return $this->response->withBody($body);
    }

    public function getStatusCode(): int
    {
        return $this->response->getStatusCode();
    }

    public function withStatus($code, $reasonPhrase = ''): MessageInterface
    {
        return $this->response->withStatus($code, $reasonPhrase);
    }

    public function getReasonPhrase(): string
    {
        return $this->response->getReasonPhrase();
    }
}
