<?php

namespace App\Http\Controllers\BackOffice;

use App\Repositories\Contracts\ApplySettingRepository;
use App\Repositories\Contracts\AudittrailRepository;

use App\Repositories\Contracts\FacultyRepository;
use App\Repositories\Contracts\ProgramTypeRepository;
use App\Repositories\Contracts\ReportRepository;
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

    public function doReport01(Request $request)
    {
        try {
            $who = session('user_id');
            $userType = session('user_type');
            $param = $request->all();
            $param['who'] = $who;
            $param['user_role'] = $userType->user_role;
            $param['user_type'] = $userType->user_type;

            $data = $this->rptRepo->getReport01DataByCriteria($param);
            $tbody = '<tr><td colspan="8" style="text-align: center">ไม่พบข้อมูล</td></tr>';
            $tfoot = '<tr><td colspan="3" style="text-align: center">รวม</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td></tr>';

            if (!empty($data) && sizeof($data) != 0) {
                $totalAppAmt = 0;
                $totalKtbAmt = 0;
                $totalScbAmt = 0;
                $totalTmbAmt = 0;
                $totalThaAmt = 0;

                $tbody = '';
                foreach ($data as $index => $value) {
                    $row = '<tr>';
                    $row .= '<td>' . ($index + 1) . '</td>';
                    $row .= '<td>' . $value->program_id . " " . $value->thai . '</td>';
                    $row .= '<td>' . $value->cond_id . " " . $value->prog_type_name . '</td>';
                    $row .= '<td>' . number_format($value->app_amt) . '</td>';
                    $row .= '<td>' . number_format($value->ktb_bank) . '</td>';
                    $row .= '<td>' . number_format($value->scb_bank) . '</td>';
                    $row .= '<td>' . number_format($value->tmb_bank) . '</td>';
                    $row .= '<td>' . number_format($value->tha_bank) . '</td>';
                    $row .= '<tr>';
                    $tbody .= $row;

                    $totalAppAmt += $value->app_amt;
                    $totalKtbAmt = bcadd($totalKtbAmt, $value->ktb_bank);
                    $totalScbAmt = bcadd($totalScbAmt, $value->scb_bank);
                    $totalTmbAmt = bcadd($totalTmbAmt, $value->tmb_bank);
                    $totalThaAmt = bcadd($totalThaAmt, $value->tha_bank);
                }

                $tfoot = '<tr>
                            <th colspan="3" style="text-align:center;"> รวม</th><th style=""> ' . number_format($totalAppAmt) . '</th>
                            <th style=""> ' . number_format($totalKtbAmt, 2) . '</th>
                            <th style=""> ' . number_format($totalScbAmt, 2) . '</th>
                            <th style=""> ' . number_format($totalTmbAmt, 2) . '</th>
                            <th style=""> ' . number_format($totalThaAmt, 2) . '</th>
                          </tr>';
            }

            return response()->json(Util::jsonResponseFormat(1, array("tbody" => $tbody, "tfoot" => $tfoot), null));
        } catch (\Exception $ex) {
            throw $ex;
            return response()->json(Util::jsonResponseFormat(3, array("tbody" => $tbody, "tfoot" => $tfoot), null));
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

            $data = $this->rptRepo->getReport02DataByCriteria($param);
            $tbody = '<tr><td colspan="8" style="text-align: center">ไม่พบข้อมูล</td></tr>';
            $tfoot = '<tr><td colspan="6" style="text-align: center">รวม</td><td>0</td><td></td></tr>';
            $totalAmt = 0;
            if (!empty($data) && sizeof($data) != 0) {
                $tbody = '';
                foreach ($data as $index => $value) {
                    $row = '<tr>';
                    $row .= '<td>' . ($index + 1) . '</td>';
                    $row .= '<td>' . $value->applicant_no . '</td>';
                    $row .= '<td>' . $value->application_no . '</td>';
                    $row .= '<td>' . $value->fullname_th . '<br>' . $value->fullname_en . '</td>';
                    $row .= '<td>' . (empty($value->receipt) ? '-' : $value->receipt) . '</td>';
                    $row .= '<td>' . (empty($value->payment_date) ? '-' : $value->payment_date) . '</td>';
                    $row .= '<td>' . number_format($value->apply_fee) . '</td>';
                    $row .= '<td>' . $value->bank_name . '</td>';
                    $row .= '<tr>';
                    $tbody .= $row;
                    $totalAmt = bcadd($totalAmt, $value->apply_fee);
                }
                $tfoot = '<tr><td colspan="6" style="text-align: center">รวม</td><td>' . number_format($totalAmt, 2) . '</td><td></td></tr>';
            }
            return response()->json(Util::jsonResponseFormat(1, array("tbody" => $tbody, "tfoot" => $tfoot), null));
        } catch (\Exception $ex) {
            throw $ex;
            return response()->json(Util::jsonResponseFormat(3, array("tbody" => $tbody, "tfoot" => $tfoot), null));
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

    public function doReport04(Request $request)
    {

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

            $data = $this->rptRepo->getReport01DataByCriteria($param);

            Excel::create('financial', function ($excel) use ($data) {
                $excel->sheet('สรุปยอดการชำระเงิน', function ($sheet) use ($data) {

                    $sheet->setFontFamily('TH Sarabun New');

                    $sheet->appendRow(array(
                        '#', 'หลักสูตร', 'ประเภทหลักสูตร', 'จำนวนผู้สมัคร',
                        'บมจ.ธนาคารกรุงไทย', 'บมจ.ธนาคารไทยพาณิชย์', 'บมจ.ธนาคารธหารไทย', 'บมจ.ธนาคารธนาชาติ'
                    ));

                    $totalAppAmt = 0;
                    $totalKtbAmt = 0;
                    $totalScbAmt = 0;
                    $totalTmbAmt = 0;
                    $totalThaAmt = 0;

                    if (!empty($data) && sizeof($data) != 0) {
                        foreach ($data as $index => $value) {
                            $sheet->appendRow(array(
                                ($index + 1), $value->program_id . " " . $value->thai,
                                $value->cond_id . " " . $value->prog_type_name,
                                number_format($value->app_amt),
                                number_format($value->ktb_bank), number_format($value->scb_bank),
                                number_format($value->tmb_bank), number_format($value->tha_bank)
                            ));

                            $totalAppAmt += $value->app_amt;
                            $totalKtbAmt = bcadd($totalKtbAmt, $value->ktb_bank);
                            $totalScbAmt = bcadd($totalScbAmt, $value->scb_bank);
                            $totalTmbAmt = bcadd($totalTmbAmt, $value->tmb_bank);
                            $totalThaAmt = bcadd($totalThaAmt, $value->tha_bank);
                        }

                        $sheet->appendRow(array(
                            '', '', 'รวม',
                            number_format($totalAppAmt),
                            number_format($totalKtbAmt), number_format($totalScbAmt),
                            number_format($totalTmbAmt), number_format($totalThaAmt)
                        ));
                    } else {
                        $sheet->appendRow(array(
                            '', '', 'รวม',
                            number_format(0),
                            number_format(0), number_format(0),
                            number_format(0), number_format(0)
                        ));
                    }
                });
            })->export('xls');
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

            $data = $this->rptRepo->getReport02DataByCriteria($param);
            Excel::create('applicants', function ($excel) use ($data) {
                $excel->sheet('รายชื่อผู้สมัครเข้าศึกษา (GS01)', function ($sheet) use ($data) {

                    $sheet->setFontFamily('TH Sarabun New');

                    $sheet->appendRow(array(
                        '#', 'เลขประจำตัวผู้สมัคร', 'เลขที่ใบสมัคร', 'ชื่อ-สกุล',
                        'เล่มที่/เลขที่ใบเสร็จรับเงิน', 'วันที่ชำระเงิน', 'จำนวนค่าสมัคร', 'ธนาคาร'
                    ));

                    $totalAmt = 0;
                    if (!empty($data) && sizeof($data) != 0) {
                        foreach ($data as $index => $value) {

                            $sheet->appendRow(array(
                                ($index + 1), $value->applicant_no, $value->application_no,
                                $value->fullname_th . ' ' . $value->fullname_en,
                                empty($value->receipt) ? '-' : $value->receipt,
                                empty($value->payment_date) ? '-' : $value->payment_date,
                                number_format($value->apply_fee), $value->bank_name
                            ));
                            $totalAmt = bcadd($totalAmt, $value->apply_fee);
                        }
                        $sheet->appendRow(array(
                            '', '', '', '', '', 'รวม',
                            number_format($totalAmt), ''
                        ));
                    } else {
                        $sheet->appendRow(array(
                            '', '', '', '', '', 'รวม',
                            number_format($totalAmt), ''
                        ));
                    }
                });
            })->export('xls');

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

            $data = $this->rptRepo->getReport03DataByCriteria($param);
            Excel::create('summaryApplication', function ($excel) use ($data) {
                $excel->sheet('รายงานสรุปยอดผู้สมัครเข้าศึกษา', function ($sheet) use ($data) {

                    $colNames = ['A', 'B', 'C', 'D', 'E', 'F', 'G'];

                    $sheet->setFontFamily('TH Sarabun New');

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
            })->export('xls');

        } catch (\Exception $ex) {
            throw $ex;
        }
    }


}
