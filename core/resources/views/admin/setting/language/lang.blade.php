<head>
    <title>Languages </title>
</head>

@extends('admin.layout.primary')
@section('panel')
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card bl-5-primary">
                <div class="card-body">
                    <p class="font-weight-bold text-info">@lang('While you are adding a new keyword, it will only add to this current language only. Please be careful on entering a keyword, please make sure there is no extra space. It needs to be exact and case-sensitive.')</p>
                    <a class="btn btn-sm btn-success box-shadow text-white text-small" data-bs-toggle="modal"
                        data-bs-target="#createModal">
                        <i class="fa fa-fw fa-plus"></i>
                        @lang('Add New Language')</a>

                    <x-table :th="['Name', 'Code', 'Default', 'Actions']">
                        @forelse ($languages as $item)
                            <tr>
                                <td data-label="@lang('Name')">{{ __($item->name) }}
                                </td>
                                <td data-label="@lang('Code')"><strong>{{ __($item->code) }}</strong></td>
                                <td data-label="@lang('Default')">
                                    {!! bolToText($item->is_default, true, 'Default', 'Selectable') !!}
                                    
                                </td>
                                <td data-label="@lang('Action')">
                                    <a href="{{ route('moder.language.key', $item->id) }}" class="btn btn-sm btn-success"
                                        data-toggle="tooltip" data-original-title="@lang('Translate')">
                                        <i class="fas fa-code"></i>
                                    </a>
                                    <a href="javascript:void(0)" class="btn btn-sm btn-primary ml-1 editBtn"
                                        data-original-title="@lang('Edit')" data-toggle="tooltip"
                                        data-url="{{ route('moder.language.manage.update', $item->id) }}"
                                        data-lang="{{ json_encode($item->only('name', 'text_align', 'is_default')) }}">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @if ($item->id != 1)
                                        <a href="javascript:void(0)" class="btn btn-sm btn-danger ml-1 deleteBtn"
                                            data-original-title="@lang('Delete')" data-toggle="tooltip"
                                            data-url="{{ route('moder.language.manage.del', $item->id) }}">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    @endif

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                            </tr>
                        @endforelse
                    </x-table>

                </div>
            </div>
        </div>
    </div>




    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="createModalLabel"> @lang('Add New Language')</h4>

                </div>
                <form class="form-horizontal" method="post" action="{{ route('moder.language.manage.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-row form-group">
                                    <label class="font-weight-bold ">@lang('Language Name') <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="code" name="name"
                                            placeholder="@lang('e.g. Japaneese, Portuguese')" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-row form-group">
                                    <label class="font-weight-bold">@lang('Language Code') <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="link" name="code"
                                            placeholder="@lang('e.g. jp, pt-br')" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="file">@lang('The language file')</label>
                            <input type="file" name="file" id="file" class="form-control" accept=".json"
                                required>
                        </div>
                        <div class="form-row form-group">
                            <div class="col-md-12">
                                <label for="inputName" class="">@lang('Default Language') <span
                                        class="text-danger">*</span></label>
                                <input type="checkbox" data-width="100%" data-height="40px" name="is_default">
                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn-primary" id="btn-save"
                            value="add">@lang('Save')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="editModalLabel">@lang('Edit Language')</h4>

                </div>
                <form method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-row">
                            <label for="inputName" class="font-weight-bold">@lang('Language Name')
                                <span class="text-danger">*</span></label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="code" name="name" required>
                            </div>
                        </div>

                        <div class="form-group mt-2">
                            <label for="inputName" class="font-weight-bold">@lang('Default Language') <span
                                    class="text-danger">*</span></label>
                            <input type="checkbox" data-width="100%" name="is_default">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn-primary" id="btn-save"
                            value="add">@lang('Update')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="deleteModalLabel">@lang('Remove Language')</h4>

                </div>
                <form method="post" action="">
                    @csrf
                    <input type="hidden" name="delete_id" id="delete_id" class="delete_id" value="0">
                    <div class="modal-body">
                        <p class="text-light">@lang('Are you sure to delete?')</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn-danger deleteButton">@lang('Delete')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @section('datatable', true)
@section('checkbox', true)
@endsection
@push('script')
<script>
    (function($) {
        "use strict";
        $('.editBtn').on('click', function() {
            var modal = $('#editModal');
            var url = $(this).data('url');
            var lang = $(this).data('lang');

            modal.find('form').attr('action', url);
            modal.find('input[name=name]').val(lang.name);
            modal.find('select[name=text_align]').val(lang.text_align);
            if (lang.is_default == 1) {
                modal.find('input[name=is_default]').bootstrapToggle('on');
            } else {
                modal.find('input[name=is_default]').bootstrapToggle('off');
            }
            modal.modal('show');
        });

        $('.deleteBtn').on('click', function() {
            var modal = $('#deleteModal');
            var url = $(this).data('url');

            modal.find('form').attr('action', url);
            modal.modal('show');
        });
    })(jQuery);
</script>
@endpush
<x-js-notify />
<x-bootstrap-toggle />
