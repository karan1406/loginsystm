<div class="input-group mb-3">
    <input type="{{ $type }}" class="form-control" placeholder="{{ $placeholder }}" name="{{ $name }}" id="{{ $id }}" {{ $attributes(['value' => old($name)])}} value="{{ $type == "password" ? null : old($name)}}">
    @if(isset($attribute))
    <div class="input-group-append">
        <div class="input-group-text">
            <span {{ $attributes }}></span>
        </div>
    </div>
    @endif
</div>
