<?php

namespace App\Orchid\Screens\Production;



use App\Models\ProductionType;
use App\Orchid\Layouts\Production\ProductionTable;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use App\Models\Production;

use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class ProductionPage extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        $production = new Production();
        return [
            'productionPage' => $production->paginate(10)
        ];
    }

    public $name = 'Продукция';

    public $description = 'Редактирование содержимого страницы с продукцией';
    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Продукция';
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
            ProductionTable::class,
            Layout::modal('createRecord', Layout::rows([
                Input::make('header')->required()->title('Заголовок'),
                TextArea::make('description')->required()->title('Описание')->rows(15),
                Cropper::make('img_path')
                    ->title('Large web banner image, generally in the front and center')
                    ->width(1000)
                    ->height(500)->targetRelativeUrl(),
                Select::make('production_type_id')
                    ->fromModel(ProductionType::class, 'type', 'alias')->required()
            ]))->title('Создать новую запись')->applyButton('Создать')->closeButton('Закрыть'),
            Layout::modal('editRecord',
                Layout::rows([
                    Input::make('record.id')->type('hidden'),
                    Input::make('record.header')->required()->title('Заголовок'),
                    TextArea::make('record.description')
                        ->required()
                        ->title("Текст")->rows(15),
                    Cropper::make('record.img_path')
                        ->title('Large web banner image, generally in the front and center')
                        ->width(1000)
                        ->height(500)->targetRelativeUrl(),
                    Select::make('record.production_type_id')
                        ->fromModel(ProductionType::class, 'type', 'alias')
                        ->required()
                ]))->async('asyncGetRecord')->closeButton('Закрыть')->applyButton('Изменить'),
            Layout::modal('deleteRecord', Layout::rows([
                Input::make('record.id')->type('hidden')
            ]))->async('asyncGetRecord')->closeButton('Закрыть')->applyButton('Удалить')
        ];
    }

    public function asyncGetRecord(Production $production): array
    {
        return [
            'record' => $production
        ];
    }

    public function update(Request $request)
    {
//        dd(Production::find($request->input('record.id')));
        Production::find($request->input('record.id'))->update($request->record);
        Toast::info('Данные успешно изменены!');
    }

    public function delete(Request $request)
    {
        Production::find($request->input('record.id'))->delete($request->record);
        Toast::info('Данные удалены!');
    }

    public function create(Request $request): void
    {
        $request->validate([
            'header' => ['required'],
            'description' => ['required'],
            'img_path' => ['required'],
            'production_type_id' => ['required']
        ]);

        Production::create(['header' => $request->header, 'description' => $request->description, 'img_path'=>$request->img_path , 'production_type_id'=>$request->production_type_id]);
        Toast::info('Запись успешно создана!');
    }

}
