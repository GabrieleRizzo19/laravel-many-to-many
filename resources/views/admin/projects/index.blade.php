@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            
            @foreach ($projects as $project)
                <div class="col-4">
                    <div class="card mt-3">
                        <img src="{{ asset('storage/' . $project->image)}}" class="card-img-top" alt="...">
                        <div class="card-body">
                        <h5 class="card-title text-uppercase fw-bold">{{ $project['title'] }}</h5>
                        <p class="card-text"><span class="fw-bold">Tipo: </span>{{ $project->type->name }}</p>
                        <p class="card-text">
                            <span class="fw-bold">Tecnologia usata:</span>
                            @foreach ($project->technology as $technology)
                                @if($loop->last)
                                    {{ $technology->name }}
                                @else
                                    {{ $technology->name }},
                                @endif
                            @endforeach
                        </p>
                        <a href="{{ route('admin.projects.show', $project) }}" class="btn btn-primary">Dettagli</a>
                        </div>
                    </div>
                </div>
            @endforeach
            
            
        </div>
    </div>
@endsection