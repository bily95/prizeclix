@extends('admin.layout.primary')
@section('title', 'Manage Language')
@section('panel')
    <div id="app">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                        <div class="row justify-content-between">
                            <div class="col-md-7">
                                <ul>
                                    <li>
                                        <h5> {{ __($lang->name) }} @lang('Language Keywords')</h5>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-5 mt-md-0 mt-3">
                                <button type="button" data-bs-toggle="modal" data-bs-target="#addModal"
                                    class="btn btn-sm btn-primary box-shadow text-small float-right"
                                    >
                                    <i class="fas fa-plus"></i> @lang('Add New Key') </button>
                            </div>
                        </div>
                        <hr>
                        <x-table :th="['Key', 'value' , '']">
                            @foreach ($json as $k => $language)
                                <tr>
                                    <td data-label="@lang('key')" class="">{{ Str::limit($k, 25) }}</td>
                                    <td data-label="@lang('Value')" class="text-left">
                                        {{ Str::limit($language, 25) }}</td>


                                    <td data-label="@lang('Action')">
                                        <a href="javascript:void(0)" data-bs-target="#editModal" data-bs-toggle="modal"
                                            data-title="{{ $k }}" data-key="{{ $k }}"
                                            data-value="{{ $language }}" class="editModal btn btn-sm btn-primary ml-1"
                                            data-original-title="@lang('Edit')"
                                            >
                                            <i class="fas fa-pen"></i>
                                        </a>

                                        <a href="javascript:void(0)" data-key="{{ $k }}"
                                            data-value="{{ $language }}" data-bs-toggle="modal" data-bs-target="#DelModal"
                                            class="btn btn-sm btn-danger ml-1 deleteKey"
                                            data-original-title="@lang('Remove')"
                                            >
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </x-table>

                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="addModalLabel"> @lang('Add New')</h4>

                    </div>

                    <form action="{{ route('moder.language.store.key', $lang->id) }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="key" class="font-weight-bold">@lang('Key')</label>
                                <input type="text" class="form-control form-control-lg " id="key" name="key"
                                    placeholder="@lang('Key')" value="{{ old('key') }}">

                            </div>
                            <div class="form-group">
                                <label for="value" class="font-weight-bold">@lang('Value')</label>
                                <input type="text" class="form-control form-control-lg" id="value" name="value"
                                    placeholder="@lang('Value')" value="{{ old('value') }}">

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-dark" data-bs-dismiss="modal">@lang('Close')</button>
                            <button type="submit" class="btn btn-primary"> @lang('Save')</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>


        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="editModalLabel">@lang('Edit')</h4>

                    </div>

                    <form action="{{ route('moder.language.update.key', $lang->id) }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group ">
                                <label for="inputName" class="font-weight-bold form-title"></label>
                                <input type="text" class="form-control form-control-lg" name="value"
                                    placeholder="@lang('Value')">
                            </div>
                            <input type="hidden" name="key">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-dark"
                                data-bs-dismiss="modal">@lang('Close')</button>
                            <button type="submit" class="btn btn-primary">@lang('Update')</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>


        <!-- Modal for DELETE -->
        <div class="modal fade" id="DelModal" tabindex="-1" role="dialog" aria-labelledby="DelModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="DelModalLabel"><i class='fa fa-trash'></i> @lang('Delete')</h4>

                    </div>
                    <div class="modal-body">
                        <strong>@lang('Are you sure to delete?')</strong>
                    </div>
                    <form action="{{ route('moder.language.delete.key', $lang->id) }}" method="post">
                        @csrf
                        <input type="hidden" name="key">
                        <input type="hidden" name="value">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-dark" data-bs-dismiss="modal"
                                >@lang('Close')</button>
                            <button type="submit" class="btn btn-danger "
                                >@lang('Delete')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script')
<script>
    (function($) {
        "use strict";
        $(document).on('click', '.deleteKey', function() {
            var modal = $('#DelModal');
            modal.find('input[name=key]').val($(this).data('key'));
            modal.find('input[name=value]').val($(this).data('value'));
        });
        $(document).on('click', '.editModal', function() {
            var modal = $('#editModal');
            modal.find('.form-title').text($(this).data('title'));
            modal.find('input[name=key]').val($(this).data('key'));
            modal.find('input[name=value]').val($(this).data('value'));
        });

    })(jQuery);
</script>
@endpush
