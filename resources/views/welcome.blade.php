@extends('layout')
@section('title', "Home")
@section('content')
@if(session()->has('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
@endif
@auth
    <div class="container">
        <form class="ms-auto me-auto mt-3" style="width: 600px" name="searchField">
            <div class="mb-3">
                <input class="form-control me 2" type="search" name="search" id="search" placeholder="Pesquisar" > 
            </div>
            <button class="btn btn-primary" type="submit">Pesquisar</button>
        </form>
    </div>
@else
<div class="container">
    <h1>Efetue login para pesquisar</h1>
</div>
@endauth

<div class="container" id="searchList">
    <h1>Os resultados da pesquisa podem demorar</h1>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script>
    $(function(){
        $('form[name="searchField"]').submit(function(event){
            event.preventDefault();

            $.ajax({
                url: "{{ route('search.do') }}",
                type: "get",
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response){
                    var obj = response.cars
                    var div = $('#searchList')
                    div.empty();
                    for (var i = 0; i <obj.length; i++)
                    {
                        div.append('<div class="card mt- mb-3" style="max-width: 700px;">'+
                                      '<div class="row g-0">'+
                                        '<div class="col-md-4">'+
                                          '<img src="'+obj[i].photo_url+'" class="img-fluid rounded-start" alt="...">'+
                                        '</div>'+
                                        '<div class="col-md-8">'+
                                          '<div class="card-body">'+
                                            '<h5 class="card-title">'+obj[i].nome_veiculo+'</h5>'+
                                            '<ul class="list-group list-group-flush">'+
                                                '<li class="list-group-item">Ano: '+obj[i].ano+'</li>'+
                                                '<li class="list-group-item">Câmbio: '+obj[i].cambio+'</li>'+
                                                '<li class="list-group-item">Combustível: '+obj[i].combustivel+'</li>'+
                                                '<li class="list-group-item">Cor: '+obj[i].cor+'</li>'+
                                                '<li class="list-group-item">Portas :'+obj[i].portas+'</li>'+
                                                '<li class="list-group-item">Quilometragem: '+obj[i].quilometragem+'</li>'+
                                                '<li class="list-group-item">Preço: R$ '+obj[i].preco+'</li>'+
                                            '</ul>'+
                                            '<a href="'+obj[i].link+'" target="_blank">'+
                                                '<button class="btn btn-primary">Ver página</button>'+
                                            '</a>'+
                                          '</div>'+
                                        '</div>'+
                                      '</div>'+
                                    '</div>'
                                    );
                        console.log(obj[i]);
                    }
                },error:function(response){
                    alert('Nenhum resultado encontrado, tente novamente')
                }
            });
        });
    });
</script>
@endsection