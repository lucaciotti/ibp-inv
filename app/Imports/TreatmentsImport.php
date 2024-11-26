<?php

namespace App\Imports;

use App\Models\Treatment;
use App\Models\TreatmentImportFile;
use App\Models\User;
use App\Notifications\DefaultMessageNotify;
use Auth;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Collection;
use Log;
use Maatwebsite\Excel\Concerns\RemembersChunkOffset;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithColumnLimit;
use Notification;
use Str;

class TreatmentsImport implements ToCollection, WithStartRow, WithChunkReading, SkipsEmptyRows, WithCalculatedFormulas, WithMultipleSheets, SkipsOnError, WithColumnLimit
{
    protected $importedfile;
    protected $rowNum = 1;
    protected $rules = [];

    public function __construct($id)
    {
        $this->importedfile = TreatmentImportFile::find($id);
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $codTreat = $row[0];
            $descr = Str::upper($row[1]);
            $type = $row[2];

            $year = (new DateTime())->format('Y');

            try {
                $record = Treatment::where('code', $codTreat)->first();
                if (!$record) {
                    $record = Treatment::create([
                        'code' => $codTreat,
                        'description' => $descr,
                        'type' => $type
                    ]);
                } else {
                    $record->description = $descr;
                    $record->type = $type;
                    $record->save();
                }
            } catch (\Throwable $th) {
                report($th);
            }
            

            Log::info('Imported Treatment Code: '. $codTreat);
        }
    }

    public function onError(\Throwable $th)
    {
        report($th);
        #INVIO NOTIFICA
        $notifyUsers = User::whereHas('roles', fn ($query) => $query->where('name', 'admin'))->orWhere('id', $this->importedfile->userCreated()->id)->get();
        foreach ($notifyUsers as $user) {
            Notification::send(
                $user,
                new DefaultMessageNotify(
                    $title = 'File di Import - [' . $this->importedfile->filename . ']!',
                    $body = 'Errore: [' . $th->getMessage() . ']',
                    $link = '#',
                    $level = 'error'
                )
            );
        }
    }

    public function rules(): array
    {
        return $this->rules;
    }

    public function sheets(): array
    {
        return [
            0 => $this
        ];
    }

    public function batchSize(): int
    {
        return 500;
    }

    public function chunkSize(): int
    {
        return 500;
    }

    public function startRow(): int
    {
        return 2;
    }

    public function endColumn(): string
    {
        return 'AZ';
    }
}
