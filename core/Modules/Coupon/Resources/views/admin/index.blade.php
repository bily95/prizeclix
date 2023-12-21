@extends('admin.layout.primary')
@section('title', __('Coupon System Config'))
@section('panel')
    <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal"
        data-bs-target="#couponModal">@lang('Create New')</button>
    <div class="clearfix"></div>
    <div class="table-responsive-sm">
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Coupon</th>
                    <th>Rewards</th>
                    <th>Paied</th>
                    <th>clicked/Limit</th>
                    <th>Status</th>
                    <th>Expire At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($coupons as $index => $item)
                    <tr>
                        <td>{{ ++$index }}</td>
                        <td>
                            <a href="{{ route('moder.coupon.history') }}?s={{ $item->token }}" target="_blank">
                                {{ $item->token }}
                            </a>
                        </td>
                        <td>{{ showAmount($item->rewards,0) }}</td>
                        <td>{{ showAmount($item->log->count() * $item->rewards,0) }}</td>
                        <td>{{ $item->log->count() }}/{{ $item->limit }}</td>
                        <td>
                            @if ($item->log->count() >= $item->limit)
                                <span class="px-2 bg-info">Completed</span>
                            @elseif($item->expire_at <= today())
                                <span class="px-2 bg-info">Expired</span>
                            @elseif($item->status == 0)
                                <span class="px-2 bg-primary">Disabled</span>
                            @else
                                <span class="px-2 bg-warning">Active</span>
                            @endif
                        </td>
                        <td>{{ showDateTime($item->expire_at,'m-d-y') }}</td>
                        <td>
                            <div class="dropdown dropstart">
                                <button class="btn btn-info btn-sm dropdown-toggle" type="button"
                                    id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-list-dots"></i>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item"
                                            href="{{ route('moder.coupon.change-status', $item->id) }}">
                                            @if ($item->status)
                                                Disable
                                            @else
                                                Enable
                                            @endif
                                        </a></li>
                                    <li><a class="dropdown-item edit_coupon" href="#"
                                            data-coupon-id="{{ $item->id }}">Edit</a></li>
                                    <li><a class="dropdown-item"
                                            href="{{ route('moder.coupon.destroy', $item->id) }}">Delete</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $coupons->links() }}
    </div>
    {{-- Coupon Modal --}}
    <div class="modal fade" id="couponModal" tabindex="-1" aria-labelledby="couponModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="couponModalLabel">Create New</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('moder.coupon.store') }}" method="POST" id="couponForm">
                    @csrf
                    <div class="modal-body">
                        <x-bs::input type="text" name="token" label="Coupon Code" />
                        <br>
                        <x-bs::input type="number" name="rewards" label="Coupon Rewards" />
                        <br>
                        <x-bs::input type="number" name="limit" label="Coupon Limit" />
                        <br>
                        <div class="form-group">
                            <label for="date">Expire At</label>
                            <input type="date" name="expire_at" class="form-control" value="{{ date('Y-d-m') }}" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('script')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
        <script>
            $(document).ready(function() {
                $('a.edit_coupon').click(function(e) {
                    e.preventDefault()
                    let couponId = $(this).data('coupon-id');
                    $.ajax({
                        url: "{{ route('moder.coupon.edit') }}",
                        type: "GET",
                        dataType: "JSON",
                        data: {
                            id: couponId
                        },
                        success: function(res) {
                            if (res.coupon) {
                                const formInput = 'form#couponForm input';
                                // update form elements values
                                $(formInput + '[name="token"]').val(res.coupon.token);
                                $(formInput + '[name="rewards"]').val(res.coupon.rewards);
                                $(formInput + '[name="limit"]').val(res.coupon.limit);
                                var expire_at = moment(res.coupon.expire_at).format('YYYY-MM-DD');
                                $(formInput + '[name="expire_at"]').val(expire_at);
                                $('form#couponForm').append(
                                    '<input type="hidden" name="id" value="' + res.coupon.id +
                                    '"/>');

                                // update form action
                                $('form#couponForm').attr('action',
                                    '{{ route('moder.coupon.update') }}');

                                // update modal title
                                $('.modal#couponModal #couponModalLabel').html('Update Coupon');

                                // show modal
                                $('.modal#couponModal').modal('show');

                            } else {
                                notify('error', 'Something goes wrong');
                            }
                        },
                        error: function(xml, error, message) {
                            notify('error', 'Something goes wrong');
                        }
                    })
                })
            })
        </script>
    @endpush
@endsection
<x-js-notify />
