<?php

namespace App\DTO;

class ImageDTO{
    public function __construct(
        public ?string $image = null,
    ){}

    public static function fromRequest(array $params): self
    {
        return new self(
            image: $params['image'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'image' => $this->image,
        ];
    }

}

?>
