@extends('admin.layout.primary')
@section('title', __('Offers'))
@section('panel')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                Manage Offers
            </h3>
        </div>
        <div class="card-body">
            <div class="table-form mb-2">
                <div class="row">
                    <form action="" method="GET">
                        <div class="col-lg-6 col-md-6 mb-2">
                            <div class="d-flex align-items-center justify-content-center">
                                @if (request()->query())
                                    <a class="badge bg-info"
                                        href="{{ route('moder.offers-network.manage-offers.list') }}">
                                        reset
                                    </a>
                                @endif
                                <input type="search" name="s" id="s" class="form-control"
                                    placeholder="search by offer title" value="{{ request('s') }}" />
                                <button type="submit" class="btn btn-primary btn-sm m-auto">
                                    <i class="fas fa-search"></i>
                                </button>

                            </div>
                        </div>
                    </form>
                    <div class="col-lg-3 col-sm-6">
                        <select name="is_completed" class="form-control" onchange="filterBy(this)">
                            <option value="all">UnCompleted/Completed</option>
                            <option value="yes" @if (request('is_completed') == 'yes') selected="true" @endif>Completed
                            </option>
                            <option value="no" @if (request('is_completed') == 'no') selected="true" @endif>UnCompleted
                            </option>
                        </select>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <select name="is_active" class="form-control" onchange="filterBy(this)">
                            <option value="all">InActive/Active</option>
                            <option value="yes" @if (request('is_active') == 'yes') selected="true" @endif>Active</option>
                            <option value="no" @if (request('is_active') == 'no') selected="true" @endif>InActive
                            </option>
                        </select>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <select name="is_banner" class="form-control" onchange="filterBy(this)">
                            <option value="all">banner/not banner</option>
                            <option value="yes" @if (request('is_banner') == 'yes') selected="true" @endif>Is banner
                            </option>
                            <option value="no" @if (request('is_banner') == 'no') selected="true" @endif>not in banner
                            </option>
                        </select>
                    </div>

                    <div class="col-lg-3 col-sm-6">
                        <select name="provider" class="form-control" onchange="filterBy(this)">
                            <option value="all">Select Provider</option>
                            @foreach ($providers as $provider)
                                <option value="{{ $provider->name }}"
                                    @if (request('provider') == $provider->name) selected="true" @endif>{{ $provider->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

            </div>
            <x-table :th="['#', 'Provider', 'Title', 'Status', 'Completed', 'Is Banner', '']">
                @foreach ($offers as $index => $item)
                    <tr>
                        <td>{{ ++$index }}</td>
                        <td>{{ $item->provider->name }}</td>
                        <td>{{ Str::limit($item->name, 15) }}</td>

                        <td>{!! bolToText($item->is_active, true, 'Inactive', 'Active') !!}
                            <a href="{{ route('moder.offers-network.manage-offers.active', $item->id) }}"
                                class="btn btn-sm btn-default px-2 py-0">
                                <i class="fas fa-exchange-alt"></i>
                            </a>
                        </td>

                        <td>{!! bolToText($item->is_completed, true, 'NotCompleted', 'Completed') !!}
                            <a href="{{ route('moder.offers-network.manage-offers.completed', $item->id) }}"
                                class="btn btn-sm btn-default px-2 py-0">
                                <i class="fas fa-exchange-alt"></i>
                            </a>
                        </td>
                        <td>{!! bolToText($item->is_banner, true, 'No', 'Yes') !!}
                            <a href="{{ route('moder.offers-network.manage-offers.banner', $item->id) }}"
                                class="btn btn-sm btn-default px-2 py-0">
                                <i class="fas fa-exchange-alt"></i>
                            </a>
                        </td>
                        <td>
                            <button type="button" class="btn btn-sm btn-danger deleteBtn"
                                data-offer-id="{{ $item->id }}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </x-table>

            @if (request()->query())
                {{ $offers->appends(request()->query())->links() }}
            @else
                {{ $offers->links() }}
            @endif

        </div>
    </div>

    {{-- Delete Modal --}}
    <div class="modal fade" id="offerModalDelete" tabindex="-1" role="dialog" aria-labelledby="offerModalDeleteLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-normal" id="offerModalDeleteLabel">Manage Affiliate Network</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="{{ route('moder.offers-network.manage-offers.delete') }}">
                        <div class="modal-body">
                            <p>Are you sure to delete this offer?</p>
                            <p>If the offer has submissions, that may be break site</p>
                            <p>Recommended: disable it</p>
                            <x-bs::input type="text" name="id" type='hidden' requied />
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Continue</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <x-js-notify />
    <x-select2 />
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            $('.deleteBtn').click(function(e) {
                e.preventDefault();
                const $id = $(this).data('offer-id');
                $('input[name="id"]').val($id);
                $('.modal#offerModalDelete').modal('show');
            })
        })

        function filterBy($type) {
            let selectedValue = $($type).val();
            let name = $($type).attr('name');
            let currentUrl = window.location.href;

            // Parse the current URL query parameters
            let urlParams = new URLSearchParams(currentUrl.split('?')[1]);

            if (urlParams.has(name)) {
                // Check if the selected filter is the same as the current one
                if (urlParams.get(name) === selectedValue) {
                    // If they are the same, remove the filter from the URL
                    urlParams.delete(name);
                } else {
                    // If they are different, update the filter value
                    urlParams.set(name, selectedValue);
                }
            } else {
                // If the filter does not exist in the URL, add it
                urlParams.set(name, selectedValue);
            }

            // Reconstruct the URL with the updated query parameters
            let newUrl = window.location.origin + window.location.pathname;
            if (urlParams.toString() !== "") {
                newUrl += "?" + urlParams.toString();
            }

            // Navigate to the new URL
            window.location.href = newUrl;
        }
    </script>
@endpush
