/*! light-blue - v3.1.0 - 2014-12-06 */
nv.models.multiBar = function () {
    function a(v) {
        return v.each(function (a) {
            var v = h - g.left - g.right, w = i - g.top - g.bottom, x = d3.select(this);
            q && (a = d3.layout.stack().offset("zero").values(function (a) {
                return a.values
            }).y(n)(a)), a = a.map(function (a, b) {
                return a.values = a.values.map(function (a) {
                    return a.series = b, a
                }), a
            }), q && a[0].values.map(function (b, c) {
                var d = 0, e = 0;
                a.map(function (a) {
                    var b = a.values[c];
                    b.size = Math.abs(b.y), b.y < 0 ? (b.y1 = e, e -= b.size) : (b.y1 = b.size + d, d += b.size)
                })
            });
            var y = c && d ? [] : a.map(function (a) {
                return a.values.map(function (a, b) {
                    return {x: m(a, b), y: n(a, b), y0: a.y0, y1: a.y1}
                })
            });
            j.domain(d3.merge(y).map(function (a) {
                return a.x
            })).rangeBands([0, v], .1), k.domain(d || d3.extent(d3.merge(y).map(function (a) {
                return q ? a.y > 0 ? a.y1 : a.y1 + a.y : a.y
            }).concat(o))).range([w, 0]), (j.domain()[0] === j.domain()[1] || k.domain()[0] === k.domain()[1]) && (singlePoint = !0), j.domain()[0] === j.domain()[1] && j.domain(j.domain()[0] ? [j.domain()[0] - .01 * j.domain()[0], j.domain()[1] + .01 * j.domain()[1]] : [-1, 1]), k.domain()[0] === k.domain()[1] && k.domain(k.domain()[0] ? [k.domain()[0] + .01 * k.domain()[0], k.domain()[1] - .01 * k.domain()[1]] : [-1, 1]), e = e || j, f = f || k;
            var z = x.selectAll("g.nv-wrap.nv-multibar").data([a]),
                A = z.enter().append("g").attr("class", "nvd3 nv-wrap nv-multibar"), B = A.append("defs"),
                C = A.append("g"), D = z.select("g");
            C.append("g").attr("class", "nv-groups"), z.attr("transform", "translate(" + g.left + "," + g.top + ")"), B.append("clipPath").attr("id", "nv-edge-clip-" + l).append("rect"), z.select("#nv-edge-clip-" + l + " rect").attr("width", v).attr("height", w), D.attr("clip-path", p ? "url(#nv-edge-clip-" + l + ")" : "");
            var E = z.select(".nv-groups").selectAll(".nv-group").data(function (a) {
                return a
            }, function (a) {
                return a.key
            });
            E.enter().append("g").style("stroke-opacity", 1e-6).style("fill-opacity", 1e-6), d3.transition(E.exit()).selectAll("rect.nv-bar").delay(function (b, c) {
                return c * t / a[0].values.length
            }).attr("y", function (a) {
                return f(q ? a.y0 : 0)
            }).attr("height", 0).remove(), E.attr("class", function (a, b) {
                return "nv-group nv-series-" + b
            }).classed("hover", function (a) {
                return a.hover
            }).style("fill", function (a, b) {
                return r(a, b)
            }).style("stroke", function (a, b) {
                return r(a, b)
            }), d3.transition(E).style("stroke-opacity", 1).style("fill-opacity", .75);
            var F = E.selectAll("rect.nv-bar").data(function (a) {
                return a.values
            });
            F.exit().remove();
            F.enter().append("rect").attr("class", function (a, b) {
                return n(a, b) < 0 ? "nv-bar negative" : "nv-bar positive"
            }).attr("x", function (b, c, d) {
                return q ? 0 : d * j.rangeBand() / a.length
            }).attr("y", function (a) {
                return f(q ? a.y0 : 0)
            }).attr("height", 0).attr("width", j.rangeBand() / (q ? 1 : a.length));
            F.style("fill", function (a, b, c) {
                return r(a, c, b)
            }).style("stroke", function (a, b, c) {
                return r(a, c, b)
            }).on("mouseover", function (b, c) {
                d3.select(this).classed("hover", !0), u.elementMouseover({
                    value: n(b, c),
                    point: b,
                    series: a[b.series],
                    pos: [j(m(b, c)) + j.rangeBand() * (q ? a.length / 2 : b.series + .5) / a.length, k(n(b, c) + (q ? b.y0 : 0))],
                    pointIndex: c,
                    seriesIndex: b.series,
                    e: d3.event
                })
            }).on("mouseout", function (b, c) {
                d3.select(this).classed("hover", !1), u.elementMouseout({
                    value: n(b, c),
                    point: b,
                    series: a[b.series],
                    pointIndex: c,
                    seriesIndex: b.series,
                    e: d3.event
                })
            }).on("click", function (b, c) {
                u.elementClick({
                    value: n(b, c),
                    point: b,
                    series: a[b.series],
                    pos: [j(m(b, c)) + j.rangeBand() * (q ? a.length / 2 : b.series + .5) / a.length, k(n(b, c) + (q ? b.y0 : 0))],
                    pointIndex: c,
                    seriesIndex: b.series,
                    e: d3.event
                }), d3.event.stopPropagation()
            }).on("dblclick", function (b, c) {
                u.elementDblClick({
                    value: n(b, c),
                    point: b,
                    series: a[b.series],
                    pos: [j(m(b, c)) + j.rangeBand() * (q ? a.length / 2 : b.series + .5) / a.length, k(n(b, c) + (q ? b.y0 : 0))],
                    pointIndex: c,
                    seriesIndex: b.series,
                    e: d3.event
                }), d3.event.stopPropagation()
            }), F.attr("class", function (a, b) {
                return n(a, b) < 0 ? "nv-bar negative" : "nv-bar positive"
            }).attr("transform", function (a, b) {
                return "translate(" + j(m(a, b)) + ",0)"
            }), s && (b || (b = a.map(function () {
                return !0
            })), F.style("fill", function (a, c, d) {
                return d3.rgb(s(a, c)).darker(b.map(function (a, b) {
                    return b
                }).filter(function (a, c) {
                    return !b[c]
                })[d]).toString()
            }).style("stroke", function (a, c, d) {
                return d3.rgb(s(a, c)).darker(b.map(function (a, b) {
                    return b
                }).filter(function (a, c) {
                    return !b[c]
                })[d]).toString()
            })), q ? d3.transition(F).delay(function (b, c) {
                return c * t / a[0].values.length
            }).attr("y", function (a) {
                return k(q ? a.y1 : 0)
            }).attr("height", function (a) {
                return Math.max(Math.abs(k(a.y + (q ? a.y0 : 0)) - k(q ? a.y0 : 0)), 1)
            }).each("end", function () {
                d3.transition(d3.select(this)).attr("x", function (b) {
                    return q ? 0 : b.series * j.rangeBand() / a.length
                }).attr("width", j.rangeBand() / (q ? 1 : a.length))
            }) : d3.transition(F).delay(function (b, c) {
                return c * t / a[0].values.length
            }).attr("x", function (b) {
                return b.series * j.rangeBand() / a.length
            }).attr("width", j.rangeBand() / a.length).each("end", function () {
                d3.transition(d3.select(this)).attr("y", function (a, b) {
                    return n(a, b) < 0 ? k(0) : k(0) - k(n(a, b)) < 1 ? k(0) - 1 : k(n(a, b)) || 0
                }).attr("height", function (a, b) {
                    return Math.max(Math.abs(k(n(a, b)) - k(0)), 1) || 0
                })
            }), e = j.copy(), f = k.copy()
        }), a
    }

    var b, c, d, e, f, g = {top: 0, right: 0, bottom: 0, left: 0}, h = 960, i = 500, j = d3.scale.ordinal(),
        k = d3.scale.linear(), l = Math.floor(1e4 * Math.random()), m = function (a) {
            return a.x
        }, n = function (a) {
            return a.y
        }, o = [0], p = !0, q = !1, r = nv.utils.defaultColor(), s = null, t = 1200,
        u = d3.dispatch("chartClick", "elementClick", "elementDblClick", "elementMouseover", "elementMouseout");
    return a.dispatch = u, a.x = function (b) {
        return arguments.length ? (m = b, a) : m
    }, a.y = function (b) {
        return arguments.length ? (n = b, a) : n
    }, a.margin = function (b) {
        return arguments.length ? (g.top = "undefined" != typeof b.top ? b.top : g.top, g.right = "undefined" != typeof b.right ? b.right : g.right, g.bottom = "undefined" != typeof b.bottom ? b.bottom : g.bottom, g.left = "undefined" != typeof b.left ? b.left : g.left, a) : g
    }, a.width = function (b) {
        return arguments.length ? (h = b, a) : h
    }, a.height = function (b) {
        return arguments.length ? (i = b, a) : i
    }, a.xScale = function (b) {
        return arguments.length ? (j = b, a) : j
    }, a.yScale = function (b) {
        return arguments.length ? (k = b, a) : k
    }, a.xDomain = function (b) {
        return arguments.length ? (c = b, a) : c
    }, a.yDomain = function (b) {
        return arguments.length ? (d = b, a) : d
    }, a.forceY = function (b) {
        return arguments.length ? (o = b, a) : o
    }, a.stacked = function (b) {
        return arguments.length ? (q = b, a) : q
    }, a.clipEdge = function (b) {
        return arguments.length ? (p = b, a) : p
    }, a.color = function (b) {
        return arguments.length ? (r = nv.utils.getColor(b), a) : r
    }, a.barColor = function (b) {
        return arguments.length ? (s = nv.utils.getColor(b), a) : s
    }, a.disabled = function (c) {
        return arguments.length ? (b = c, a) : b
    }, a.id = function (b) {
        return arguments.length ? (l = b, a) : l
    }, a.delay = function (b) {
        return arguments.length ? (t = b, a) : t
    }, a
};