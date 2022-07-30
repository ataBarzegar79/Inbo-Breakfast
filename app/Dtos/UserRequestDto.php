<?php

namespace App\Dtos;

use Illuminate\Http\UploadedFile;

class UserRequestDto
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
        public UploadedFile $avatar,
        public string $is_admin,
    )
    {
    }
}
