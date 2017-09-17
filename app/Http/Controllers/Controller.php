<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Repositories\FileRepositoryImpl;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Excel;
use Illuminate\Support\Facades\Input;

class Controller extends BaseController {

    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests;

    protected $FileRepo;
    protected $excels;

    public function __construct(FileRepositoryImpl $FileRepo, Excel $excels) {

        $this->FileRepo = $FileRepo;
        $this->excels = $excels;
    }

    public function doDownloadFile(Request $request) {
        try {

            $data = $request->all();
            if (!array_key_exists('file_id', $data) || empty($data['file_id'])) {
                return;
            }

            $file = $this->FileRepo->getFileByGenName($data['file_id']);
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

        $thaiweek = ["วันอาทิตย์", "วันจันทร์", "วันอังคาร", "วันพุธ", "วันพฤหัส", "วันศุกร์", "วันเสาร์"];
        $thaimonth = ["มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"];

        $res = $thaiweek[date('N', strtotime($date))] . " ที่ " . date('j', strtotime($date)) . " " . $thaimonth[date('m', strtotime($date)) - 1] . " พ.ศ. " . (date('Y', strtotime($date)) + 543);

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
            $data = $this->excels->load($path, function($reader) {

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
                            'Admission_StatusID' => trim($Admission_Status[0])
                        ];
                    }
                }
            }
        }
        return response()->json($insert);
    }

    public function exportExcel($filname, $data) {

        $this->excels->create($filname, function($excel) use($data) {
            $excel->sheet('Sheet1', function($sheet) use($data) {
                $sheet->fromArray($data);
            });
        })->export('xls');


        return;
    }

}
