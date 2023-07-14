@extends('layouts.admin')

@section('content')
    
    <div class="container">

        <div class="row my-3">

            <div class="text-end">
                <a href="{{ route('admin.projects.edit', $project) }}" class="d-inline-block my-showpage-button btn btn-warning text-white fw-bold">MODIFICA PROGETTO</a>
                <form class="d-inline-block my-showpage-button" action="{{ route('admin.projects.destroy', $project) }}" method="POST">
                    @csrf

                    @method('DELETE')

                    <button type="submit" class="form-control fw-bold btn btn-danger">CANCELLA PROGETTO</button>
                </form>
            </div>
            
            <h1 class=" text-uppercase">{{ $project['title'] }}</h1>
            <h5>Tipo: {{ $project->type->name }}</h5>
            <h5>
                Tecnologia usata:
                @foreach ($project->technology as $technology)
                    @if($loop->last)
                        {{ $technology->name }}
                    @else
                        {{ $technology->name }},
                    @endif
                @endforeach
            </h5>
            <p>{{ $project['description'] }}</p>
            <img src="{{ asset('storage/' . $project->image)}}" alt="">
        </div>
    </div>

@endsection