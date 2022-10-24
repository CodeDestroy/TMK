<?php

namespace App\Orchid\Screens\News;

use App\Models\News;
use App\Orchid\Layouts\News\NewsTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;


use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class NewsPage extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        $news = new News();
        return [
            'newsPage' => $news->paginate(10)
        ];
    }

    public $name = 'Новости';

    public $description = 'Редактирование содержимого страницы с новостями';

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Новости';
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
            NewsTable::class,
            Layout::modal('createRecord', Layout::rows([
                Input::make('header')->required()->title('Заголовок'),
                TextArea::make('description')->required()->title('Описание')->rows(15),
                DateTimer::make()
                    ->name('date')
                    ->required()
                    ->title('Дата'),
                Cropper::make('img_path')
                    ->title('Large web banner image, generally in the front and center')
                    ->width(1000)
                    ->height(500)->targetRelativeUrl(),
            ]))->title('Создать новую запись')->applyButton('Создать')->closeButton('Закрыть'),
            Layout::modal('editRecord', Layout::rows([
                Input::make('record.id')->type('hidden'),
                Input::make('record.header')->required()->title('Заголовок'),
                TextArea::make('record.description')->required()->title("Текст")->rows(15),
                DateTimer::make()
                    ->name('date')
                    ->required()
                    ->title('Дата'),
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
    public function asyncGetRecord(News $news): array
    {
        return [
            'record' => $news
        ];
    }

    public function update(Request $request)
    {
        News::find($request->input('record.id'))->update($request->record);
        Toast::info('Данные успешно изменены!');
    }

    public function delete(Request $request)
    {
        News::find($request->input('record.id'))->delete($request->record);
        Toast::info('Данные удалены!');
    }

    public function create(Request $request): void
    {
        $request->validate([
            'header' => ['required'],
            'date' => ['required'],
            'description' => ['required'],
            'img_path' => ['required']
        ]);
        News::create(['header' => $request->header, 'date' => $request->date , 'description' => $request->description, 'img_path'=>$request->img_path]);
        Toast::info('Запись успешно создана!');
    }
}
