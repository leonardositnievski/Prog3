<input id='{{$name}}' name='{{$name}}' {{$attributes}} value="{{ old($name) }}" class='@error($name) {{'error'}} @enderror'>
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