<?php

use App\Enums\UserTypeEnum;

return [
    ['path' => '/api/v1/visits', 'method' => 'POST', 'public' => false,  'permissions' => [], 'roles' => [UserTypeEnum::DOCTOR->value]],
    ['path' => '/api/v1/visits/{id}', 'method' => 'GET', 'public' => false, 'permissions' => [], 'roles' => [UserTypeEnum::USER->value]],
    ['path' => '/api/v1/patients/{patientId}/records', 'method' => 'GET', 'public' => false,  'permissions' => [], 'roles' => [UserTypeEnum::USER->value]]
];