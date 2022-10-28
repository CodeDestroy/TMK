<?php

namespace App\Orchid\Screens\Categories;

use App\Models\Categories;
use App\Models\SubCategories;
use App\Orchid\Layouts\Categories\SubCategoriesTable;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\SimpleMDE;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class SubCategoriesPage extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        $subCategory = new SubCategories();
        return [
            'subcategoriesPage' => $subCategory->paginate(10)
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */

    public $name = 'Разделы в категориях';

    public $description = 'Редактирование содержимого страницы с разделами';
    public function name(): ?string
    {
        return 'Разделы в категориях';
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
            SubCategoriesTable::class,
            Layout::modal('createRecord', Layout::rows([
                Input::make('alias')->required()->title('Алиас'),
                Input::make('name')->required()->title('Заголовок/Имя'),
                SimpleMDE::make('text')->required()->title('Содержание'),
                Select::make('parent_id')
                    ->fromModel(Categories::class, 'name')->required()
            ]))->title('Создать новую запись')->applyButton('Создать')->closeButton('Закрыть'),
            Layout::modal('editRecord',
                Layout::rows([
                    Input::make('record.id')->type('hidden'),
                    Input::make('record.alias')->required()->title('Алиас'),
                    Input::make('record.name')->required()->title('Заголовок/Имя'),
                    Quill::make('record.text')->title('Содержание')
                        ->toolbar(["text", "color", "header", "list", "format", "media"]),
                    Select::make('record.parent_id')
                        ->fromModel(Categories::class, 'name')->required()
                ]))->async('asyncGetRecord')->closeButton('Закрыть')->applyButton('Изменить'),
            Layout::modal('deleteRecord', Layout::rows([
                Input::make('record.id')->type('hidden')
            ]))->async('asyncGetRecord')->closeButton('Закрыть')->applyButton('Удалить')
        ];
    }

    public function asyncGetRecord(SubCategories $subCategory): array
    {
        return [
            'record' => $subCategory
        ];
    }

    public function update(Request $request)
    {
//        dd(Production::find($request->input('record.id')));
        SubCategories::find($request->input('record.id'))->update($request->record);
        Toast::info('Данные успешно изменены!');
    }

    public function delete(Request $request)
    {
        SubCategories::find($request->input('record.id'))->delete($request->record);
        Toast::info('Данные удалены!');
    }

    public function create(Request $request): void
    {
        $request->validate([
            'alias' => ['required'],
            'name' => ['required'],
            'text' => ['required'],
            'parent_id' => ['required']
        ]);

        SubCategories::create(['alias' => $request->alias, 'name' => $request->name, 'text'=>$request->text , 'parent_id'=>$request->parent_id]);
        Toast::info('Запись успешно создана!');
    }
}
