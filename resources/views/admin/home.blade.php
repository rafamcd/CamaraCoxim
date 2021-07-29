@extends('adminlte::page')

@section('plugins.Chartjs', true)

@section('title',' - Painel')

@section('content_header')
    <div class="row">
        <div class="col-md-6">
            <h1>Dashboard</h1>
        </div>
        <div class="col-md-6">
            <form method="GET">
                <select onChange="this.form.submit()" name="intervalo" class="float-md-right">
                    <option {{$dataIntervalo==1000000?'selected="selected"':''}} value="1000000">Todo o tempo</option>
                    <option {{$dataIntervalo==30?'selected="selected"':''}} value="30">Últimos 30 dias</option>
                    <option {{$dataIntervalo==60?'selected="selected"':''}} value="60">Últimos 2 meses</option>
                    <option {{$dataIntervalo==90?'selected="selected"':''}} value="90">Últimos 3 meses</option>
                    <option {{$dataIntervalo==180?'selected="selected"':''}} value="180">Últimos 6 meses</option>                    
                </select>
            </form>            
        </div>
    </div>
    
@endsection

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{$noticiasCount}}</h3>
                    <p>Notícias</p>
                </div>
                <div class="icon">
                    <i class="far fa-fw fa-newspaper"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{$vereadoresCount}}</h3>
                    <p>Vereadores</p>
                </div>
                <div class="icon">
                    <i class="far fa-fw fa-user"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{$pdfsCount}}</h3>
                    <p>PDFs inseridos</p>
                </div>
                <div class="icon">
                    <i class="far fa-fw fa-sticky-note"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{$usersCount}}</h3>
                    <p>Usuários</p>
                </div>
                <div class="icon">
                    <i class="far fa-fw fa-heart"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Notícias x Vereador</h3>
                </div>
                <div class="card-body">
                    <canvas id="paginaPie"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Atalhos</h3>
                </div>
                <div class="card-body">
                    <h3><a href="{{route('noticias')}}" style="text-decoration: none; color:#000000;"><i class="nav-icon fa fa-check"></i>&nbsp;&nbsp;Notícias</a></h3>
                    <h3><a href="{{route('eventos')}}" style="text-decoration: none; color:#000000;"><i class="nav-icon fa fa-check"></i>&nbsp;&nbsp;Eventos</a></h3>
                    <h3><a href="{{route('vereadores')}}" style="text-decoration: none; color:#000000;"><i class="nav-icon fa fa-check"></i>&nbsp;&nbsp;Vereadores</a></h3>
                </div>
            </div>
        </div>
        
    </div>

<script>
    window.onload = function() {
        let ctx = document.getElementById('paginaPie').getContext('2d');
        window.paginaPie = new Chart(ctx, {
            type:'pie',
            data: {
                datasets: [{
                    data: {{$pageValues}},
                    backgroundColor: {!! $colorsPie !!}
                }],
                labels: {!! $pageLabels !!}
            },
            options: {
                responsive: true,
                legend: {
                    display:false
                }
            }
        });
    }
</script>

@endsection

