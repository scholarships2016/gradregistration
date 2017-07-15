<?php

namespace App\Repositories\Contracts;

interface CurriculumRepository
{
 public function searchByCriteria($criteria = null,$faculty_id= null,$degree_id= null,$status=null,$program_id=null, $paging = false);

}
