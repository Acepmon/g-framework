<?php

namespace App\Http\Controllers\Admin;

use Storage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Backup;
use DB;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Validator;
use Spatie\Backup\BackupDestination\BackupDestination;

class BackupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $backups = Backup::all();
        return view('admin.backups.index', ['backups' => $backups]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.backups.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
//    public function createDbBackup()
//    {
//        echo "wwww";
//        //return view('admin.backups.create');
//    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $validatedData = $request->validate([
             'title' => 'required|max:191'
         ]);

        $backups = new Backup;
        $backups->title = $request->title;
        $backups->description = $request->description;
        $backups->status = Backup::IN_PROGRESS;
        $backups->save();
        $type = 'database';
        $id = $backups->id;
        $datetime = \Carbon\Carbon::parse($backups->created_at)->format('Y-m-d-H-i-s');

        $filename = $type . '-' . $id . '-' . $datetime  . '.zip';
        $backups->filename = "backup-".$filename;
        $backups->save();

        Artisan::call('backup:run', [
            '--only-db' => 1,
            '--filename' => $filename,
        ]);

        //dd(Artisan::output());

        return redirect()->route('admin.backups.index')->with('status', 'Backup created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $backups = Backup::findOrFail($id);
        return view('admin.backups.show', ['backup' => $backups]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $backups = Backup::findOrFail($id);
        return view('admin.backups.edit', ['backup' => $backups]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:191'
        ]);

        $backups = Backup::findOrFail($id);
        $backups->title = $request->title;
        $backups->description = $request->description;

        $backups->status = Backup::COMPLETED;
        $backups->save();
        return redirect()->route('admin.backups.index')->with('status', 'Backup edited');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function databaseRestore(Request $request, Backup $backup)
    {
        $backups = Backup::findOrFail($request->id);
        $backupPath = storage_path('app\sss');
//        /echo $backupPath;
        $pathZip = $backupPath . DIRECTORY_SEPARATOR . $backups->filename;

        $ret = $this->extract($pathZip, $backups->filename, $backups->id, $backupPath);
        //$backups->save();
        return $ret;
    }

    public function extract($pathZip, $filename, $id, $backupPath)
    {
        ini_set('max_execution_time', 3000);
        \Zipper::make($pathZip)->extractTo($backupPath);
        DB::unprepared(file_get_contents($backupPath .DIRECTORY_SEPARATOR. "db-dumps". DIRECTORY_SEPARATOR ."mysql-gframe.sql"));
        $backups = Backup::findOrFail($id);
        $backups->status = Backup::RESTORED;
        $backups->save();
        //Storage::disk('themes')->deleteDirectory("db-dumps");
        //Storage::local('app')->deleteDirectory("sss/db-dumps");
        return response()->json(['status' => 'Success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $backups = Backup::findOrFail($id);
        Storage::disk('themes')->deleteDirectory("db-dumps");
        $backups->delete();
        return redirect()->route('admin.backups.index')->with('status', 'Backup deleted');

//        if ($backups->type == Backup::TYPE_SYSTEM) {
//            return redirect()->route('admin.backups.index')->with('status', 'System backup cannot be deleted!');
//        } else {
//            $backups->delete();
//            return redirect()->route('admin.backups.index')->with('status', 'Backup deleted');
//        }
    }
}
