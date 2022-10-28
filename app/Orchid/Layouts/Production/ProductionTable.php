<?php

namespace App\Orchid\Layouts\Production;

use App\Models\Production;
use App\Models\ProductionType;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class ProductionTable extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'productionPage';

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
            TD::make('img_path', 'Картинка')->width('400px')->render(function (Production $production){
                return "<img src=$production->img_path width='400'>";
            }),
            TD::make('production_type_id', 'Тип продукции')->render(function (Production $production){

                return ProductionType::where('alias', $production->production_type_id)->get()[0]->type;
            }),
            TD::make('created_at', 'Дата создания')->defaultHidden()->width('150px'),
            TD::make('updated_at', 'Дата редактирования')->defaultHidden()->width('150px'),
            TD::make('Actions')
                ->render(function (Production $production) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([
                            ModalToggle::make('Редактировать')
                                ->modal('editRecord')
                                ->method('update')
                                ->icon('pencil')
                                ->modalTitle('Редактирование записи с id = ' . $production->id)
                                ->asyncParameters([
                                    'record' => $production->id
                                ]),
                            ModalToggle::make('Удалить')
                                ->modal('deleteRecord')

                                ->method('delete')
                                ->icon('trash')
                                ->modalTitle('Удалить запись с id = ' . $production->id . '?')
                                ->asyncParameters([
                                    'record' => $production->id
                                ])

                        ])->align(TD::ALIGN_CENTER);

                })->width('10px')->align(TD::ALIGN_CENTER)
        ];
    }
}
