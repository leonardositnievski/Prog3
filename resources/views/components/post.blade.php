<div class="post-wrapper">
    <div class="post">
        <div class="post-header">
            <div class="post-author-pic">
                @if ($post->owner->photo_url)
                    <img src="{{ $post->owner->photo_url }}" alt="">
                @else
                    <img src="{{ asset('images/default-user.png') }}" alt="">

                @endif
            </div>

            <span class="post-author-name"><a href="{{ routeLang('profile', ['id' => $post->owner->id]) }}">{{$post->owner->name}}</a></span>
            <span class="post-timestamp">{{$post->timestamp}}</span>
            <span class='bi bi-exclamation-circle post-denunciar modal-denunciar-button' data-post-id="{{$post->id}}" data-username="{{$post->owner->name}}"  title="{{__('view.post.report')}}"></span>
        </div>
        <div class="post-body">
            <h6 class="post-title">{{$post->titulo}}</h6>

            <div class="post-description">{{$post->descricao}}</div>
            <div class="post-content">
                <img src="{{ $post->photo_url }}" alt="">
            </div>
        </div>
        <div class="post-footer">
            @if ($post->autorizado)
                <div class="post-avaliation" data-post-id="{{$post->id}}" >
                    <x-Avaliation :value="$post->nota"/>
                </div>
                <div class="post-actions">
                    <a class='post-actions-rate-button'  data-post-id="{{$post->id}}"  data-username="{{$post->owner->name}}"  >{{__('view.post.actions.rate.button')}}</a>
                </div>
            @else

            <div class="post-actions">
                <a href='{{ route('autorizacao', ['id' => $post->id, 'action' => 'negar']) }}'>{{__('view.post.actions.deny')}}</a>
                <a href='{{ route('autorizacao', ['id' => $post->id, 'action' => 'aprovar']) }}'>{{__('view.post.actions.aprove')}}</a>
            </div>
            @endif
        </div>



    </div>
</div>
