@extends('layouts.app')
@section('title')
  Store Category Page 
@endsection
@section('content')
  <!-- Page Content -->
    <div class="page-content page-home">
      <section class="store-trend-categories">
        <div class="container">
          <div class="row">
            <div class="col-12" data-aos="fade-up">
              <h5>All Categories</h5>
            </div>
          </div>
          <div class="row">
              {{-- $incrementCategory berfungsi utk menambahkan delay data aos --}}
            @php
              $incrementCategory = 0
            @endphp

            {{-- fungsi forelse utk looping data --}}
            @forelse ($categories as $category)
                <div
                  class="col-6 col-md-3 col-lg-2"
                  data-aos="fade-up"
                  data-aos-delay="{{ $incrementCategory+= 100 }}"
                >
 
                  {{--   "{{ route('categories-details', $category->slug) }}   --}}
                  <a href="{{ route('categories-detail', $category->slug) }}" class="component-categories d-block">
                    <div class="categories-image">
                      <img
                        src="{{ Storage::url($category->photo) }}"
                        alt="Gadgets Categories"
                        class="w-100"
                      />
                    </div>
                    <p class="categories-text">{{ $category->name }}</p>
                  </a>
                </div>

            @empty
              <div class="col-12 text-center py-5" data-aos="fade-up" data-aos-delay="100">
                Category tidak tersedia
              </div>
            @endforelse

          </div>
        </div>
      </section>

      <section class="store-new-products">
        <div class="container">
          <div class="row">
            <div class="col-12" data-aos="fade-up">
              <h5>All Products</h5>
            </div>
          </div>

          <div class="row">
                {{-- $incrementProduct berfungsi utk menambahkan delay data aos --}}
                @php
                  $incrementProduct = 0
                @endphp
                @forelse ($products as $product)
                    <div
                      class="col-6 col-md-4 col-lg-3"
                      data-aos="fade-up"
                      data-aos-delay="{{ $incrementProduct+= 100 }}"
                    >

                      {{-- {{ route('detail', $product->slug) }} --}}
                      <a href="{{ route('detail', $product->slug) }}" class="component-products d-block">
                        <div class="products-thumbnail">
                          <div
                            class="products-image"
                            style="
                              @if($product->product_galleries->count())
                                background-image: url('{{ Storage::url($product->product_galleries->first()->photos) }}')
                              @else
                                background-color: #eee
                              @endif
                            "
                          ></div>
                        </div>
                        <div class="products-text">{{ $product->name }}</div>
                        <div class="products-price">Rp {{ $product->price }}</div>
                      </a>
                    </div>
                    
                @empty
                    <div class="col-12 text-center py-5" data-aos="fade-up" data-aos-delay="100">
                      Product tidak tersedia
                    </div>                
                @endforelse  
          </div>

          <div class="row">
            <div class="col-12 mt-4 text-right">
              {{ $products->links() }}
            </div>
          </div>

        </div>
      </section>
      <!-- ###### // selesai TUTORIAL backup Ke 1 // #####  -->
    </div>
@endsection