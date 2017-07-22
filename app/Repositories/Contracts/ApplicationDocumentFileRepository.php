<?php

namespace App\Repositories\Contracts;

interface ApplicationDocumentFileRepository {

 public function GetData($application_ID);
 public function Delete($application_ID,$doc_apply_id );
 public function saveApplicationDocumentFile($data);
}
