@push('style')
    <link rel="stylesheet" href="{{ asset('/asset/static/carsoul/bxslider.css') }}">
    <style>
        .bx-wrapper {
            -moz-box-shadow: 0 0 5px #ccc;
            -webkit-box-shadow: 0 0 5px #ccc;
            box-shadow: 0 0 0px #ccc;
            border: 5px solid transparent;
            background: transparent;
            max-width: unset !important;

        }

        body.dark-theme .bx-wrapper {
            background: transparent !important;
        }

        .bx-wrapper .bx-controls-direction a {
            z-index: 9;
        }

        .banner-image {
            position: relative;
            background: #ddd;
            border-radius: 15px 15px 0 0;
            overflow: hidden;
        }

        a.offerClick {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            backdrop-filter: blur(5px);
            display: none;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            font-size: 4rem;
        }

        .banner-image:hover a.offerClick {
            display: flex;
        }

        .dropdown.my-3.categories a {
            width: 100%;
            display: block;
            text-decoration: none;
            color: #fff;
            background: #222925;
            padding: 9px;
            border-radius: 6px;
            margin: 0;
        }

        .dropdown.my-3.categories a:hover {
            color: #ccc;
            background: #121714;
        }

        .offers-devices {
            position: absolute;
            display: flex;
            align-items: center;
            background: #383d52d6;
            font-size: 1rem;
            color: #ddd;
            justify-content: center;
            gap: 5px;
            width: auto;
            padding: 5px;
            border-radius: 5px;
            margin: 0 0 0 12px;
        }

        .banner-image img.lazyloaded {
            height: 100px;
            width: 100%;
            padding: 5px;
            border-radius: 15px;
        }

        .dropdown.my-3.categories>a:hover:first-child {
            background: #339966;
        }

        .dropdown.my-3.categories ul {
            width: 100%;
            background: #222925;
        }

        .card.banner-card p {
            white-space: nowrap;
            overflow: hidden;
            margin-right: 7px;
        }

        .home_slider.banner-slider p {
            font-size: 0.8rem;
            white-space: nowrap;
            overflow: hidden;
        }

        /* Modal */

        div#offerDetailsModalContent .modal-header {
            backdrop-filter: blur(5px);
            background-repeat: no-repeat;
            background-size: 100% 100%;
            padding: 0;
            /* white-space: nowrap; */
            overflow: hidden;
        }

        div#offerDetailsModalContent .modal-header .modal-header-content {
            backdrop-filter: blur(5px);
            display: flex;
            padding: 15px 13px;
            margin: 0;
            width: 100%;
            height: 100%;
            background-color: #194c3369;
            min-height: 160px;
        }

        .d-flex.device-icons.my-2 {
            background: #292d3e94;
            width: auto;
            max-width: 130px;
            align-items: center;
            justify-content: center;
            border-radius: 3px;
        }

        .device-icons i {
            background: unset;
            padding: 10px 3px;
            border-radius: 15px;
            font-size: 15px;
        }

        div#offerDetailsModalContent .modal-body {
            max-height: 350px;
            overflow: auto;
            font-size: 12px;
        }
    </style>
@endpush
@push('script')
    <script src="{{ asset('/asset/static/carsoul/bxslider.min.js') }}"></script>
    <script src="{{ asset('/asset/static/carsoul/lazysizes.min.js') }}" async=""></script>
    <script>
        $(document).ready(function() {

            $(document).on('click', 'a.offerClick', function(e) {
                e.preventDefault();
                let $id = $(this).data('offer-id');
                //console.log($id);
                $.ajax({
                    url: "{{ route('user.offer-network.details') }}",
                    data: {
                        id: $id
                    },
                    dataType: "json",
                    type: "GET",
                    success: function(res) {
                        if (res.html) {
                            $('#offerDetailsModalContent').html(res.html);
                            $('.modal#offerDetailsModal').modal('show');
                            $('[title]').tooltip();
                        } else {
                            alert('Something goes wrong');
                        }
                    }
                })

            })

            $('.banner_slider').bxSlider({
                auto: true,
                minSlides: 2,
                maxSlides: 5,
                slideWidth: 250,
                slideMargin: 10,
                stopAutoOnClick: true,
                autoHover: true,
                touchEnabled: false,
            });
            $('.home_slider').bxSlider({
                auto: true,
                minSlides: 3,
                maxSlides: 4,
                slideWidth: 120,
                slideMargin: 10,
                stopAutoOnClick: true,
                autoHover: true,
                touchEnabled: false,
            });
        });
    </script>

    @if (isset($category->id) && isset($offers))
        <script>
            var nextPage = {{ $offers->currentPage() + 1 }};
            var lastPage = {{ $offers->lastPage() }};
            var categoryId = {{ $category->id }};

            $(document).ready(function() {
                $(window).scroll(function() {
                    if ($(window).scrollTop() + $(window).height() >= $(document).height() - 300) {
                        loadMoreOffers();
                    }
                });
            });

            function loadMoreOffers() {
                if (nextPage <= lastPage) {
                    $('#loading-indicator').show();

                    $.ajax({
                        url: '{{ route('user.offer-network.browse', [$category->id, $category->name]) }}',
                        data: {
                            page: nextPage,
                            categoryId: categoryId
                        },
                        success: function(data) {
                            $('#offers-container').append(data);
                            nextPage++;
                            $('#loading-indicator').hide();
                        }
                    });
                }
            }
        </script>
    @endif
    @if (isset($offers))
        <script>
            $(document).ready(function() {
                let debounceTimer;

                $('input[type="search"]').on('input', function() {
                    clearTimeout(debounceTimer);
                    debounceTimer = setTimeout(function() {
                        let name = $('input[type="search"]').val();
                        $.ajax({
                            url: "{{ route('user.offer-network.index') }}",
                            data: {
                                name: name,
                            },
                            success: function(data) {
                                $('#offers-container').html(data);
                                $('#loading-indicator').hide();
                            }
                        });
                    }, 300); // Adjust the debounce time as needed (e.g., 300 milliseconds)
                });

                $('select[name="orderBy"]').on('change', function() {
                    let orderBy = $(this).val();
                    $.ajax({
                        url: "{{ route('user.offer-network.index') }}",
                        data: {
                            orderBy: orderBy,
                        },
                        success: function(data) {
                            $('#offers-container').html(data);
                            $('#loading-indicator').hide();
                        }
                    });
                });
            });


            var nextPage = {{ $offers->currentPage() + 1 }};
            var lastPage = {{ $offers->lastPage() }};

            $(document).ready(function() {
                $(window).scroll(function() {
                    if ($(window).scrollTop() + $(window).height() >= $(document).height() - 300) {
                        loadMoreOffers();
                    }
                });
            });

            function loadMoreOffers() {
                if (nextPage <= lastPage) {
                    $('#loading-indicator').show();

                    $.ajax({
                        url: '{{ route('user.offer-network.index') }}',
                        data: {
                            page: nextPage,
                        },
                        success: function(data) {
                            $('#offers-container').append(data);
                            nextPage++;
                            $('#loading-indicator').hide();
                        }
                    });
                }
            }
        </script>
    @endif
@endpush
