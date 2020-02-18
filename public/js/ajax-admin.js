function deluser(id) {
    const request = new XMLHttpRequest();
    const url = "/deluser";
    const params = "id=" + id + "&token=" + token;
    request.open("POST", url, true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send(params);
    document.location = '/admin';
}

function delfilter(id, user) {
    const request = new XMLHttpRequest();
    const url = "/delfilter";
    const params = "id=" + id + "&workspace=" + user + "&token=" + token;
    request.open("POST", url, true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send(params);
    document.location = document.location;
}