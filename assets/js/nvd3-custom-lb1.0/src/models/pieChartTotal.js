/*! light-blue - v3.1.0 - 2014-12-06 */
nv.models.pieChartTotal = function () {
    function a(j) {
        return j.each(function (k) {
            var l = d3.select(this), p = (e || parseInt(l.style("width")) || 960) - d.left - d.right,
                q = (f || parseInt(l.style("height")) || 400) - d.top - d.bottom;
            if (a.update = function () {
                a(j)
            }, a.container = this, m.disabled = k[0].map(function (a) {
                return !!a.disabled
            }), !k[0] || !k[0].length) {
                var r = l.selectAll(".nv-noData").data([n]);
                return r.enter().append("text").attr("class", "nvd3 nv-noData").attr("dy", "-.7em").style("text-anchor", "middle"), r.attr("x", d.left + p / 2).attr("y", d.top + q / 2).text(function (a) {
                    return a
                }), a
            }
            l.selectAll(".nv-noData").remove();
            var s = l.selectAll("g.nv-wrap.nv-pieChart").data([k]),
                t = s.enter().append("g").attr("class", "nvd3 nv-wrap nv-pieChart").append("g"), u = s.select("g");
            t.append("g").attr("class", "nv-pieWrap");
            var v = d3.select(l.node().parentNode);
            if (g) {
                v.selectAll(".total").remove();
                var w = d3.sum(k[0].filter(function (a) {
                    return !a.disabled
                }), b.y()), x = h ? d3.sum(k[0].filter(function (a) {
                    return !a.disabled
                }), a.z()) : void 0, y = v.append("div").attr("class", "total").html(g(w, x));
                y.attr("style", "left: " + (parseInt(v.style("width")) / 2 - parseInt(y.style("width")) / 2) + "px;top: " + (parseInt(v.style("height")) / 2 - parseInt(y.style("height")) / 2) + "px;")
            }
            t.append("g").attr("class", "nv-legendWrap"), i && (c.width(p).key(b.x()), s.select(".nv-legendWrap").datum(b.values()(k[0])).call(c), d.top != c.height() && (d.top = c.height(), q = (f || parseInt(l.style("height")) || 400) - d.top - d.bottom), s.select(".nv-legendWrap").attr("transform", "translate(0," + -d.top + ")")), s.attr("transform", "translate(" + d.left + "," + d.top + ")"), b.width(p).height(q);
            var z = u.select(".nv-pieWrap").datum(k);
            d3.transition(z).call(b), c.dispatch.on("legendClick", function (c) {
                c.disabled = !c.disabled, b.values()(k[0]).filter(function (a) {
                    return !a.disabled
                }).length || b.values()(k[0]).map(function (a) {
                    return a.disabled = !1, s.selectAll(".nv-series").classed("disabled", !1), a
                }), m.disabled = k[0].map(function (a) {
                    return !!a.disabled
                }), o.stateChange(m), j.transition().call(a)
            }), b.dispatch.on("elementMouseout.tooltip", function (a) {
                o.tooltipHide(a)
            }), o.on("changeState", function (b) {
                "undefined" != typeof b.disabled && (k[0].forEach(function (a, c) {
                    a.disabled = b.disabled[c]
                }), m.disabled = b.disabled), j.call(a)
            })
        }), a
    }

    var b = nv.models.pie(), c = nv.models.legend(), d = {top: 30, right: 20, bottom: 20, left: 20}, e = null, f = null,
        g = null, h = null, i = !0, j = nv.utils.defaultColor(), k = !0, l = function (a, b) {
            return "<h3>" + a + "</h3><p>" + b + "</p>"
        }, m = {}, n = "No Data Available.", o = d3.dispatch("tooltipShow", "tooltipHide", "stateChange", "changeState"),
        p = function (c, d) {
            var e = b.description()(c.point) || b.x()(c.point), f = c.pos[0] + (d && d.offsetLeft || 0),
                g = c.pos[1] + (d && d.offsetTop || 0), h = b.valueFormat()(b.y()(c.point)), i = l(e, h, c, a);
            nv.tooltip.show([f, g], i, c.value < 0 ? "n" : "s", null, d)
        };
    return b.dispatch.on("elementMouseover.tooltip", function (a) {
        a.pos = [a.pos[0] + d.left, a.pos[1] + d.top], o.tooltipShow(a)
    }), o.on("tooltipShow", function (a) {
        k && p(a)
    }), o.on("tooltipHide", function () {
        k && nv.tooltip.cleanup()
    }), a.legend = c, a.dispatch = o, a.pie = b, d3.rebind(a, b, "valueFormat", "values", "x", "y", "description", "id", "showLabels", "donutLabelsOutside", "pieLabelsOutside", "donut", "donutRatio", "labelThreshold"), a.margin = function (b) {
        return arguments.length ? (d.top = "undefined" != typeof b.top ? b.top : d.top, d.right = "undefined" != typeof b.right ? b.right : d.right, d.bottom = "undefined" != typeof b.bottom ? b.bottom : d.bottom, d.left = "undefined" != typeof b.left ? b.left : d.left, a) : d
    }, a.width = function (b) {
        return arguments.length ? (e = b, a) : e
    }, a.height = function (b) {
        return arguments.length ? (f = b, a) : f
    }, a.color = function (d) {
        return arguments.length ? (j = nv.utils.getColor(d), c.color(j), b.color(j), a) : j
    }, a.showLegend = function (b) {
        return arguments.length ? (i = b, a) : i
    }, a.tooltips = function (b) {
        return arguments.length ? (k = b, a) : k
    }, a.tooltipContent = function (b) {
        return arguments.length ? (l = b, a) : l
    }, a.total = function (b) {
        return arguments.length ? (g = b, a) : g
    }, a.state = function (b) {
        return arguments.length ? (m = b, a) : m
    }, a.noData = function (b) {
        return arguments.length ? (n = b, a) : n
    }, a.z = function (b) {
        return arguments.length ? (h = b, a) : h
    }, a
};