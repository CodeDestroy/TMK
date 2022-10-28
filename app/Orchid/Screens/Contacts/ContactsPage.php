<?php

namespace App\Orchid\Screens\Contacts;

use App\Models\Contacts;

use App\Models\News;
use App\Orchid\Layouts\Contacts\ContactsTable;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Screen;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class ContactsPage extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        $contacts = new Contacts();
        return [
            'contactsPage' => $contacts->paginate(10)
        ];
    }

    public $name = 'Контакты';

    public $description = 'Редактирование содержимого страницы с контактами';


    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Контакты';
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
            ContactsTable::class,
            Layout::modal('createRecord', Layout::rows([
                Input::make('adress')->required()->title('Адрес'),
                Input::make('phone')->required()->title('Телефон'),
                Input::make('email')->required()->title('Телефон'),
            ]))->title('Создать новую запись')->applyButton('Создать')->closeButton('Закрыть'),
            Layout::modal('editRecord', Layout::rows([
                Input::make('record.id')->type('hidden'),
                Input::make('record.adress')->required()->title('Адрес'),
                Input::make('record.phone')->required()->title('Телефон'),
                Input::make('record.email')->required()->title('E-mail'),
            ]))->async('asyncGetRecord')->closeButton('Закрыть')->applyButton('Изменить'),
        ];
    }

    public function asyncGetRecord(Contacts $contacts): array
    {
        return [
            'record' => $contacts
        ];
    }

    public function update(Request $request)
    {
        Contacts::find($request->input('record.id'))->update($request->record);
        Toast::info('Данные успешно изменены!');
    }
    public function create(Request $request): void
    {
        $request->validate([
            'adress' => ['required'],
            'phone' => ['required'],
            'email' => ['email'],

        ]);
        Contacts::create(['adress' => $request->adress, 'phone' => $request->phone, 'email'=>$request->email]);

        Toast::info('Запись успешно создана!');
    }


}
