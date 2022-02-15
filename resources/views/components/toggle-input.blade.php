<div class="toggle-input">
    <span>{{$placeholder}}</span>
    <input type="checkbox" name="{{$name}}" {{$attributes}} id="{{$name}}" @if($value) checked @endif>
    <label for="{{$name}}"></label>
    @if ($hint)
        <span class="form-input-hint">{{$hint}}</span>
    @endif
</div>
