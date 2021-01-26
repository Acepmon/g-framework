<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use App\ContentMeta;
use App\Content;

class CronPremium extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:removepremium';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        /*
        $premiums=ContentMeta::where('key','=','publishVerifiedEnd')->where('value', '<', Carbon::now())
            ->get();
        if(count($premiums)>0){
            foreach ($premiums as $data){
                $update = ContentMeta::where('key','=','publishVerified')->where('content_id', '=', $data->content_id)->firstOrFail();
                $update->value=0;
                $update->save();
                $content = Content::find($data->content_id);
                $content->order = 1;
                $content->save();
                $delete = ContentMeta::find($data->id);
                $delete->delete();
            }
        }
        */
        $premiums = Content::where('order','>','1')->get();
        $now = Carbon::now();
        if (count($premiums)>0) {
            foreach ($premiums as $content){
                $verifiedEnd = ContentMeta::where('key','=','publishVerifiedEnd')->where('content_id', '=', $content->id)->first();
                if ($verifiedEnd == Null || $verifiedEnd->value < $now) {
                    if ($verifiedEnd != Null) {
                        $verifiedEnd->delete();
                    }
                    $content->updateMeta('publishType', 'free');
                    $content->updateMeta('publishVerified', '0');
                    $content->order = 1;
                    $content->save();
                }
            }
        }
    }
}
