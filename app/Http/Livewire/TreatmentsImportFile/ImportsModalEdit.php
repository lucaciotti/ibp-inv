<?php

namespace App\Http\Livewire\TreatmentsImportFile;

use App\Jobs\TreatmentsJobImport;
use App\Models\TreatmentImportFile;
use App\Notifications\DefaultMessageNotify;
use Auth;
use DateTime;
use Livewire\Component;
use Livewire\WithFileUploads;
use Notification;
use WireElements\Pro\Components\Modal\Modal;
use WireElements\Pro\Concerns\InteractsWithConfirmationModal;

class ImportsModalEdit extends Modal
{
    use WithFileUploads;
    use InteractsWithConfirmationModal;

    public $title = 'Import Trattamenti dei Prodotti da XLS';

    public $file;
    public $file_extension;
    public $path = '';
    public $filename = '';
    public $file_placeolder = 'Carica file excel...';


    protected $rules = [
        'file' => 'required',
        'file_extension' => 'required|in:xlsx,xls',
        'filename' => 'required',
    ];

    public function render()
    {
        return view('livewire.treatments-import-file.imports-modal-edit');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedFile()
    {
        // dd($this->file->getClientOriginalName());
        $this->file_extension = strtolower($this->file->getClientOriginalExtension());
        $this->filename = $this->file->getClientOriginalName();
        $this->validate();
        if ($this->file) {
            $this->file_placeolder = $this->file->getClientOriginalName();
        } else {
            $this->file_placeolder = 'Carica file excel...';
        }
    }

    public function save()
    {
        $validatedData = $this->validate();
        $this->path = $this->file->store('warehouse_import_file');
        $extradata = [
            'status' => 'File Caricato',
            'path' => $this->path,
            'date_upload' => new DateTime()
        ];
        $importFile = TreatmentImportFile::create(array_merge($validatedData, $extradata));

        //TODO Avvia JOb
        TreatmentsJobImport::dispatch($importFile->id)->onQueue('importFiles');

        Notification::send(Auth::user(), new DefaultMessageNotify(
            $title = 'Import Trattamenti/Prodotti',
            $body = 'Avviato processo di Importazione da file ' . $validatedData['filename'],
            $link = '#',
            $level = 'info'
        ));

        $this->close(
            andEmit: [
                'refreshDatatable'
            ]
        );
    }
}
