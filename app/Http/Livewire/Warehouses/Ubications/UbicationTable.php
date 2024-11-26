<?php

namespace App\Http\Livewire\Warehouses\Ubications;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Ubication;
use Illuminate\Database\Eloquent\Builder;
use Laratrust;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class UbicationTable extends DataTableComponent
{
    protected $model = Ubication::class;
    protected $warehouse_id;

    public function mount($warehouse_id)
    {
        $this->warehouse_id = intval($warehouse_id);
    }

    public function builder(): Builder
    {
        return Ubication::query()
            ->where('warehouse_id', $this->warehouse_id);
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setAdditionalSelects(['ubications.id as id'])
            ->setPerPage(25)
            ->setPerPageAccepted([25, 50, 75, 100])
            ->setTdAttributes(function (Column $column, $row, $columnIndex, $rowIndex) {
                if ($column->getTitle() == '') {
                    return [
                        'default' => false,
                        'style' => 'width:30%;'
                    ];
                }
                if ($column->getTitle() == 'Codice') {
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
        $actionColumns = [];
        if (Laratrust::isAbleTo('config-update')) {
            array_push(
                $actionColumns,
                LinkColumn::make('Modifica')
                ->title(fn ($row) => '<span class="fa fa-edit pr-1"></span>Modifica')
                ->location(fn ($row) => '#')
                    ->attributes(function ($row) {
                        return [
                            'class' => 'btn btn-default btn-xs mr-2 ',
                            'onclick' => "Livewire.emit('modal.open', 'warehouses.ubications.ubication-modal-edit', {'id': " . $row->id . ", 'warehouse_id': ".$this->warehouse_id."});"
                        ];
                    }),
            );
        }

        return [
            Column::make("Codice", "code")
                ->sortable(),
            Column::make("Descrizione", "description")
                ->sortable(),
            Column::make("Magazzino", "warehouse.code")
                ->sortable(),
            Column::make("Dt.Modifica", "updated_at")
            ->format(
                fn ($value, $row, Column $column) => '<span class="fa fa-history pr-1"></span>' . $value->format('d-m-Y')
            )->html()
                ->sortable(),
            ButtonGroupColumn::make('')
                ->buttons($actionColumns),
        ];
    }
}
