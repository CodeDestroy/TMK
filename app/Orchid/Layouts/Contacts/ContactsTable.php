<?php

namespace App\Orchid\Layouts\Contacts;

use App\Models\Contacts;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class ContactsTable extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'contactsPage';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('id', 'Id')->width('20px'),
            TD::make('adress', 'Адрес')->width('700px'),
            TD::make('phone', 'Телефон')->width('400px'),
            TD::make('email', 'Электронная почта')->width('400px'),
            TD::make('Actions')
                ->render(function (Contacts $contacts) {
                    return ModalToggle::make('Редактировать')
                        ->modal('editRecord')
                        ->method('update')
                        ->icon('pencil')
                        ->modalTitle('Редактирование записи с id = ' . $contacts->id)
                        ->asyncParameters([
                            'record' => $contacts->id
                        ]);

                })->width('10px')->align(TD::ALIGN_CENTER)
        ];
    }
}
