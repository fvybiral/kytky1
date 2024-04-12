<?php

namespace App\Jobs;

use App\Models\Encyklopedie;
use App\Models\Kytka;
use App\Models\Nomenklatura;
use App\Models\Soubor;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\Attributes\WithoutRelations;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SparujSouborSEncyklopediiJob implements ShouldQueue
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
        $kytky = Kytka::where('souborid', $this->soubor->id)->get();

        foreach ($kytky as $kytka) {
            $encyklopedie = Encyklopedie::where('normalized_input', $kytka->normalized_input)->first();

            if (!$encyklopedie) {
                $encyklopedie = Encyklopedie::create([
                    'input' => $kytka->input,
                    'normalized_input' => $kytka->normalized_input,
                ]);

                $nomenklatura = Nomenklatura::where('normalized_name', $encyklopedie->normalized_input)->first();

                if ($nomenklatura) {
                    $encyklopedie->name = $nomenklatura->name;
                    $encyklopedie->save();
                }
            }

            $kytka->encyklopedieid = $encyklopedie->id;
            $kytka->save();
        }
        PrepocitejSouborJob::dispatch($this->soubor);
    }
}
