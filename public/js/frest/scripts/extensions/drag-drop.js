$(document).ready(function () {

    dragula([document.getElementById('card-drag-area')]);
    dragula([document.getElementById('basic-list-group')]);
    dragula([document.getElementById('multiple-list-group-a'), document.getElementById('multiple-list-group-b')]);

    dragula([document.getElementById('chips-list-1'), document.getElementById('chips-list-2')], {
        copy: true
    });

    dragula([document.getElementById("handle-list-1"), document.getElementById("handle-list-2")], {
        moves: function (el, container, handle) {
            return handle.classList.contains('handle');
        }
    });

});
