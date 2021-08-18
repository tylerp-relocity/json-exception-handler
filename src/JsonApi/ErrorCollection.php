<?php

namespace SMartins\Exceptions\JsonApi;

use Illuminate\Support\Collection;
use SMartins\Exceptions\Response\ErrorHandledCollectionInterface;
use SMartins\Exceptions\Response\InvalidContentException;

class ErrorCollection extends Collection implements ErrorHandledCollectionInterface
{
    /**
     * The HTTP status code applicable to this problem, expressed as a string value.
     *
     * @var string
     */
    protected $statusCode;

    /**
     * The HTTP headers on response.
     *
     * @var array
     */
    protected $headers = [];

    /**
     * Returns the status code.
     *
     * @return string|null
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * Returns response headers.
     *
     * @return array headers
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * Set the status code.
     *
     * @param string $statusCode
     *
     * @return self
     */
    public function setStatusCode(string $statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * Set the headers of response.
     *
     * @param array $headers
     *
     * @return self
     */
    public function setHeaders(array $headers): self
    {
        $this->headers = $headers;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function validatedContent(string $type): ErrorHandledCollectionInterface
    {
        foreach ($this->items as $item) {
            if (! $item instanceof $type) {
                throw new InvalidContentException('All items on ['.self::class.'] must to be instances of ['.$type.'].');
            }
        }

        return $this;
    }
}
