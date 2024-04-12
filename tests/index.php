<script src="script.js"></script>
<div id="LiveLi">
    <a>live true</a>
</div>
<div id="DownloadsLi">
    <a>downloads true</a>
</div>
<div id="BauteileLi">
    <a>bauteile true</a>
</div>

<h2>Settings</h2>
<div class="Teamspace-Control-Settings" id="Teamspace-Control-Settings-1">
    <a class="Teamspace-Control-Text">Live Cam</a>
    <label class="switch">
        <input id="Checkboxlive" onclick="updateUiOnChecked()" type="checkbox">
        <span class="slider round"></span>
    </label>
</div>
<hr>
<div class="Teamspace-Control-Settings" id="Teamspace-Control-Settings-2">
    <a class="Teamspace-Control-Text">Downloads</a>
    <label class="switch">
        <input id="Checkboxdownloads" onclick="updateUiOnChecked()" type="checkbox">
        <span class="slider round"></span>
    </label>
</div>
<hr>
<div class="Teamspace-Control-Settings" id="Teamspace-Control-Settings-4">
    <a class="Teamspace-Control-Text">Bauteile</a>
    <label class="switch">
        <input id="Checkboxbauteile" onclick="updateUiOnChecked()" type="checkbox">
        <span class="slider round"></span>
    </label>
</div>