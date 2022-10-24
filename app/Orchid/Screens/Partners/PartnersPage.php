<?php

namespace App\Orchid\Screens\Partners;

use App\Models\Partners;
use App\Orchid\Layouts\Partners\PartnersTable;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Screen;
use App\Orchid\Layouts\News\NewsTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;

use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;
class PartnersPage extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        $partners = new Partners();
        return [
            'partnersPage' => $partners->paginate(10)
        ];
    }

    public $name = 'Партнеры';

    public $description = 'Редактирование содержимого страницы с партнерами';

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Партнеры';
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
            PartnersTable::class,
            Layout::modal('createRecord', Layout::rows([
                Input::make('header')->required()->title('Заголовок'),
                TextArea::make('description')->required()->title('Описание')->rows(15),
                Cropper::make('img_path')
                    ->title('Основная картинка')
                    ->width(1000)
                    ->height(500)->targetRelativeUrl(),
                Cropper::make('img_logo_path')
                    ->title('Баннер')
                    ->width(1550)
                    ->height(600)->targetRelativeUrl(),
                CheckBox::make('show_on_main')
                    ->value(1)
                    ->title('Показывать баннер')
            ]))->title('Создать новую запись')->applyButton('Создать')->closeButton('Закрыть'),
            Layout::modal('editRecord', Layout::rows([
                Input::make('record.id')->type('hidden'),
                Input::make('record.header')->required()->title('Заголовок'),
                TextArea::make('record.description')->required()->title("Текст")->rows(15),
                Cropper::make('img_path')
                    ->title('Основная картинка')
                    ->width(1000)
                    ->height(500)->targetRelativeUrl(),
                Cropper::make('img_logo_path')
                    ->title('Баннер')
                    ->width(1000)
                    ->height(500)->targetRelativeUrl(),
                CheckBox::make('show_on_main')
                    ->value(1)
                    ->title('Показывать баннер')
            ]))->async('asyncGetRecord')->closeButton('Закрыть')->applyButton('Изменить'),
            Layout::modal('deleteRecord', Layout::rows([
                Input::make('record.id')->type('hidden')
            ]))->async('asyncGetRecord')->closeButton('Закрыть')->applyButton('Удалить')
        ];
    }
    public function asyncGetRecord(Partners $partners): array
    {
        return [
            'record' => $partners
        ];
    }

    public function update(Request $request)
    {
        Partners::find($request->input('record.id'))->update($request->record);
        Toast::info('Данные успешно изменены!');
    }

    public function delete(Request $request)
    {
        Partners::find($request->input('record.id'))->delete($request->record);
        Toast::info('Данные удалены!');
    }

    public function create(Request $request): void
    {
        $request->validate([
            'header' => ['required'],
            'description' => ['required'],
            'img_path' => ['required'],
        ]);
        Partners::create(['header' => $request->header, 'description' => $request->description, 'img_path'=>$request->img_path, 'img_logo_path'=>$request->img_logo_path, 'show_on_main'=>$request->show_on_main]);
        Toast::info('Запись успешно создана!');
    }


}
