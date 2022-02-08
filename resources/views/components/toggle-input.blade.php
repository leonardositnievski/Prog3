<label for="{{$name}}">{{$placeholder}}</label>
<input type="checkbox" name="{{$name}}" {{$attributes}} id="{{$name}}" @if(old($name)) checked @endif>
@if ($hint)
    <span class="form-input-hint">{{$hint}}</span>
@endif
