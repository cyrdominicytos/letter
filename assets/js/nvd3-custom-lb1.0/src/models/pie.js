/*! light-blue - v3.1.0 - 2014-12-06 */
nv.models.pie = function () {
    function a(h) {
        return h.each(function (a) {
            function h(a) {
                p || (a.innerRadius = 0);
                var b = d3.interpolate(this._current, a);
                return this._current = b(0), function (a) {
                    return D(b(a))
                }
            }

            var k = c - b.left - b.right, v = d - b.top - b.bottom, w = Math.min(k, v) / 2, x = w, y = d3.select(this),
                z = y.selectAll(".nv-wrap.nv-pie").data([e(a[0])]),
                A = z.enter().append("g").attr("class", "nvd3 nv-wrap nv-pie nv-chart-" + i), B = A.append("g"),
                C = z.select("g");
            B.append("g").attr("class", "nv-pie"), z.attr("transform", "translate(" + b.left + "," + b.top + ")"), C.select(".nv-pie").attr("transform", "translate(" + k / 2 + "," + v / 2 + ")"), y.on("click", function (a, b) {
                u.chartClick({data: a, index: b, pos: d3.event, id: i})
            });
            var D = d3.svg.arc().outerRadius(x);
            r && D.startAngle(r), s && D.endAngle(s), p && D.innerRadius(w * t);
            var E = d3.layout.pie().sort(null).value(function (a) {
                return a.disabled ? 0 : g(a)
            }), F = z.select(".nv-pie").selectAll(".nv-slice").data(E);
            F.exit().remove();
            var G = F.enter().append("g").attr("class", "nv-slice").on("mouseover", function (a, b) {
                d3.select(this).classed("hover", !0), u.elementMouseover({
                    label: f(a.data),
                    value: g(a.data),
                    point: a.data,
                    pointIndex: b,
                    pos: [d3.event.pageX, d3.event.pageY],
                    id: i
                })
            }).on("mouseout", function (a, b) {
                d3.select(this).classed("hover", !1), u.elementMouseout({
                    label: f(a.data),
                    value: g(a.data),
                    point: a.data,
                    index: b,
                    id: i
                })
            }).on("click", function (a, b) {
                u.elementClick({
                    label: f(a.data),
                    value: g(a.data),
                    point: a.data,
                    index: b,
                    pos: d3.event,
                    id: i
                }), d3.event.stopPropagation()
            }).on("dblclick", function (a, b) {
                u.elementDblClick({
                    label: f(a.data),
                    value: g(a.data),
                    point: a.data,
                    index: b,
                    pos: d3.event,
                    id: i
                }), d3.event.stopPropagation()
            });
            F.attr("fill", function (a, b) {
                return j(a, b)
            }).attr("stroke", function (a, b) {
                return j(a, b)
            });
            G.append("path").each(function (a) {
                this._current = a
            });
            if (d3.transition(F.select("path")).attr("d", D).attrTween("d", h), l) {
                var H = d3.svg.arc().innerRadius(0);
                m && (H = D), n && (H = d3.svg.arc().outerRadius(D.outerRadius())), G.append("g").classed("nv-label", !0).each(function (a) {
                    var b = d3.select(this);
                    b.attr("transform", function (a) {
                        if (q) {
                            a.outerRadius = x + 10, a.innerRadius = x + 15;
                            var b = (a.startAngle + a.endAngle) / 2 * (180 / Math.PI);
                            return (a.startAngle + a.endAngle) / 2 < Math.PI ? b -= 90 : b += 90, "translate(" + H.centroid(a) + ") rotate(" + b + ")"
                        }
                        return a.outerRadius = w + 10, a.innerRadius = w + 15, "translate(" + H.centroid(a) + ")"
                    }), b.append("rect").style("stroke", "#fff").style("fill", "#fff").attr("rx", 3).attr("ry", 3), b.append("text").style("text-anchor", q ? (a.startAngle + a.endAngle) / 2 < Math.PI ? "start" : "end" : "middle").style("fill", "#000")
                }), F.select(".nv-label").transition().attr("transform", function (a) {
                    if (q) {
                        a.outerRadius = x + 10, a.innerRadius = x + 15;
                        var b = (a.startAngle + a.endAngle) / 2 * (180 / Math.PI);
                        return (a.startAngle + a.endAngle) / 2 < Math.PI ? b -= 90 : b += 90, "translate(" + H.centroid(a) + ") rotate(" + b + ")"
                    }
                    return a.outerRadius = w + 10, a.innerRadius = w + 15, "translate(" + H.centroid(a) + ")"
                }), F.each(function (a) {
                    var b = d3.select(this);
                    b.select(".nv-label text").style("text-anchor", q ? (a.startAngle + a.endAngle) / 2 < Math.PI ? "start" : "end" : "middle").text(function (a) {
                        var b = (a.endAngle - a.startAngle) / (2 * Math.PI);
                        return a.value && b > o ? f(a.data) : ""
                    });
                    var c = b.select("text").node().getBBox();
                    b.select(".nv-label rect").attr("width", c.width + 10).attr("height", c.height + 10).attr("transform", function () {
                        return "translate(" + [c.x - 5, c.y - 5] + ")"
                    })
                })
            }
        }), a
    }

    var b = {top: 0, right: 0, bottom: 0, left: 0}, c = 500, d = 500, e = function (a) {
            return a.values
        }, f = function (a) {
            return a.x
        }, g = function (a) {
            return a.y
        }, h = function (a) {
            return a.description
        }, i = Math.floor(1e4 * Math.random()), j = nv.utils.defaultColor(), k = d3.format(",.2f"), l = !0, m = !0, n = !1,
        o = .02, p = !1, q = !1, r = !1, s = !1, t = .5,
        u = d3.dispatch("chartClick", "elementClick", "elementDblClick", "elementMouseover", "elementMouseout");
    return a.dispatch = u, a.margin = function (c) {
        return arguments.length ? (b.top = "undefined" != typeof c.top ? c.top : b.top, b.right = "undefined" != typeof c.right ? c.right : b.right, b.bottom = "undefined" != typeof c.bottom ? c.bottom : b.bottom, b.left = "undefined" != typeof c.left ? c.left : b.left, a) : b
    }, a.width = function (b) {
        return arguments.length ? (c = b, a) : c
    }, a.height = function (b) {
        return arguments.length ? (d = b, a) : d
    }, a.values = function (b) {
        return arguments.length ? (e = b, a) : e
    }, a.x = function (b) {
        return arguments.length ? (f = b, a) : f
    }, a.y = function (b) {
        return arguments.length ? (g = d3.functor(b), a) : g
    }, a.description = function (b) {
        return arguments.length ? (h = b, a) : h
    }, a.showLabels = function (b) {
        return arguments.length ? (l = b, a) : l
    }, a.labelSunbeamLayout = function (b) {
        return arguments.length ? (q = b, a) : q
    }, a.donutLabelsOutside = function (b) {
        return arguments.length ? (n = b, a) : n
    }, a.pieLabelsOutside = function (b) {
        return arguments.length ? (m = b, a) : m
    }, a.donut = function (b) {
        return arguments.length ? (p = b, a) : p
    }, a.donutRatio = function (b) {
        return arguments.length ? (t = b, a) : t
    }, a.startAngle = function (b) {
        return arguments.length ? (r = b, a) : r
    }, a.endAngle = function (b) {
        return arguments.length ? (s = b, a) : s
    }, a.id = function (b) {
        return arguments.length ? (i = b, a) : i
    }, a.color = function (b) {
        return arguments.length ? (j = nv.utils.getColor(b), a) : j
    }, a.valueFormat = function (b) {
        return arguments.length ? (k = b, a) : k
    }, a.labelThreshold = function (b) {
        return arguments.length ? (o = b, a) : o
    }, a
};