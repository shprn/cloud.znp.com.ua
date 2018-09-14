// Gallery
document.getElementById('links').ondblclick = function (event) {
    if (!event.target.src)
        return;

    event = event || window.event;
    var target = event.target || event.srcElement,
        link = target.src ? target.parentNode : target,
        options = {index: link, event: event},
        links = this.getElementsByTagName('a');
    blueimp.Gallery(links, options);
};