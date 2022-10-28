<?php

namespace App\Orchid\Layouts\Submits;

use App\Models\Submit;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Illuminate\Http\Request;
class SubmitsTable extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'submitsPage';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('id', 'Id')->width('20px')->sort(),
            TD::make('name', 'Имя')->width('180px')->filter(TD::FILTER_TEXT)->sort(),
            TD::make('email', 'E-mail')->width('250px')->filter(TD::FILTER_TEXT)->sort(),
            TD::make('phone', 'Телефон')->width('200px')->filter(TD::FILTER_TEXT)->sort(),
            TD::make('description', 'Заметки')->width('600px')->filter(TD::FILTER_TEXT)->sort(),
            TD::make('checked', 'Обработана')->width('150px')->filter(TD::FILTER_TEXT)->sort()->render(function (Submit $submit){
                return $submit->checked === '1' ? 'Обработана' : 'Не обработана';
            }),
            TD::make('created_at', 'Дата создания')->width('150px')->filter(TD::FILTER_TEXT)->sort(),
            TD::make('updated_at', 'Дата редактирования')->defaultHidden()->width('150px'),
            TD::make('Actions')
                ->render(function (Submit $submit) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([
                            ModalToggle::make('Редактировать')
                                ->modal('editRecord')
                                ->method('update')
                                ->icon('pencil')
                                ->modalTitle('Редактирование записи с id = ' . $submit->id)
                                ->asyncParameters([
                                    'record' => $submit->id
                                ]),
                            ModalToggle::make('Удалить')
                                ->modal('deleteRecord')

                                ->method('delete')
                                ->icon('trash')
                                ->modalTitle('Удалить запись с id = ' . $submit->id . '?')
                                ->asyncParameters([
                                    'record' => $submit->id
                                ])

                        ]);

                })->width('10px')->align(TD::ALIGN_CENTER)
        ];
    }
}
