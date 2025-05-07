<div class="row">
    <div class="input-field col s12">
        <label for="user">{{ trans('messages.call.user') }}</label>
        <input id="user" type="hidden" name="user" value="{{ $user->id }}" data-error=".user">
        <input type="text" data-error=".user" value="{{ $user->name }}" readonly>
        <div class="user">
            @if ($errors->has('user'))
                <div class="error">{{ $errors->first('user') }}</div>
            @endif
        </div>
    </div>
</div>

<div class="row">
    <div class="input-field col s12">
        <label for="department" class="active">{{ trans('messages.mainapp.menu.department') }}</label>
        <select id="department" class="browser-default" name="department" data-error=".department">
            <option value="">{{ trans('messages.select') }} {{ trans('messages.mainapp.menu.department') }}
            </option>
            @foreach ($departments as $department)
                @if (session()->has('department') && $department->id == session()->get('department'))
                    <option value="{{ $department->id }}" selected>{{ $department->name }}</option>
                @else
                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                @endif
            @endforeach
        </select>
        <div class="department">
            @if ($errors->has('department'))
                <div class="error">{{ $errors->first('department') }}</div>
            @endif
        </div>
    </div>
</div>
<div class="row">
    <div class="input-field col s12">
        <label for="counter" class="active">{{ trans('messages.mainapp.menu.counter') }}</label>
        <select id="counter" class="browser-default" name="counter" data-error=".counter">
            <option value="">{{ trans('messages.select') }} {{ trans('messages.mainapp.menu.counter') }}
            </option>
            @foreach ($counters as $counter)
                @if (session()->has('counter') && $counter->id == session()->get('counter'))
                    <option value="{{ $counter->id }}" selected>{{ $counter->name }} {{ $counter->idcounter }}
                    </option>
                @else
                    <option value="{{ $counter->id }}">{{ $counter->name }} {{ $counter->idcounter }}</option>
                @endif
            @endforeach
        </select>
        <div class="counter">
            @if ($errors->has('counter'))
                <div class="error">{{ $errors->first('counter') }}</div>
            @endif
        </div>
    </div>
</div>
