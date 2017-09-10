<?php

namespace App\Utils;
/**
 * Created by PhpStorm.
 * User: worakanpongnumkul
 * Date: 4/3/2017 AD
 * Time: 10:45 AM
 */
class Util
{
    /*SQL*/
    const SQL_SELECT = ' SELECT ';
    const SQL_FROM = ' FROM ';
    const SQL_WHERE = ' WHERE ';
    const SQL_AND = ' AND ';
    const SQL_OR = ' OR ';
    const SQL_JOIN = ' INNER JOIN ';
    const SQL_LEFT_JOIN = ' LEFT JOIN ';
    const SQL_RIGHT_JOIN = ' RIGHT JOIN ';
    const SQL_LEFT_OUTER_JOIN = ' LEFT OUTER JOIN ';
    const SQL_RIGHT_OUTER_JOIN = ' RIGHT OUTER JOIN ';
    const SQL_ON = ' ON ';
    const SQL_BETWEEN = ' BETWEEN ';
    const SQL_INT_TRUE = 1;
    const SQL_INT_FALSE = 0;
    const ORDER_ASC = 'asc';
    const ORDER_DESC = 'desc';


    /*Message*/
    const CANNOT_SAVE = 'ไม่สามารถบันทึกข้อมูลได้<br/>Unable to save.';
    const FAIL_SAVE = 'บันทึกไม่สำเร็จ<br/>Saving failed.';
    const SUCCESS_SAVE = 'บันทึกสำเร็จ<br/>Saving is successful.';
    const UNABLE_TO_ACCESS = 'ไม่สามารถใข้งานในส่วนนี้ได้ กรุณาติดต่อ Admin</br>Service is unavailable, please contact administrator.';
    const DATA_NOT_FOUND = 'ไม่พบข้อมูล<br/>No Data Found';
    const ERROR_OCCUR = 'เกิดข้อผิดพลาด<br/>Error';
    const CHANGE_PASS_SUCCESS = 'เปลี่ยนรหัสผ่านสำเร็จ<br/>Changing password is successful.';
    const CHANGE_PASS_ERROR = 'เปลี่ยนรหัสผ่านไม่สำเร็จ<br/>Changing password failed.';
    const UPDATE_SUCCESS = 'ปรับปรุงข้อมูลสำเร็จ<br/>Updating is successful.';


    const SUCCESS_DELETE = 'ลบข้อมูลสำเร็จ';
    const CANNOT_DELETE = 'ไม่สามารถลบข้อมูลได้';


    /*Role Name Eng*/
    const ROLE_ADMIN = 'Admin';
    const ROLE_STAFF = 'Staff';
    const ROLE_APPLICANT = 'Applicant';


    /*Module*/
    const MODULE_LV1 = 1;
    const MODULE_LV2 = 2;
    const MODULE_LV3 = 3;

    /*System*/
    const SYSYEM_USER = 'SYSTEM';

    /*Exit Type*/
    const EXIT_TYPES = ['เกษียณอายุ', 'ออกจากงานฯ', 'ลาออก', 'สิ้นกำหนดการจ้าง',
        'เกษียณอายุก่อนกำหนด', 'ถึงแก่กรรม', 'ปลดออก', 'เกษียณอายุทางเลือก',
        'ให้ออก', 'เลิกจ้าง'];

    /*Folder*/
    const PROFILE_FOLDER = 'PROFILE_FOLDER';
    const DOC_FOLDER = 'DOC_FOLDER';
    const TRASH_FOLDER = 'TRASH_FOLDER';
    const TEMP_FOLDER = 'TEMP_FOLDER';
    const CURRICULUM_DOC_FOLDER = 'CURRICULUM_DOC_FOLDER';

    /*Folder by M*/

    const APPLY_DOC = 'APPLY_DOC/DOC';
    const APPLY_IMG = 'APPLY_DOC/IMG';

    /* Audit Action*/
    const AUDIT_ACT_VIEW = 1;
    const AUDIT_ACT_CREATE = 2;
    const AUDIT_ACT_UPDATE = 3;
    const AUDIT_ACT_DELETE = 4;
    const AUDIT_ACT_APPROVE = 5;
    const AUDIT_ACT_REJECT = 6;

    /*Section Name*/
    const SECTION_CURRICULUM = 'Curriculum';


    /**
     * Util constructor.
     */
    public function __construct()
    {
    }

    public static function prepareDataForDropdownList($datas, $keyName, $valueName)
    {
        $result = array();
        try {
            foreach ($datas as $data) {
                $result = array_add($result, $data[$keyName], $data[$valueName]);
            }
        } catch (\Exception $ex) {
            throw $ex;
        }
        return $result;
    }

    public static function jsonResponseFormat($status, $data, $message)
    {
        $reStatus = "";
        switch ($status) {
            case 1:
                $reStatus = "success";
                break;
            case 2:
                $reStatus = "warning";
                break;
            case 3:
                $reStatus = "error";
                break;
            default:
                $reStatus = "";
        }

        return array("status" => $reStatus, "data" => $data, "message" => $message);
    }

    public static function dateFormatToNewDateFormat($srcFormat, $srcDateStr, $descFormat)
    {
        try {
            $curDateTiem = \DateTime::createFromFormat($srcFormat, $srcDateStr);
            return $curDateTiem->format($descFormat);
        } catch (\Exception $ex) {
            throw $ex;
        }
    }


    public static function prepareAudittrail($section, $actionId, $detail, $performer)
    {
        $auditObj['section'] = $section;
        $auditObj['audit_action_id'] = $actionId;
        $auditObj['detail'] = $detail;
        $auditObj['performer'] = $performer;
        return $auditObj;
    }

    public static function prepareAcademicYearList($currYear, $nextNo = 0, $backNo = 0, $sort = 'asc')
    {
        try {
            $curr = intval($currYear) + 543;
            $minYear = $curr - intval($backNo);
            $maxYeay = $curr + intval($nextNo);

            $yearList = array();

            for ($i = $minYear; $i <= $maxYeay; $i++) {
                array_push($yearList, $i);
            }

            if (strcmp($sort, Util::ORDER_DESC)) {
                sort($yearList);
            } else if (strcmp($sort, Util::ORDER_ASC)) {
                rsort($yearList);
            }
            return $yearList;
        } catch (\Exception $ex) {
            throw $ex;
        }
    }
    public static function prepareDataForDropdownListDistrict($datas, $keyName, $valueName, $valueNameEn)
    {
        $result = array();
        try {
            foreach ($datas as $data) {
                $result = array_add($result, $data[$keyName], $data[$valueName].' - '.$data[$valueNameEn]);
            }
        } catch (\Exception $ex) {
            throw $ex;
        }
        return $result;
    }
}
