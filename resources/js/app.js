import './bootstrap';
import interact from 'interactjs';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

interact('.draggable-node').draggable({
    listeners: {
        move(event) {
            const target = event.target;
            const x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx;
            const y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy;
            target.style.transform = `translate(${x}px, ${y}px)`;
            target.setAttribute('data-x', x);
            target.setAttribute('data-y', y);
        },
        end(event) {
            const target = event.target;
            const nodeId = target.getAttribute('data-id');
            // Use Axios (already in your bootstrap.js) to save
            window.axios.post(`/nodes/${nodeId}/move`, {
                x_pos: target.getAttribute('data-x'),
                y_pos: target.getAttribute('data-y')
            });
        }
    }
});
