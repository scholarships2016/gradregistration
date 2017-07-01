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


    /*Message*/
    const CANNOT_SAVE = 'ไม่สามารถบันทึกข้อมูลได้';
    const FAIL_SAVE = 'บันทึกไม่สำเร็จ';
    const SUCCESS_SAVE = 'บันทึกสำเร็จ';
    const UNABLE_TO_ACCESS = 'ไม่สามารถใข้งานในส่วนนี้ได้ กรุณาติดต่อ Admin';
    const DATA_NOT_FOUND = 'ไม่พบข้อมูล';
    const ERROR_OCCUR = 'เกิดข้อผิดพลาด';

    /*Role Name Eng*/
    const ROLE_APPROVER = 'Approver';
    const ROLE_ROOT = 'Root';
    const ROLE_COMMITTEE = 'Committee';
    const ROLE_MODULE_ADMIN = 'Module-Admin';
    const ROLE_ADMIN = 'Admin';
    const ROLE_REPORTER = 'Reporter';

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
}