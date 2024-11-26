<?php

namespace App\Http\Livewire\Inventory\Sessions;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\InventorySession;
use Laratrust;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class InvSessionsTable extends DataTableComponent
{
    protected $model = InventorySession::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setAdditionalSelects(['inventory_sessions.id as id'])
            ->setPerPage(25)
            ->setPerPageAccepted([25, 50, 75, 100])
            ->setTdAttributes(function (Column $column, $row, $columnIndex, $rowIndex) {
                if ($column->getTitle() == '') {
                    return [
                        'default' => false,
                        // 'class' => 'w-5',
                        'style' => 'width:30%;'
                    ];
                }
                if ($column->getTitle() == 'Descrizione') {
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
                            'onclick' => "Livewire.emit('modal.open', 'inventory.sessions.inv-session-modal-edit', {'id': " . $row->id . "});"
                        ];
                    }),
            );
        }

        $columns = [
            // Column::make("#", "id")
            //     ->sortable(),
            Column::make("Anno", "year")
                ->sortable()
                ->searchable(),
            Column::make("Mese", "month")
                ->sortable()
                ->searchable(),
                Column::make("Descrizione", "description")
                ->sortable()
                ->searchable(),
            Column::make("Data Inizio", "date_start")
                ->sortable()
                ->searchable(),
            Column::make("Data Fine", "date_end")
                ->sortable()
                ->searchable(),
            Column::make("Dt.Modifica", "updated_at")
            ->format(
                fn ($value, $row, Column $column) => '<span class="fa fa-history pr-1"></span>' . $value->format('d-m-Y')
            )->html()
                ->sortable(),
            ButtonGroupColumn::make('')
                ->buttons($actionColumns),

            // Column::make("Updated at", "updated_at")
            //     ->sortable(),
        ];
        return $columns;
    }
}
