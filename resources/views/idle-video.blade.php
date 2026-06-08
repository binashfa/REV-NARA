<div id="idleOverlay">
    <video autoplay muted loop>
        <source src="{{ asset('videos/idle.mp4') }}" type="video/mp4">
    </video>
</div>

<style>
#idleOverlay{
    position:fixed;
    inset:0;
    background:rgba(0,0,0,.8);
    z-index:999999;

    display:flex;
    justify-content:center;
    align-items:center;

    opacity:0;
    visibility:hidden;

    transition:.4s;
}

#idleOverlay.show{
    opacity:1;
    visibility:visible;
}

#idleOverlay video{
    width:500px;
    max-width:90%;
    border-radius:20px;
}
</style>

<script>
let idleTimer;

function showIdleVideo() {
    document.getElementById('idleOverlay')
        .classList.add('show');
}

function hideIdleVideo() {
    document.getElementById('idleOverlay')
        .classList.remove('show');
}

function resetIdleTimer() {

    clearTimeout(idleTimer);

    hideIdleVideo();

    idleTimer = setTimeout(() => {
        showIdleVideo();
    }, 10000);
}

['mousemove','scroll','click','keydown']
.forEach(event => {
    window.addEventListener(event, resetIdleTimer);
});

resetIdleTimer();
</script>