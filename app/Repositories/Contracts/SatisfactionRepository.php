<?php

namespace App\Repositories\Contracts;

interface SatisfactionRepository
{
 public function getById($id);
 public function save(array $data);

}
