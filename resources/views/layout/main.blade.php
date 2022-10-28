<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @if(parse_url(url('/'), PHP_URL_SCHEME) == 'HTTPS')
        <link rel="stylesheet" type="text/css" href="{{secure_asset('/css/style.css')}}">
        <link rel="stylesheet" type="text/css" href="{{secure_asset('/css/bootstrap.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{secure_asset('/owl/owl.carousel.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{secure_asset('/owl/owl.theme.default.min.css')}}">
    @else
        <link rel="stylesheet" type="text/css" href="{{asset('/css/style.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('/css/bootstrap.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('/owl/owl.carousel.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('/owl/owl.theme.default.min.css')}}">
    @endif
    <title>@yield('title-block')</title>
</head>
<body>
<div class="wrapper">
    <header>
        <div class="header-main">
            <div class="container-xl  header-cont">
                <nav class="navbar navbar-dark navbar-expand-md bg-red">
                    @if(parse_url(url('/'), PHP_URL_SCHEME) == 'HTTPS')
                        <a class="navbar-brand" href="/"><img src="{{secure_asset('/source/logo1.png')}}" class="header-logo"></a>
                    @else
                        <a class="navbar-brand" href="/"><img src="{{asset('/source/logo1.png')}}" class="header-logo"></a>
                    @endif
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Переключатель навигации">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item mx-2">
                                <a class="nav-link header-link" href="/products">Продукция</a>
                            </li>
                            <li class="nav-item mx-2">
                                <a class="nav-link header-link" href="/services">Услуги</a>
                            </li>
                            <li class="nav-item mx-2">
                                <a class="nav-link header-link" href="/news">Новости</a>
                            </li>
                            <li class="nav-item mx-2">
                                <a class="nav-link header-link" href="/partners">Партнеры</a>
                            </li>
                            <li class="nav-item mx-2">
                                <a class="nav-link header-link" href="/contacts">Контакты</a>
                            </li>
                            <li class="nav-item mx-2">
                                <button type="button" class="nav-link nav-order" style="color: white!important; background-color: #dc3545; margin: 0 auto; padding: 0.5em;" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    Оставить заявку
                                </button>
                                <!-- <a class="nav-link  nav-order" href="#" style="color: white;">Оставить заявку</a> -->
                            </li>
                        </ul>

                    </div>

                </nav>
            </div>
        </div>
    </header>
    <div>
        @yield('content')
    </div>



    <footer class="part_footer">
        <div class="container-xl row c1" style="padding-top: 1em!important;">
            <div class="col">

                <ul style="list-style-type: none; ">
                    <li style="font-weight: 800;">
                        <a>Продукция</a>
                    </li>

                    @foreach($types as $el)
                        <li>
                            <a href="/products/{{$el->alias}}" class="footer_li_el">{{$el->type}}</a>
                        </li>
                    @endforeach
                    {{--<li>
                        <a href="/products/product_type{{ $el->production_type_id  }}" class="link-product">Подробности</a>
                        <a href="#" class="footer_li_el">Оборудование для горнорудной промышленности</a>
                    </li>
                    <li>
                        <a href="#" class="footer_li_el">Цементная промышленность</a>
                    </li>
                    <li>
                        <a href="#" class="footer_li_el">Конвеерное оборудование</a>
                    </li>
                    <li>
                        <a href="#" class="footer_li_el">Тепловые электростанции</a>
                    </li>
                    <li>
                        <a href="#" class="footer_li_el">Оборудование для АЭС</a>
                    </li>
                    <li>
                        <a href="#" class="footer_li_el">Специальное оборудование</a>
                    </li>
                    <li>
                        <a href="#" class="footer_li_el">Грузоподъемное оборудование</a>
                    </li>
                    <li>
                        <a href="#" class="footer_li_el">Прочее оборудование</a>
                    </li>--}}
                </ul>
                <ul style=" list-style-type: none;">
                    @foreach($categories as $category_el)
                        @if ($category_el->name == 'О компании')
                            <li  style="font-weight: 800;">
                                <a  class="footer_li_el">{{$category_el->name}}</a>
                            </li>
                            @foreach($sub_categories as $sub_category_el)
                                @if ($sub_category_el->parent_id == $category_el->id)
                                    <li>
                                        <a href="/category/{{$category_el->alias}}/{{$sub_category_el->alias}}" class="footer_li_el">{{$sub_category_el->name}}</a>
                                    </li>
                                @endif
                            @endforeach
                        @elseif($category_el->name == 'Производство')
                            </div>
                            <div class="col">
                            <li  style="font-weight: 800;">
                                <a  class="footer_li_el">{{$category_el->name}}</a>
                            </li>
                            @foreach($sub_categories as $sub_category_el)
                                @if ($sub_category_el->parent_id == $category_el->id)
                                    <li>
                                        <a href="/category/{{$category_el->alias}}/{{$sub_category_el->alias}}" class="footer_li_el">{{$sub_category_el->name}}</a>
                                    </li>
                                @endif
                            @endforeach
                        @else
                            <li  style="font-weight: 800;">
                                <a  class="footer_li_el">{{$category_el->name}}</a>
                            </li>
                            @foreach($sub_categories as $sub_category_el)
                                @if ($sub_category_el->parent_id == $category_el->id)
                                    <li>
                                        <a href="/category/{{$category_el->alias}}/{{$sub_category_el->alias}}" class="footer_li_el">{{$sub_category_el->name}}</a>
                                    </li>
                                @endif
                            @endforeach
                            </div>
                       @endif
                    @endforeach
                    {{--<li  style="font-weight: 800;">
                        <a>О компании</a>
                    </li>
                    <li>
                        <a href="#" class="footer_li_el">Политика интегрированной системы менеджмента</a>
                    </li>
                    <li>
                        <a href="#" class="footer_li_el">История компании</a>
                    </li>
                    <li>
                        <a href="#" class="footer_li_el">Документы</a>
                    </li>
                    <li>
                        <a href="/news" class="footer_li_el">Новости</a>
                    </li>
                    <li>
                        <a href="#" class="footer_li_el">Реализация остатков ТМЦ</a>
                    </li>
                </ul>

            </div>
            <div class="col">
                <ul style=" list-style-type: none;">
                    <li  style="font-weight: 800;">
                        <a>Производство</a>
                    </li>
                    <li>
                        <a href="#" class="footer_li_el">Масштабное производство</a>
                    </li>
                    <li>
                        <a href="#" class="footer_li_el">Информационные технологии</a>
                    </li>
                    <li>
                        <a href="#" class="footer_li_el">Техническое перевооружение</a>
                    </li>

                </ul>
                <ul style="list-style-type: none;">
                    <li style="font-weight: 800">
                        <a>Карьера</a>
                    </li>
                    <li>
                        <a href="#" class="footer_li_el">Обучение и практика</a>
                    </li>
                    <li>
                        <a href="#" class="footer_li_el">Вакансии</a>
                    </li>
                    <li>
                        <a href="#" class="footer_li_el">Значимые проекты</a>
                    </li>
                    <li>
                        <a href="#" class="footer_li_el">Лебединский ГОК</a>
                    </li>
                    <li>
                        <a href="#" class="footer_li_el">ТЭС "Бар" (Индия)</a>
                    </li>
                </ul>

            </div>--}}





            <div class="col">
                <ul style=" list-style-type: none;">
                    <li  style="font-weight: 800;">
                        Контакты
                    </li>
                    <li>
                        <a href="mailto:{{$contacts->email}}?subject=E-mail" class="footer_li_el">E-mail: <b>{{$contacts->email}}</b></a>

                    </li>
                    <li class="footer_li_el">

                        <a class="footer_li_el phone" href="tel: {{$contacts->phone}}">Телефон: <b>{{$contacts->phone}}</b></a>
                    </li>
                </ul>
                <ul style="list-style-type: none;">
                    <li style="font-weight: 800;">
                        <a href="#" class="footer_li_el">Адрес</a>
                    </li>
                    <li>
                        <a href="https://www.google.com/search?q={{str_replace(" ", "+", $contacts->adress)}}" class="footer_li_el">
                            {{$contacts->adress}}</a>
                    </li>
                    {{--<li>
                        <a href="#" class="footer_li_el">Воронежская область</a>
                    </li>
                    <li>
                        <a href="#" class="footer_li_el">Россия</a>
                    </li>--}}
                </ul>

            </div>
        </div>
    </footer>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Заявка</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                </div>
                <form action="{{route('contact-form')}}" method="post">
                    @csrf

                    <div class="modal-body">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Ваше имя" name="name" id="name" aria-label=" Ваше имя" aria-describedby="basic-addon1">
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Ваш e-mail адресс" aria-label="Ваш e-mail адресс" name="email" id="email" aria-describedby="basic-addon2">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Ваш телефон:</span>
                            <input type="text" class="form-control" placeholder="+7 (___)-___-__-__" aria-label="+7 (___)-___-__-__" name="phone" id="phone" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-bs-dismiss="modal" class="nav-link" style="background-color: #dc3545; border: 0;">Закрыть</button>
                        <button type="submit" class="nav-link" style="background-color: #dc3545; border: 0;">Отправить</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@if(parse_url(url('/'), PHP_URL_SCHEME) == 'HTTPS')
    <script src="{{secure_asset('/js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{secure_asset('/js/bootstrap.bundle.js')}}"></script>
    <script src="{{secure_asset('/owl/owl.carousel.min.js')}}"></script>
    <script src="{{secure_asset('/owl.carousel.js')}}"></script>
@else
    <script src="{{asset('/js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('/js/bootstrap.bundle.js')}}"></script>
    <script src="{{asset('/owl/owl.carousel.min.js')}}"></script>
    <script src="{{asset('/owl/owl.carousel.js')}}"></script>
@endif

</body>


