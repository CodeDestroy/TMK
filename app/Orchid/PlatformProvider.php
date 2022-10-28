<?php

declare(strict_types=1);

namespace App\Orchid;

use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Menu;


class PlatformProvider extends OrchidServiceProvider
{
    /**
     * @param Dashboard $dashboard
     */
    public function boot(Dashboard $dashboard): void
    {
        parent::boot($dashboard);

        // ...
    }

    /**
     * @return Menu[]
     */
    public function registerMainMenu(): array
    {
        return [
            Menu::make('Страницы сайта')
                ->list([
                    Menu::make('Главная страница')
                        ->icon('home')
                        ->route('platform.mainPage'),
                    Menu::make('Продукция')
                        ->icon('wrench')
                        ->route('platform.productionPage'),
                    Menu::make('Типы продукции')
                        ->icon('task')
                        ->route('platform.productiontypesPage'),
                    Menu::make('Услуги')
                        ->icon('docs')
                        ->route('platform.servicesPage'),
                    Menu::make('Новости')
                        ->icon('note')
                        ->route('platform.newsPage'),
                    Menu::make('Партнеры')
                        ->icon('people')
                        ->route('platform.partnersPage'),
                    Menu::make('Контакты')
                        ->icon('phone')
                        ->route('platform.contactsPage'),
                    Menu::make('Категории в футере')
                        ->icon('layers')
                        ->route('platform.categoriesPage'),
                    Menu::make('Разделы в футере (подкатегории)')
                        ->icon('list')
                        ->route('platform.subcategoriesPage')


                ])->icon('globe'),
            Menu::make('Заявки')
                ->icon('user-follow')
                ->route('platform.submitsPage'),
            /*Menu::make('Главная страница')
                ->icon('home')
                ->route('platform.mainPage')
                ->title('Главная страница'),
            Menu::make('Продукция')
                ->icon('wrench')
                ->route('platform.productionPage')
                ->title('Главная страница'),*/
            /*Menu::make('Example screen')
                ->icon('monitor')
                ->route('platform.example')
                ->title('Navigation')
                ->badge(function () {
                    return 6;
                }),

            Menu::make('Dropdown menu')
                ->icon('code')
                ->list([
                    Menu::make('Sub element item 1')->icon('bag'),
                    Menu::make('Sub element item 2')->icon('heart'),
                ]),

            Menu::make('Basic Elements')
                ->title('Form controls')
                ->icon('note')
                ->route('platform.example.fields'),

            Menu::make('Advanced Elements')
                ->icon('briefcase')
                ->route('platform.example.advanced'),*/

           /*  Menu::make('Text Editors')
                ->icon('list')
                ->route('platform.example.editors'),

            Menu::make('Overview layouts')
                ->title('Layouts')
                ->icon('layers')
                ->route('platform.example.layouts'),

            Menu::make('Chart tools')
                ->icon('bar-chart')
                ->route('platform.example.charts'),

            Menu::make('Cards')
                ->icon('grid')
                ->route('platform.example.cards')
                ->divider(),



            Menu::make('Changelog')
                ->icon('shuffle')
                ->url('https://github.com/orchidsoftware/platform/blob/master/CHANGELOG.md')
                ->target('_blank')
                ->badge(function () {
                    return Dashboard::version();
                }, Color::DARK()), */
            Menu::make('Документация')
                ->title('Docs')
                ->icon('docs')
                ->url('https://orchid.software/ru/docs'),
            Menu::make(__('Пользователи'))
                ->icon('user')
                ->route('platform.systems.users')
                ->permission('platform.systems.users')
                ->title(__('Access rights')),

            Menu::make(__('Роли'))
                ->icon('lock')
                ->route('platform.systems.roles')
                ->permission('platform.systems.roles'),
        ];
    }

    /**
     * @return Menu[]
     */
    public function registerProfileMenu(): array
    {
        return [
            Menu::make('Profile')
                ->route('platform.profile')
                ->icon('user'),
        ];
    }

    /**
     * @return ItemPermission[]
     */
    public function registerPermissions(): array
    {
        return [
            ItemPermission::group(__('System'))
                ->addPermission('platform.systems.roles', __('Roles'))
                ->addPermission('platform.systems.users', __('Users')),
        ];
    }
}
