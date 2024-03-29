/*! light-blue - v3.1.0 - 2014-12-06 */
nv.models.scatter = function () {
    function a(J) {
        return J.each(function (a) {
            function J() {
                if (!v) return !1;
                var b = d3.merge(a.map(function (a, b) {
                    return a.values.map(function (a, c) {
                        return [k(n(a, c)) * (Math.random() / 1e12 + 1), l(o(a, c)) * (Math.random() / 1e12 + 1), b, c, a]
                    }).filter(function (a, b) {
                        return w(a[4], b)
                    })
                }));
                if (H === !0) {
                    if (z) {
                        var c = O.select("defs").selectAll(".nv-point-clips").data([j]).enter();
                        c.append("clipPath").attr("class", "nv-point-clips").attr("id", "nv-points-clip-" + j);
                        var d = O.select("#nv-points-clip-" + j).selectAll("circle").data(b);
                        d.enter().append("circle").attr("r", A), d.exit().remove(), d.attr("cx", function (a) {
                            return a[0]
                        }).attr("cy", function (a) {
                            return a[1]
                        }), O.select(".nv-point-paths").attr("clip-path", "url(#nv-points-clip-" + j + ")")
                    }
                    b.length < 3 && (b.push([k.range()[0] - 20, l.range()[0] - 20, null, null]), b.push([k.range()[1] + 20, l.range()[1] + 20, null, null]), b.push([k.range()[0] - 20, l.range()[0] + 20, null, null]), b.push([k.range()[1] + 20, l.range()[1] - 20, null, null]));
                    var e = d3.geom.polygon([[-10, -10], [-10, h + 10], [g + 10, h + 10], [g + 10, -10]]),
                        i = d3.geom.voronoi(b).map(function (a, c) {
                            return {data: e.clip(a), series: b[c][2], point: b[c][3]}
                        }), m = O.select(".nv-point-paths").selectAll("path").data(i);
                    m.enter().append("path").attr("class", function (a, b) {
                        return "nv-path-" + b
                    }), m.exit().remove(), m.filter(function (a) {
                        return a.data.length > 0
                    }).attr("d", function (a) {
                        return "M" + a.data.join("L") + "Z"
                    }), m.on("click", function (b) {
                        if (I) return 0;
                        var c = a[b.series], d = c.values[b.point];
                        G.elementClick({
                            point: d,
                            series: c,
                            pos: [k(n(d, b.point)) + f.left, l(o(d, b.point)) + f.top],
                            seriesIndex: b.series,
                            pointIndex: b.point
                        })
                    }).on("mouseover", function (b) {
                        if (I) return 0;
                        var c = a[b.series], d = c.values[b.point];
                        G.elementMouseover({
                            point: d,
                            series: c,
                            pos: [k(n(d, b.point)) + f.left, l(o(d, b.point)) + f.top],
                            seriesIndex: b.series,
                            pointIndex: b.point
                        })
                    }).on("mouseout", function (b) {
                        if (I) return 0;
                        var c = a[b.series], d = c.values[b.point];
                        G.elementMouseout({point: d, series: c, seriesIndex: b.series, pointIndex: b.point})
                    })
                } else O.select(".nv-groups").selectAll(".nv-group").selectAll(".nv-point").on("click", function (b, c) {
                    if (I) return 0;
                    var d = a[b.series], e = d.values[c];
                    G.elementClick({
                        point: e,
                        series: d,
                        pos: [k(n(e, c)) + f.left, l(o(e, c)) + f.top],
                        seriesIndex: b.series,
                        pointIndex: c
                    })
                }).on("mouseover", function (b, c) {
                    if (I) return 0;
                    var d = a[b.series], e = d.values[c];
                    G.elementMouseover({
                        point: e,
                        series: d,
                        pos: [k(n(e, c)) + f.left, l(o(e, c)) + f.top],
                        seriesIndex: b.series,
                        pointIndex: c
                    })
                }).on("mouseout", function (b, c) {
                    if (I) return 0;
                    var d = a[b.series], e = d.values[c];
                    G.elementMouseout({point: e, series: d, seriesIndex: b.series, pointIndex: c})
                });
                I = !1
            }

            var K = g - f.left - f.right, L = h - f.top - f.bottom, M = d3.select(this);
            a = a.map(function (a, b) {
                return a.values = a.values.map(function (a) {
                    return a.series = b, a
                }), a
            });
            var N = B && C && D ? [] : d3.merge(a.map(function (a) {
                return a.values.map(function (a, b) {
                    return {x: n(a, b), y: o(a, b), size: p(a, b)}
                })
            }));
            k.domain(B || d3.extent(N.map(function (a) {
                return a.x
            }).concat(s))), k.range(x ? [.5 * K / a[0].values.length, K * (a[0].values.length - .5) / a[0].values.length] : [0, K]), l.domain(C || d3.extent(N.map(function (a) {
                return a.y
            }).concat(t))).range([L, 0]), m.domain(D || d3.extent(N.map(function (a) {
                return a.size
            }).concat(u))).range(E || [16, 256]), (k.domain()[0] === k.domain()[1] || l.domain()[0] === l.domain()[1]) && (F = !0), k.domain()[0] === k.domain()[1] && k.domain(k.domain()[0] ? [k.domain()[0] - .01 * k.domain()[0], k.domain()[1] + .01 * k.domain()[1]] : [-1, 1]), l.domain()[0] === l.domain()[1] && l.domain(l.domain()[0] ? [l.domain()[0] + .01 * l.domain()[0], l.domain()[1] - .01 * l.domain()[1]] : [-1, 1]), b = b || k, c = c || l, d = d || m;
            var O = M.selectAll("g.nv-wrap.nv-scatter").data([a]),
                P = O.enter().append("g").attr("class", "nvd3 nv-wrap nv-scatter nv-chart-" + j + (F ? " nv-single-point" : "")),
                Q = P.append("defs"), R = P.append("g"), S = O.select("g");
            R.append("g").attr("class", "nv-groups"), R.append("g").attr("class", "nv-point-paths"), O.attr("transform", "translate(" + f.left + "," + f.top + ")"), Q.append("clipPath").attr("id", "nv-edge-clip-" + j).append("rect"), O.select("#nv-edge-clip-" + j + " rect").attr("width", K).attr("height", L), S.attr("clip-path", y ? "url(#nv-edge-clip-" + j + ")" : ""), I = !0;
            var T = O.select(".nv-groups").selectAll(".nv-group").data(function (a) {
                return a
            }, function (a) {
                return a.key
            });
            if (T.enter().append("g").style("stroke-opacity", 1e-6).style("fill-opacity", 1e-6), d3.transition(T.exit()).style("stroke-opacity", 1e-6).style("fill-opacity", 1e-6).remove(), T.attr("class", function (a, b) {
                return "nv-group nv-series-" + b
            }).classed("hover", function (a) {
                return a.hover
            }), d3.transition(T).style("fill", function (a, b) {
                return i(a, b)
            }).style("stroke", function (a, b) {
                return i(a, b)
            }).style("stroke-opacity", 1).style("fill-opacity", .5), r) {
                var U = T.selectAll("circle.nv-point").data(function (a) {
                    return a.values
                });
                U.enter().append("circle").attr("cx", function (a, c) {
                    return b(n(a, c))
                }).attr("cy", function (a, b) {
                    return c(o(a, b))
                }).attr("r", function (a, b) {
                    return Math.sqrt(m(p(a, b)) / Math.PI)
                }), U.exit().remove(), d3.transition(T.exit().selectAll("path.nv-point")).attr("cx", function (a, b) {
                    return k(n(a, b))
                }).attr("cy", function (a, b) {
                    return l(o(a, b))
                }).remove(), U.attr("class", function (a, b) {
                    return "nv-point nv-point-" + b
                }), d3.transition(U).attr("cx", function (a, b) {
                    return k(n(a, b))
                }).attr("cy", function (a, b) {
                    return l(o(a, b))
                }).attr("r", function (a, b) {
                    return Math.sqrt(m(p(a, b)) / Math.PI)
                })
            } else {
                var U = T.selectAll("path.nv-point").data(function (a) {
                    return a.values
                });
                U.enter().append("path").attr("transform", function (a, d) {
                    return "translate(" + b(n(a, d)) + "," + c(o(a, d)) + ")"
                }).attr("d", d3.svg.symbol().type(q).size(function (a, b) {
                    return m(p(a, b))
                })), U.exit().remove(), d3.transition(T.exit().selectAll("path.nv-point")).attr("transform", function (a, b) {
                    return "translate(" + k(n(a, b)) + "," + l(o(a, b)) + ")"
                }).remove(), U.attr("class", function (a, b) {
                    return "nv-point nv-point-" + b
                }), d3.transition(U).attr("transform", function (a, b) {
                    return "translate(" + k(n(a, b)) + "," + l(o(a, b)) + ")"
                }).attr("d", d3.svg.symbol().type(q).size(function (a, b) {
                    return m(p(a, b))
                }))
            }
            clearTimeout(e), e = setTimeout(J, 300), b = k.copy(), c = l.copy(), d = m.copy()
        }), a
    }

    var b, c, d, e, f = {top: 0, right: 0, bottom: 0, left: 0}, g = 960, h = 500, i = nv.utils.defaultColor(),
        j = Math.floor(1e5 * Math.random()), k = d3.scale.linear(), l = d3.scale.linear(), m = d3.scale.linear(),
        n = function (a) {
            return a.x
        }, o = function (a) {
            return a.y
        }, p = function (a) {
            return a.size || 1
        }, q = function (a) {
            return a.shape || "circle"
        }, r = !0, s = [], t = [], u = [], v = !0, w = function (a) {
            return !a.notActive
        }, x = !1, y = !1, z = !0, A = function () {
            return 25
        }, B = null, C = null, D = null, E = null, F = !1,
        G = d3.dispatch("elementClick", "elementMouseover", "elementMouseout"), H = !0, I = !1;
    return G.on("elementMouseover.point", function (a) {
        v && d3.select(".nv-chart-" + j + " .nv-series-" + a.seriesIndex + " .nv-point-" + a.pointIndex).classed("hover", !0)
    }), G.on("elementMouseout.point", function (a) {
        v && d3.select(".nv-chart-" + j + " .nv-series-" + a.seriesIndex + " .nv-point-" + a.pointIndex).classed("hover", !1)
    }), a.dispatch = G, a.x = function (b) {
        return arguments.length ? (n = d3.functor(b), a) : n
    }, a.y = function (b) {
        return arguments.length ? (o = d3.functor(b), a) : o
    }, a.size = function (b) {
        return arguments.length ? (p = d3.functor(b), a) : p
    }, a.margin = function (b) {
        return arguments.length ? (f.top = "undefined" != typeof b.top ? b.top : f.top, f.right = "undefined" != typeof b.right ? b.right : f.right, f.bottom = "undefined" != typeof b.bottom ? b.bottom : f.bottom, f.left = "undefined" != typeof b.left ? b.left : f.left, a) : f
    }, a.width = function (b) {
        return arguments.length ? (g = b, a) : g
    }, a.height = function (b) {
        return arguments.length ? (h = b, a) : h
    }, a.xScale = function (b) {
        return arguments.length ? (k = b, a) : k
    }, a.yScale = function (b) {
        return arguments.length ? (l = b, a) : l
    }, a.zScale = function (b) {
        return arguments.length ? (m = b, a) : m
    }, a.xDomain = function (b) {
        return arguments.length ? (B = b, a) : B
    }, a.yDomain = function (b) {
        return arguments.length ? (C = b, a) : C
    }, a.sizeDomain = function (b) {
        return arguments.length ? (D = b, a) : D
    }, a.sizeRange = function (b) {
        return arguments.length ? (E = b, a) : E
    }, a.forceX = function (b) {
        return arguments.length ? (s = b, a) : s
    }, a.forceY = function (b) {
        return arguments.length ? (t = b, a) : t
    }, a.forceSize = function (b) {
        return arguments.length ? (u = b, a) : u
    }, a.interactive = function (b) {
        return arguments.length ? (v = b, a) : v
    }, a.pointActive = function (b) {
        return arguments.length ? (w = b, a) : w
    }, a.padData = function (b) {
        return arguments.length ? (x = b, a) : x
    }, a.clipEdge = function (b) {
        return arguments.length ? (y = b, a) : y
    }, a.clipVoronoi = function (b) {
        return arguments.length ? (z = b, a) : z
    }, a.useVoronoi = function (b) {
        return arguments.length ? (H = b, H === !1 && (z = !1), a) : H
    }, a.clipRadius = function (b) {
        return arguments.length ? (A = b, a) : A
    }, a.color = function (b) {
        return arguments.length ? (i = nv.utils.getColor(b), a) : i
    }, a.shape = function (b) {
        return arguments.length ? (q = b, a) : q
    }, a.onlyCircles = function (b) {
        return arguments.length ? (r = b, a) : r
    }, a.id = function (b) {
        return arguments.length ? (j = b, a) : j
    }, a.singlePoint = function (b) {
        return arguments.length ? (F = b, a) : F
    }, a
};