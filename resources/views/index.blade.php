<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="owl/owl.carousel.min.css">
  <link rel="stylesheet" type="text/css" href="owl/owl.theme.default.min.css">

	<title>Главная</title>
</head>
<body>
<div class="wrapper">
	<header>
	<div class="header-main">
		<div class="container-xl  header-cont">
			<nav class="navbar navbar-dark navbar-expand-md bg-red">
 
    <a class="navbar-brand" href="/"><img src="./source/logo1.png" class="header-logo"></a>
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
	@if($errors->any())
			<div class="alert alert-danger">
				<ul>
					@foreach($errors->all() as $error)
					<li>{{$error}}</li>
					@endforeach
				</ul>
			</div>
	@endif
	<div class="container-xxl main-cont">
        <div class="main-pic" style="text-align: center;">
             <img src="source/slide.jpg" alt="" class="img-fluid">
                 <h2 class="main-pic_text">Комплексное решение<br>в строительстве</h2>
         </div>
         <div class="container-xl row c1" >
         	<div class="col-lg-9 col-md-8   col-12">
         <div class="main-title py-4"><h2>Продукция</h2></div>
         	<div class="content-cont">
				@foreach($description as $el)
         		<p class="content_text pb-2">
         			{{ $el->mainPageDescription }}
				</p>
         		<!-- <p class="content_text  py-2">
         		 Выполнение строительно-монтажных работ, проектирование, создание и подключение инженерных систем.Наша команда проектирует, строит под ключ металлокаркасные промышленные объекты: с остеклением и глухие.
         		</p>
         			<p class="content_text pb-2">
         			Строительная компания «ТМК» является одним из ведущих предприятий в Воронежской области. Офис расположен в г. Воронеж. География работ – центральные регионы России. По договоренности сотрудничаем с заказчиками из других федеральных округов.Основные направления деятельности ООО «ТМК»:1. Поставка строительных материалов, промышленного оборудования, электротехники, инструментов, мебели, средств дезинфекции и СИЗ, а также любых материалов, не требующих лицензирования;
         		</p>
         		<p class="content_text  py-2">
         		 Выполнение строительно-монтажных работ, проектирование, создание и подключение инженерных систем.Наша команда проектирует, строит под ключ металлокаркасные промышленные объекты: с остеклением и глухие.
         		</p> -->
				@endforeach
         	</div>
			 
         	</div>
 				<div class=" col-lg-3 col-md-4  col-12">
 					<div class="news-block my-5">
					
 						<div class="news-main_title pb-1">новости</div>
						 @foreach($data as $el)
						 <div class="news-block_item">
 							 <div class="news_title py-1">{{ $el->header }}</div> 
 							 <div class="news_date pt-1">{{ $el->date }}</div>  
 							 <div class="news_text py-1">{{\Illuminate\Support\Str::limit($el->description, 100, '...') }}</div>
 						</div>

						@endforeach
 						<button type="button" class="btn btn-danger mt-3" onclick = "location.href='news';">Ещё новости</button>
 					</div>
 				</div>
				</div>
           

         	</div>


         <div class="container-xl">
         	  <div class="part_title my-3">НАШИ ПАРТНЕРЫ</div>
         	   <div class="owl-carousel carouselOne  my-5" >
				@foreach($partners as $el)
						 <div class="o-item">
							<img src="source/{{$el->img_logo_path}}">
						</div >
				@endforeach
         	   	<!-- <div class="o-item">
         	   		 <img src="source/prt1.png">
         	   	</div >
         	   	<div class="o-item">
         	   		 <img src="source/prt1.png">
         	   	</div>
         	   	<div class="o-item">
         	   		 <img src="source/prt1.png">
         	   	</div>
         	   	<div class="o-item">
         	   		 <img src="source/prt1.png">
         	   	</div> -->
         	   </div>
         </div>



</div>





<footer class="part_footer">
	<div class="container-xl row c1" style="padding-top: 1em!important;">
		<div class="col">
			
			<ul style="list-style-type: none; ">
				<li style="font-weight: 800;">
					<a>Продукция</a>
				</li>
				<li>
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
				</li>
			</ul>
			<ul style=" list-style-type: none;">
				<li  style="font-weight: 800;">
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
					<a href="#" class="footer_li_el">Новости</a>
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
			
		</div>
		<div class="col">
			<ul style=" list-style-type: none;">
				<li  style="font-weight: 800;">
					Контакты
				</li>
				<li>
					<a href="mailto:info@tmk-vr.ru?subject=E-mail" class="footer_li_el">E-mail: <b>info@tmk-vr.ru</b></a>
					
				</li>
				<li class="footer_li_el">

					<a class="footer_li_el phone" href="tel: +79202256666">Телефон: <b>+7 920 225-66-66</b></a>
				</li>
			</ul>
			<ul style="list-style-type: none;">
				<li style="font-weight: 800;">
					<a href="#" class="footer_li_el">Адрес</a>
				</li>
				<li>
					<a href="#" class="footer_li_el">ул. Сакко и Ванцетти, д. 61</a>
				</li>
				<li>
					<a href="#" class="footer_li_el">Воронежская область</a>
				</li>
				<li>
					<a href="#" class="footer_li_el">Россия</a>
				</li>
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
      <div class="modal-body">
			  <div class="input-group mb-3">
				  <input type="text" class="form-control" placeholder="Ваше имя" aria-label=" Ваше имя" aria-describedby="basic-addon1">
				</div>
				<div class="input-group mb-3">
				  <input type="text" class="form-control" placeholder="Ваш e-mail адресс" aria-label="Ваш e-mail адресс" aria-describedby="basic-addon2">
				  <span class="input-group-text" id="basic-addon2">@example.com</span>
				</div>
				<div class="input-group mb-3">
				  <span class="input-group-text" id="basic-addon1">Ваш телефон:</span>
				  <input type="text" class="form-control" placeholder="+7 (___)-___-__-__" aria-label="+7 (___)-___-__-__" aria-describedby="basic-addon1">
				</div>
      </div>
      <div class="modal-footer">
        <button type="button" data-bs-dismiss="modal" class="nav-link" style="background-color: #dc3545; border: 0;">Закрыть</button>
        <button type="button" class="nav-link" style="background-color: #dc3545; border: 0;">Отправить</button>
      </div>
    </div>
  </div>
</div>
</div>
<script src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.bundle.js"></script>
<script src="owl/owl.carousel.min.js"></script>
<script src="owl/owl.carousel.js"></script>
<script type="text/javascript">

	 $(document).ready(function() {
               $('.carouselOne').owlCarousel({

                    responsive:{ 
                        0:{
                            items:1
                        },
                        465:{
                            items:2
                        },
                        768:{
                            items:4
                        },
                         
                    }
                });
            });
</script>
</body>  




