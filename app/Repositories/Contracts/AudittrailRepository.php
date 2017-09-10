<?php

namespace App\Repositories\Contracts;

interface AudittrailRepository
{
    public function save(array $data);

    public function doPaging();

    public function getDistinctSection();
}
