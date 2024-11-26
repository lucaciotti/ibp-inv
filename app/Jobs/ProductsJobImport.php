<?php

namespace App\Jobs;

use App\Imports\ProductsImport;
use App\Models\ProductImportFile;
use Excel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Log;

class ProductsJobImport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private ProductImportFile $importedfile;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($import_file_id)
    {
        Log::info('Import Product FileExcelRow Job Created');
        $this->importedfile = ProductImportFile::find($import_file_id);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info('Import Product FileExcelRow Job Started');
        $this->importedfile->status = 'Processing';
        $this->importedfile->save();
        Excel::import(new ProductsImport($this->importedfile->id), storage_path('app/' . $this->importedfile->path));
    }
}
