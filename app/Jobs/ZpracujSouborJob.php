<?php

namespace App\Jobs;

use App\Models\Kytka;
use App\Models\Soubor;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\Attributes\WithoutRelations;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use \Str;

class ZpracujSouborJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        #[WithoutRelations]
        public Soubor $soubor,
    )
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->upload();
    }

    /**
     * @return void
     */
    private function upload(): void
    {
        $skipHeader = true;
        $rows = 0;
        $filename = storage_path('app/' . $this->soubor->storage_path);
        if (($handle = fopen($filename, "r")) !== false) {
            while (($data = fgetcsv($handle, 1000, ";")) !== false) {
                if ($skipHeader) {
                    $skipHeader = false;
                    continue;
                }
                if (!empty($data)) {
                    $rows++;
                    $kytka = new Kytka();
                    $kytka->souborid = $this->soubor->id;
                    $kytka->input = $data[0];
                    $prepared = $data[0];
//                    $prepared = str_replace("#×#", ' x ', $data[0]);
//                    $prepared = preg_replace("#[\s\.\-\:]+#", ' ', $prepared);
                    $kytka->normalized_input = collect(explode(' ', $prepared))
                        ->map(function ($word) {
                            if (in_array($word,['×','+','×','x'])) {
                                return $word;
                            }
                            return trim(mb_strtolower(Str::ascii($word)));
                        })
                        ->filter(function ($word) {
                            return $word !== '' && $word !== ' ' && $word !== null;
                        })
//                        ->sort()
                        ->join('-');
                    $kytka->match_score = null;
                    $kytka->save();
                }
            }
            fclose($handle);
        }
        $this->soubor->lines_count = $rows;
        $this->soubor->progress = 0;
        $this->soubor->state = 'IMPORTED';
        $this->soubor->save();

        SparujSouborSEncyklopediiJob::dispatch($this->soubor);
    }
}
