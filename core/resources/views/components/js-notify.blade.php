@props(['livewire' => false])
@push('style')
    <link rel="stylesheet" href="{{ asset('/asset/static/pnotify/dist/pnotify.css') }}">
    <link rel="stylesheet" href="{{ asset('/asset/static/pnotify/dist/pnotify.brighttheme.css') }}">
@endpush
@push('script')
    <script src="{{ asset('/asset/static/pnotify/dist/pnotify.js') }}"></script>

    @foreach (session('notify') ?? [] as $msg)
        <script>
            (function($) {
                "use strict";
                new PNotify({
                    type: '{{ $msg[0] }}',
                    text: '{{ __($msg[1]) }}'
                });
            })
            (jQuery);
        </script>
    @endforeach

    @php
        $collection = collect($errors->all());
        $errors = $collection->unique();
    @endphp

    <script>
        (function($) {
            "use strict";
            @foreach ($errors ?? [] as $error)
                new PNotify({
                    type: 'default',
                    text: '{{ __($error) }}'
                });
            @endforeach
        })(jQuery);
    </script>

    <script>
        "use strict";

        function notify(status, message) {
            new PNotify({
                type: status,
                text: message
            });
        }
    </script>

    @if ($livewire)
        <script>
            (function($){
                Livewire.on('showToast', function(type, text){
                    new PNotify({
                        type:type,
                        text:text,
                    })
                })
            })(jQuery)
        </script>
    @endif

@endpush
