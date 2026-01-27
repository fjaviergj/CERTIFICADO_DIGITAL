<?php

declare(strict_types=1);

namespace App\Modules\Auth\DTO;

readonly class UserDto
{
    public function __construct(
        public int $id,
        public string $serialNumber,
        public string $dniNie,
        public string $nombreCompleto,
        public ?string $email = null
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            id: (int) $data['id'],
            serialNumber: $data['serial_number'],
            dniNie: $data['dni_nie'],
            nombreCompleto: $data['nombre_completo'],
            email: $data['email'] ?? null
        );
    }
}
