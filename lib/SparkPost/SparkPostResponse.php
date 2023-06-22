<?php

namespace SparkPost;

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

    /**
     * set the response to be wrapped.
     *
     * @param ResponseInterface $response
     * @param array|null $request
     */
    public function __construct(ResponseInterface $response, ?array $request = null)
    {
        $this->response = $response;
        $this->request = $request;
    }

    /**
     * Returns the request values sent.
     *
     * @return array|null $request
     */
    public function getRequest(): ?array
    {
        return $this->request;
    }

    /**
     * Returns the body.
     *
     * @return array $body - the json decoded body from the http response
     */
    public function getBody(): array
    {
        $body = $this->response->getBody();
        $body_string = $body->__toString();

        return json_decode($body_string, true);
    }

    /**
     * pass these down to the response given in the constructor.
     */
    public function getProtocolVersion(): string
    {
        return $this->response->getProtocolVersion();
    }

    public function withProtocolVersion($version): SparkPostResponse|ResponseInterface
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

    public function withHeader($name, $value): SparkPostResponse|ResponseInterface
    {
        return $this->response->withHeader($name, $value);
    }

    public function withAddedHeader($name, $value): SparkPostResponse|ResponseInterface
    {
        return $this->response->withAddedHeader($name, $value);
    }

    public function withoutHeader($name): SparkPostResponse|ResponseInterface
    {
        return $this->response->withoutHeader($name);
    }

    public function withBody(StreamInterface $body): SparkPostResponse|ResponseInterface
    {
        return $this->response->withBody($body);
    }

    public function getStatusCode(): int
    {
        return $this->response->getStatusCode();
    }

    public function withStatus($code, $reasonPhrase = ''): SparkPostResponse|ResponseInterface
    {
        return $this->response->withStatus($code, $reasonPhrase);
    }

    public function getReasonPhrase(): string
    {
        return $this->response->getReasonPhrase();
    }
}
