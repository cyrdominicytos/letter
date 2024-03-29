/*! light-blue - v3.1.0 - 2014-12-06 */
nv.models.multiBarChart = function () {
    function a(n) {
        return n.each(function (t) {
            var z = d3.select(this), A = this, B = (j || parseInt(z.style("width")) || 960) - i.left - i.right,
                C = (k || parseInt(z.style("height")) || 400) - i.top - i.bottom;
            if (a.update = function () {
                n.transition().call(a)
            }, a.container = this, u.disabled = t.map(function (a) {
                return !!a.disabled
            }), !(t && t.length && t.filter(function (a) {
                return a.values.length
            }).length)) {
                var D = z.selectAll(".nv-noData").data([v]);
                return D.enter().append("text").attr("class", "nvd3 nv-noData").attr("dy", "-.7em").style("text-anchor", "middle"), D.attr("x", i.left + B / 2).attr("y", i.top + C / 2).text(function (a) {
                    return a
                }), a
            }
            z.selectAll(".nv-noData").remove(), b = d.xScale(), c = d.yScale();
            var E = z.selectAll("g.nv-wrap.nv-multiBarWithLegend").data([t]),
                F = E.enter().append("g").attr("class", "nvd3 nv-wrap nv-multiBarWithLegend").append("g"),
                G = E.select("g");
            if (F.append("g").attr("class", "nv-x nv-axis"), F.append("g").attr("class", "nv-y nv-axis"), F.append("g").attr("class", "nv-barsWrap"), F.append("g").attr("class", "nv-legendWrap"), F.append("g").attr("class", "nv-controlsWrap"), p && (g.width(B - x()), d.barColor() && t.forEach(function (a, b) {
                a.color = d3.rgb("#ccc").darker(1.5 * b).toString()
            }), G.select(".nv-legendWrap").datum(t).call(g), i.top != g.height() && (i.top = g.height(), C = (k || parseInt(z.style("height")) || 400) - i.top - i.bottom), G.select(".nv-legendWrap").attr("transform", "translate(" + x() + "," + -i.top + ")")), o) {
                var H = [{key: "Grouped", disabled: d.stacked()}, {key: "Stacked", disabled: !d.stacked()}];
                h.width(x()).color(a.controlsColor()), G.select(".nv-controlsWrap").datum(H).attr("transform", "translate(0," + -i.top + ")").call(h)
            }
            E.attr("transform", "translate(" + i.left + "," + i.top + ")"), d.disabled(t.map(function (a) {
                return a.disabled
            })).width(B).height(C).color(t.map(function (a, b) {
                return a.color || m(a, b)
            }).filter(function (a, b) {
                return !t[b].disabled
            }));
            var I = G.select(".nv-barsWrap").datum(t.filter(function (a) {
                return !a.disabled
            }));
            if (d3.transition(I).call(d), l) {
                e.scale(b).ticks(B / 100).tickSize(-C, 0), G.select(".nv-x.nv-axis").attr("transform", "translate(0," + c.range()[0] + ")"), d3.transition(G.select(".nv-x.nv-axis")).call(e);
                var J = G.select(".nv-x.nv-axis > g").selectAll("g");
                J.selectAll("line, text").style("opacity", 1), q && J.filter(function (a, b) {
                    return b % Math.ceil(t[0].values.length / (B / 100)) !== 0
                }).selectAll("text, line").style("opacity", 0), r && J.selectAll("text").attr("transform", "rotate(" + r + " 0,0)").attr("text-anchor", r > 0 ? "start" : "end"), G.select(".nv-x.nv-axis").selectAll("g.nv-axisMaxMin text").style("opacity", 1), f.scale(c).ticks(C / 36).tickSize(-B, 0), d3.transition(G.select(".nv-y.nv-axis")).call(f)
            }
            g.dispatch.on("legendClick", function (b) {
                b.disabled = !b.disabled, t.filter(function (a) {
                    return !a.disabled
                }).length || t.map(function (a) {
                    return a.disabled = !1, E.selectAll(".nv-series").classed("disabled", !1), a
                }), u.disabled = t.map(function (a) {
                    return !!a.disabled
                }), w.stateChange(u), n.transition().call(a)
            }), h.dispatch.on("legendClick", function (b) {
                if (b.disabled) {
                    switch (H = H.map(function (a) {
                        return a.disabled = !0, a
                    }), b.disabled = !1, b.key) {
                        case"Grouped":
                            d.stacked(!1);
                            break;
                        case"Stacked":
                            d.stacked(!0)
                    }
                    u.stacked = d.stacked(), w.stateChange(u), n.transition().call(a)
                }
            }), w.on("tooltipShow", function (a) {
                s && y(a, A.parentNode)
            }), w.on("changeState", function (b) {
                "undefined" != typeof b.disabled && (t.forEach(function (a, c) {
                    a.disabled = b.disabled[c]
                }), u.disabled = b.disabled), "undefined" != typeof b.stacked && (d.stacked(b.stacked), u.stacked = b.stacked), n.call(a)
            })
        }), a
    }

    var b, c, d = nv.models.multiBar(), e = nv.models.axis(), f = nv.models.axis(), g = nv.models.legend(),
        h = nv.models.legend(), i = {top: 30, right: 20, bottom: 30, left: 60}, j = null, k = null, l = !0,
        m = nv.utils.defaultColor(), n = ["#555", "#555", "#555"], o = !0, p = !0, q = !0, r = 0, s = !0,
        t = function (a, b, c) {
            return "<h3>" + a + "</h3><p>" + c + " on " + b + "</p>"
        }, u = {stacked: !1}, v = "No Data Available.",
        w = d3.dispatch("tooltipShow", "tooltipHide", "stateChange", "changeState"), x = function () {
            return o ? 180 : 0
        };
    d.stacked(!1), e.orient("bottom").tickPadding(7).highlightZero(!1).showMaxMin(!1).tickFormat(function (a) {
        return a
    }), f.orient("left").tickFormat(d3.format(",.1f"));
    var y = function (b, c) {
        var g = b.pos[0] + (c.offsetLeft || 0), h = b.pos[1] + (c.offsetTop || 0),
            i = e.tickFormat()(d.x()(b.point, b.pointIndex)), j = f.tickFormat()(d.y()(b.point, b.pointIndex)),
            k = t(b.series.key, i, j, b, a);
        nv.tooltip.show([g, h], k, b.value < 0 ? "n" : "s", null, c)
    };
    return d.dispatch.on("elementMouseover.tooltip", function (a) {
        a.pos = [a.pos[0] + i.left, a.pos[1] + i.top], w.tooltipShow(a)
    }), d.dispatch.on("elementMouseout.tooltip", function (a) {
        w.tooltipHide(a)
    }), w.on("tooltipHide", function () {
        s && nv.tooltip.cleanup()
    }), a.dispatch = w, a.multibar = d, a.legend = g, a.xAxis = e, a.yAxis = f, d3.rebind(a, d, "x", "y", "xDomain", "yDomain", "forceX", "forceY", "clipEdge", "id", "stacked", "delay", "barColor"), a.margin = function (b) {
        return arguments.length ? (i.top = "undefined" != typeof b.top ? b.top : i.top, i.right = "undefined" != typeof b.right ? b.right : i.right, i.bottom = "undefined" != typeof b.bottom ? b.bottom : i.bottom, i.left = "undefined" != typeof b.left ? b.left : i.left, a) : i
    }, a.width = function (b) {
        return arguments.length ? (j = b, a) : j
    }, a.height = function (b) {
        return arguments.length ? (k = b, a) : k
    }, a.color = function (b) {
        return arguments.length ? (m = nv.utils.getColor(b), g.color(m), a) : m
    }, a.showControls = function (b) {
        return arguments.length ? (o = b, a) : o
    }, a.showLegend = function (b) {
        return arguments.length ? (p = b, a) : p
    }, a.reduceXTicks = function (b) {
        return arguments.length ? (q = b, a) : q
    }, a.rotateLabels = function (b) {
        return arguments.length ? (r = b, a) : r
    }, a.tooltip = function (b) {
        return arguments.length ? (t = b, a) : t
    }, a.tooltips = function (b) {
        return arguments.length ? (s = b, a) : s
    }, a.tooltipContent = function (b) {
        return arguments.length ? (t = b, a) : t
    }, a.state = function (b) {
        return arguments.length ? (u = b, a) : u
    }, a.noData = function (b) {
        return arguments.length ? (v = b, a) : v
    }, a.ticks = function (b) {
        return arguments.length ? (l = b, a) : l
    }, a.controlsColor = function (b) {
        return arguments.length ? (n = b, a) : n
    }, a
};