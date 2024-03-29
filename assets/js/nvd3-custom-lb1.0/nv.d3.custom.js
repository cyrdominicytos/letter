/*! light-blue - v3.1.0 - 2014-12-06 */
function daysInMonth(a, b) {
    return new Date(b, a + 1, 0).getDate()
}

function d3_time_range(a, b, c) {
    return function (d, e, f) {
        var g = a(d), h = [];
        if (d > g && b(g), f > 1) for (; e > g;) {
            var i = new Date(+g);
            c(i) % f === 0 && h.push(i), b(g)
        } else for (; e > g;) h.push(new Date(+g)), b(g);
        return h
    }
}

var nv = window.nv || {};
nv.version = "0.0.1a", nv.dev = !0, window.nv = nv, nv.tooltip = {}, nv.utils = {}, nv.models = {}, nv.charts = {}, nv.graphs = [], nv.logs = {}, nv.dispatch = d3.dispatch("render_start", "render_end"), nv.dev && (nv.dispatch.on("render_start", function () {
    nv.logs.startTime = +new Date
}), nv.dispatch.on("render_end", function () {
    nv.logs.endTime = +new Date, nv.logs.totalTime = nv.logs.endTime - nv.logs.startTime, nv.log("total", nv.logs.totalTime)
})), nv.log = function () {
    if (nv.dev && console.log && console.log.apply) console.log.apply(console, arguments); else if (nv.dev && console.log && Function.prototype.bind) {
        var a = Function.prototype.bind.call(console.log, console);
        a.apply(console, arguments)
    }
    return arguments[arguments.length - 1]
}, nv.render = function a(b) {
    b = b || 1, a.active = !0, nv.dispatch.render_start(), setTimeout(function () {
        for (var c, d, e = 0; b > e && (d = a.queue[e]); e++) c = d.generate(), typeof d.callback == typeof Function && d.callback(c), nv.graphs.push(c);
        a.queue.splice(0, e), a.queue.length ? setTimeout(arguments.callee, 0) : (nv.render.active = !1, nv.dispatch.render_end())
    }, 0)
}, nv.render.active = !1, nv.render.queue = [], nv.addGraph = function (a) {
    typeof arguments[0] == typeof Function && (a = {
        generate: arguments[0],
        callback: arguments[1]
    }), nv.render.queue.push(a), nv.render.active || nv.render()
}, nv.identity = function (a) {
    return a
}, nv.strip = function (a) {
    return a.replace(/(\s|&)/g, "")
}, d3.time.monthEnd = function (a) {
    return new Date(a.getFullYear(), a.getMonth(), 0)
}, d3.time.monthEnds = d3_time_range(d3.time.monthEnd, function (a) {
    a.setUTCDate(a.getUTCDate() + 1), a.setDate(daysInMonth(a.getMonth() + 1, a.getFullYear()))
}, function (a) {
    return a.getMonth()
}), function () {
    var a = window.nv.tooltip = {};
    a.show = function (a, b, c, d, e, f) {
        var g = document.createElement("div");
        g.className = "nvtooltip " + (f ? f : "xy-tooltip"), c = c || "s", d = d || 20;
        var h = e ? e : document.getElementsByTagName("body")[0];
        g.innerHTML = b, g.style.left = 0, g.style.top = 0, g.style.opacity = 0, h.appendChild(g);
        var i, j, k = parseInt(g.offsetHeight), l = parseInt(g.offsetWidth), m = nv.utils.windowSize().width,
            n = nv.utils.windowSize().height, o = window.scrollY, p = window.scrollX;
        n = window.innerWidth >= document.body.scrollWidth ? n : n - 16, m = window.innerHeight >= document.body.scrollHeight ? m : m - 16;
        var q = function (a) {
            var b = j;
            do isNaN(a.offsetTop) || (b += a.offsetTop); while (a = a.offsetParent);
            return b
        }, r = function (a) {
            var b = i;
            do isNaN(a.offsetLeft) || (b += a.offsetLeft); while (a = a.offsetParent);
            return b
        };
        switch (c) {
            case"e":
                i = a[0] - l - d, j = a[1] - k / 2;
                var s = r(g), t = q(g);
                p > s && (i = a[0] + d > p ? a[0] + d : p - s + i), o > t && (j = o - t + j), t + k > o + n && (j = o + n - t + j - k);
                break;
            case"w":
                i = a[0] + d, j = a[1] - k / 2, s + l > m && (i = a[0] - l - d), o > t && (j = o + 5), t + k > o + n && (j = o - k - 5);
                break;
            case"n":
                i = a[0] - l / 2 - 5, j = a[1] + d;
                var s = r(g), t = q(g);
                p > s && (i = p + 5), s + l > m && (i = i - l / 2 + 5), t + k > o + n && (j = o + n - t + j - k);
                break;
            case"s":
                i = a[0] - l / 2, j = a[1] - k - d;
                var s = r(g), t = q(g);
                p > s && (i = p + 5), s + l > m && (i = i - l / 2 + 5), o > t && (j = o)
        }
        return g.style.left = i + "px", g.style.top = j + "px", g.style.opacity = 1, g.style.position = "absolute", g.style.pointerEvents = "none", g
    }, a.cleanup = function () {
        for (var a = document.getElementsByClassName("nvtooltip"), b = []; a.length;) b.push(a[0]), a[0].style.transitionDelay = "0 !important", a[0].style.opacity = 0, a[0].className = "nvtooltip-pending-removal";
        setTimeout(function () {
            for (; b.length;) {
                var a = b.pop();
                a.parentNode.removeChild(a)
            }
        }, 500)
    }
}(), nv.utils.windowSize = function () {
    var a = {width: 640, height: 480};
    return document.body && document.body.offsetWidth && (a.width = document.body.offsetWidth, a.height = document.body.offsetHeight), "CSS1Compat" == document.compatMode && document.documentElement && document.documentElement.offsetWidth && (a.width = document.documentElement.offsetWidth, a.height = document.documentElement.offsetHeight), window.innerWidth && window.innerHeight && (a.width = window.innerWidth, a.height = window.innerHeight), a
}, nv.utils.windowResize = function (a) {
    var b = window.onresize;
    window.onresize = function (c) {
        "function" == typeof b && b(c), a(c)
    }
}, nv.utils.getColor = function (a) {
    return arguments.length ? "[object Array]" === Object.prototype.toString.call(a) ? function (b, c) {
        return b.color || a[c % a.length]
    } : a : nv.utils.defaultColor()
}, nv.utils.defaultColor = function () {
    var a = d3.scale.category20().range();
    return function (b, c) {
        return b.color || a[c % a.length]
    }
}, nv.utils.customTheme = function (a, b, c) {
    b = b || function (a) {
        return a.key
    }, c = c || d3.scale.category20().range();
    var d = c.length;
    return function (e) {
        var f = b(e);
        return d || (d = c.length), "undefined" != typeof a[f] ? "function" == typeof a[f] ? a[f]() : a[f] : c[--d]
    }
}, nv.utils.pjax = function (a, b) {
    function c(c) {
        d3.html(c, function (c) {
            var d = d3.select(b).node();
            d.parentNode.replaceChild(d3.select(c).select(b).node(), d), nv.utils.pjax(a, b)
        })
    }

    d3.selectAll(a).on("click", function () {
        history.pushState(this.href, this.textContent, this.href), c(this.href), d3.event.preventDefault()
    }), d3.select(window).on("popstate", function () {
        d3.event.state && c(d3.event.state)
    })
};