


    <section class="testimonials-section py-5">
        <div class="container">
            <h3 class="text-center mb-4">آراء عملائنا</h3>
            @if (count($testimonails) > 0)
            <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">

                    @forelse ($testimonails as $key => $value)
                    <div class="carousel-item {{$key == 0 ? "active" : ''}}">
                        <div class="row justify-content-center">
                            <div class="col-md-5 text-center">
                                <div class="card shadow-sm border-0 rounded-3 p-4">
                                    <img src="{{$value->image == null ? asset('assets/profileimages/avatar.jpg') : asset($value->image) }}" alt="{{$value->name}}" class="rounded-circle mb-3 mx-auto"
                                        width="100" height="100">
                                    <h5>{{$value->name}}</h5>
                                    <p class="text-muted">{{$value->jobTitle}}</p>
                                    <p class="testimonial-text">"{{$value->message}}"</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    @endforeach

                </div>

                <!-- Controls -->
                <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">السابق</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">التالي</span>
                </button>
            </div>


            @else
            <div class="vh-50 rounded-2 py-5" style="background-color: #56c8a426;   padding:26px;">
                <h4 class="text-center"> لا يوجد توصيات🥲</h4>

            </div>
            @endif
    
        </div>
    </section>
