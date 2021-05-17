(function() {
    let bars = document.getElementsByClassName("bar");

    for (var i = 0; i < bars.length; i++) {
        let bar = bars[i];
        let text = bar.getElementsByTagName('p')[0].innerText;
        let values = text.split('/');
        let size = parseInt(values[0]) / parseInt(values[1]);
        size = size * 100;

        if (size < 0) {
            size = 0;
        }

        bar.getElementsByClassName("bar-filled")[0].style.width = String(size) + "%";
    }
})()
