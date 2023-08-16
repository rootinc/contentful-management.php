<?php

declare(strict_types=1);

namespace Contentful\Management\SystemProperties\Component;

trait ActionStatusTrait
{
    /**
     * @var string
     */
    protected $status;

    protected function initStatus(array $data)
    {
        $status = $data['status'] ?? '';
        $this->status = $status;
    }

    protected function jsonSerializeStatus(): array
    {
        return [
            'status' => $this->status,
        ];
    }

    public function getStatus(): string
    {
        return $this->status;
    }
}
