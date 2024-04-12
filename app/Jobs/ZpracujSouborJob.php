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
use \Str;
use \DB;

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
                    $kytka->input = $data[0];
                    $kytka->souborid = $this->soubor->id;
                    $normalize = $this->normalize($data[0]);
                    $kytka->normalized_input = $normalize;
                    $kytka->nomenklaturaid = DB::table('nomenklatura')
                        ->where('normalized_name', '=', $normalize)
                        ->value('id');
                    $kytka->save();
                }
            }
            fclose($handle);
        }
        $this->soubor->lines_count = $rows;
        $this->soubor->progress = 0;
        $this->soubor->state = 'IMPORTED';
        $this->soubor->save();

        $kytky = Kytka::where('souborid', $this->soubor->id)->whereNull('nomenklaturaid')->get();
        foreach ($kytky as $kytka) {
            $encyklopedie = Encyklopedie::where('normalized_input', $kytka->normalized_input)->first();
            if (!$encyklopedie) {
                $encyklopedie = Encyklopedie::create([
                    'input' => $kytka->input,
                    'normalized_input' => $kytka->normalized_input,
                ]);
            }
            $kytka->encyklopedieid = $encyklopedie->id;
            $kytka->save();
        }

        $this->soubor->state = 'PAIRED';
        $this->soubor->save();
    }

    /**
     * @param mixed $prepared
     * @return string
     */
    private function normalize(mixed $prepared): string
    {
        return collect(explode(' ', $prepared))
            ->map(function ($word) {
                if (in_array($word, ['×', '+', '×', 'x'])) {
                    return $word;
                }
                return trim(mb_strtolower(preg_replace('#\s+#',' ', $word)));
            })
            ->filter(function ($word) {
                return $word !== '' && $word !== ' ' && $word !== null;
            })
            ->join(' ');
    }
}
