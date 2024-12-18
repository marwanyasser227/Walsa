<section class="partners-section py-5">
    <div class="container">
        <h3 class="text-center mb-5">شركاؤنا</h3>
        <div class="row">
            @if(count($groupedPartners) > 0)
            <div id="partnersCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach($groupedPartners as $key => $partners)
                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                        <div class="row">
                            @foreach($partners as $partner)
                                <div class="col-md-4 text-center">
                                    <img src="{{$partner->image != null ? asset($partner->image) : asset('assets/site/placeholder.png') }}" class="img-fluid mb-2" alt="{{ $partner->name }}">
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

            
            @else
            <div class="vh-50 rounded-2" style="background-color: #56c8a426;   padding:26px;">
                <h4 class="text-center"> لا يوجد شركاء😒</h4>

            </div>
            @endif
        </div>
    </div>
</section>
