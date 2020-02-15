var currentColor = 'all';

function clickToColorHandler(color) {
    var inputText = document.getElementById("input-url");
    if (inputText.value != '') {
        return;
    }
    reset();
    currentColor = color;
    document.getElementById('delete-in-header').innerHTML = "Удалить отображаемые";
    var colors = ['blue', 'red', 'orange', 'yellow', 'green', 'pink'];

    for (var a = 0; a < colors.length; a++) {
        if(colors[a] == color) continue;
        var collection = document.getElementsByClassName('item-' + colors[a]);
        for (var i = 0; i < collection.length; i++) {
            collection[i].style.display = "none";
        }
    }
}

function clearColorsConfiguration() {
    var radios = document.getElementsByClassName('color-radio');

    for (var x = 0; x < radios.length; x++) {
        radios[x].checked = false;
    }

    reset();
}

function reset() {
    var colors = ['blue', 'red', 'orange', 'yellow', 'green', 'pink'];
    currentColor = 'all';
    document.getElementById('delete-in-header').innerHTML = "Удалить все";
    for (var a = 0; a < colors.length; a++) {
        var collection = document.getElementsByClassName('item-' + colors[a]);
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
