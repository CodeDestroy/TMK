<?php

namespace App\Orchid\Screens\ProductionTypes;

use App\Models\ProductionType;
use App\Orchid\Layouts\ProductionTypes\ProductionTypesTable;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Screen;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class ProductionTypesPage extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        $productiontype = new ProductionType();
        return [
            'productiontypesPage' => $productiontype->paginate(10)
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public $name = 'Типы продукции';

    public $description = 'Редактирование содержимого страницы с типами продукции';
    public function name(): ?string
    {
        return 'Типы продукции';
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
            ProductionTypesTable::class,
            Layout::modal('createRecord',
                Layout::rows([
                    Input::make('alias')
                        ->required()
                        ->title('Алиас'),
                    TextArea::make('type')
                        ->required()
                        ->title('Название')
                        ->rows(3)
                ]))
                ->title('Создать новую запись')
                ->applyButton('Создать')
                ->closeButton('Закрыть'),
            Layout::modal('editRecord',
                Layout::rows([
                    Input::make('record.alias')
                        ->required()
                        ->title('Алиас'),
                    TextArea::make('record.type')
                        ->required()
                        ->title('Название')
                        ->rows(3)
                ]))
                ->async('asyncGetRecord')
                ->closeButton('Закрыть')
                ->applyButton('Изменить'),
            Layout::modal('deleteRecord',
                Layout::rows([
                    Input::make('record.alias')->type('hidden')
                ]))
                ->async('asyncGetRecord')
                ->closeButton('Закрыть')
                ->applyButton('Удалить')
        ];
    }

    public function asyncGetRecord(ProductionType $productionType): array
    {
        return [
            'record' => $productionType,
        ];
    }

    public function update(Request $request)
    {
        //dd($request->record);
        ProductionType::where('alias', $request->input('record.alias'))->get()[0]->update($request->record);
        Toast::info('Данные успешно изменены!');
    }

    public function delete(Request $request)
    {
        ProductionType::where('alias', $request->input('record.alias'))->get()[0]->delete($request->record);
        Toast::info('Данные удалены!');
    }

    public function create(Request $request): void
    {
        $request->validate([
            'alias' => ['required'],
            'type' => ['required'],
        ]);
        $newType = new ProductionType;
        $newType->alias = $request->alias;
        $newType->type = $request->type;
        $newType->save();

        Toast::info('Запись успешно создана!');
    }
}
