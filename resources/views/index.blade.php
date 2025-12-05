@extends('components.layouts.theme')

@section('title','HomePage')

@section('content')



<div class="relative w-full bg-black overflow-hidden">
    <div class="relative w-full mx-auto">
        <video 
            class="w-full h-auto object-contain shadow-2xl"
            autoplay
            muted
            playsinline
            id="heroVideo"
        >
            <source src="{{ asset('videos/iphone-video.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>

        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent pointer-events-none"></div>
    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function () {
    const video = document.getElementById('heroVideo');
    if (!video) return;

    // Check if video already played on this page load
    const alreadyPlayed = sessionStorage.getItem('home_video_played');

    if (!alreadyPlayed) {
        // Play video once
        video.play().catch(err => console.log("Autoplay failed:", err));

        // Mark as played
        sessionStorage.setItem('home_video_played', '1');

        // Stop looping (make sure it really plays only once)
        video.addEventListener('ended', () => {
            video.pause();
        });

    } else {
        // Skip video (optional: hide or replace)
        video.currentTime = video.duration; // Jump to end
    }
});
</script>





<div class="bg-gray-100 min-h-screen">
  <br>
    <h1 class="text-xl md:text-4xl font-bold text-center text-gray-900 pt-8 mb-4 drop-shadow-md">
    Welcome to Our Store
</h1>






<div class="max-w-7xl mx-auto p-6 pt-12">
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
    @foreach($products as $product)
      <a href="{{ route('products.show', $product->id) }}" class="block h-full">
        <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300 h-full flex flex-col max-w-xs mx-auto w-full">
          
          <!-- Product Image -->
          <div class="w-full h-64 bg-gray-50 p-4">
            <img 
              src="{{ asset($product->image) }}" 
              alt="{{ $product->name }}" 
              class="w-full h-full object-contain mix-blend-multiply"
              onerror="this.src='{{ asset('images/no-image.png') }}'"
            >
          </div>

          <!-- Product Info -->
          <div class="p-5 flex-grow flex flex-col text-center">
            <div class="mb-2">
              <span class="text-xs font-semibold tracking-wider text-blue-600 uppercase bg-blue-50 px-2 py-1 rounded-full">
                {{ $product->subcategory ?? $product->category }}
              </span>
            </div>

            <h3 class="text-lg font-bold text-gray-900 line-clamp-2 mb-2 flex-grow">
              {{ $product->name }}
            </h3>

            <div class="mt-auto">
              <p class="text-xl font-bold text-gray-900 mb-2">
                <span class="text-sm font-normal text-gray-500 relative top-0.1 mr-0.5">
                    {{ $product->currency }}
                </span>
                {{ number_format($product->price) }}
              </p>

              @if($product->ram || $product->storage)
                <div class="flex items-center justify-center gap-2 text-xs text-gray-500 border-t border-gray-100 pt-3">
                  @if($product->ram)
                    <span class="flex items-center gap-1">
                      <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path></svg>
                      {{ $product->ram }}
                    </span>
                  @endif
                  @if($product->ram && $product->storage)
                    <span class="text-gray-300">|</span>
                  @endif
                  @if($product->storage)
                    <span class="flex items-center gap-1">
                      <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path></svg>
                      {{ $product->storage }}
                    </span>
                  @endif
                </div>
              @endif
            </div>
          </div>
        </div>
      </a>
    @endforeach
  </div>
</div>



<br>
<br>
<br>




  

<hr class="border-t border-gray-300 m-0 p-0">
<div class="w-full flex flex-col items-center text-center px-4 py-10 bg-gradient-to-b from-gray-50 to-white">

    <!-- Title -->
    <h1 class="text-xl md:text-3xl font-semibold text-gray-800 mb-6 tracking-wide">
        Explore Our New Mobile Phones Collection
    </h1>

    <!-- Image Container -->
    <div class="w-full max-w-4xl rounded-xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-[1.01]">
        <img src="../Images/allphones.webp" 
             alt="Mobile Phones Collection"
             class="w-full h-64 md:h-[420px] object-cover">
    </div>

    <!-- Button -->
    <a href="{{ route('products.index') }}"
   class="mt-8 inline-flex items-center gap-2 bg-gray-900 text-white px-8 py-3 rounded-full shadow-md 
          hover:bg-black hover:shadow-xl hover:scale-105 transition-all duration-300">
    Browse Phones 
    <span class="text-lg">→</span>
