<div id="{{ $meta['name'] }}" class="card {{ $meta['name'] }}">
    <h5 class="card-header">{{ $meta['title'] }}</h5>
    <div class="card-body">
        @foreach($meta['meta'] as $m => $v)
            @if( in_array($v['type'], ['text','url','password'])  )
                <div id="{{$m}}" class="form-group type-{{$v['type']}} {{$m}}">
                    <label for="{{$m}}-field">{{$v['title']}}</label>
                    <input value="{{get_meta_value($slug,$m)}}" name="{{ $meta['name'] }}[{{$m}}]" type="{{$v['type']}}" class="form-control"
                           id="{{$m}}-field" {{ $v['required'] ? 'required' : '' }}>
                </div>
            @endif

            @if ($v['type']==='textarea')
                <div id="{{$m}}" class="form-group type-{{$v['type']}} {{$m}}">
                    <label for="{{$m}}-field">{{$v['title']}}</label>
                    <textarea name="{{ $meta['name'] }}[{{$m}}]" type="{{$v['type']}}" class="form-control richEditor"
                              id="{{$m}}-field" {{ $v['required'] ? 'required' : '' }}>{!! html_entity_decode( get_meta_value($slug,$m) ) !!}</textarea>
                </div>
            @endif


            @if ($v['type']==='file')
                <div id="{{$m}}" class="form-group type-{{$v['type']}} {{$m}}">
                    <label for="{{$m}}-field">{{$v['title']}}</label>
                    <div class="input-group">
                       <span class="input-group-btn">
                         <a id="{{$m}}-field" data-input="{{$m}}-thumbnail" data-preview="holder"
                            class="btn btn-primary uploader2">
                           <i class="fas fa-folder-open"></i>
                         </a>
                       </span>
                        <input id="{{$m}}-thumbnail" class="form-control" type="text" value="{{get_meta_value($slug,$m)}}"
                               name="{{ $meta['name'] }}[{{$m}}]" readonly>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>
