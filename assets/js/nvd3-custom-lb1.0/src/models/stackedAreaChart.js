/*! light-blue - v3.1.0 - 2014-12-06 */
nv.models.stackedAreaChart = function () {
    function a(l) {
        return l.each(function (m) {
            var r = d3.select(this), y = this, z = (j || parseInt(r.style("width")) || 960) - i.left - i.right,
                A = (k || parseInt(r.style("height")) || 400) - i.top - i.bottom;
            if (a.update = function () {
                a(l)
            }, a.container = this, t.disabled = m.map(function (a) {
                return !!a.disabled
            }), !(m && m.length && m.filter(function (a) {
                return a.values.length
            }).length)) {
                var B = r.selectAll(".nv-noData").data([u]);
                return B.enter().append("text").attr("class", "nvd3 nv-noData").attr("dy", "-.7em").style("text-anchor", "middle"), B.attr("x", i.left + z / 2).attr("y", i.top + A / 2).text(function (a) {
                    return a
                }), a
            }
            r.selectAll(".nv-noData").remove(), b = d.xScale(), c = d.yScale();
            var C = r.selectAll("g.nv-wrap.nv-stackedAreaChart").data([m]),
                D = C.enter().append("g").attr("class", "nvd3 nv-wrap nv-stackedAreaChart").append("g"),
                E = C.select("g");
            if (p && (D.append("g").attr("class", "nv-x nv-axis"), D.append("g").attr("class", "nv-y nv-axis")), D.append("g").attr("class", "nv-stackedWrap"), o && D.append("g").attr("class", "nv-legendWrap"), n && D.append("g").attr("class", "nv-controlsWrap"), o && (g.width(z - w), E.select(".nv-legendWrap").datum(m).call(g), i.top != g.height() && (i.top = g.height(), A = (k || parseInt(r.style("height")) || 400) - i.top - i.bottom), E.select(".nv-legendWrap").attr("transform", "translate(" + w + "," + -i.top + ")")), n) {
                var F = [{key: "Stacked", disabled: "zero" != d.offset()}, {
                    key: "Stream",
                    disabled: "wiggle" != d.offset()
                }, {key: "Expanded", disabled: "expand" != d.offset()}];
                h.width(w).color(a.controlsColor()), E.select(".nv-controlsWrap").datum(F).call(h), i.top != Math.max(h.height(), g.height()) && (i.top = Math.max(h.height(), g.height()), A = (k || parseInt(r.style("height")) || 400) - i.top - i.bottom), E.select(".nv-controlsWrap").attr("transform", "translate(0," + -i.top + ")")
            }
            C.attr("transform", "translate(" + i.left + "," + i.top + ")"), d.width(z).height(A);
            var G = E.select(".nv-stackedWrap").datum(m);
            G.call(d), p && (e.scale(b), E.select(".nv-x.nv-axis").attr("transform", "translate(0," + A + ")"), E.select(".nv-x.nv-axis").transition().call(e), f.scale(c).ticks("wiggle" == d.offset() ? 0 : A / 50).tickSize(-z, 0).setTickFormat("expand" == d.offset() ? d3.format("%") : s), E.select(".nv-y.nv-axis").transition().call(f)), d.dispatch.on("areaClick.toggle", function (b) {
                m = m.map(1 === m.filter(function (a) {
                    return !a.disabled
                }).length ? function (a) {
                    return a.disabled = !1, a
                } : function (a, c) {
                    return a.disabled = c != b.seriesIndex, a
                }), t.disabled = m.map(function (a) {
                    return !!a.disabled
                }), v.stateChange(t), a(l)
            }), g.dispatch.on("legendClick", function (b) {
                b.disabled = !b.disabled, m.filter(function (a) {
                    return !a.disabled
                }).length || m.map(function (a) {
                    return a.disabled = !1, a
                }), t.disabled = m.map(function (a) {
                    return !!a.disabled
                }), v.stateChange(t), a(l)
            }), h.dispatch.on("legendClick", function (b) {
                if (b.disabled) {
                    switch (F = F.map(function (a) {
                        return a.disabled = !0, a
                    }), b.disabled = !1, b.key) {
                        case"Stacked":
                            d.style("stack");
                            break;
                        case"Stream":
                            d.style("stream");
                            break;
                        case"Expanded":
                            d.style("expand")
                    }
                    t.style = d.style(), v.stateChange(t), a(l)
                }
            }), v.on("tooltipShow", function (a) {
                q && x(a, y.parentNode)
            }), v.on("changeState", function (b) {
                "undefined" != typeof b.disabled && (m.forEach(function (a, c) {
                    a.disabled = b.disabled[c]
                }), t.disabled = b.disabled), "undefined" != typeof b.style && d.style(b.style), l.call(a)
            })
        }), a
    }

    var b, c, d = nv.models.stackedArea(), e = nv.models.axis(), f = nv.models.axis(), g = nv.models.legend(),
        h = nv.models.legend(), i = {top: 0, right: 0, bottom: 20, left: 35}, j = null, k = null,
        l = nv.utils.defaultColor(), m = ["#555", "#555", "#555"], n = !0, o = !0, p = !0, q = !0,
        r = function (a, b, c) {
            return "<h4>" + a + "</h4><p>" + c + " on " + b + "</p>"
        }, s = d3.format(",f"), t = {style: d.style()}, u = "No Data Available.",
        v = d3.dispatch("tooltipShow", "tooltipHide", "stateChange", "changeState"), w = 250;
    p && (e.orient("bottom"), f.orient("left")), d.scatter.pointActive(function (a) {
        return !!Math.round(100 * d.y()(a))
    });
    var x = function (b, c) {
        var g = b.pos[0] + (c.offsetLeft || 0), h = b.pos[1] + (c.offsetTop || 0),
            i = e.tickFormat()(d.x()(b.point, b.pointIndex)), j = f.tickFormat()(d.y()(b.point, b.pointIndex)),
            k = r(b.series.key, i, j, b, a);
        nv.tooltip.show([g, h], k, b.value < 0 ? "n" : "s", null, c)
    };
    return d.dispatch.on("tooltipShow", function (a) {
        a.pos = [a.pos[0] + i.left, a.pos[1] + i.top], v.tooltipShow(a)
    }), d.dispatch.on("tooltipHide", function (a) {
        v.tooltipHide(a)
    }), v.on("tooltipHide", function () {
        q && nv.tooltip.cleanup()
    }), a.dispatch = v, a.stacked = d, a.legend = g, a.controls = h, a.xAxis = e, a.yAxis = f, d3.rebind(a, d, "x", "y", "size", "xScale", "yScale", "xDomain", "yDomain", "sizeDomain", "interactive", "offset", "order", "style", "clipEdge", "forceX", "forceY", "forceSize", "interpolate"), a.margin = function (b) {
        return arguments.length ? (i.top = "undefined" != typeof b.top ? b.top : i.top, i.right = "undefined" != typeof b.right ? b.right : i.right, i.bottom = "undefined" != typeof b.bottom ? b.bottom : i.bottom, i.left = "undefined" != typeof b.left ? b.left : i.left, a) : i
    }, a.width = function (b) {
        return arguments.length ? (j = b, a) : getWidth
    }, a.height = function (b) {
        return arguments.length ? (k = b, a) : getHeight
    }, a.color = function (b) {
        return arguments.length ? (l = nv.utils.getColor(b), g.color(l), d.color(l), a) : l
    }, a.showControls = function (b) {
        return arguments.length ? (n = b, a) : n
    }, a.showLegend = function (b) {
        return arguments.length ? (o = b, a) : o
    }, a.tooltip = function (b) {
        return arguments.length ? (r = b, a) : r
    }, a.tooltips = function (b) {
        return arguments.length ? (q = b, a) : q
    }, a.tooltipContent = function (b) {
        return arguments.length ? (r = b, a) : r
    }, a.state = function (b) {
        return arguments.length ? (t = b, a) : t
    }, a.noData = function (b) {
        return arguments.length ? (u = b, a) : u
    }, a.showAxes = function (b) {
        return arguments.length ? (p = b, p || a.margin({left: 0, right: 0, top: 0, bottom: 0}), a) : p
    }, a.controlsColor = function (b) {
        return arguments.length ? (m = b, a) : m
    }, f.setTickFormat = f.tickFormat, f.tickFormat = function (a) {
        return arguments.length ? (s = a, f) : s
    }, a
};