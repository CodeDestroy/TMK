<?php

namespace App\Orchid\Screens\Services;



use App\Orchid\Layouts\Services\ServicesTable;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use App\Models\Service;

use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class ServicesPage extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        $service = new Service();
        return [
            'servicesPage' => $service->paginate(10)
        ];
    }
    public $name = 'Услуги';

    public $description = 'Редактирование содержимого страницы с услугами';
    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Услуги';
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
            ServicesTable::class,
            Layout::modal('createRecord', Layout::rows([
                Input::make('header')->required()->title('Заголовок'),
                TextArea::make('description')->required()->title('Описание')->rows(15),
                Cropper::make('img_path')
                    ->title('Large web banner image, generally in the front and center')
                    ->width(1000)
                    ->height(500)->targetRelativeUrl(),
            ]))->title('Создать новую запись')->applyButton('Создать')->closeButton('Закрыть'),
            Layout::modal('editRecord', Layout::rows([
                Input::make('record.id')->type('hidden'),
                Input::make('record.header')->required()->title('Заголовок'),
                TextArea::make('record.description')->required()->title("Текст")->rows(15),
                Cropper::make('record.img_path')
                    ->title('Large web banner image, generally in the front and center')
                    ->width(1000)
                    ->height(500)->targetRelativeUrl(),
            ]))->async('asyncGetRecord')->closeButton('Закрыть')->applyButton('Изменить'),
            Layout::modal('deleteRecord', Layout::rows([
                Input::make('record.id')->type('hidden')
            ]))->async('asyncGetRecord')->closeButton('Закрыть')->applyButton('Удалить')
        ];
    }

    public function asyncGetRecord(Service $service): array
    {
        return [
            'record' => $service
        ];
    }

    public function update(Request $request)
    {
        Service::find($request->input('record.id'))->update($request->record);
        Toast::info('Данные успешно изменены!');
    }

    public function delete(Request $request)
    {
        Service::find($request->input('record.id'))->delete($request->record);
        Toast::info('Данные удалены!');
    }

    public function create(Request $request): void
    {
        $request->validate([
            'header' => ['required'],
            'description' => ['required'],
            'img_path' => ['required']
        ]);
        Service::create(['header' => $request->header, 'description' => $request->description, 'img_path'=>$request->img_path]);
        Toast::info('Запись успешно создана!');
    }
}
