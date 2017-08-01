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

class Controller extends BaseController {

    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests;

    protected $FileRepo;

    public function __construct(FileRepositoryImpl $FileRepo) {

        $this->FileRepo = $FileRepo;
    }

    public function doDownloadFile(Request $request) {
        try {

            $data = $request->all();
            if (!array_key_exists('file_id', $data) || empty($data['file_id'])) {
                return;
            }

            $file = $this->FileRepo->findOrFail($data['file_id']);
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
    
 

}
