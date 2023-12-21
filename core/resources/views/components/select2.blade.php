@props([
    'modal' => false,
    'search' => false,
])



@push('style')
    <link rel="stylesheet" href="{{ asset('/asset/static/select2/css/select2.min.css') }}">
    <style>
        .select2-container {
            min-width: 100%;
            padding: 0px;
            color: #212529;
        }

        .select2-container--default .select2-selection--single {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            min-height: 35px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 30px;
            position: absolute;
            top: 1px;
            right: 1px;
            width: 35px;
        }
    </style>
@endpush
@push('script')
    <script src="{{ asset('/asset/static/select2/js/select2.min.js') }}"></script>
    @if ($modal)
        <script>
            $(document).ready(function() {
                $('select.form-control').select2({
                    dropdownParent: $('{{ '#' . $modal }}'),
                    {{ $search ? 'minimumResultsForSearch: 1' : 'minimumResultsForSearch: Infinity' }},
                });
            });
        </script>
    @else
        <script>
            $(document).ready(function() {
                $('select.form-control').select2({
                    {{ $search ? 'minimumResultsForSearch: 1' : 'minimumResultsForSearch: Infinity' }},
                });
            });
        </script>
    @endif


@endpush
