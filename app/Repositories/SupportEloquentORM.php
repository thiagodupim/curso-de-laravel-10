<?php

use App\DTO\CreateSupportDTO;
use App\DTO\UpdateSupportDto;
use App\Repositories\SupportRepositoryInterface;

class SupporEloquentORM implements SupportRepositoryInterface
{
    public function getAll(string $filter = null): array
    {

    }

    public function findOne(string $id): stdClass|null
    {

    }

    public function delete(string $id):void
    {

    }

    public function new(CreateSupportDTO $dto): stdClass4
    {

    }
    
    public function upadate(UpdateSupportDTO $dto): stdClass|null
    {

    }
}