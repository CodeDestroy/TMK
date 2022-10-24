<?php

namespace App\Orchid\Layouts\Main;

use App\Models\Main;

use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;
class MainTable extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'mainPage';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('id', 'Id')->width('20px'),
            TD::make('mainPageDescription', 'Текст')->width('700px'),
            TD::make('created_at', 'Дата создания')->defaultHidden()->width('150px'),
            TD::make('updated_at', 'Дата редактирования')->defaultHidden()->width('150px'),
                TD::make('Actions')
                ->render(function (Main $main) {
                    return DropDown::make()
                            ->icon('options-vertical')
                            ->list([
                                ModalToggle::make('Редактировать')
                                    ->modal('editRecord')
                                    ->method('update')
                                    ->icon('pencil')
                                    ->modalTitle('Редактирование записи с id = ' . $main->id)
                                    ->asyncParameters([
                                        'record' => $main->id
                                    ]),
                                ModalToggle::make('Удалить')
                                    ->modal('deleteRecord')

                                    ->method('delete')
                                    ->icon('trash')
                                    ->modalTitle('Удалить запись с id = ' . $main->id . '?')
                                    ->asyncParameters([
                                        'record' => $main->id
                                    ])

                        ])->align(TD::ALIGN_CENTER);

                })->width('10px')->align(TD::ALIGN_CENTER)
        ];
    }
}
