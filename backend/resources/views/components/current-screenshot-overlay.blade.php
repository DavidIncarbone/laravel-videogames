<div id="current-screenshot-overlay" class="d-none">
    <div class="overlay-img-container d-flex flex-column fs-5">
        <h5 class="text-white text-center mb-3">{{ $overlayTitle }}</h5>
        <div id="screenshot-details" class="w-100 mb-3 d-flex justify-content-center align-items-center ">
            <div><i id="arrow-left-current" class="fa-solid fa-circle-left"></i>
            </div>
            {{ $img }}
            <div><i id="arrow-right-current" class="fa-solid fa-circle-right"></i>
            </div>
        </div>
        <div id="index-current-screenshot" class="text-center text-white">{{ $index }}</div>
    </div>
</div>
