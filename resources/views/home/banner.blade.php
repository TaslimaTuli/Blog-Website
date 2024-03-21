{{--
<div class="banner_section layout_padding">
            <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
               <div class="carousel-inner">
                  <div class="carousel-item active">
                     <div class="container">
                        <h1 class="banner_taital">Admin Post</h1>
                        @foreach ($data as $data)
                        <p class="banner_text">{{ $data->title }}</p>
                        <div class="read_bt"><a href="#">Read More</a></div>
                     </div>
                  </div>
                  <div class="carousel-item">
                     <div class="container">
                        <h1 class="banner_taital">Admin Post</h1>
                        <p class="banner_text">{{ $data->title }}</p>
                        <div class="read_bt"><a href="#">Read More</a></div>
                     </div>
                  </div>
                  <div class="carousel-item">
                     <div class="container">
                        <h1 class="banner_taital">Admin Post</h1>
                        <p class="banner_text">{{ $data->title }}</p>
                        @endforeach
                        <div class="read_bt"><a href="#">Read More</a></div>
                     </div>
                  </div>

               </div>

            </div>

</div>

 --}}

<div class="banner_section layout_padding">
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            @foreach ($data as $item)
                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                    <div class="container">
                        <h1 class="banner_taital">Admin Post</h1>
                        <p class="banner_text">{{ $item->title }}</p>
                        <div class="btn_main"><a href="{{ url('read_more', $item->id) }}">Read More</a></div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

