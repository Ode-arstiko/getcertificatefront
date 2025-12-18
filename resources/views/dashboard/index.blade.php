<div class="container-fluid p-3">
    dashboard <br>
    
    @if (session('tokenInvalid'))
        {{ session('tokenInvalid') }}
    @endif <br>
    
    <div style="max-width: 90%; word-wrap: break-word;">
        @if (session('tokenSuccess'))
            {{ session('tokenSuccess') }}
        @endif
    </div>
</div>