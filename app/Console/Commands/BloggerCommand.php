<?php

namespace App\Console\Commands;

use App\Models\Blogs;
use Carbon\Carbon;
use Illuminate\Console\Command;

class BloggerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blogger:automation';

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
     * @return int
     */

     public function handle()
     {
         $blog = Blogs::where('status', '2')->latest()->get();
         foreach ($blog as $item) {
             fLogs('Artikel : '.$item->title, 'i');
             if(Carbon::parse($item->published_at)->isPast()){
                 $item->update([
                     'status' => 1
                 ]);
                 fLogs("\t=> update to publish", 's');
             }else{
                 fLogs("\t=> on schedule at ". Carbon::parse($item->published_at)->diffForHumans(), 'w');
             }
         }
         return true;
     }
}
