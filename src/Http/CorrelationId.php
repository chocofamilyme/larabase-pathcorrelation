<?php

namespace Chocofamily\Pathcorrelation\Http;

use Closure;
use Illuminate\Support\Str;

class CorrelationId
{
    /** @var string */
    private $correlationId = '';

    /** @var integer */
    private $spanId = 0;

    /** @var integer */
    private $nextSpanId = 0;

    /** @var CorrelationId */
    private static $instance;

    public function __construct()
    {
        //$this->getInstance();
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle(\Illuminate\Http\Request $request, Closure $next)
    {
        if (PHP_SAPI == 'cli') {
            $this->correlationId = $this->generateId();
        } else {
            $this->correlationId = $request->input('correlation_id', $this->generateId());
            $this->spanId        = $request->input('span_id', 0);
        }

        $this->nextSpanId = $this->spanId + 1;

        return $next($request);
    }

    /**
     * @return CorrelationId
     */
    public static function getInstance(): CorrelationId
    {
        if (empty(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    /**
     * @return array
     */
    public function getNextQueryParams(): array
    {
        return [
            'correlation_id' => $this->correlationId,
            'span_id'        => $this->nextSpanId,
        ];
    }
    /**
     * @return array
     */
    public function getCurrentQueryParams(): array
    {
        return [
            'correlation_id' => $this->correlationId,
            'span_id'        => $this->spanId,
        ];
    }
    /**
     * @return string
     */
    public function getCorrelationId(): string
    {
        return $this->correlationId;
    }
    /**
     * @return int
     */
    public function getSpanId(): int
    {
        return $this->spanId;
    }
    /**
     * @return int
     */
    public function getNextSpanId(): int
    {
        return $this->nextSpanId;
    }
    /**
     * @param string $id
     * @param int    $span
     */
    public function setCorrelation(string $id, int $span)
    {
        $this->correlationId = $id;
        $this->spanId        = $span;
        $this->nextSpanId    = $this->spanId + 1;
    }

    private function generateId(): string
    {
        return Str::uuid()->toString();
    }
}