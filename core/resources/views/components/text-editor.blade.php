@props(['livewire' => false])
@push('style')
    <link rel="stylesheet" href="{{ asset('/asset/static/summernote/summernote-lite.css') }}">
@endpush
@push('script')
    <script src="{{ asset('/asset/static/summernote/summernote-lite.js') }}"></script>
    @if ($livewire)
        <script>
            $(document).ready(function() {
                let textarea = $('textarea');
                textarea.summernote({
                    callbacks: {
                        onChange: function(contents, $editable) {
                            const model = $(this).attr('wire:model');
                            @this.set(model, contents);
                        }
                    }
                });

            });
        </script>
    @else
        <script>
            $(document).ready(function() {
                $('textarea').summernote({
                    minHeight: 350,
                    autoFocus: true,

                });
            });
        </script>
    @endif
@endpush
