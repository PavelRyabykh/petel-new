function deleteUrls() {
    if (currentColor == "all") {
        delall();
    } else {
        deleteUrlsByColor(currentColor);
    }
}

function deleteUrl(id) {
    const request = new XMLHttpRequest();
    const url = "/delurl";
    const params = "id=" + id;
    request.open("POST", url, true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send(params);

    document.getElementById('item-' + id).remove();
}

function upUrl(id) {
    const request = new XMLHttpRequest();
    const url = "/up";
    const params = "up=" + id;
    request.open("POST", url, true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send(params);

    var item = document.getElementById('item-' + id);
    document.getElementById('item-' + id).remove();
    var urlList = document.getElementById('urls');
    urlList.prepend(item);
}

function delall() {
    const request = new XMLHttpRequest();
    const url = "/delall";
    const params = "delall=on";
    request.open("POST", url, true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send(params);
    document.location = '/';
}

function deleteUrlsByColor(color) {
    const request = new XMLHttpRequest();
    const url = "/delbycolor";
    const params = "color=" + color;
    request.open("POST", url, true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send(params);
    document.location = '/';
}
