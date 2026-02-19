window.RopeSystem = (function () {

    const gravity = 9.8;
    const segmentCount = 12;
    const constraintIterations = 5;

    let canvas, ctx;
    let ropes = [];

    function resize() {
        const container = document.getElementById("sortable-nodes");
        if (!container || !canvas) return;

        canvas.width = container.clientWidth;
        canvas.height = container.clientHeight;
    }

    function init() {
        canvas = document.getElementById("ropes-area");
        if (!canvas) return;
        console.log("RopeSystem initialized");

        ctx = canvas.getContext("2d");
        resize();
        window.addEventListener("resize", resize);

        buildRopes()
        animate()
    }

    function buildRopes() {
        const nodes = [...document.querySelectorAll('.draggable-node')];

        for (let i = 0; i < nodes.length; i++) {
            for (let j = i + 1; j < nodes.length; j++) {

                const tagsA = JSON.parse(nodes[i].dataset.tags);
                const tagsB = JSON.parse(nodes[j].dataset.tags);

                if (hasIntersection(tagsA, tagsB)) {
                    ropes.push(createRope(nodes[i], nodes[j]));
                }
            }
        }
    }

    function hasIntersection(a, b) {
        return a.some(tag => b.includes(tag));
    }

    function createRope(nodeA, nodeB) {

        const ax = nodeA.offsetLeft + nodeA.offsetWidth / 2;
        const ay = nodeA.offsetTop + nodeA.offsetHeight / 2;

        const bx = nodeB.offsetLeft + nodeB.offsetWidth / 2;
        const by = nodeB.offsetTop + nodeB.offsetHeight / 2;

        const totalLength = Math.hypot(bx - ax, by - ay);
        const segmentLength = totalLength / segmentCount;

        let points = [];

        for (let i = 0; i <= segmentCount; i++) {
            const t = i / segmentCount;

            const x = ax * (1 - t) + bx * t;
            const y = ay * (1 - t) + by * t;

            points.push({
                x,
                y,
                oldX: x,
                oldY: y
            });
        }

        return {
            nodeA,
            nodeB,
            points,
            segmentLength
        };
    }

    function applyPhysics(rope) {
        rope.points.forEach(p => {
            const vx = p.x - p.oldX;
            const vy = p.y - p.oldY;

            p.oldX = p.x;
            p.oldY = p.y;

            p.x += vx;
            p.y += vy + (gravity/6);
        });
    }

    function applyConstraints(rope) {

        const ax = rope.nodeA.offsetLeft + rope.nodeA.offsetWidth / 2;
        const ay = rope.nodeA.offsetTop + rope.nodeA.offsetHeight / 2;

        const bx = rope.nodeB.offsetLeft + rope.nodeB.offsetWidth / 2;
        const by = rope.nodeB.offsetTop + rope.nodeB.offsetHeight / 2;

        rope.points[0].x = ax;
        rope.points[0].y = ay;

        rope.points[rope.points.length - 1].x = bx;
        rope.points[rope.points.length - 1].y = by;

        for (let i = 0; i < rope.points.length - 1; i++) {

            const p1 = rope.points[i];
            const p2 = rope.points[i + 1];

            const dx = p2.x - p1.x;
            const dy = p2.y - p1.y;

            const dist = Math.hypot(dx, dy);
            const diff = rope.segmentLength - dist;
            const percent = diff / dist / 2;

            const offsetX = dx * percent;
            const offsetY = dy * percent;

            if (i !== 0) {
                p1.x -= offsetX;
                p1.y -= offsetY;
            }

            if (i !== rope.points.length - 2) {
                p2.x += offsetX;
                p2.y += offsetY;
            }
        }
    }

    function draw() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);

        ctx.lineWidth = 4;
        ctx.strokeStyle = '#94a3b8';
        ctx.lineCap = 'round';

        ropes.forEach(rope => {
            ctx.beginPath();
            ctx.moveTo(rope.points[0].x, rope.points[0].y);

            rope.points.forEach(p => {
                ctx.lineTo(p.x, p.y);
            });

            ctx.stroke();
        });
    }

    function animate() {
        ropes.forEach(rope => {
            applyPhysics(rope);

            for (let i = 0; i < constraintIterations; i++) {
                applyConstraints(rope);
            }
        });

        draw();
        requestAnimationFrame(animate);
    }

    return { init };

})();
