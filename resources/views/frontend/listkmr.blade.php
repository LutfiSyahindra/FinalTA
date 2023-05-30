@extends('frontend.layouts.mainds')
@section('content')
<!-- top Destination starts -->
<section class="trending pt-6 pb-0 bg-lgrey">
    <div class="container">
        <div class="list-results d-flex align-items-center justify-content-between">
            <div class="list-results-sort">
                <p class="m-0">Showing 1-5 of 80 results</p>
            </div>
            <div class="click-menu d-flex align-items-center justify-content-between">
                <div class="change-list me-2"><a href="tour-list.html"><i class="fa fa-bars rounded"></i></a></div>
                <div class="change-grid f-active me-2"><a href="tour-grid.html"><i class="fa fa-th rounded"></i></a>
                </div>
                <div class="sortby d-flex align-items-center justify-content-between ml-2">
                    <select class="niceSelect">
                        <option value="1">Sort By</option>
                        <option value="2">Average rating</option>
                        <option value="3">Price: low to high</option>
                        <option value="4">Price: high to low</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach ($availableRooms as $item)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="trend-item rounded box-shadow">
                    <div class="trend-image position-relative">
                        <img src="{{ asset('storage/backend/assets/images/room/'.$item->room->img) }}"
                            alt="{{ $item->room }}" class="">
                        <div class="color-overlay"></div>
                    </div>
                    <div class="trend-content p-4 pt-5 position-relative">
                        <h5 class="theme mb-1"><i class="flaticon-location-pin"></i> Room</h5>
                        <h3 class="mb-1"><a href="{{ route('detail.show', $item->room_id) }}">{{ $item->room->room
                                }}</a></h3>
                        <p class=" border-b pb-2 mb-2">{{ $item->room->deskripsi }}</p>
                        <div class="entry-meta">
                            <div class="entry-author d-flex align-items-center">
                                <p class="mb-0"><span class="theme fw-bold fs-5"> Rp {{
                                        number_format($item->room->harga, 0, ',', '.') }}</span> | Per Night</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- top Destination ends -->
@endsection