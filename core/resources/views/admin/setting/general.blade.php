@section('title', __('Appeareance Settings'))
@section('page-title', __('Site General Setting'))

<div>
    <div class="">
        <div class="row">
            
            <div class="col-md-6">
                <div class="card my-2">
                    <div class="card-body">
                        <h5 class="card-title">@lang('Basic Settings') </h5>
                        <form id="demo-form2" wire:submit.prevent="save">
                            <div class="form-group">
                                <label for="siteName">@lang('Site Name * :')</label>
                                <input type="text" id="siteName" class="form-control" wire:model="setting.siteName"
                                     required />
                            </div>
                            
                            <div class="form-group">
                                <label for="siteEmail">@lang('Site Email * :')</label>
                                <input type="text" id="siteEmail" class="form-control" wire:model="setting.siteEmail"
                                     required />
                            </div>
                            <hr />
                            <h5 class="card-title mt-2">@lang('SEO Settings')</h5>
                            <div class="form-group">
                                <label for="siteMetaDescription">@lang('Description * :')</label>
                                <textarea id="siteMetaDescription" class="form-control" rows="3" wire:model="setting.siteMetaDescription"
                                    required />
                                
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label for="siteMetaKeywords">@lang('Keywords *') :</label>
                                <input type="text" id="siteMetaKeywords" class="form-control"
                                    wire:model="setting.siteMetaKeywords" 
                                     required />
                            </div>
                            <x-upload 
                                string="site Social Image"
                                name="{{ set('siteSocialImage', 'default.png') }}"
                                upload="siteSocialImage"
                            />
                            <div class="form-group">
                                <label for="googleAnalysis">@lang('Google Analysis * :')</label>
                                <input type="text" id="googleAnalysis" value="{{ set('googleAnalysis', '975498623') }}" class="form-control" wire:model="setting.googleAnalysis"
                                     required />
                            </div>
                            <hr />
                            <button type="submit" class="btn btn-success btn-block my-2">@lang('Save')</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card my-2">
                    <div class="card-body">
                        <h5 class="card-title">@lang('Logo And Favicon Settings')</h5>
                        <form id="demo-form4" wire:submit.prevent="saveSiteLogoAndFavicon"
                            enctype="multipart/form-data">
                            <x-upload 
                                string="site loading image"
                                name="{{ set('siteLoadingImage', 'default.png') }}"
                                upload="siteLoadingImage"
                            />

                            <x-upload 
                                string="Site Small Logo Image"
                                name="{{ set('siteSmallLogoImage', 'default.png') }}"
                                upload="siteSmallLogoImage"
                            />

                            <x-upload 
                                string="Site Big Logo Image"
                                name="{{ SETTING['siteLogoImage'] }}"
                                upload="siteLogoImage"
                            />

                            <x-upload 
                                string="Site Favicon Image"
                                name="{{ SETTING['siteFaviconImage'] }}"
                                upload="siteFaviconImage"
                            />

                            
                            <button type="submit" class="btn btn-success btn-block my-2">@lang('Save')</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<x-js-notify livewire="true"/>