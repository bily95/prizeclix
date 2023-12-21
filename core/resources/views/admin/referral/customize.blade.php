@extends('admin.layout.primary')
@section('panel')

    <div class="card">
        <div class="card-header">
            <h4 class="card-title" style="margin-top:5px;margin-bottom:5px;">@lang('Customize Referral Page')</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="card" >
                        <div class="card-header">
                            <h4 class="card-title"style="margin-top:5px;margin-bottom:5px;">@lang('Notes:')</h4>
                        </div>
                        <div class="card-body" style="border-top-left-radius:0px;border-top-right-radius:0px;">
                            <p class="card-text">
                                @lang('You can add banners and helper links for users')
                            </p>
                            <p class="card-text">
                                @lang('For adding html, Please use edit html from the editor menu')
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <form action="{{ route('moder.referral.do-customize') }}" method="post" style="overflow:hidden;">
                        @csrf
                        <textarea name="contents" class="form-control nicEdit mb-3">
                    {{ SETTING['ref_page_content'] }}
                </textarea>
                        <input type="submit" class="btn btn-success mt-3" value="Save" style="box-shadow:none;">
                    </form>
                </div>
            </div>

        </div>
    </div>


@endsection

@section('editor', true)
