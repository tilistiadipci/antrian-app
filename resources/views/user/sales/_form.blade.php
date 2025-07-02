<form id="add" action="{{ isset($sales) ? route('sales.update', $sales->id) : route('sales.store') }}"
    method="post">
    @if (isset($sales))
        {{ method_field('PUT') }}
    @endif
    {{ csrf_field() }}

    <div class="row">
        <div class="input-field col s12">
            <label for="name">{{ trans('messages.name') }}</label>
            <input id="name" type="text" name="name" placeholder="{{ trans('messages.name') }}"
                value="{{ isset($sales) ? $sales->name : old('name') }}" data-error=".name" required>
            <div class="name">
                @if ($errors->has('name'))
                    <div class="error">{{ $errors->first('name') }}</div>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="input-field col s12">
            <label for="email">Email</label>
            <input id="email" type="text" name="email" placeholder="Email"
                value="{{ isset($sales) ? $sales->email : old('email') }}" data-error=".email">
            <div class="email">
                @if ($errors->has('email'))
                    <div class="error">{{ $errors->first('email') }}</div>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="input-field col s12">
            <label for="no_hp">No Hp / Whatsapp</label>
            <input id="no_hp" type="text" name="no_hp" placeholder="No HP/ Whatsapp"
                value="{{ isset($sales) ? $sales->no_hp : old('no_hp') }}" data-error=".no_hp">
            <div class="no_hp">
                @if ($errors->has('no_hp'))
                    <div class="error">{{ $errors->first('no_hp') }}</div>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            <label for="nocounter">Default Kiosk</label>
            <select id="is_sales_assigned" class="browser-default" name="is_sales_assigned">
                <option value="0" {{ isset($sales) && $sales->is_sales_assigned == 0 ? 'selected' : '' }}>Tidak</option>
                <option value="1" {{ isset($sales) && $sales->is_sales_assigned == 1 ? 'selected' : '' }}>Ya</option>
            </select>
            <div class="is_sales_assigned">
                @if ($errors->has('is_sales_assigned'))
                    <div class="error">{{ $errors->first('is_sales_assigned') }}</div>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="input-field col s12">
            <button class="btn waves-effect waves-light right" type="submit">
                {{ trans('messages.save') }}<i class="mdi-content-save left"></i>
            </button>
        </div>
    </div>
</form>
