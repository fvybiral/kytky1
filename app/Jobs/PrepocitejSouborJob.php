<?php

namespace App\Jobs;

use App\Models\Soubor;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\Attributes\WithoutRelations;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use DB;

class PrepocitejSouborJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        #[WithoutRelations]
        public Soubor $soubor,
    ) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $total = DB::table('soubor')->where('id',$this->soubor->id)->count();
        $paired = DB::table('kytka')->where('souborid',$this->soubor->id)
            ->whereExists(function (Builder $query) {
                $query->select(DB::raw(1))
                    ->from('encyklopedie')
                    ->whereColumn('encyklopedie.id', 'kytka.encyklopedieid')
                    ->whereNotNull('name');
            });
        $this->soubor->progress = round($paired / $total * 100, 2);
        $this->soubor->save();
    }
}
