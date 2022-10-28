<?php

namespace App\Orchid\Screens\Submits;

use App\Models\Submit;
use App\Orchid\Layouts\Submits\SubmitsTable;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Illuminate\Http\Request;
use Orchid\Support\Facades\Toast;

class SubmitsPage extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        $submit = new Submit();
        return [
            'submitsPage' => Submit::filters()->paginate(10)
        ];
    }
    public $name = 'Заявки';

    public $description = 'Заявки пользователей';
    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Заявки';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            SubmitsTable::class,
            Layout::modal('editRecord', Layout::rows([
                Input::make('record.id')->type('hidden'),
                Input::make('record.name')->required()->title('Имя'),
                Input::make('record.email')->required()->title('E-mail'),
                Input::make('record.phone')->required()->title('Телефон'),
                TextArea::make('record.description')->title('Заметки')->rows(3),
                CheckBox::make('record.checked')
                    ->sendTrueOrFalse()
                    ->title('Обработана')
            ]))->async('asyncGetRecord')->closeButton('Закрыть')->applyButton('Изменить'),
            Layout::modal('deleteRecord', Layout::rows([
                Input::make('record.id')->type('hidden')
            ]))->async('asyncGetRecord')->closeButton('Закрыть')->applyButton('Удалить')
        ];
    }
    public function asyncGetRecord(Submit $submit): array
    {
        return [
            'record' => $submit
        ];
    }

    public function update(Request $request)
    {
        Submit::find($request->input('record.id'))->update($request->record);
        Toast::info('Данные успешно изменены!');
    }

    public function delete(Request $request)
    {
        Submit::find($request->input('record.id'))->delete($request->record);
        Toast::info('Данные удалены!');
    }


}
