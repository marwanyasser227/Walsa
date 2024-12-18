<div class="mt-5 ">
    @foreach ($hubs as $hub)

    <!-- Static map for Hubs -->
    <div id="{{$hub->id}}-map" class="map-container w-100" style="height: 400px; display: none;">
        <iframe src="{{$hub->map->map}}" width="100%" height="100%"
        frameborder="0"></iframe>
    </div>
    @endforeach
</div>
