<?php

namespace App\Repositories\Contracts;

interface NewsRepository {

    public function getNewsNow();

    public function getNewsAll();

    public function DeleteNews($id);

    public function save(array $data);
}
