<!-- Modal Buku Tamu -->
    <div id="guestModal" class="modal">
        <div class="modal-content">
            <h5>Form Buku Tamu</h5>
            <br>
            <form id="guestForm">
                @csrf
                <div class="row">
                    <label for="nocounter">Sales <span style="color: red">*</span></label>
                    <select id="sales" class="browser-default" name="sales">
                        @foreach ($sales as $s)
                            <option value="{{ $s->id }}" {{ ($sales_assigned->id ?? '') == $s->id ? 'selected' : '' }}>
                                {{ $s->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="input-field">
                    <input id="name" class="input-keyboard" name="name" type="text" required autocomplete="off">
                    <label for="name">Nama <span style="color: red">*</span></label>
                </div>
                <div class="input-field">
                    <input id="dinas" class="input-keyboard" name="dinas" type="text" autocomplete="off" required>
                    <label for="dinas">Lembaga / Instansi <span style="color: red">*</span></label></label>
                </div>
                <div class="input-field">
                    <input id="no_hp" class="input-keyboard" name="no_hp" type="text" autocomplete="off" required regexp="^[0-9]+$">
                    <label for="no_hp">No HP <span style="color: red">*</span></label>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <a href="#!"  class="modal-close btn-flat" style="background: rgb(255, 90, 90); color: #fff">Batal</a>
            <a href="#!" onclick="submitGuest()" class="waves-effect waves-green btn"
                id="guestSubmit">Kirim</a>
        </div>
    </div>

    {{-- keyboard --}}
    <div class="virtual-keyboard">
        <div class="keyboard">
            <div class="key-row">
                <div class="keys" data-default="1" data-shift="!">1</div>
                <div class="keys" data-default="2" data-shift="@">2</div>
                <div class="keys" data-default="3" data-shift=";">3</div>
                <div class="keys" data-default="4" data-shift="'">4</div>
                <div class="keys" data-default="5" data-shift="%">5</div>
                <div class="keys" data-default="6" data-shift="^">6</div>
                <div class="keys" data-default="7" data-shift="&">7</div>
                <div class="keys" data-default="8" data-shift="*">8</div>
                <div class="keys" data-default="9" data-shift="(">9</div>
                <div class="keys" data-default="0" data-shift=")">0</div>
                <div class="keys special-key" id="backspace">⌫</div>
            </div>
            <div class="key-row">
                <div class="keys">q</div>
                <div class="keys">w</div>
                <div class="keys">e</div>
                <div class="keys">r</div>
                <div class="keys">t</div>
                <div class="keys">y</div>
                <div class="keys">u</div>
                <div class="keys">i</div>
                <div class="keys">o</div>
                <div class="keys">p</div>
            </div>
            <div class="key-row">
                <div class="keys">a</div>
                <div class="keys">s</div>
                <div class="keys">d</div>
                <div class="keys">f</div>
                <div class="keys">g</div>
                <div class="keys">h</div>
                <div class="keys">j</div>
                <div class="keys">k</div>
                <div class="keys">l</div>
            </div>
            <div class="key-row">
                <div class="keys special-key" id="shift">Shift</div>
                <div class="keys">z</div>
                <div class="keys">x</div>
                <div class="keys">c</div>
                <div class="keys">v</div>
                <div class="keys">b</div>
                <div class="keys">n</div>
                <div class="keys">m</div>
                <div class="keys">,</div>
                <div class="keys">.</div>
                <div class="keys">/</div>
            </div>
            <div class="key-row">
                <div class="keys space-key" id="space">Space</div>
            </div>
        </div>
    </div>