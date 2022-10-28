<?php

namespace App\Orchid\Screens\Categories;

use App\Models\Categories;
use App\Orchid\Layouts\Categories\CategoriesTable;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class CategoriesPage extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        $categories = new Categories();
        return [
            'categoriesPage' => $categories->paginate(10)
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */

    public $name = 'Категории в футере';

    public $description = 'Редактирование содержимого страницы с Категориями';

    public function name(): ?string
    {
        return 'Категории в футере';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            ModalToggle::make('Создать новую запись')->modal('createRecord')->method('create'),
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            CategoriesTable::class,
            Layout::modal('createRecord', Layout::rows([
                Input::make('alias')->required()->title('Алиас'),
                TextArea::make('name')->required()->title('Описание')->rows(3),
            ]))->title('Создать новую запись')->applyButton('Создать')->closeButton('Закрыть'),
            Layout::modal('editRecord',
                Layout::rows([
                    Input::make('record.id')->type('hidden'),
                    Input::make('record.alias')->required()->title('Алиас'),
                    TextArea::make('record.name')->required()->title('Описание')->rows(3),
                ]))->async('asyncGetRecord')->closeButton('Закрыть')->applyButton('Изменить'),
            Layout::modal('deleteRecord', Layout::rows([
                Input::make('record.id')->type('hidden')
            ]))->async('asyncGetRecord')->closeButton('Закрыть')->applyButton('Удалить')
        ];
    }

    public function asyncGetRecord(Categories $categories): array
    {
        return [
            'record' => $categories
        ];
    }

    public function update(Request $request)
    {
//        dd(Production::find($request->input('record.id')));
        Categories::find($request->input('record.id'))->update($request->record);
        Toast::info('Данные успешно изменены!');
    }

    public function delete(Request $request)
    {
        Categories::find($request->input('record.id'))->delete($request->record);
        Toast::info('Данные удалены!');
    }

    public function create(Request $request): void
    {
        $request->validate([
            'alias' => ['required'],
            'name' => ['required'],

        ]);

        Categories::create(['alias' => $request->alias, 'name' => $request->name]);
        Toast::info('Запись успешно создана!');
    }

}
