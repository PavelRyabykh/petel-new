var currentFilter = 'all';
window.onload = function() {
    for (var i = 0; i < filters.length; i++) {
        if (location.hash == '#' + filters[i]) {
            var elem = document.getElementById('radio__' + filters[i]).checked = true;
            clickToColorHandler(filters[i]);
        }
    }
};
function clickToColorHandler(filter) {
    location.hash = filter;
    // var inputText = document.getElementById("input-url");
    // if (inputText.value != '') {
    //     return;
    // }
    reset();
    currentFilter = filter;
    document.getElementById('delete-in-header').innerHTML = "Удалить отображаемые";

    for (var a = 0; a < filters.length; a++) {
        if(filters[a] == filter) continue;
        var collection = document.getElementsByClassName('item-' + filters[a]);
        for (var i = 0; i < collection.length; i++) {
            collection[i].style.display = "none";
        }
    }
}

function clearFiltersConfiguration() {
    location.hash = '';
    var radios = document.getElementsByClassName('color-radio');

    for (var x = 0; x < radios.length; x++) {
        radios[x].checked = false;
    }

    reset();
}

function reset() {
    currentFilter = 'all';
    document.getElementById('delete-in-header').innerHTML = "Удалить все";
    for (var a = 0; a < filters.length; a++) {
        var collection = document.getElementsByClassName('item-' + filters[a]);
        for (var i = 0; i < collection.length; i++) {
            collection[i].style.display = "flex";
        }
    }
}

function copyText(id) {
    var contentHolder = document.getElementById('text-' + id);
    var range = document.createRange(),
        selection = window.getSelection();
    selection.removeAllRanges();
    range.selectNodeContents(contentHolder);
    selection.addRange(range);
    document.execCommand('copy');
    selection.removeAllRanges();
}
