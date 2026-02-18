window.RopeSystem = (function () {

    const gravity = 0.3;
    const segmentCount = 12;
    const constraintIterations = 5;

    let canvas, ctx;
    let ropes = [];

    function resize() {
        const container = document.getElementById("graph-container");
        if (!container || !canvas) return;

        canvas.width = container.clientWidth;
        canvas.height = container.clientHeight;
    }

    function init() {
        canvas = document.getElementById("ropes-area");
        if (!container || !canvas) return;
        console.log("RopeSystem initialized");

        ctx = canvas.getContext("2d");
        resize();
        window.addEventListener("resize", resize);
    }

    return { init };

})();
