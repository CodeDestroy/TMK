<?php

namespace App\Orchid\Layouts\Partners;

use App\Models\Partners;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\ModalToggle;

class PartnersTable extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'partnersPage';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('id', 'Id')->width('20px'),
            TD::make('header', 'Заголовок')->width('700px'),
            TD::make('description', 'Описание')->width('700px'),
            TD::make('img_path', 'Картинка')->width('400px'),
            TD::make('img_logo_path', 'Баннер')->width('400px'),
            TD::make('show_on_main', 'Показывать баннер')->width('150px'),
            TD::make('created_at', 'Дата создания')->defaultHidden()->width('150px'),
            TD::make('updated_at', 'Дата редактирования')->defaultHidden()->width('150px'),
            TD::make('Actions')
                ->render(function (Partners $partners) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([
                            ModalToggle::make('Редактировать')
                                ->modal('editRecord')
                                ->method('update')
                                ->icon('pencil')
                                ->modalTitle('Редактирование записи с id = ' . $partners->id)
                                ->asyncParameters([
                                    'record' => $partners->id
                                ]),
                            ModalToggle::make('Удалить')
                                ->modal('deleteRecord')

                                ->method('delete')
                                ->icon('trash')
                                ->modalTitle('Удалить запись с id = ' . $partners->id . '?')
                                ->asyncParameters([
                                    'record' => $partners->id
                                ])
                        ]);

                })->width('10px')->align(TD::ALIGN_CENTER)
        ];
    }
}
