/*! light-blue - v3.1.0 - 2014-12-06 */
nv.models.legend = function () {
    function a(i) {
        return i.each(function (a) {
            var i = c - b.left - b.right, j = d3.select(this), l = j.selectAll("g.nv-legend").data([a]),
                m = (l.enter().append("g").attr("class", "nvd3 nv-legend").append("g"), l.select("g"));
            l.attr("transform", "translate(" + b.left + "," + b.top + ")");
            var n = m.selectAll(".nv-series").data(function (a) {
                return a
            }), o = n.enter().append("g").attr("class", "nv-series").on("mouseover", function (a, b) {
                h.legendMouseover(a, b)
            }).on("mouseout", function (a, b) {
                h.legendMouseout(a, b)
            }).on("click", function (a, b) {
                h.legendClick(a, b)
            }).on("dblclick", function (a, b) {
                h.legendDblclick(a, b)
            });
            if (o.append("circle").style("stroke-width", 2).attr("r", 5), o.append("text").attr("text-anchor", "start").attr("dy", ".32em").attr("dx", "8"), n.classed("disabled", function (a) {
                return a.disabled
            }), n.exit().remove(), n.select("circle").style("fill", function (a, b) {
                return a.color || f(a, b)
            }).style("stroke", function (a, b) {
                return a.color || f(a, b)
            }), n.select("text").text(e), g) {
                var p = [];
                n.each(function () {
                    p.push(d3.select(this).select("text").node().getComputedTextLength() + 28)
                });
                for (var q = 0, r = 0, s = []; i > r && q < p.length;) s[q] = p[q], r += p[q++];
                for (; r > i && q > 1;) {
                    for (s = [], q--, k = 0; k < p.length; k++) p[k] > (s[k % q] || 0) && (s[k % q] = p[k]);
                    r = s.reduce(function (a, b) {
                        return a + b
                    })
                }
                for (var t = [], u = 0, v = 0; q > u; u++) t[u] = v, v += s[u];
                n.attr("transform", function (a, b) {
                    return "translate(" + t[b % q] + "," + (5 + 20 * Math.floor(b / q)) + ")"
                }), m.attr("transform", "translate(" + (c - b.right - r) + "," + b.top + ")"), d = b.top + b.bottom + 20 * Math.ceil(p.length / q)
            } else {
                var w, x = 5, y = 5, z = 0;
                n.attr("transform", function () {
                    var a = d3.select(this).select("text").node().getComputedTextLength() + 28;
                    return w = y, c < b.left + b.right + w + a && (y = w = 5, x += 20), y += a, y > z && (z = y), "translate(" + w + "," + x + ")"
                }), m.attr("transform", "translate(" + (c - b.right - z) + "," + b.top + ")"), d = b.top + b.bottom + x + 15
            }
        }), a
    }

    var b = {top: 5, right: 0, bottom: 5, left: 0}, c = 400, d = 20, e = function (a) {
            return a.key
        }, f = nv.utils.defaultColor(), g = !0,
        h = d3.dispatch("legendClick", "legendDblclick", "legendMouseover", "legendMouseout");
    return a.dispatch = h, a.margin = function (c) {
        return arguments.length ? (b.top = "undefined" != typeof c.top ? c.top : b.top, b.right = "undefined" != typeof c.right ? c.right : b.right, b.bottom = "undefined" != typeof c.bottom ? c.bottom : b.bottom, b.left = "undefined" != typeof c.left ? c.left : b.left, a) : b
    }, a.width = function (b) {
        return arguments.length ? (c = b, a) : c
    }, a.height = function (b) {
        return arguments.length ? (d = b, a) : d
    }, a.key = function (b) {
        return arguments.length ? (e = b, a) : e
    }, a.color = function (b) {
        return arguments.length ? (f = nv.utils.getColor(b), a) : f
    }, a.align = function (b) {
        return arguments.length ? (g = b, a) : g
    }, a
};