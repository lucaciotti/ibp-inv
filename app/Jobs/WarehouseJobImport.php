<?php

namespace App\Jobs;

use App\Imports\WarehousesImport;
use App\Models\WarehouseImportFile;
use Excel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Log;

class WarehouseJobImport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private WarehouseImportFile $importedfile;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($import_file_id)
    {
        Log::info('Import Warehouse FileExcelRow Job Created');
        $this->importedfile = WarehouseImportFile::find($import_file_id);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info('Import Warehouse FileExcelRow Job Started');
        $this->importedfile->status = 'Processing';
        $this->importedfile->save();
        Excel::import(new WarehousesImport($this->importedfile->id), storage_path('app/' . $this->importedfile->path));
    }
}
