@if (auth()->role->name == 'user'):
    @if(!empty(advertisements())):
    <div id="carouselExampleIndicators" class="carousel slide mb-4" data-ride="carousel" style="border: 10px solid white;">
        <ol class="carousel-indicators">
            @foreach(advertisements() as $key1 => $itemImage): 
                <li data-target="#carouselExampleIndicators" data-slide-to="{{ $key1 }}" class="{{ $key1 == 0 ? 'active' : '' }}"></li>
            @endforeach
        </ol>
        <div class="carousel-inner">
            @foreach(advertisements() as $key => $advertisemnet):
            <div class="carousel-item @if($key == 0): active @endif">
                <a href="{{ $advertisemnet->description }}">
                 <img class="d-block w-100" src="{{ url($advertisemnet->image) }}" alt="{{ $advertisemnet->title }}" style="max-height: 200px;">
                </a> 
            </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    @endif
@endif    