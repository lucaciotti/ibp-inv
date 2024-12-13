<?php

namespace App\Http\Livewire\Inventory\Statsimple;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;
use App\Models\InventoryMeasurement;
use App\Models\InventorySimple;
use App\Models\Warehouse;
use Arr;
use Auth;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;
use Session;

class MeasureSimpleTable extends DataTableComponent
{
    protected $model = InventorySimple::class;

    public $invSession_id;

    public function mount()
    {
        $this->setFilter('active', 'yes');
    }

    public function builder(): Builder
    {
        $this->invSession_id = Session::get('inventory.session.id');
        $q = InventorySimple::query()
            ->where('inventory_session_id', $this->invSession_id);
        if (Auth::user()->roles()->first()->name=='user'){
            $q = $q->whereHas('audits', function($q){$q->where('event', 'created')->where('user_id', Auth::user()->id);});
        }
        return $q;
    }

    protected function getListeners()
    {
        return [
            'clearSelected' => 'clearSelected',
        ];
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setAdditionalSelects(['inventory_simples.id as id'])
            ->setPerPage(25)
            ->setPerPageAccepted([25, 50, 75, 100])
            ->setOfflineIndicatorEnabled()
            ->setFilterLayoutSlideDown()
            ->setHideBulkActionsWhenEmptyEnabled()
            ->setTdAttributes(function (Column $column, $row, $columnIndex, $rowIndex) {
                if ($column->getTitle() == '') {
                    return [
                        'default' => false,
                        // 'class' => 'w-5',
                        'style' => 'width:30%;'
                    ];
                }
                if ($column->getTitle() == 'Prodotto') {
                    return [
                        'class' => 'text-bold',
                    ];
                }
                if ($column->getTitle() == "Dt.Modifica") {
                    return [
                        'class' => 'text-bold btn',
                        'onclick' => "Livewire.emit('slide-over.open', 'audits.audits-slide-over', {'ormClass': '" . class_basename(get_class($row)) . "', 'ormId': " . $row->id . "});",
                    ];
                }
                return [];
            });
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Prodotto", "product.code")
                ->sortable()
                ->searchable(),
            Column::make("Descr. Prodotto", "product.description")
                ->sortable()
                ->searchable(),
            Column::make("Classe", "product.classe")
                ->sortable()
                ->searchable(),
            Column::make("Trattamento", "treatment.code")
                ->sortable()
                ->searchable(),
            Column::make("Ubicazione", "ubication.code")
                ->sortable()
                ->searchable(),
            Column::make("Magazzino", "warehouse.code")
                ->sortable()
                ->searchable(),
            Column::make("U.M.", "product.unit")
                ->sortable(),
            Column::make("Qta Inv.", "qty")
                ->sortable()
                ->searchable(),
            BooleanColumn::make('Valido', 'active')
                ->excludeFromColumnSelect(),
            Column::make("Dt.Modifica", "updated_at")
                ->format(
                    fn ($value, $row, Column $column) => '<span class="fa fa-history pr-1"></span>' . $value->format('d-m-Y')
                )->html()
                ->sortable(),
            Column::make("Caricato da")
                ->label(
                    fn ($row, Column $column) => $this->getAuditCreatedUser($row, $column)
                )
                ->sortable()
                ->searchable(),
        ];
    }

    public function getAuditCreatedUser($row, $column)
    {
        return $row->audits()->first()->user->name;
    }

    public function filters(): array
    {
        $magCollect = Warehouse::get()->toArray();
        $magCollectPluck = Arr::pluck($magCollect, 'description', 'id');
        $magList = ['' => 'Tutti'];
        foreach ($magCollectPluck as $key => $value) {
            $magList[$key] = $value;
        }
        return [
            TextFilter::make('Ubicazione', 'ubication')
            ->config([
                'placeholder' => 'Cerca Ubicazione',
            ])
            ->filter(function (Builder $builder, string $value) {
                $builder->where('ubication', 'like', '%' . $value . '%');
            }),

            SelectFilter::make('Magazzino', 'warehouse_id')
            ->options($magList)
            ->filter(function (Builder $builder, string $value) {
                $valueFilter = ($value != '') ? intval($value) : 0;
                if ($valueFilter>0){
                $builder->where('inventory_simples.warehouse_id', $valueFilter);
                } else {
                    $builder->where('inventory_simples.warehouse_id', '>', $valueFilter);
                }
            }),

            SelectFilter::make('Valido', 'active')
                ->options([
                    '' => 'Tutti',
                    'yes' => 'Si',
                    'no' => 'No',
                ])
                ->filter(function (Builder $builder, string $value) {
                    $valueFilter = ($value == 'yes') ? true : (($value == 'no') ? false : null);
                    $builder->where('active', $valueFilter);
                }),
        ];
    }

    public function bulkActions(): array
    {
        $actions = [];
        $actionsExport = [];
        if (Auth::user()->roles()->first()->name != 'user') {
            if (Auth::user()->roles()->first()->name == 'admin'){
                $actions = [
                    'deactiveRows' => 'Cancella Misurazione',
                    // 'deleteRows' => 'Cancella Riga da DB. ATTENZIONE!',
                ];
            } else {
                $actions = [
                    'deactiveRows' => 'Cancella Misurazione',
                ];
            }
            $actionsExport = [
                'hr1' => '---------------------------',
                'xlsExport' => 'Export Xls - Totale x Ubicazione',
                'xlsExportWarehous' => 'Export Xls - Totale x Magazzino',
                'csvExport' => 'Export CSV - Totale',
            ];
        }

        return array_merge($actions, $actionsExport);
    }

    public function deactiveRows()
    {
        foreach ($this->getSelected() as $id) {
            // $tasks = InventorySimple::find($id)->update(['qty' => 0]);
            $tasks = InventorySimple::find($id)->update(['active' => false]);
        }
    }

    public function deleteRows()
    {
        foreach ($this->getSelected() as $id) {
            // $tasks = InventorySimple::find($id)->update(['qty' => 0]);
            $tasks = InventorySimple::find($id)->delete();
        }
    }

    public function xlsExport()
    {
        Session::put('invsimple.xlsExport.inv_ids', $this->getSelected());
        return redirect()->route('exportxls_simple');
        // $this->emit('modal.open', 'xls-export.xls-export-modal', ['tasks_ids' => $this->getSelected(), 'type_id' => $this->type_id, 'configs' => $this->buildTasksConfig()]);
        // dd($this->getSelected());
    }

    public function xlsExportWarehous()
    {
        Session::put('invsimple.xlsExport.inv_ids', $this->getSelected());
        return redirect()->route('exportxls_warehouse_simple');
        // $this->emit('modal.open', 'xls-export.xls-export-modal', ['tasks_ids' => $this->getSelected(), 'type_id' => $this->type_id, 'configs' => $this->buildTasksConfig()]);
        // dd($this->getSelected());
    }

    public function csvExport()
    {
        Session::put('invsimple.xlsExport.inv_ids', $this->getSelected());
        return redirect()->route('exportcsv_simple');
        // $this->emit('modal.open', 'xls-export.xls-export-modal', ['tasks_ids' => $this->getSelected(), 'type_id' => $this->type_id, 'configs' => $this->buildTasksConfig()]);
        // dd($this->getSelected());
    }
}
