<?php

namespace App\Jobs;

use App\Models\invoicing\Invoice;
use App\Models\LiaisonAnapath;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessAnapath implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
   public $invoice;
   public $hospitalisation;
    /**
     * Create a new job instance.
     */
    public function __construct($invoice=null,$hospitalisation=null)
    {
        $this->invoice = $invoice;
        $this->hospitalisation = $hospitalisation;

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $invoice = Invoice::find($this->invoice);
        if ($this->invoice){
            foreach ($invoice->items()->get() as $item) {
                if ($item->service && $item->service->service_category_id == 10 && $item->service->anapath_id) {
                    $item_srv = $item->service;
                    $gender =$invoice->patient->gender_id;
                    if ($gender==1)
                        $gender='M';
                    elseif ($gender==2)
                        $gender='F';
                    LiaisonAnapath::create([
                        'IDPATIENT' => $invoice->patient->id,
                        'IDRECU' => $invoice->id,
                        'IDACTE' => $item_srv->anapath_id,
                        'NOM' => $invoice->patient->first_name,
                        'PRENOM' => $invoice->patient->last_name,
                        'DATE' => now(),
                        'MONTANT' => $item->total,
                        'DATENAISSANCE' => now(),
                        'ETAT' => 0,
                        'SEXE' => $gender,
                        'NUM_RECU' => $invoice->id,
                    ]);
                }
            }
        }
        if ($this->hospitalisation){

            $gender =$this->hospitalisation->hospitalisation->patient->gender_id;
            if ($gender==1)
                $gender='M';
            elseif ($gender==2)
                $gender='F';
            LiaisonAnapath::create([
                'IDPATIENT' => $this->hospitalisation->hospitalisation->patient->id,
                'IDRECU' => $this->hospitalisation->hospitalisation->id,
                'IDACTE' => $this->hospitalisation->service->anapath_id,
                'NOM' => $this->hospitalisation->hospitalisation->patient->first_name,
                'PRENOM' => $this->hospitalisation->hospitalisation->patient->last_name,
                'DATE' => now(),
                'MONTANT' => $this->hospitalisation->total,
                'DATENAISSANCE' => now(),
                'ETAT' => 0,
                'SEXE' => $gender,
                'NUM_RECU' =>  $this->hospitalisation->hospitalisation->id,
            ]);
        }


    }
}
