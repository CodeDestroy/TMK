<?php

namespace App\Orchid\Layouts\Main;

use App\Models\Main;
use http\Env\Request;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

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
            TD::make('action')->render(function (Main $main){
                return ModalToggle::make('Редактировать')
                    ->modal('editRecord')
                    ->method('update')
                    ->modalTitle('Редактирование записи id=' . $main->id)
                    ->asyncParameters([
                        'record' => $main->id
                    ]);
            })->width('50px')
        ];
    }
}
