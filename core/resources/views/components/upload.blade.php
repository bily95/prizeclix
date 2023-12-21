@props([
    'string' => 'Site Logo Image',
    'name' => 'default.png',
    'upload' => null,
])
<div class="form-group">
    <label for="siteSocialImage">@lang($string) * :</label>
    <div class="row">
        <div class="col-3">
            <img src="{{ asset('asset/uploads/setting/' . $name) }}" alt="image"
                width="100px" height="100px"
                class="mb-5 img-responsive rounded mx-auto d-block bg-light" />
        </div>
        <div class="col-6">
            <input type="file" id="{{ $upload }}" class="form-control"
                wire:model="{{ $upload }}" />
            <div wire:loading wire:target="{{ $upload }}"><i
                    class="spinner-border text-primary"></i>
            </div>
            @error($upload)
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>