/*! light-blue - v3.1.0 - 2014-12-06 */
nv.models.lineChart = function () {
    function a(o) {
        return o.each(function (t) {
            var u = d3.select(this), v = this, w = (j || parseInt(u.style("width")) || 960) - h.left - h.right,
                x = (k || parseInt(u.style("height")) || 400) - h.top - h.bottom;
            if (a.update = function () {
                a(o)
            }, a.container = this, p.disabled = t.map(function (a) {
                return !!a.disabled
            }), !(t && t.length && t.filter(function (a) {
                return a.values.length
            }).length)) {
                var y = u.selectAll(".nv-noData").data([q]);
                return y.enter().append("text").attr("class", "nvd3 nv-noData").attr("dy", "-.7em").style("text-anchor", "middle"), y.attr("x", h.left + w / 2).attr("y", h.top + x / 2).text(function (a) {
                    return a
                }), a
            }
            u.selectAll(".nv-noData").remove(), b = d.xScale(), c = d.yScale();
            var z = u.selectAll("g.nv-wrap.nv-lineChart").data([t]),
                A = z.enter().append("g").attr("class", "nvd3 nv-wrap nv-lineChart").append("g"), B = z.select("g");
            A.append("g").attr("class", "nv-x nv-axis"), A.append("g").attr("class", "nv-y nv-axis"), A.append("g").attr("class", "nv-linesWrap"), A.append("g").attr("class", "nv-legendWrap"), l && (g.width(w), B.select(".nv-legendWrap").datum(t).call(g), h.top != g.height() && (h.top = g.height(), x = (k || parseInt(u.style("height")) || 400) - h.top - h.bottom), z.select(".nv-legendWrap").attr("transform", "translate(0," + -h.top + ")")), z.attr("transform", "translate(" + h.left + "," + h.top + ")"), d.width(w).height(x).color(t.map(function (a, b) {
                return a.color || i(a, b)
            }).filter(function (a, b) {
                return !t[b].disabled
            }));
            var C = B.select(".nv-linesWrap").datum(t.filter(function (a) {
                return !a.disabled
            }));
            d3.transition(C).call(d), e.scale(b), B.select(".nv-x.nv-axis").attr("transform", "translate(0," + c.range()[0] + ")"), d3.transition(B.select(".nv-x.nv-axis")).call(e), f.scale(c).ticks(x / 50).tickSize(-w, 0), m || f.ticks(0), d3.transition(B.select(".nv-y.nv-axis")).call(f), g.dispatch.on("legendClick", function (b) {
                b.disabled = !b.disabled, t.filter(function (a) {
                    return !a.disabled
                }).length || t.map(function (a) {
                    return a.disabled = !1, z.selectAll(".nv-series").classed("disabled", !1), a
                }), p.disabled = t.map(function (a) {
                    return !!a.disabled
                }), r.stateChange(p), o.transition().call(a)
            }), r.on("tooltipShow", function (a) {
                n && s(a, v.parentNode)
            }), r.on("changeState", function (b) {
                "undefined" != typeof b.disabled && (t.forEach(function (a, c) {
                    a.disabled = b.disabled[c]
                }), p.disabled = b.disabled), o.call(a)
            })
        }), a
    }

    var b, c, d = nv.models.line(), e = nv.models.axis(), f = nv.models.axis(), g = nv.models.legend(),
        h = {top: 30, right: 20, bottom: 50, left: 60}, i = nv.utils.defaultColor(), j = null, k = null, l = !0, m = !0,
        n = !0, o = function (a, b, c) {
            return "<h3>" + a + "</h3><p>" + c + " at " + b + "</p>"
        }, p = {}, q = "No Data Available.", r = d3.dispatch("tooltipShow", "tooltipHide", "stateChange", "changeState");
    e.orient("bottom").tickPadding(7), f.orient("left");
    var s = function (b, c) {
        if (c) {
            var g = d3.select(c).select("svg"), h = g.attr("viewBox");
            if (h) {
                h = h.split(" ");
                var i = parseInt(g.style("width")) / h[2];
                b.pos[0] = b.pos[0] * i, b.pos[1] = b.pos[1] * i
            }
        }
        var j = b.pos[0] + (c.offsetLeft || 0), k = b.pos[1] + (c.offsetTop || 0),
            l = e.tickFormat()(d.x()(b.point, b.pointIndex)), m = f.tickFormat()(d.y()(b.point, b.pointIndex)),
            n = o(b.series.key, l, m, b, a);
        nv.tooltip.show([j, k], n, null, null, c)
    };
    return d.dispatch.on("elementMouseover.tooltip", function (a) {
        a.pos = [a.pos[0] + h.left, a.pos[1] + h.top], r.tooltipShow(a)
    }), d.dispatch.on("elementMouseout.tooltip", function (a) {
        r.tooltipHide(a)
    }), r.on("tooltipHide", function () {
        n && nv.tooltip.cleanup()
    }), a.dispatch = r, a.lines = d, a.legend = g, a.xAxis = e, a.yAxis = f, d3.rebind(a, d, "defined", "isArea", "x", "y", "size", "xScale", "yScale", "xDomain", "yDomain", "forceX", "forceY", "interactive", "clipEdge", "clipVoronoi", "id", "interpolate"), a.margin = function (b) {
        return arguments.length ? (h.top = "undefined" != typeof b.top ? b.top : h.top, h.right = "undefined" != typeof b.right ? b.right : h.right, h.bottom = "undefined" != typeof b.bottom ? b.bottom : h.bottom, h.left = "undefined" != typeof b.left ? b.left : h.left, a) : h
    }, a.width = function (b) {
        return arguments.length ? (j = b, a) : j
    }, a.height = function (b) {
        return arguments.length ? (k = b, a) : k
    }, a.color = function (b) {
        return arguments.length ? (i = nv.utils.getColor(b), g.color(i), a) : i
    }, a.showLegend = function (b) {
        return arguments.length ? (l = b, a) : l
    }, a.tooltips = function (b) {
        return arguments.length ? (n = b, a) : n
    }, a.tooltipContent = function (b) {
        return arguments.length ? (o = b, a) : o
    }, a.state = function (b) {
        return arguments.length ? (p = b, a) : p
    }, a.ticks = function (b) {
        return arguments.length ? (m = b, a) : m
    }, a.noData = function (b) {
        return arguments.length ? (q = b, a) : q
    }, a
};