</a>
</div>
<hr class="border-t border-gray-300 m-0 p-0">
<div class="w-full bg-white py-16">
  <div class="max-w-5xl mx-auto text-center px-4">
    
    <!-- Small Top Text -->
    <p class="text-sm text-gray-500 font-medium mb-2">
      Looking for Delivery?
    </p>

    <!-- Main Heading -->
    <h2 class="text-3xl font-semibold text-gray-800 mb-12">
      Order online, We Bring to your Home
    </h2>

    <!-- 3 Columns -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-12">

      <!-- Fast Delivery -->
      <div class="flex flex-col items-center text-center">
          <svg xmlns="http://www.w3.org/2000/svg" 
    fill="none" viewBox="0 0 24 24" stroke-width="1.5" 
    stroke="currentColor" class="w-16 h-16 mb-4">
    <path stroke-linecap="round" stroke-linejoin="round"
      d="M3 7h10v10H3V7zm10 0h5l3 4v6h-8V7z" />
    <circle cx="7.5" cy="17" r="1.7" />
    <circle cx="16.5" cy="17" r="1.7" />
  </svg>

        <h3 class="text-lg font-semibold text-gray-900 mb-2">
          Fast Delivery
        </h3>
        <p class="text-sm text-gray-600 leading-relaxed">
          within Colombo same day delivery,<br>
          Island wide within 2–3 working Days
        </p>
      </div>

      <!-- Safe Packaging -->
      <div class="flex flex-col items-center text-center">
        <svg xmlns="http://www.w3.org/2000/svg"
    fill="none" viewBox="0 0 24 24" stroke-width="1.5"
    stroke="currentColor" class="w-16 h-16 mb-4">
    <path stroke-linecap="round" stroke-linejoin="round"
      d="M3.75 7.5L12 3l8.25 4.5M3.75 7.5v9L12 21m-8.25-13.5L12 12m0 0l8.25-4.5M12 12v9m8.25-13.5v9L12 21" />
  </svg>

        <h3 class="text-lg font-semibold text-gray-900 mb-2">
          Safe Packaging
        </h3>
        <p class="text-sm text-gray-600 leading-relaxed">
          All our product packaging is safe & secure.<br>
          We really care about every order.
        </p>
      </div>

      <!-- Secure Online Payment -->
      <div class="flex flex-col items-center text-center">
        <svg xmlns="http://www.w3.org/2000/svg" 
             fill="none" viewBox="0 0 24 24" stroke-width="1.5" 
             stroke="currentColor" class="w-16 h-16 mb-4">
          <path stroke-linecap="round" 
            stroke-linejoin="round" 
            d="M2.25 8.25h19.5M4.5 6h15a2.25 
            2.25 0 012.25 2.25v7.5A2.25 2.25 0 
            0119.5 18H4.5A2.25 2.25 0 012.25 
            15.75v-7.5A2.25 2.25 0 014.5 
            6zm3 9.75h.008v.008H7.5v-.008A.008.008 0 
            017.508 15.75zm3 0h.008v.008H10.5v-.008a.008.008 
            0 01.008-.008z" />
        </svg>

        <h3 class="text-lg font-semibold text-gray-900 mb-2">
          Secure Online Payment
        </h3>
        <p class="text-sm text-gray-600 leading-relaxed">
          Highly Secured Payment Gateway<br>
          Trusted by Millions of People, Sri Lanka
        </p>
      </div>

    </div>
  </div>
</div>
<hr class="border-t border-gray-200 m-0 p-0">


@endsection