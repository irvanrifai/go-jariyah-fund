<div class="container">
    <div id="carouselHome" class="carousel slide carousel-home" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php $slider = \App\Http\Controllers\SliderController::get_slider() ?>
            <?php $item_active = 'active'; ?>
            @foreach($slider as $sliders)
                <div class="carousel-item {{ $item_active }}">
                    <a href="{{ $sliders['link'] }}">
                        <div class="img-wrapper">
                            <img src="{{ $sliders['image'] }}" class="d-block w-100" alt="{{ $sliders['image'] }}"/>
                        </div>
                    </a>
                </div>

                <?php $item_active = ''; ?>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselHome"
                data-bs-slide="prev">
            <span class="bi-arrow-left-circle-fill" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselHome"
                data-bs-slide="next">
            <span class="bi-arrow-right-circle-fill" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

