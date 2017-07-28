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

    public function WLog($message, $activity, $errorLog) {
        $log =  '|User:' . ((session('user_id') != null) ? session('email_address') : 'unknowUser' ). '|Activity:' . $activity . '|Message:' . $message;
        $ip = request()->ip();
        if ($errorLog == null || $errorLog == '') {
            Log::info($log . '|IP:' . $ip. PHP_EOL);
        } else {
            Log::error($log . '|Error Message:' . $errorLog . '|IP:' . $ip. PHP_EOL);
        }
    }

}
