function deleteUrls() {
    if (currentFilter == "all") {
        delall();
    } else {
        deleteUrlsByFilter(currentFilter);
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

function deleteUrlsByFilter(filter) {
    const request = new XMLHttpRequest();
    const url = "/delbyfilter";
    const params = "filter=" + filter;
    request.open("POST", url, true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send(params);
    document.location = '/';
}
