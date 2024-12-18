<div id="branchCarousel" class="carousel slide" data-bs-ride="carousel">
    <!-- Carousel Inner -->
    <div class="carousel-inner">
        @foreach ($hubs as $key => $hub )
        <div style="padding: 0 ">
            <div class="carousel-item  {{$key == 0 ? 'active' : ''}}">
                <div class="card h-100 border shadow-sm branch-card" data-map="{{$hub->id}}">
                    <div class="card-body text-center">
                        <h5 class="card-title">{{$hub->name_ar}}</h5>
                        <p class="card-text">{{$hub->address}}</p>
                    </div>
                </div>
    </div>
        </div>

        @endforeach
    </div>

    <!-- Carousel Controls -->
    <button class="carousel-control-prev" type="button" data-bs-target="#branchCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">السابق</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#branchCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">التالي</span>
    </button>
</div>
