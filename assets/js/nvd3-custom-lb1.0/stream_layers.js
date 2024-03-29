/*! light-blue - v3.1.0 - 2014-12-06 */
function stream_layers(a, b, c) {
    function d(a) {
        for (var c = 1 / (.1 + Math.random()), d = 2 * Math.random() - .5, e = 10 / (.1 + Math.random()), f = 0; b > f; f++) {
            var g = (f / b - d) * e;
            a[f] += c * Math.exp(-g * g)
        }
    }

    return arguments.length < 3 && (c = 0), d3.range(a).map(function () {
        var a, e = [];
        for (a = 0; b > a; a++) e[a] = c + c * Math.random();
        for (a = 0; 5 > a; a++) d(e);
        return e.map(stream_index)
    })
}

function stream_waves(a, b) {
    return d3.range(a).map(function (a) {
        return d3.range(b).map(function (c) {
            var d = 20 * c / b - a / 3;
            return 2 * d * Math.exp(-.5 * d)
        }).map(stream_index)
    })
}

function stream_index(a, b) {
    return {x: b, y: Math.max(0, a)}
}