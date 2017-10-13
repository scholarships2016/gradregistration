<?php

namespace App\Http\Controllers\BackOffice;

use App\Repositories\Contracts\ApplySettingRepository;
use App\Repositories\Contracts\AudittrailRepository;

use App\Repositories\Contracts\DepartmentRepository;
use App\Repositories\Contracts\FacultyRepository;
use App\Repositories\Contracts\ProgramTypeRepository;
use App\Repositories\Contracts\ReportRepository;
use App\Repositories\Contracts\TblMajorRepository;
use App\Utils\Util;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    private static $SECTION_NAME = 'Report';
    protected $rptRepo;
    protected $facRepo;
    protected $applySetRepo;
    protected $progTypeRepo;


    /**
     * ReportController constructor.
     */
    public function __construct(ReportRepository $rptRepo, FacultyRepository $facRepo,
                                ApplySettingRepository $applySetRepo, ProgramTypeRepository $progTypeRepo)
    {
        $this->rptRepo = $rptRepo;
        $this->facRepo = $facRepo;
        $this->applySetRepo = $applySetRepo;
        $this->progTypeRepo = $progTypeRepo;
    }


    public function showReport01Page(Request $request)
    {
        try {
            $acaYears = $this->applySetRepo->getDistinctAcademicYear();
            $facs = $this->facRepo->getAllFacultyForDropdown();
            $progs = $this->progTypeRepo->getAllProgramTypeForDropdown();
            return view("backoffice.reports.report_GSFinancial", ["acaYears" => $acaYears, "facs" => $facs, "progs" => $progs]);
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function showReport02Page(Request $request)
    {
        try {
            $acaYears = $this->applySetRepo->getDistinctAcademicYear();
            $facs = $this->facRepo->getAllFacultyForDropdown();
            $progs = $this->progTypeRepo->getAllProgramTypeForDropdown();
            return view("backoffice.reports.report_GS01", ["acaYears" => $acaYears, "facs" => $facs, "progs" => $progs]);
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function showReport03Page(Request $request)
    {
        try {
            $acaYears = $this->applySetRepo->getDistinctAcademicYear();
            $facs = $this->facRepo->getAllFacultyForDropdown();
            $progs = $this->progTypeRepo->getAllProgramTypeForDropdown();
            return view("backoffice.reports.report_GSSummary", ["acaYears" => $acaYears, "facs" => $facs, "progs" => $progs]);
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function showReport04Page(Request $request)
    {
        try {
            $acaYears = $this->applySetRepo->getDistinctAcademicYear();
            $facs = $this->facRepo->getAllFacultyForDropdown();
            $progs = $this->progTypeRepo->getAllProgramTypeForDropdown();
            $flows = $this->rptRepo->getFlowApplyForDropdown();
            return view("backoffice.reports.report_GS04", ["acaYears" => $acaYears, "facs" => $facs, "progs" => $progs, "flows" => $flows]);
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function showReportEngScorePage(Request $request)
    {
        try {
            $acaYears = $this->applySetRepo->getDistinctAcademicYear();
            $facs = $this->facRepo->getAllFacultyForDropdown();
            $progs = $this->progTypeRepo->getAllProgramTypeForDropdown();
            return view("backoffice.reports.report_EngScore", ["acaYears" => $acaYears, "facs" => $facs, "progs" => $progs]);
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function showSatisfactionPage(Request $request)
    {
        try {
            $acaYears = $this->applySetRepo->getDistinctAcademicYear();
            return view("backoffice.reports.report_satisfaction", ["acaYears" => $acaYears]);
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function showReportToRegPage(Request $request)
    {
        try {
            $acaYears = $this->applySetRepo->getDistinctAcademicYear();
            $facs = $this->facRepo->getAllFacultyForDropdown();
            $progs = $this->progTypeRepo->getAllProgramTypeForDropdown();
            return view("backoffice.reports.report_to_reg", ["acaYears" => $acaYears, "facs" => $facs, "progs" => $progs]);
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function doReport01(Request $request)
    {
        try {
            $who = session('user_id');
            $userType = session('user_type');
            $param = $request->all();
            $param['who'] = $who;
            $param['user_role'] = $userType->user_role;
            $param['user_type'] = $userType->user_type;

            $data = $this->rptRepo->getReport01DataByCriteria2($param);
            $tbody = '<tr><td colspan="10" style="text-align: center">ไม่พบข้อมูล</td></tr>';

            if (!empty($data) && sizeof($data) != 0) {
                $tbody = '';
                foreach ($data as $index => $value) {
                    $row = '<tr>';
                    $row .= '<td>' . ($index + 1) . '</td>';
                    $row .= '<td>' . $value->stu_citizen_card . '</td>';
                    $row .= '<td>' . (empty($value->fullname_th) ? $value->fullname_en : $value->fullname_th . ' <br>' . $value->fullname_en) . '</td>';
                    $row .= '<td>' . $value->program_id . '</td>';
                    $row .= '<td>' . $value->major_name . '</td>';
                    $row .= '<td>' . $value->department_name . '</td>';
                    $row .= '<td>' . $value->faculty_name . '</td>';
                    $row .= '<td>' . $value->prog_type_name . '</td>';
                    $row .= '<td>' . $value->bank_name . '</td>';
                    $row .= '<td>' . $value->payment_status . '</td>';
                    $row .= '<tr>';
                    $tbody .= $row;
                }
            }

            return response()->json(Util::jsonResponseFormat(1, array("tbody" => $tbody), null));
        } catch (\Exception $ex) {
            throw $ex;
            return response()->json(Util::jsonResponseFormat(3, array("tbody" => $tbody), null));
        }
    }

    public function doReport02(Request $request)
    {
        try {
            $who = session('user_id');
            $userType = session('user_type');
            $param = $request->all();
            $param['who'] = $who;
            $param['user_role'] = $userType->user_role;
            $param['user_type'] = $userType->user_type;

            $data = $this->rptRepo->getReport02DataByCriteria2($param);
            $tbody = '<tr><td colspan="17" style="text-align: center">ไม่พบข้อมูล</td></tr>';
            if (!empty($data) && sizeof($data) != 0) {
                $tbody = '';
                foreach ($data as $index => $value) {
                    $uni = null;
                    if (!empty($value->university)) {
                        $uni = explode("|", $value->university);
                    }
                    $row = '<tr>';
                    $row .= '<td>' . ($index + 1) . '</td>';
                    $row .= '<td>' . $value->academic_year . '</td>';
                    $row .= '<td>' . $value->stu_citizen_card . '</td>';
                    $row .= '<td>' . (empty($value->stu_first_name) ? $value->stu_first_name_en : $value->stu_first_name . "<br>" . $value->stu_first_name_en) . '</td>';
                    $row .= '<td>' . (empty($value->stu_last_name) ? $value->stu_last_name_en : $value->stu_last_name . "<br>" . $value->stu_last_name_en) . '</td>';
                    $row .= '<td>' . $value->sex . '</td>';
                    $row .= '<td>' . $value->nation_name . '</td>';
                    $row .= '<td>' . $value->eng_score . '</td>';
                    $row .= '<td>' . $value->test_type . '</td>';
                    $row .= '<td>' . (!empty($uni) && sizeof($uni) > 0 ? $uni[0] : '') . '</td>';
                    $row .= '<td>' . $value->work_status_name . '</td>';
                    $row .= '<td>' . $value->program_id . '</td>';
                    $row .= '<td>' . $value->curr_status . '</td>';
                    $row .= '<td>' . $value->flow_id . '</td>';
                    $row .= '<td>' . $value->major_name . '</td>';
                    $row .= '<td>' . $value->faculty_name . '</td>';
                    $row .= '<td>' . $value->prog_type_name . '</td>';
                    $row .= '<tr>';
                    $tbody .= $row;
                }
            }
            return response()->json(Util::jsonResponseFormat(1, array("tbody" => $tbody), null));
        } catch (\Exception $ex) {
            throw $ex;
            return response()->json(Util::jsonResponseFormat(3, array("tbody" => $tbody), null));
        }
    }

    public function doReport03(Request $request)
    {
        try {
            $who = session('user_id');
            $userType = session('user_type');
            $param = $request->all();
            $param['who'] = $who;
            $param['user_role'] = $userType->user_role;
            $param['user_type'] = $userType->user_type;

            $data = $this->rptRepo->getReport03DataByCriteria($param);
            $tbody = '<tr><td colspan="7" style="text-align: center">ไม่พบข้อมูล</td></tr>';
            $tfoot = '<tr><td colspan="3" style="text-align: right">รวมทั้งสิ้น</td><td>0</td><td>0</td><td>0</td><td>0</td></tr>';

            $totalArray = array();

            if (!empty($data) && sizeof($data) != 0) {
                $totalArray['grandtotal'] = [0, 0, 0, 0, ''];
                $tbody = '';
                $facBuff = null;
                $progTypeBuff = null;
                $progCount = 0;
                foreach ($data as $index => $value) {
                    if ($facBuff !== $value->faculty_id) {
                        $tbody .= '<tr><td style="text-align: left" colspan="7">คณะ' . $value->faculty_name . '</td></tr>';
                        $facBuff = $value->faculty_id;
                        $progTypeBuff = null;
                    }
                    if ($progTypeBuff !== $value->cond_id) {
                        $tbody .= '<tr><td></td><td colspan="6">' . $value->prog_type_name . '</td></tr>';
                        $progTypeBuff = $value->cond_id;
                        if (!array_key_exists($value->cond_id, $totalArray)) {
                            $totalArray[$value->cond_id] = [0, 0, 0, 0, $value->prog_type_name];
                        }
                        if (!array_key_exists($value->degree_level_name, $totalArray)) {
                            $totalArray[$value->degree_level_name] = [0, 0, 0, 0, $value->prog_type_name];
                        }
                        $progCount = 0;
                    }
                    $progCount += 1;
                    $tbody .= '<tr><td>' . $progCount . '</td><td>' . $value->major_info . '</td><td>'
                        . $value->prog_info . '</td><td>' . number_format($value->expected_amount) . '</td><td>'
                        . number_format($value->apply_via_web_amt) . '</td><td>' . number_format($value->payed_app_amt)
                        . '</td><td>' . number_format($value->passed_exam_amt) . '</td></tr>';

                    $totalArray[$value->cond_id][0] = bcadd($totalArray[$value->cond_id][0], $value->expected_amount);
                    $totalArray[$value->cond_id][1] = bcadd($totalArray[$value->cond_id][1], $value->apply_via_web_amt);
                    $totalArray[$value->cond_id][2] = bcadd($totalArray[$value->cond_id][2], $value->payed_app_amt);
                    $totalArray[$value->cond_id][3] = bcadd($totalArray[$value->cond_id][3], $value->passed_exam_amt);
                    $totalArray[$value->degree_level_name][0] = bcadd($totalArray[$value->degree_level_name][0], $value->expected_amount);
                    $totalArray[$value->degree_level_name][1] = bcadd($totalArray[$value->degree_level_name][1], $value->apply_via_web_amt);
                    $totalArray[$value->degree_level_name][2] = bcadd($totalArray[$value->degree_level_name][2], $value->payed_app_amt);
                    $totalArray[$value->degree_level_name][3] = bcadd($totalArray[$value->degree_level_name][3], $value->passed_exam_amt);
                    $totalArray['grandtotal'][0] = bcadd($totalArray['grandtotal'][0], $value->expected_amount);
                    $totalArray['grandtotal'][1] = bcadd($totalArray['grandtotal'][1], $value->apply_via_web_amt);
                    $totalArray['grandtotal'][2] = bcadd($totalArray['grandtotal'][2], $value->payed_app_amt);
                    $totalArray['grandtotal'][3] = bcadd($totalArray['grandtotal'][3], $value->passed_exam_amt);
                }
            }

            if (!empty($totalArray) && sizeof($totalArray) != 0) {
                $tfootHead = '';
                $tfoot = '';
                if (array_key_exists(Util::DIPLOMA_TH, $totalArray)) {
                    $tfoot .= '<tr><td colspan="3" style="text-align: right">รวมยอด ' . Util::DIPLOMA_TH . '</td><td>'
                        . $totalArray[Util::DIPLOMA_TH][0] . '</td><td>' . $totalArray[Util::DIPLOMA_TH][1] .
                        '</td><td>' . $totalArray[Util::DIPLOMA_TH][2] . '</td><td>' . $totalArray[Util::DIPLOMA_TH][3] . '</td></tr>';
                    unset($totalArray[Util::DIPLOMA_TH]);
                }
                if (array_key_exists(Util::MASTER_TH, $totalArray)) {
                    $tfoot .= '<tr><td colspan="3" style="text-align: right">รวมยอด ' . Util::MASTER_TH . '</td><td>'
                        . $totalArray[Util::MASTER_TH][0] . '</td><td>' . $totalArray[Util::MASTER_TH][1] .
                        '</td><td>' . $totalArray[Util::MASTER_TH][2] . '</td><td>' . $totalArray[Util::MASTER_TH][3] . '</td></tr>';
                    unset($totalArray[Util::MASTER_TH]);
                }
                if (array_key_exists(Util::HIGH_DIPLOMA_TH, $totalArray)) {
                    $tfoot .= '<tr><td colspan="3" style="text-align: right">รวมยอด ' . Util::HIGH_DIPLOMA_TH . '</td><td>'
                        . $totalArray[Util::HIGH_DIPLOMA_TH][0] . '</td><td>' . $totalArray[Util::HIGH_DIPLOMA_TH][1] .
                        '</td><td>' . $totalArray[Util::HIGH_DIPLOMA_TH][2] . '</td><td>' . $totalArray[Util::HIGH_DIPLOMA_TH][3] . '</td></tr>';
                    unset($totalArray[Util::HIGH_DIPLOMA_TH]);
                }
                if (array_key_exists(Util::DOCTOR_TH, $totalArray)) {
                    $tfoot .= '<tr><td colspan="3" style="text-align: right">รวมยอด ' . Util::DOCTOR_TH . '</td><td>'
                        . $totalArray[Util::DOCTOR_TH][0] . '</td><td>' . $totalArray[Util::DOCTOR_TH][1] .
                        '</td><td>' . $totalArray[Util::DOCTOR_TH][2] . '</td><td>' . $totalArray[Util::DOCTOR_TH][3] . '</td></tr>';
                    unset($totalArray[Util::DOCTOR_TH]);
                }
                $tfoot .= '<tr><td colspan="3" style="text-align: right">รวมทั้งสิ้น</td><td>'
                    . $totalArray['grandtotal'][0] . '</td><td>' . $totalArray['grandtotal'][1] .
                    '</td><td>' . $totalArray['grandtotal'][2] . '</td><td>' . $totalArray['grandtotal'][3] . '</td></tr>';
                unset($totalArray['grandtotal']);

                if (!empty($totalArray) && sizeof($totalArray) != 0) {
                    ksort($totalArray);
                    foreach ($totalArray as $key => $value) {
                        $tfootHead .= '<tr><td colspan="3" style="text-align: right">' . $value[4] . '</td><td>'
                            . $value[0] . '</td><td>' . $value[1] .
                            '</td><td>' . $value[2] . '</td><td>' . $value[3] . '</td></tr>';
                    }
                    $tfoot = $tfootHead . '' . $tfoot;
                }

            }

            return response()->json(Util::jsonResponseFormat(1, array("tbody" => $tbody, "tfoot" => $tfoot), null));
        } catch (\Exception $ex) {
            throw $ex;
            return response()->json(Util::jsonResponseFormat(3, array("tbody" => $tbody, "tfoot" => $tfoot), null));
        }
    }

    public function doReport09(Request $request)
    {
        try {
            $who = session('user_id');
            $userType = session('user_type');
            $param = $request->all();
            $param['who'] = $who;
            $param['user_role'] = $userType->user_role;
            $param['user_type'] = $userType->user_type;

            $data = $this->rptRepo->getEngScoreReport($param);
            $tbody = '<tr><td colspan="9" style="text-align: center">ไม่พบข้อมูล</td></tr>';

            if (!empty($data) && sizeof($data) != 0) {
                $tbody = "";
                foreach ($data as $index => $value) {
                    $row = '<tr>';
                    $row .= '<td>' . ($index + 1) . '</td>';
                    $row .= '<td>' . $value->stu_citizen_card . '</td>';
                    $row .= '<td>' . $value->fullname_th . '<br>' . $value->fullname_en . '</td>';
                    $row .= '<td>' . $value->program_id . '</td>';
                    $row .= '<td>' . $value->major_name . '</td>';
                    $row .= '<td>' . $value->eng_score . '</td>';
                    $row .= '<td>' . $value->test_type . '</td>';
                    $row .= '<td>' . $value->prog_type_name . '</td>';
                    $row .= '<td>' . $value->faculty_name . '</td>';
                    $row .= '</tr>';
                    $tbody .= $row;
                }
            }
            return response()->json(Util::jsonResponseFormat(1, array("tbody" => $tbody), null));
        } catch (\Exception $ex) {
            throw $ex;
            return response()->json(Util::jsonResponseFormat(3, array("tbody" => $tbody, "tfoot" => $tfoot), null));
        }
    }

    public function doReport13(Request $request)
    {
        try {
            $who = session('user_id');
            $userType = session('user_type');
            $param = $request->all();
            $param['who'] = $who;
            $param['user_role'] = $userType->user_role;
            $param['user_type'] = $userType->user_type;

            $tbody = '<tr><td colspan="4" style="text-align: center">ไม่พบข้อมูล</td></tr>';
            $data = $this->rptRepo->getSatisfactionData($param);
            $data2 = $this->rptRepo->getSatisfactionChartsData($param);

            if (!empty($data) && sizeof($data) != 0) {
                $tbody = "";
                foreach ($data as $index => $value) {
                    $row = '<tr>';
                    $row .= '<td>' . ($index + 1) . '</td>';
                    $row .= '<td>' . $value->SATI_SUGGESTION . '</td>';
                    $row .= '<td>' . $value->fullname_th . '</td>';
                    $row .= '<td>' . $value->created . '</td>';
                    $row .= '</tr>';
                    $tbody .= $row;
                }
            }

            return response()->json(Util::jsonResponseFormat(1, array("tbody" => $tbody, "chartData" => $data2), null));
        } catch (\Exception $ex) {
            throw $ex;
            return response()->json(Util::jsonResponseFormat(3, array("tbody" => $tbody, "tfoot" => $tfoot), null));
        }
    }

    public function doReport01Excel(Request $request)
    {
        try {
            $who = session('user_id');
            $userType = session('user_type');
            $param = $request->all();
            $param['who'] = $who;
            $param['user_role'] = $userType->user_role;
            $param['user_type'] = $userType->user_type;
            if (!(isset($param['fileType']) && ($param['fileType'] == 'xls' || $param['fileType'] == 'txt'))) {
                throw new \Exception('Cannot Export');
            }


            $data = $this->rptRepo->getReport01DataByCriteria2($param);

            Excel::create('financial', function ($excel) use ($data) {
                $excel->sheet('สรุปยอดการชำระเงิน', function ($sheet) use ($data) {
                    $sheet->setFontFamily('TH Sarabun New');
                    $sheet->setFontSize(14);
                    $sheet->appendRow(array(
                        "เลขที่บัตรประชาชน",
                        "ชื่อสกุล ไทย",
                        "ชื่อสกุล อังกฤษ",
                        "รหัสหลักสูตรที่สมัคร",
                        "สาขาที่สมัคร",
                        "ภาควิชา",
                        "คณะ",
                        "ประเภทหลักสูตร",
                        "ธนาคาร",
                        "สถานะผู้สมัคร"
                    ));

                    if (!empty($data) && sizeof($data) != 0) {
                        foreach ($data as $index => $value) {
                            $sheet->appendRow(array(
                                $value->stu_citizen_card,
                                $value->fullname_th,
                                $value->fullname_en,
                                $value->program_id,
                                $value->major_name,
                                $value->department_name,
                                $value->faculty_name,
                                $value->prog_type_name,
                                $value->bank_name,
                                $value->payment_status
                            ));
                        }
                    }

                });
            })->export($param['fileType']);
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function doReport02Excel(Request $request)
    {
        try {
            $who = session('user_id');
            $userType = session('user_type');
            $param = $request->all();
            $param['who'] = $who;
            $param['user_role'] = $userType->user_role;
            $param['user_type'] = $userType->user_type;
            if (!(isset($param['fileType']) && ($param['fileType'] == 'xls' || $param['fileType'] == 'txt'))) {
                throw new \Exception('Cannot Export');
            }

            $data = $this->rptRepo->getReport02DataByCriteria2($param);
            Excel::create('applicants', function ($excel) use ($data) {
                $excel->sheet('รายชื่อผู้สมัครเข้าศึกษา (GS01)', function ($sheet) use ($data) {

                    $sheet->setFontFamily('TH Sarabun New');
                    $sheet->setFontSize(14);

                    $sheet->appendRow(array(
                        "ปีการศึกษาที่เข้า",
                        "เลขที่ ปชช",
                        "ชื่อ ไทย/อังกฤษ",
                        "นามสกุล ไทย/อังกฤษ",
                        "เพศ",
                        "สัญชาติ",
                        "คะแนนภาษาอังกฤษ",
                        "ประเภท ENG",
                        "มหาวิทยาลัยที่จบ",
                        "สถานะการทำงาน",
                        "รหัสหลักสูตรที่สมัคร",
                        "สถานะผู้สมัคร",
                        "สถานะ",
                        "ชื่อสาขาที่สมัคร",
                        "คณะ",
                        "ประเภทหลักสูตรที่สมัคร"
                    ));

                    if (!empty($data) && sizeof($data) != 0) {
                        foreach ($data as $index => $value) {
                            $uni = null;
                            if (!empty($value->university)) {
                                $uni = explode("|", $value->university);
                            }
                            $sheet->appendRow(array(
                                $value->academic_year,
                                $value->stu_citizen_card,
                                (empty($value->stu_first_name) ? $value->stu_first_name_en : $value->stu_first_name . PHP_EOL . $value->stu_first_name_en),
                                (empty($value->stu_last_name) ? $value->stu_last_name_en : $value->stu_last_name . PHP_EOL . $value->stu_last_name_en),
                                $value->sex, $value->nation_name, $value->eng_score, $value->test_type, (!empty($uni) && sizeof($uni) > 0 ? $uni[0] : ''),
                                $value->work_status_name, $value->program_id, $value->curr_status, $value->flow_id, $value->major_name, $value->faculty_name,
                                $value->prog_type_name
                            ));
                        }
                    }
                });
            })->export($param['fileType']);

        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function doReport03Excel(Request $request)
    {
        try {
            $who = session('user_id');
            $userType = session('user_type');
            $param = $request->all();
            $param['who'] = $who;
            $param['user_role'] = $userType->user_role;
            $param['user_type'] = $userType->user_type;
            if (!(isset($param['fileType']) && ($param['fileType'] == 'xls' || $param['fileType'] == 'txt'))) {
                throw new \Exception('Cannot Export');
            }

            $data = $this->rptRepo->getReport03DataByCriteria($param);
            Excel::create('summaryApplication', function ($excel) use ($data) {
                $excel->sheet('รายงานสรุปยอดผู้สมัครเข้าศึกษา', function ($sheet) use ($data) {

                    $sheet->setFontFamily('TH Sarabun New');
                    $sheet->setFontSize(14);

                    $sheet->appendRow(array(
                        '#', 'สาขาวิชา', 'หลักสูตร', 'คาดว่า',
                        'สมัครผ่านเว็บไซต์', 'ส่งใบสมัคร', 'สอบได้'
                    ));


                    $totalArray = array();
                    $rowCount = 2;
                    if (!empty($data) && sizeof($data) != 0) {
                        $totalArray['grandtotal'] = [0, 0, 0, 0, ''];
                        $tbody = '';
                        $facBuff = null;
                        $progTypeBuff = null;
                        $progCount = 0;

                        foreach ($data as $index => $value) {
                            if ($facBuff !== $value->faculty_id) {
                                $sheet->appendRow(array('คณะ' . $value->faculty_name));
                                $sheet->mergeCells('A' . $rowCount . ':G' . $rowCount);
                                $rowCount += 1;
                                $facBuff = $value->faculty_id;
                                $progTypeBuff = null;
                            }
                            if ($progTypeBuff !== $value->cond_id) {
                                $sheet->appendRow(array('', $value->prog_type_name));
                                $sheet->mergeCells('B' . $rowCount . ':G' . $rowCount);
                                $rowCount += 1;
                                $progTypeBuff = $value->cond_id;
                                if (!array_key_exists($value->cond_id, $totalArray)) {
                                    $totalArray[$value->cond_id] = [0, 0, 0, 0, $value->prog_type_name];
                                }
                                if (!array_key_exists($value->degree_level_name, $totalArray)) {
                                    $totalArray[$value->degree_level_name] = [0, 0, 0, 0, $value->prog_type_name];
                                }
                                $progCount = 0;
                            }
                            $progCount += 1;

                            $sheet->appendRow(array($progCount, $value->major_info, $value->prog_info, number_format($value->expected_amount),
                                number_format($value->apply_via_web_amt), number_format($value->payed_app_amt), number_format($value->passed_exam_amt)));
                            $rowCount += 1;

                            $totalArray[$value->cond_id][0] = bcadd($totalArray[$value->cond_id][0], $value->expected_amount);
                            $totalArray[$value->cond_id][1] = bcadd($totalArray[$value->cond_id][1], $value->apply_via_web_amt);
                            $totalArray[$value->cond_id][2] = bcadd($totalArray[$value->cond_id][2], $value->payed_app_amt);
                            $totalArray[$value->cond_id][3] = bcadd($totalArray[$value->cond_id][3], $value->passed_exam_amt);
                            $totalArray[$value->degree_level_name][0] = bcadd($totalArray[$value->degree_level_name][0], $value->expected_amount);
                            $totalArray[$value->degree_level_name][1] = bcadd($totalArray[$value->degree_level_name][1], $value->apply_via_web_amt);
                            $totalArray[$value->degree_level_name][2] = bcadd($totalArray[$value->degree_level_name][2], $value->payed_app_amt);
                            $totalArray[$value->degree_level_name][3] = bcadd($totalArray[$value->degree_level_name][3], $value->passed_exam_amt);
                            $totalArray['grandtotal'][0] = bcadd($totalArray['grandtotal'][0], $value->expected_amount);
                            $totalArray['grandtotal'][1] = bcadd($totalArray['grandtotal'][1], $value->apply_via_web_amt);
                            $totalArray['grandtotal'][2] = bcadd($totalArray['grandtotal'][2], $value->payed_app_amt);
                            $totalArray['grandtotal'][3] = bcadd($totalArray['grandtotal'][3], $value->passed_exam_amt);
                        }


                    }
                    if (!empty($totalArray) && sizeof($totalArray) != 0) {
                        $grandTotal = $totalArray;

                        if (array_key_exists(Util::DIPLOMA_TH, $grandTotal)) {
                            unset($grandTotal[Util::DIPLOMA_TH]);
                        }
                        if (array_key_exists(Util::MASTER_TH, $grandTotal)) {
                            unset($grandTotal[Util::MASTER_TH]);
                        }
                        if (array_key_exists(Util::HIGH_DIPLOMA_TH, $grandTotal)) {
                            unset($grandTotal[Util::HIGH_DIPLOMA_TH]);
                        }
                        if (array_key_exists(Util::DOCTOR_TH, $grandTotal)) {
                            unset($grandTotal[Util::DOCTOR_TH]);
                        }
                        unset($grandTotal['grandtotal']);

                        if (!empty($grandTotal) && sizeof($grandTotal) != 0) {
                            ksort($grandTotal);
                            foreach ($grandTotal as $key => $value) {
                                $sheet->appendRow(array('', '', $value[4], $value[0], $value[1], $value[2], $value[3]));
                                $sheet->mergeCells('A' . $rowCount . ':B' . $rowCount);
                                $rowCount += 1;
                            }
                        }

                        if (array_key_exists(Util::DIPLOMA_TH, $totalArray)) {
                            $sheet->appendRow(array('', '', 'รวมยอด ' . Util::DIPLOMA_TH, $totalArray[Util::DIPLOMA_TH][0],
                                $totalArray[Util::DIPLOMA_TH][1], $totalArray[Util::DIPLOMA_TH][2], $totalArray[Util::DIPLOMA_TH][3]));
                            $sheet->mergeCells('A' . $rowCount . ':B' . $rowCount);
                            $rowCount += 1;
                            unset($totalArray[Util::DIPLOMA_TH]);
                        }
                        if (array_key_exists(Util::MASTER_TH, $totalArray)) {
                            $sheet->appendRow(array('', '', 'รวมยอด ' . Util::MASTER_TH, $totalArray[Util::MASTER_TH][0],
                                $totalArray[Util::MASTER_TH][1], $totalArray[Util::MASTER_TH][2], $totalArray[Util::MASTER_TH][3]));
                            $sheet->mergeCells('A' . $rowCount . ':B' . $rowCount);
                            $rowCount += 1;
                            unset($totalArray[Util::MASTER_TH]);
                        }
                        if (array_key_exists(Util::HIGH_DIPLOMA_TH, $totalArray)) {
                            $sheet->appendRow(array('', '', 'รวมยอด ' . Util::HIGH_DIPLOMA_TH, $totalArray[Util::HIGH_DIPLOMA_TH][0],
                                $totalArray[Util::HIGH_DIPLOMA_TH][1], $totalArray[Util::HIGH_DIPLOMA_TH][2],
                                $totalArray[Util::HIGH_DIPLOMA_TH][3]));
                            $sheet->mergeCells('A' . $rowCount . ':B' . $rowCount);
                            $rowCount += 1;
                            unset($totalArray[Util::HIGH_DIPLOMA_TH]);
                        }
                        if (array_key_exists(Util::DOCTOR_TH, $totalArray)) {
                            $sheet->appendRow(array('', '', 'รวมยอด ' . Util::DOCTOR_TH, $totalArray[Util::DOCTOR_TH][0],
                                $totalArray[Util::DOCTOR_TH][1], $totalArray[Util::DOCTOR_TH][2],
                                $totalArray[Util::DOCTOR_TH][3]));
                            $sheet->mergeCells('A' . $rowCount . ':B' . $rowCount);
                            $rowCount += 1;
                            unset($totalArray[Util::DOCTOR_TH]);
                        }
                        $sheet->appendRow(array('', '', 'รวมยั้งสิ้น ', $totalArray['grandtotal'][0], $totalArray['grandtotal'][1], $totalArray['grandtotal'][2], $totalArray['grandtotal'][3]));
                        $sheet->mergeCells('A' . $rowCount . ':B' . $rowCount);
                        $rowCount += 1;

                    }
                });
            })->export($param['fileType']);

        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function doReport04Excel(Request $request)
    {
        try {
            $who = session('user_id');
            $userType = session('user_type');
            $param = $request->all();
            $param['who'] = $who;
            $param['user_role'] = $userType->user_role;
            $param['user_type'] = $userType->user_type;

            if (!(isset($param['fileType']) && ($param['fileType'] == 'xls' || $param['fileType'] == 'txt'))) {
                throw new \Exception('Cannot Export');
            }

            $data1 = $this->rptRepo->getReport04ApplicantDataByCriteria($param);
            $data2 = $this->rptRepo->getReport04ApplicationDataByCriteria($param);
            Excel::create('ApplicantApplicationInfo', function ($excel) use ($data1, $data2) {
                $excel->sheet('Applicant_Info', function ($sheet) use ($data1) {
                    $sheet->setFontFamily('TH Sarabun New');
                    $sheet->setFontSize(14);
                    $sheet->appendRow(array(
                        'ลำดับ', 'ชื่อ-สกุล ไทย', 'ชื่อ-สกุล อังกฤษ', 'เพศ', 'สัญชาติ', 'ศาสนา',
                        'สถานภาพสมรส', 'วัน/เดือน/ปีเกิด', 'สถานที่เกิด (จังหวัด)', 'อีเมล์',
                        'รูปถ่าย', 'ที่อยู่', 'คะแนนภาษาอังกฤษ', 'คะแนนภาษาไทย', 'คะแนนความถนัดทางธุรกิจ(CU-BEST)', 'การศึกษาระดับปริญญาตรี',
                        'การศึกษาระดับปริญญาโท', 'ข้อมูลที่ทำงาน', 'ความสนใจในการรับทุน', 'แหล่งที่ทราบข้อมูล'

                    ));

                    foreach ($data1 as $index => $value) {
                        $sheet->appendRow(array(
                            ($index + 1), $value->fullname_th, $value->fullname_en, $value->stu_sex,
                            $value->nation_name, $value->religion_name, $value->stu_married,
                            $value->stu_birthdate, $value->stu_birthplace, $value->stu_email, $value->file_origi_name,
                            $value->address, $value->eng_score, $value->thai_test_score, $value->cu_best_score,
                            $value->bachelor_info, $value->master_info, $value->work_info, $value->fund_interesting, $value->news_src
                        ));
                    }
                });
                $excel->sheet('Application_Info', function ($sheet) use ($data2) {
                    $sheet->setFontFamily('TH Sarabun New');
                    $sheet->setFontSize(14);
                    $sheet->appendRow(array(
                        'ลำดับ', 'เลขที่ใบสมัคร', 'ลำดับที่สมัคร', 'หลักสูตร', 'สาขาวิชา', 'แขนงวิชา',
                        'ประเภทหลักสูตร', 'รหัสประจำตัวประชาชน', 'วันที่สมัคร',
                        'เล่มที่ใบเสร็จรับเงิน', 'เลขที่ใบเสร็จรับเงิน', 'ธนาคาร', 'วันที่ขำระเงิน',
                        'สิทธิ์การเข้าสอบ', 'หมายเหตุ', 'ผ่านการทดสอบ', 'หมายเหตุ',
                        'สถานะ', 'หมายเลขเครื่อง', 'เอกสารประกอบการสมัคร',
                        'บุคคลอ้างอิง1', 'บุคคลอ้างอิง2', 'บุคคลอ้างอิง3', 'ข้อมูลเพิ่มเติมที่หลักสูตรต้องการ'
                    ));

                    foreach ($data2 as $index => $value) {
                        $person = [];
                        if (isset($value->people_ref)) {
                            $person = explode("|", $value->people_ref);
                        }
                        $sheet->appendRow(array(
                            ($index + 1), $value->app_id, $value->curriculum_num,
                            $value->program_id, $value->major_id, $value->curr_sub_major_id,
                            $value->prog_type_name, $value->stu_citizen_card, $value->apply_date,
                            $value->receipt_book_no, $value->receipt_no, $value->bank_name, $value->payment_date,
                            $value->exam_name, $value->exam_remark, $value->admission_status_name_th,
                            $value->admission_remark, $value->flow_name, $value->ipaddress, $value->doc_details,
                            (array_key_exists(0, $person) ? $person[0] : ''), (array_key_exists(1, $person) ? $person[1] : ''),
                            (array_key_exists(2, $person) ? $person[2] : ''), $value->additional_answer
                        ));
                    }

                });
            })->export($param['fileType']);

        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function doReport09Excel(Request $request)
    {
        try {
            $who = session('user_id');
            $userType = session('user_type');
            $param = $request->all();
            $param['who'] = $who;
            $param['user_role'] = $userType->user_role;
            $param['user_type'] = $userType->user_type;

            $data = $this->rptRepo->getEngScoreReport($param);
            if (!(isset($param['fileType']) && ($param['fileType'] == 'xls' || $param['fileType'] == 'txt'))) {
                throw new \Exception('Cannot Export');
            }

            Excel::create('EngScoreReport', function ($excel) use ($data) {
                $excel->sheet('EngScoreReport', function ($sheet) use ($data) {
                    $sheet->setFontFamily('TH Sarabun New');
                    $sheet->setFontSize(14);
                    $sheet->appendRow(array('#',
                        'เลขที่บัตรประชาชน',
                        'ชื่อสกุล ไทย',
                        'ชื่อสกุล อังกฤษ',
                        'รหัสหลักสูตรที่สมัคร',
                        'สาขาที่สมัคร',
                        'คะแนนที่ได้',
                        'ประเภทคะแนน',
                        'ประเภทหลักสูตร',
                        'คณะ'
                    ));
                    foreach ($data as $index => $value) {
                        $sheet->appendRow(array(
                            ($index + 1)
                        , $value->stu_citizen_card
                        , $value->fullname_th
                        , $value->fullname_en
                        , $value->program_id
                        , $value->major_name
                        , $value->eng_score
                        , $value->test_type
                        , $value->prog_type_name
                        , $value->faculty_name
                        ));
                    }
                });
            })->export($param['fileType']);


        } catch (\Exception $ex) {
            throw $ex;
        }
    }


    public function doReport13Excel(Request $request)
    {
        try {
            $who = session('user_id');
            $userType = session('user_type');
            $param = $request->all();
            $param['who'] = $who;
            $param['user_role'] = $userType->user_role;
            $param['user_type'] = $userType->user_type;

            $data = $this->rptRepo->getSatisfactionData($param);
            if (!(isset($param['fileType']) && ($param['fileType'] == 'xls' || $param['fileType'] == 'txt'))) {
                throw new \Exception('Cannot Export');
            }

            Excel::create('SatisfactionReport', function ($excel) use ($data) {
                $excel->sheet('SatisfactionReport', function ($sheet) use ($data) {
                    $sheet->setFontFamily('TH Sarabun New');
                    $sheet->setFontSize(14);
                    $sheet->appendRow(array('#',
                        'ความคิดเห็น',
                        'ผู้ให้ความคิดเห็น',
                        'วัน-เวลา'
                    ));
                    foreach ($data as $index => $value) {
                        $sheet->appendRow(array(
                            ($index + 1),
                            $value->SATI_SUGGESTION,
                            $value->fullname_th,
                            $value->created
                        ));
                    }
                });
            })->export($param['fileType']);

        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function doReport14Excel(Request $request)
    {
        try {
            $who = session('user_id');
            $userType = session('user_type');
            $param = $request->all();
            $param['who'] = $who;
            $param['user_role'] = $userType->user_role;
            $param['user_type'] = $userType->user_type;

            $data = null;
            $rptName = '';
            if (!(isset($param['fileType']) && ($param['fileType'] == 'xls' || $param['fileType'] == 'txt'))) {
                throw new \Exception('Cannot Export');
            }

            if (isset($param['rpt_type']) && $param['rpt_type'] == 1) {
                $data = $this->rptRepo->getDatasRegistrationCenter1($param);
                $rptName = 'สทป-1';
            } else if (isset($param['rpt_type']) && $param['rpt_type'] == 2) {
                $data = $this->rptRepo->getDatasRegistrationCenter2($param);
                $rptName = 'สทป-2';
            } else if (isset($param['rpt_type']) && $param['rpt_type'] == 3) {
                $data = $this->rptRepo->getDatasPolicyAndPlan($param);
                $rptName = 'นโยบายและแผน';
            } else {
                throw new \Exception('Cannot Export');
            }

            Excel::create($rptName, function ($excel) use ($data, $rptName) {
                $excel->sheet($rptName, function ($sheet) use ($data) {
                    $sheet->setFontFamily('TH Sarabun New');
                    $sheet->setFontSize(14);
                    $sheet->fromArray(json_decode(json_encode($data), true), null, 'A1', false, false);
                });
            })->export($param['fileType']);

        } catch (\Exception $ex) {
            throw $ex;
        }
    }


}
