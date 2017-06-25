<?php

namespace App\Repositories\Contracts;

interface NameTitleRepository {
public function getAll();
public function getByID($id);
 
}
