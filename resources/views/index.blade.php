@extends('layout')

@section('content')

<div class="container">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

      @foreach ($games as $game)
      <div class="col">
        <div class="card shadow-sm">
          <img src="/{{ $game->img_url }}" alt="Game image">
          <div class="border border-bottom"></div>
          <div class="card-body">
            <p class="card-text">{{ $game->title }}</p>
            <div class="d-flex justify-content-between align-items-center">
              <div class="btn-group">
                <a href="games/{{ $game->id }}" class="btn btn-sm btn-outline-secondary">Add Rating</a>
              </div>
              <small class="text-body-secondary">Rating Avg: {{ $game->avg() }}</small>
            </div>
          </div>
        </div>
      </div>
      @endforeach

    </div>

    <div class="text-center mt-5">
        {{ $games->links() }}
    </div>
</div>

@endsection