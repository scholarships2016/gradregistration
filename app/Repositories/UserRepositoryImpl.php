<?php

/**
 * Created by PhpStorm.
 * User: worakanpongnumkul
 * Date: 4/3/2017 AD
 * Time: 2:35 PM
 */

namespace App\Repositories;

use App\Repositories\Contracts\ProfileRepository;
use App\Repositories\Contracts\UserRepository;
use App\Models\User;
use App\Utils\Util;
use Illuminate\Support\Facades\DB;

class UserRepositoryImpl extends AbstractRepositoryImpl implements UserRepository
{

    protected $profileRepo;

    public function __construct(ProfileRepository $profileRepo)
    {
        parent::setModelClassName(User::class);
        $this->profileRepo = $profileRepo;
    }

    public function getUserAndRoleById($id)
    {
        $result = null;
        try {
            $query = $this->with('role')->with('profile')->whereNull('deleted_at')->where('id', $id);
            $result = $query->first();
        } catch (\Exception $ex) {
            throw $ex;
        }
        return $result;
    }

    public function searchUserByCriteria($criteria = null)
    {
        $result = null;
        try {
            $query = DB::table('users as u')
                ->select('u.id', 'u.egat_code_id', 'u.email', 'r.role_name_eng', DB::raw('CONCAT("คุณ",p.fullname_th," (",p.job_title_abbr,")") as fullname_th'), 'p.fullname_eng', 'u.is_active', 'u.is_ldap_auth')
                ->leftJoin('roles as r', function ($join) {
                    $join->on('r.id', '=', 'u.role_id')
                        ->whereNull('r.deleted_at');
                })
                ->leftJoin('profiles as p', function ($join) {
                    $join->on('p.id', '=', 'u.profile_id')
                        ->whereNull('p.deleted_at');
                })->whereNull('u.deleted_at');

            if (!empty($criteria)) {
                if (array_key_exists('egat_code_id', $criteria) && !empty($criteria['egat_code_id'])) {
                    $query->where('u.egat_code_id', 'like', '%' . $criteria['egat_code_id'] . '%');
                }
                if (array_key_exists('role_id', $criteria) && !empty($criteria['role_id'])) {
                    $query->where('r.role_id', $criteria['role_id']);
                }
                if (array_key_exists('is_ldap_auth', $criteria) && !empty($criteria['is_ldap_auth'])) {
                    if ($criteria['is_ldap_auth'] !== "ALL") {
                        $query->where('u.is_ldap_auth', $criteria['is_ldap_auth']);
                    }
                }
                if (array_key_exists('is_active', $criteria) && !empty($criteria['is_active'])) {
                    if ($criteria['is_active'] !== "ALL") {
                        $query->where('u.is_active', $criteria['is_active']);
                    }
                }
            }
            $result = $query->get();
        } catch (\Exception $ex) {
            throw $ex;
        }
        return $result;
    }

    public function getActiveUserById($id)
    {
        $result = null;
        try {
            $query = $this->find($id)->where('is_active', true);
        } catch (\Exception $ex) {
            throw $ex;
        }
        return $result;
    }

    public function save(array $data)
    {
        // No password saving

        $result = false;
        try {
            if (!array_key_exists('id', $data) || empty($data['id'])) {
                throw new \Exception('No Id to Update');
            }
            $curObj = $this->find($data['id']);
            if (array_key_exists('role_id', $data)) {
                $curObj->role_id = trim($data['role_id']);
            }
            if (array_key_exists('egat_code_id', $data)) {
                $curObj->egat_code_id = trim($data['egat_code_id']);
            }
            if (array_key_exists('email', $data)) {
                $curObj->email = trim($data['email']);
            }
            if (array_key_exists('username', $data)) {
                $curObj->username = trim($data['username']);
            }
            if (array_key_exists('is_ldap_auth', $data)) {
                $curObj->is_ldap_auth = trim($data['is_ldap_auth']);
            }
            if (array_key_exists('is_active', $data)) {
                $curObj->is_active = trim($data['is_active']);
            }
            if (array_key_exists('password', $data) && !empty($data['password'])) {
                $curObj->password = $data['password'];
            }
            $result = $curObj->save();
        } catch (\Exception $ex) {
            throw $ex;
        }
        return $result;
    }

    public function register(array $data)
    {
        $result = false;
        try {
            if (array_key_exists('egat_code_id', $data) && !empty($data['egat_code_id'])) {
                $profile = $this->profileRepo->findByEmpId($data['egat_code_id']);
                $data = array_add($data, 'profile_id', $profile->id);
                $this->create($data);
                $result = true;
            }
        } catch (\Exception $ex) {
            throw $ex;
        }
        return $result;
    }

