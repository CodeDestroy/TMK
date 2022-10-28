<?php

namespace App\Orchid\Layouts\ProductionTypes;

use App\Models\ProductionType;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class ProductionTypesTable extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'productiontypesPage';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('alias', 'Алиас')->width('250px'),
            TD::make('type', 'Название')->width('700px'),
            TD::make('created_at', 'Дата создания')->defaultHidden()->width('150px'),
            TD::make('updated_at', 'Дата редактирования')->defaultHidden()->width('150px'),
            TD::make('Actions')
                ->render(function (ProductionType $productionType) {
                    //dd($productionType->alias);
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([
                            ModalToggle::make('Редактировать')
                                ->modal('editRecord')
                                ->method('update')
                                ->icon('pencil')
                                ->modalTitle('Редактирование записи с id = ' . $productionType->alias)
                                ->asyncParameters([
                                    'record' => $productionType->alias
                                ]),
                            ModalToggle::make('Удалить')
                                ->modal('deleteRecord')

                                ->method('delete')
                                ->icon('trash')
                                ->modalTitle('Удалить запись с id = ' . $productionType->alias . '?')
                                ->asyncParameters([
                                    'record' => $productionType->alias
                                ])

                        ])->align(TD::ALIGN_CENTER);

                })->width('10px')->align(TD::ALIGN_CENTER)
        ];
    }
}
