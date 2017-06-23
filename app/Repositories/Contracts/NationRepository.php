<?php

namespace App\Repositories\Contracts;

interface NationRepository {

    public function getById($id);

    public function searchByCriteria($criteria = null, $paging = false);

    public function save(array $data);

    public function delete($id);
}
 

 