    public function searchUserByCriteriaAsPagination($criteria = null)
    {
        try {
            $columnMap = array(0 => "u.egat_code_id",
                1 => "fullname_th",
                2 => "r.role_name_eng");
            $draw = empty($criteria['draw']) ? 1 : $criteria['draw'];
            $data = null;
            $textArray = [];
            $textArray2 = [];

            if (array_key_exists('findTextHidden', $criteria) && !empty($criteria['findTextHidden'])) {
                $textArray = explode(" ", $criteria['findTextHidden']);
            }
            if (array_key_exists('search', $criteria) && !empty($criteria['search']['value'])) {
                $textArray2 = explode(" ", $criteria['search']['value']);
            }

            $query = DB::table('users as u')
                ->select('u.id', 'u.egat_code_id', 'u.profile_id', DB::raw("concat('คุณ',p.fullname_th,' (',p.job_title_abbr,')') as fullname_th"), 'r.role_name_eng',
                    'u.is_ldap_auth', 'u.is_active')
                ->join('profiles as p', function ($join) {
                    $join->on('p.id', '=', 'u.profile_id')
                        ->whereNull('p.deleted_at');
                })
                ->leftJoin('roles as r', function ($join) {
                    $join->on('r.id', '=', 'u.role_id')
                        ->whereNull('r.deleted_at');
                })
                ->whereNull('u.deleted_at');

            $recordsTotal = $query->get()->count();

            if (array_key_exists('empIdHidden', $criteria) && !empty($criteria['empIdHidden'])) {
                $query->where('u.egat_code_id', trim($criteria['empIdHidden']));
            }
            if (array_key_exists('roleIdHidden', $criteria) && !empty($criteria['roleIdHidden'])) {
                $roleIds = explode(",", $criteria['roleIdHidden']);
                $query->whereIn('u.role_id', $roleIds);
            }
            if (array_key_exists('fullnameThHidden', $criteria) && $criteria['fullnameThHidden'] != '') {
                $query->where('p.fullname_th', 'like', '%' . $criteria['fullnameThHidden'] . '%');
            }
            if (array_key_exists('fullnameEngHidden', $criteria) && $criteria['fullnameEngHidden'] != '') {
                $query->where('p.fullname_eng', 'like', '%' . $criteria['fullnameEngHidden'] . '%');
            }
            if (array_key_exists('isLdapAuthHidden', $criteria) && $criteria['isLdapAuthHidden'] != '') {
                $query->where('u.is_ldap_auth', '=', $criteria['isLdapAuthHidden']);
            }
            if (array_key_exists('isActiveHidden', $criteria) && $criteria['isActiveHidden'] != '') {
                $query->where('u.is_active', '=', $criteria['isActiveHidden']);
            }

            if (!empty($textArray)) {
                $query->where(function ($query) use ($textArray, $criteria) {

                    $query->orWhere('u.egat_code_id', 'like', '%' . $criteria['findTextHidden'] . '%');
                    $query->orWhere('p.fullname_th', 'like', '%' . $criteria['findTextHidden'] . '%');
                    $query->orWhere('p.fullname_eng', 'like', '%' . $criteria['findTextHidden'] . '%');
                    $query->orWhere('p.job_title', 'like', '%' . $criteria['findTextHidden'] . '%');
                    $query->orWhere('p.job_title_abbr', 'like', '%' . $criteria['findTextHidden'] . '%');
                    $query->orWhere('r.role_name_th', 'like', '%' . $criteria['findTextHidden'] . '%');
                    $query->orWhere('r.role_name_eng', 'like', '%' . $criteria['findTextHidden'] . '%');

                    foreach ($textArray as $text) {
                        $query->orWhere('u.egat_code_id', 'like', '%' . $text . '%');
                        $query->orWhere('p.fullname_th', 'like', '%' . $text . '%');
                        $query->orWhere('p.fullname_eng', 'like', '%' . $text . '%');
                        $query->orWhere('p.job_title', 'like', '%' . $text . '%');
                        $query->orWhere('p.job_title_abbr', 'like', '%' . $text . '%');
                        $query->orWhere('r.role_name_th', 'like', '%' . $text . '%');
                        $query->orWhere('r.role_name_eng', 'like', '%' . $text . '%');
                    }
                });
            }

            if (!empty($textArray2)) {
                $query->where(function ($query) use ($textArray2, $criteria) {
                    $query->orWhere('u.egat_code_id', 'like', '%' . trim($criteria['search']['value']) . '%');
                    $query->orWhere('p.fullname_th', 'like', '%' . trim($criteria['search']['value']) . '%');
                    $query->orWhere('p.fullname_eng', 'like', '%' . trim($criteria['search']['value']) . '%');
                    $query->orWhere('p.job_title', 'like', '%' . trim($criteria['search']['value']) . '%');
                    $query->orWhere('p.job_title_abbr', 'like', '%' . trim($criteria['search']['value']) . '%');
                    $query->orWhere('r.role_name_th', 'like', '%' . trim($criteria['search']['value']) . '%');
                    $query->orWhere('r.role_name_eng', 'like', '%' . trim($criteria['search']['value']) . '%');

                    foreach ($textArray2 as $text) {
                        $query->orWhere('u.egat_code_id', 'like', '%' . $text . '%');
                        $query->orWhere('p.fullname_th', 'like', '%' . $text . '%');
                        $query->orWhere('p.fullname_eng', 'like', '%' . $text . '%');
                        $query->orWhere('p.job_title', 'like', '%' . $text . '%');
                        $query->orWhere('p.job_title_abbr', 'like', '%' . $text . '%');
                        $query->orWhere('r.role_name_th', 'like', '%' . $text . '%');
                        $query->orWhere('r.role_name_eng', 'like', '%' . $text . '%');
                    }
                });
            }

            //ToDo Something
            $recordsFiltered = $query->get()->count();
            $query->orderBy($columnMap[$criteria['order'][0]['column']], $criteria['order'][0]['dir']);
            $query->offset($criteria['start'])->limit($criteria['length']);
            $data = $query->get();

            $result = array('draw' => $draw,
                'recordsTotal' => $recordsTotal,
                'recordsFiltered' => $recordsFiltered,
                'data' => $data
            );

            return $result;
        } catch (\Exception $ex) {
            throw $ex;
        }

    }

    public function getActiveUserProfilesByEmpId($empId)
    {
        try {
            if (empty($empId)) {
                return null;
            }
            $query = DB::table('profiles as p')
                ->select('p.id', 'p.egat_emp_id', 'p.fullname_th', 'p.job_title', 'p.job_title_abbr', 'p.email')
                ->whereNull('deleted_at')
                ->whereNull('p.status')
                ->where('p.egat_emp_id', 'like', '%' . $empId . '%');
            return $query->get();
        } catch (\Exception $ex) {
            throw $ex;
        }
    }


}