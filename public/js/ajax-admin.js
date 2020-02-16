function deluser(id) {
    const request = new XMLHttpRequest();
    const url = "/deluser";
    const params = "id=" + id;
    request.open("POST", url, true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send(params);
    document.location = '/admin';
}