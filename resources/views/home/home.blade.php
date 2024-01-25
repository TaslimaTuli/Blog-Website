<!DOCTYPE html>
<html lang="en">
   <head>
    @include('home.homeCss')
   </head>
   <body>
      <!-- header section start -->
      <div class="header_section">
        @include('home.homeHeader')
         <!-- banner section start -->
        @include('home.banner')

         <!-- banner section end -->
      </div>
      <!-- header section end -->
      <!-- services section start -->
      @include('home.service')
      <!-- services section end -->
      <!-- about section start -->
     @include('home.about')
      <!-- about section end -->

      <!-- footer section start -->
      @include('home.footer')
   </body>
</html>
