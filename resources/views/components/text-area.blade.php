<textarea id='{{$name}}' name='{{$name}}' {{$attributes}} class='@error($name) {{'error'}} @enderror'>{{old($name)}}</textarea>
<label for='{{$name}}'>{{$placeholder}}</label>

@error($name)
    <span class="form-input-error" for='{{$name}}'>{{$message}}</span>
@enderror

@if ($hint)
    <span class="form-input-hint">{{$hint}}</span>
@endif

@if ($icon)
    <i class="{{$icon}}" for='{{$name}}'></i>
@endif