<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Repositories\FileRepositoryImpl;
use App\Repositories\Contracts\AudittrailRepository;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Excel as excel2;
use \Crypt;

class Controller extends BaseController {

    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests;

    protected $FileRepo;
    protected $excelRepo;
    protected $auditRepo;
    protected $excel2Repo;

    public function __construct(FileRepositoryImpl $FileRepo = null, Excel $excels = null, AudittrailRepository $auditRepo = null, excel2 $excel2Repo = null) {
        $this->FileRepo = $FileRepo;
        $this->excelRepo = $excels;
        $this->auditRepo = $auditRepo;
        $this->excel2Repo = $excel2Repo;
    }

    public function doDownloadFile(Request $request) {
        try {

            $data = $request->all();
            if (!array_key_exists('file_id', $data) || empty($data['file_id'])) {
                return;
            }
            $id = Crypt::decrypt($data['file_id']);
            $file = $this->FileRepo->findOrFail($id);
            $path = Storage::disk('local')->getDriver()->getAdapter()->applyPathPrefix($file->file_path);

            return response()->download($path, $file->file_origi_name);
        } catch (\Exception $ex) {
            
        }
    }

    public function doDownloadMediaFile(Request $request) {
        try {

            $data = $request->all();
            if (!array_key_exists('file_id', $data) || empty($data['file_id'])) {
                return;
            }
            $decrypt_file_id = Crypt::decrypt($data['file_id']);
            //echo  $decrypt_file_id;

            $file = $this->FileRepo->getFileByGenName($decrypt_file_id);
            $path = Storage::disk('local')->getDriver()->getAdapter()->applyPathPrefix($file->file_path);

            return response()->download($path, $file->file_origi_name);
        } catch (\Exception $ex) {
            
        }
    }

    public function doPDFImg($id) {
        try {
            $file = $this->FileRepo->findOrFail($id);
            $path = Storage::disk('local')->getDriver()->getAdapter()->applyPathPrefix($file->file_path);

            return $path;
        } catch (\Exception $ex) {
            
        }
    }

    public function WLog($message, $activity, $errorLog) {
        $log = '|User:' . ((session('user_id') != null) ? session('email_address') : 'unknowUser' ) . '|Activity:' . $activity . '|Message:' . $message;
        $ip = request()->ip();
        if ($errorLog == null || $errorLog == '') {
            Log::info($log . '|IP:' . $ip . PHP_EOL);
        } else {
            Log::error($log . '|Error Message:' . $errorLog . '|IP:' . $ip . PHP_EOL);
        }
    }

    public static function ConvertDateThai($date) {


        $date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');

        $thaiweek = [ "วันจันทร์", "วันอังคาร", "วันพุธ", "วันพฤหัส", "วันศุกร์", "วันเสาร์", "วันอาทิตย์"];
        $thaimonth = ["มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"];

        $res = $thaiweek[date('N', strtotime($date)) - 1] . " ที่ " . date('j', strtotime($date)) . " " . $thaimonth[date('m', strtotime($date)) - 1] . " พ.ศ. " . (date('Y', strtotime($date)) + 543);

        return $res;
    }

    public static function ConvertDateThaiNotWeek($date) {


        $date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');

        $thaimonth = ["มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"];

        $res = date('j', strtotime($date)) . " " . $thaimonth[date('m', strtotime($date)) - 1] . " พ.ศ. " . (date('Y', strtotime($date)) + 543);

        return $res;
    }

    public function importExport() {
        return view('importExport');
    }

    public function importExcel() {
        if (Input::hasFile('import_file')) {
            $path = Input::file('import_file')->getRealPath();
            $data = $this->excel2Repo->load($path, function($reader) {
                        
                    })->get()[0];

            if (!empty($data) && $data->count()) {
                 

                foreach ($data as $key => $value) {
                    
                    if ($value->row) {
                        $title_name = explode('-', $value->title_name);
                        $sex = explode('-', $value->sex);
                        $nationality = explode('-', $value->nationality);
                        $religion = explode('-', $value->religion);
                        $address_prov = explode('_', $value->address_prov);
                        $address_dist = explode('_', $value->address_dist);
                        $work_status = explode('-', $value->work_status);
                        $Admission_Status = explode('-', $value->admission_status);
                        $edu_pass_id = explode('-', $value->edu_pass_id);
                        $university_id = explode('-', $value->university_id);
                        $edu_pass_id_M = explode('-', $value->edu_pass_idm);                         
                        $university_id_M = explode('-', $value->university_idm);
                        
                        $eng_test_id = explode('-', $value->eng_test_id);
                        $insert[] = ['row' => $value->row,
                            'id_card' => $value->id_card,
                            'title_name' => trim($title_name[1]),
                            'title_nameID' => trim($title_name[0]),
                            'name_th' => $value->name_th,
                            'lname_th' => $value->lname_th,
                            'name_en' => $value->name_en,
                            'lname_en' => $value->lname_en,
                            'sex' => trim($sex[1]),
                            'sexID' => trim($sex[0]),
                            'nationality' => trim($nationality[1]),
                            'nationalityID' => trim($nationality[0]),
                            'birth_day' => trim($value->birth_day),
                            'religion' => trim($religion[1]),
                            'religionID' => trim($religion[0]),
                            'address_no' => $value->address_no,
                            'address_moo' => $value->address_moo,
                            'address_soi' => $value->address_soi,
                            'address_str' => $value->address_str,
                            'address_prov' => trim($address_prov[0]),
                            'address_provID' => trim($address_prov[1]),
                            'address_dist' => trim($address_dist[0]),
                            'address_distID' => trim($address_dist[1]),
                            'work_status' => trim($work_status[1]),
                            'work_statusID' => trim($work_status[0]),
                            'work_place_name' => $value->work_place_name,
                            'work_position' => $value->work_position,
                            'Admission_Status' => trim($Admission_Status[1]),
                            'Admission_StatusID' => trim($Admission_Status[0]),
                            'stu_phone' => trim($value->stu_phone),
                            'eng_test_id' => trim($eng_test_id[0]),
                            'eng_test_text' => trim($eng_test_id[1]),
                            'eng_test_score' => trim($value->eng_test_score),
                            'eng_date_taken' => trim($value->eng_date_taken),
                            'edu_pass_id' => trim($edu_pass_id[0]),
                            'edu_pass_text' => trim($edu_pass_id[1]),
                            'university_id' => trim($university_id[0]),
                            'university_text' => trim($university_id[1]),
                            'edu_gpax' => trim($value->edu_gpax),
                            'edu_faculty' => trim($value->edu_faculty),
                            'edu_major' => trim($value->edu_major),
                            'edu_degree' => trim($value->edu_degree),
                            
                            'edu_pass_idM' => trim($edu_pass_id_M[0]),                            
                            'edu_pass_textM' => trim($edu_pass_id_M[1]),                            
                            'university_idM' => trim($university_id_M[0]),
                            'university_textM' => trim($university_id_M[1]),
                            'edu_gpaxM' => trim($value->edu_gpaxm),
                            'edu_facultyM' => trim($value->edu_facultym),
                            'edu_majorM' => trim($value->edu_majorm),                            
                            'edu_degreeM' => trim($value->edu_degreem) 
                        ];
                    }
                }
            }
        }
        return response()->json($insert);
    }

    public function exportExcel($filname, $data) {

        return Excel::create($filname, function($excel) use ($data) {
                    $excel->sheet('mySheet', function($sheet) use ($data) {
                        $sheet->fromArray($data);
                    });
                })->download('xlsx');
    }

}
