<?php

namespace App\Orchid\Screens\Main;



use Illuminate\Http\Request;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use App\Models\Main;

use Orchid\Support\Facades\Layout;
use App\Orchid\Layouts\Main\MainTable;
use Orchid\Support\Facades\Toast;

class MainPage extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */





    //use AsSource;
    public function query(): iterable
    {
        $main = new Main();
        return [
            'mainPage' => $main->paginate(10)
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public $name = 'Главная страница';

    public $description = 'Редактирование содержимого главной страницы';

    public function name(): ?string
    {
        return 'Главная страница';
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
     * @return false|\Orchid\Screen\Layout[]|string|string[]
     */

    public function layout(): iterable
    {
        return [
            MainTable::class,
            Layout::modal('createRecord', Layout::rows([
                TextArea::make('mainPageDescription')->required()->title('Текст')->rows(15)

            ]))->title('Создать новую запись')->applyButton('Создать')->closeButton('Закрыть'),
            Layout::modal('editRecord', Layout::rows([
                Input::make('record.id')->type('hidden'),
                TextArea::make('record.mainPageDescription')->required()->title("Текст")->rows(15),
            ]))->async('asyncGetRecord')->closeButton('Закрыть')->applyButton('Изменить'),
            Layout::modal('deleteRecord', Layout::rows([
                Input::make('record.id')->type('hidden')
            ]))->async('asyncGetRecord')->closeButton('Закрыть')->applyButton('Удалить')
        ];
    }
    public function asyncGetRecord(Main $main): array
    {
        return [
            'record' => $main
        ];
    }

    public function update(Request $request)
    {
        Main::find($request->input('record.id'))->update($request->record);
        Toast::info('Данные успешно изменены!');
    }

    public function delete(Request $request)
    {
        Main::find($request->input('record.id'))->delete($request->record);
        Toast::info('Данные удалены!');
    }

    public function create(Request $request): void
    {
        $request->validate([
           'mainPageDescription' => ['required']
        ]);
        Main::create(['mainPageDescription' => $request->mainPageDescription]);
        Toast::info('Запись успешно создана!');
    }

}
