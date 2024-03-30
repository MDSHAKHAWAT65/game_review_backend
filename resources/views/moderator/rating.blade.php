@extends('moderator/dashboard')

@section('content')
<style>
  .map-box{
    height: 7rem;
  }
</style>
<script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDMgPmKmGDrhHfCXg7shxlvnpVJHJ3dNZo&callback=console.debug&libraries=maps,marker&v=beta">
</script>
<div class="container">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 mb-4">
      
      <div class="col"></div>
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

      <div class="col"></div>
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
                <div class="map-box mt-1">
                  <div class="mb-1">
                    {{ $rating->coordinate_info }}
                  </div>
                  @php
                      $coordinates = explode(',', $rating->coordinate);
                  @endphp
                  <gmp-map center="{{$coordinates[0]}} ,{{$coordinates[1]}}" zoom="15" map-id="DEMO_MAP_ID">
                    <gmp-advanced-marker position="{{$coordinates[0]}} ,{{$coordinates[1]}}" title="My location"></gmp-advanced-marker>
                  </gmp-map>
                </div>
              </div>
            </div>
        @endforeach


        @if (!$game->ratings->count())
            <p class="text-center text-muted">No rating avaialble</p>
        @endif
      </div>
    </div>
</div>

<script>
// Initialize and add the map
let map;

async function initMap() {
  //@ts-ignore
  const { Map } = await google.maps.importLibrary("maps");
  const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");
}

initMap();

</script>

@endsection