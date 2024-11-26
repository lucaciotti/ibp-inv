<?php

namespace App\Http\Livewire\Sys\User;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\User;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class UserTable extends DataTableComponent
{
    protected $model = User::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id')->setPerPage(25)
            ->setPerPageAccepted([25, 50, 75, 100])
            ->setTdAttributes(function (Column $column, $row, $columnIndex, $rowIndex) {
                if ($column->getTitle()== "Nome") {
                    return [
                        'class' => 'text-bold btn',
                        'onclick' => "Livewire.emit('modal.open', 'sys.user.user-modal-edit', {'user_id': " . $row->id . "});",
                    ];
                }
                if ($column->getTitle() == '') {
                    return [
                        'default' => false,
                        'style' => 'width:20%;'
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
            Column::make("#", "id")
                ->sortable(),
            Column::make("Nome", "name")
                ->sortable(),
            Column::make("Email", "email")
                ->sortable(),
            Column::make("Ruolo")
                ->label(
                    fn ($row, Column $column) => $this->getRoleUser($row, $column)
                ),
            Column::make("Dt.Modifica", "updated_at")
                ->format(
                    fn ($value, $row, Column $column) => '<span class="fa fa-history pr-1"></span>' . $value->format('d-m-Y')
                )->html()
                ->sortable(),

            ButtonGroupColumn::make('')
                ->buttons([
                    LinkColumn::make('Reset Password')
                        ->title(fn ($row) => '<span class="fa fa-key pr-1"></span>Reset Password')
                        ->location(fn ($row) => 'resetPassword/'.$row->id)
                        ->attributes(function ($row) {
                            return [
                                'class' => 'btn btn-success btn-xs mr-2 ',
                                // 'onclick' => "Livewire.emit('modal.open', 'plan-type.plan-type-modal-edit', {'id': " . $row->id . "});"
                            ];
                        }),
                    LinkColumn::make('Act Like')
                        ->title(fn ($row) => '<span class="fa fa-ghost pr-1"></span>Act As')
                        ->location(fn ($row) => 'actLike/' . $row->id )
                        ->attributes(function ($row) {
                            return [
                                'class' => 'btn btn-warning btn-xs mr-2 text-bold',
                                'style' => 'opacity: 75%'
                            ];
                        }),
                ]),
        ];
    }

    public function getRoleUser($row, $column)
    {
        return $row->roles->first()->display_name ?? '';
    }
}
