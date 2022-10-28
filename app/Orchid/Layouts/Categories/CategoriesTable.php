<?php

namespace App\Orchid\Layouts\Categories;

use App\Models\Categories;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class CategoriesTable extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'categoriesPage';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('id', 'Id')->width('20px'),
            TD::make('alias', 'Алиас')->width('200px'),
            TD::make('name', 'Название')->width('250px'),
            TD::make('created_at', 'Дата создания')->defaultHidden()->width('150px'),
            TD::make('updated_at', 'Дата редактирования')->defaultHidden()->width('150px'),
            TD::make('Actions')
                ->render(function (Categories $categories) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([
                            ModalToggle::make('Редактировать')
                                ->modal('editRecord')
                                ->method('update')
                                ->icon('pencil')
                                ->modalTitle('Редактирование записи с id = ' . $categories->id)
                                ->asyncParameters([
                                    'record' => $categories->id
                                ]),
                            ModalToggle::make('Удалить')
                                ->modal('deleteRecord')

                                ->method('delete')
                                ->icon('trash')
                                ->modalTitle('Удалить запись с id = ' . $categories->id . '?')
                                ->asyncParameters([
                                    'record' => $categories->id
                                ])

                        ])->align(TD::ALIGN_CENTER);

                })->width('10px')->align(TD::ALIGN_CENTER)
        ];
    }
}
