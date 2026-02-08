import './bootstrap';
import interact from 'interactjs';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

interact('.draggable-node').draggable({
    listeners: {
        move(event) {
            const el = event.target;

            let x = (parseFloat(el.dataset.x) || 0) + event.dx;
            let y = (parseFloat(el.dataset.y) || 0) + event.dy;

            el.style.left = `${x}px`;
            el.style.top = `${y}px`;

            el.dataset.x = x;
            el.dataset.y = y;
        },

        end(event) {
            const el = event.target;
            const container = document.getElementById('sortable-nodes');

            let x = Number(el.dataset.x);
            let y = Number(el.dataset.y);

            const maxX = container.clientWidth - el.offsetWidth;
            const maxY = container.clientHeight - el.offsetHeight;

            x = Math.max(0, Math.min(x, maxX));
            y = Math.max(0, Math.min(y, maxY));

            el.style.left = `${x}px`;
            el.style.top = `${y}px`;

            el.dataset.x = x;
            el.dataset.y = y;

            fetch(`/app/nodes/${el.dataset.id}/move`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ x_pos: x, y_pos: y })
            });
        }
    }
});
