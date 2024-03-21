<div class="services_section layout_padding">
    <div class="container">
         <h1 class="services_taital">Latest Posts</h1>
         {{-- <p class="services_text">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration</p> --}}

         <div class="services_section_2">
             <div class="row">
                 @foreach ($data->reverse()->take(6) as $data)
                     <div class="col-md-4">
                         {{-- <div><img src="/postImage/{{ $data->image }}" class="services_img"></div> --}}
                         @if ($data->image)
                             <div><img src="/postImage/{{ $data->image }}" class="services_img"></div>
                         @else
                             <div><img src="/postImage/no-image.png" class="services_img"></div>
                         @endif
                         <h2>{{ $data->title }}</h2>
                         <h4>Posted by <b>{{ $data->name }}</b></h4>
                         <div class="btn_main"><a href="{{ url('read_more', $data->id) }}">Read More</a></div>
                     </div>
                 @endforeach
             </div>
         </div>

    </div>
</div>
