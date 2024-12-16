<section class="partners-section py-5">
    <div class="container">
        <h3 class="text-center mb-5">شركاؤنا</h3>
        <div class="row">
            <div id="partnersCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach($groupedPartners as $key => $partners)
                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                        <div class="row">
                            @foreach($partners as $partner)
                                <div class="col-md-4 text-center">
                                    <img src="{{ asset($partner->image) }}" class="img-fluid mb-2" alt="{{ $partner->name }}">
                                    <h5>{{ $partner->name }}</h5>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#partnersCarousel"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#partnersCarousel"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                </button>
            </div>
        </div>
    </div>
</section>
