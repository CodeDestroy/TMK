@extends('layout.main')

@section('title-block')
{{\Illuminate\Support\Str::limit($description->name, 30, '...') }}
@endsection

@section('content')
<div class="container-xl py-2">
    <div class="main-title py-4"><h2>Услуга</h2></div>
    <a style="text-decoration: none;">
        <div class = "row">
            <div class="col py-1">
                <p class="name-product">{{ $description->name}}</p>
                <p class="py-1" id="text">{{str_replace('&quot;', "", $description->text)}}</p>
            </div>
        </div>

    </a>
</div>

<script>

    let body = document.getElementById("text");
    body.innerHTML = body.innerText
    //console.log(body.innerHTML)
    images = body.getElementsByTagName("img");
    console.log(images[0])
    for (let image of images){
        console.log(path.relative('/foo/bar/baz', '/foo'));
    }

</script>
@endsection
