@extends('layouts.admin')

@section('content')
    
    <div class="container my-3">
        <div class="row">

            <h1 class="text-center">MODIFICA IL PROGETTO</h1>

            <form action="{{ route('admin.projects.update', $project) }}" method="POST" class="needs-validation" enctype="multipart/form-data">
                @csrf

                @method('PUT')
            
                <label for="title">Titolo</label>
                <input class="form-control mb-3" type="text" name="title" id="title" value="{{ $project['title'] }}">
                @error('title')
                    <div class="text-danger mb-3">{{ $message }}</div>
                @enderror

                <label for="description">Descrizione</label>
                <textarea class="form-control mb-3" name="description" id="description" cols="30" rows="10">{{ $project['description'] }}</textarea>
                @error('description')
                    <div class="text-danger mb-3">{{ $message }}</div>
                @enderror

                <label for="type_id">Tipo</label>
                <select class="form-control mb-3" name="type_id" id="type_id">
                    <option disabled>Seleziona il tipo</option>
                    @foreach ($typeArray as $type)
                        <option value="{{ $type['id'] }}" @selected(old("type_id", $project)== $type['id'])>{{ $type['name'] }}</option>
                    @endforeach
                </select>
                @error('type_id')
                    <div class="text-danger mb-3">{{ $message }}</div>
                @enderror

                <span>Tecnologia usata:</span>
                <div class="d-block btn-group mb-3" role="group">
                    @foreach ($technologyArray as $i => $technology)
                        {{-- NON VA IL CHECKED --}}
                        <input type="checkbox" value="{{$technology['id']}}" class="btn-check" id="technology{{$i}}" name="technology[]" @checked(old('technology') ? in_array($technology['id'], old('technology')) : in_array($technology['id'], $projectTechnology) ) >
                        <label class="btn btn-outline-primary" for="technology{{$i}}">{{$technology['name']}}</label>
                    @endforeach
                </div>
                @error('technology')
                    <div class="text-danger mb-3">{{ $message }}</div>
                @enderror

                <label for="image">Immagine</label>
                <input class="form-control mb-3" type="file" name="image" id="image">
                @error('image')
                    <div class="text-danger mb-3">{{ $message }}</div>
                @enderror

                <input type="submit" class="form-control btn btn-primary"> 

            </form>
        </div>
    </div>

@endsection