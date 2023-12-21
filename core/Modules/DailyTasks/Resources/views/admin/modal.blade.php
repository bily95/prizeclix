{{-- Create Modal --}}
<div class="modal fade" id="storeLevel" tabindex="-1" role="dialog" aria-labelledby="storeLevelLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-normal" id="storeLevelLabel">Add New Task</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('moder.dailytasks.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <x-bs::input type="string" name="title" label="Task Title"
                            placeholder="Earn xxx to claim XXX" />
                        <div class="form-group">
                            <label for="type">@lang('Type')</label>
                            <select class="form-control" name="type">
                                <option value="earn">@lang('Earn')</option>
                                <option value="offer">@lang('Offer')</option>
                            </select>
                        </div>
                        <x-bs::input type="number" name="reward" label="Task Rewards" placeholder="100,200,300...." />
                        <div class="require">
                            <x-bs::input type="number" name="require" label="tasks Requires Earning coins"
                                placeholder="100,200,300...." />
                        </div>
                        <div class="condition">
                            <x-bs::input type="string" name="condition" label="tasks Requires completed Offers"
                                placeholder="1,2,8...." />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@if (Request::routeIs('moder.dailytasks.edit'))
    <x-select2 />
@else
    <x-select2 modal="storeLevel" />
@endif
@push('script')
    <script>
        $(document).ready(function() {
            const $typeSelect = $('[name="type"]');
            const $requireDiv = $('div.require');
            const $conditionDiv = $('div.condition');

            function toggleDivs() {
                const value = $typeSelect.val();
                if (value === 'earn') {
                    $requireDiv.show();
                    $conditionDiv.hide();
                } else {
                    $requireDiv.show();
                    $conditionDiv.show();
                }
            }

            $typeSelect.change(toggleDivs);
            toggleDivs(); // Initial execution on page load
        });
    </script>
@endpush
