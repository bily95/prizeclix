@extends('admin.layout.primary')
@section('title', __('Offers Categories'))
@section('panel')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title float-start">
                Manage Offer Categories
            </h3>
            <button type="button" class="btn btn-primary float-end" data-bs-target="#categoryModal" data-bs-toggle="modal">
                Create New
            </button>
            <div class="clearfix"></div>
        </div>
        <div class="card-body">
            <x-table :th="['#', 'Name', 'Status', 'At Home', '']">
                @foreach ($categories as $index => $item)
                    <tr>
                        <td>{{ ++$index }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{!! bolToText($item->is_active, true, 'InActive', 'Active') !!}
                            <a href="{{ route('moder.offers-network.category.active-status', $item->id) }}"
                                class="btn btn-sm btn-default px-2 py-1">
                                <i class="fas fa-exchange-alt"></i>
                            </a>
                        </td>

                        <td>{!! bolToText($item->at_home, true, 'Disabled', 'Enabled') !!}
                            <a href="{{ route('moder.offers-network.category.home-status', $item->id) }}"
                                class="btn btn-sm btn-default px-2 py-1">
                                <i class="fas fa-exchange-alt"></i>
                            </a>
                        </td>
                        <td>
                            <button type="button" class="btn btn-sm btn-info editBtn"
                                data-category-id="{{ $item->id }}">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-danger deleteBtn"
                                data-category-id="{{ $item->id }}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </x-table>
            {{ $categories->links() }}
        </div>
    </div>


    {{-- Categories modal create and edit --}}
    <div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-normal" id="categoryModalLabel">Add New Task</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('moder.offers-network.category.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <x-bs::input type="text" name="name" label="Offer Title" placeholder="Survey, Offerwall"
                                requied autofocus />
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
    {{-- Delete Modal --}}
    <div class="modal fade" id="categoryModalDelete" tabindex="-1" role="dialog"
        aria-labelledby="categoryModalDeleteLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-normal" id="categoryModalDeleteLabel">Add New Task</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="{{ route('moder.offers-network.category.delete') }}">
                        <div class="modal-body">
                            <p>Are you sure to delete this category?</p>
                            <p>If the category has offers, that may be break site</p>
                            <p>Recommended: disable it or edit/rename it</p>
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
@endsection
<x-js-notify />
@push('script')
    <script>
        $(document).ready(function() {
            $('.editBtn').click(function(e) {
                e.preventDefault()
                const $id = $(this).data('category-id');
                $.ajax({
                    url: "{{ route('moder.offers-network.category.show') }}",
                    data: {
                        id: $id
                    },
                    type: "GET",
                    dataType: "JSON",
                    success: function(res) {
                        console.log(res);
                        if (res.category) {
                            $('input[name="name"]').val(res.category.name);
                            $('form').append(
                                `<input type="hidden" name="id" value="${res.category.id}" />`
                            );
                            $('form').attr('action',
                                "{{ route('moder.offers-network.category.update') }}");
                            $('#categoryModalLabel').html('Update ' + res.category.name)
                            $('.modal#categoryModal').modal('show');
                        }
                    }
                });
            })

            $('.deleteBtn').click(function(e) {
                e.preventDefault();
                const $id = $(this).data('category-id');
                $('input[name="id"]').val($id);
                $('.modal#categoryModalDelete').modal('show');
            })
        })
    </script>
@endpush
