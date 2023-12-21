@props(['livewire' => false])
@push('style')
    <link rel="stylesheet" href="{{ asset('/asset/static/checkbox/bootstrap-toggle.min.css') }}">
    <style>
        .toggle.btn {
            min-width: 100px;
            height: 32px !important;
        }
    </style>
@endpush
@push('script')
    <script src="{{ asset('/asset/static/checkbox/bootstrap-toggle.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('input[type="checkbox"]').bootstrapToggle({
                // on: "on",
                // off: "off",
                onstyle: "info",
                offstyle: "dark",
                size:"small",
            });
        });
    </script>
    @if ($livewire)
        <script>
            let checkbox = $('input[type="checkbox"]');

            checkbox.bootstrapToggle({
                // on: "on",
                // off: "off",
                onstyle: "info",
                offstyle: "dark",
                size:"small",
            });

            $.each(checkbox, function(index, item) {
                if ($(item).data('value') == 'on' || $(item).data('value') == '1') {
                    $(item).bootstrapToggle('on')
                }else{
                    $(item).bootstrapToggle('off')
                }
            })


            checkbox.change(function() {
                let model = $(this).attr('model');
                let wireModel = $(this).attr('wire:model');
                if(typeof(model) !== 'undefined'){
                    @this.set(model, $(this).prop('checked') ? 'on' : 'off');
                }else if(typeof(wireModel) !== 'undefined'){
                    @this.set(wireModel, $(this).prop('checked') ? '1' : '0');
                }else{
                    console.log('Invalid wire model');
                }
            });
        </script>
    @endif
@endpush
