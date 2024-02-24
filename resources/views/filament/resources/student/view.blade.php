<x-filament-panels::page>
    @if ($this->hasInfolist())
        <div id="qrcode" style="width: 100px; height: 100px; margin-top: 15px"></div>
        {{ $this->infolist }}
    @else
        {{ $this->form }}
    @endif

    {{-- @if (count($relationManagers = $this->getRelationManagers()))
        <x-filament-panels::resources.relation-managers
            :active-manager="$this->activeRelationManager"
            :managers="$relationManagers"
            :owner-record="$record"
            :page-class="static::class"
        />
    @endif --}}
    <script src="{{ asset('qrcode.js') }}"></script>
    <script type="text/javascript">
        var qrcode = new QRCode(document.getElementById("qrcode"), {
            width: 100,
            height: 100
        });

        function makeCode() {
            var elText = "hallo";
            qrcode.makeCode(elText);
        }

        makeCode();
    </script>
</x-filament-panels::page>
