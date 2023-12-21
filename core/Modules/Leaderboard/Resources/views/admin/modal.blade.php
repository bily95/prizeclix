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
                <form action="{{ route('moder.leaderboard.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="type">@lang('Type')</label>
                            <select class="form-control" name="type">
                                <option value="daily">@lang('Daily')</option>
                                <option value="monthly">@lang('Monthly')</option>
                            </select>
                        </div>
                        <x-bs::input type="number" name="reward" label="Level Rewards"
                            placeholder="100,200,300...." />
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