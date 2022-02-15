<label for="{{$name}}" class='form-input-image'>
    <span>{{$placeholder}}</span>
    <div class='form-image {{$url ? 'active' : ''}}' for="{{$name}}" style='background-image:url({{$url}})' >
        <i class="bi bi-camera-fill"></i>
    </div>
    @error($name)
        <span class="form-input-error" for="{{$name}}">{{$message}}</span>
    @enderror
    <input type="file" name='{{$name}}' id={{$name}}>
</label>
