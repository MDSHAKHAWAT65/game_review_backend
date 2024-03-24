@extends('layout')

@section('content')

<div class="container">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 mb-4">

      <div class="col">
        <div class="card shadow-sm">
          <img src="/{{ $game->img_url }}" alt="Game image">
          <div class="border border-bottom"></div>
          <div class="card-body">
            <p class="card-text">{{ $game->title }}</p>
            <div class="d-flex justify-content-between align-items-center">
              {{-- <div class="btn-group">
                <a href="games/{{ $game->id }}" class="btn btn-sm btn-outline-secondary">Add Rating</a>
              </div> --}}
              <small class="text-body-secondary">Rating Avg: {{ $game->avg() }}</small>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="card mb-4">
      <div class="card-body">
        <h3>Add Your Rating</h3>

        @include('includes/errors')
        @include('includes/alert_success')
        @include('includes/alert_failed')
        
        <form class="row g-3" action="/games/rating-add" method="POST">
          @csrf
          <input type="hidden" name="game_id" value="{{ $game->id }}">
          <div class="col-md-2">
            <label for="inputState" class="form-label">Rating</label>
            <select {{  $ratingDisabled ? 'disabled': '' }} id="inputState" class="form-select" name="rating">
              <option selected>Choose...</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
            </select>
          </div>
          <div class="col">
            <label class="form-label">Comment</label>
            <textarea {{  $ratingDisabled ? 'disabled': '' }} class="form-control" name="comment" rows="1"></textarea>
          </div>

          <div class="col-12">
            <button {{  $ratingDisabled ? 'disabled': '' }} type="submit" class="btn btn-primary">Submit Rating</button>
          </div>
      </form>
      </div>
    </div>

    {{-- rating section --}}
    <div class="card mb-4">
      <div class="card-body">
        <h3>All ratings</h3>
        
        @foreach ($game->ratings as $rating)
            <div class="card mb-4">
              <div class="card-body">
                <h6><span class="text-muted">User:</span> {{ auth()->user()->username }} | <span class="pst-4 text-muted">Rating: {{ $rating->rating }}</span></h6>
                <textarea disabled class="form-control text-sm" rows="2">{{ $rating->comment }}</textarea>
              </div>
            </div>
        @endforeach


        @if (!$game->ratings->count())
            <p class="text-center text-muted">No rating avaialble</p>
        @endif
      </div>
    </div>
</div>

@endsection