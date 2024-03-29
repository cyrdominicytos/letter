/*! light-blue - v3.1.0 - 2014-12-06 */
nv.models.stackedArea = function () {
    function a(k) {
        return k.each(function (a) {
            var k = e - d.left - d.right, r = f - d.top - d.bottom, s = d3.select(this);
            b = p.xScale(), c = p.yScale(), a = a.map(function (a) {
                return a.values = a.values.map(function (b, c) {
                    return b.index = c, b.stackedY = a.disabled ? 0 : j(b, c), b
                }), a
            }), a = d3.layout.stack().order(m).offset(l).values(function (a) {
                return a.values
            }).x(i).y(function (a) {
                return a.stackedY
            }).out(function (a, b, c) {
                a.display = {y: c, y0: b}
            })(a);
            var t = s.selectAll("g.nv-wrap.nv-stackedarea").data([a]),
                u = t.enter().append("g").attr("class", "nvd3 nv-wrap nv-stackedarea"), v = u.append("defs"),
                w = u.append("g"), x = t.select("g");
            w.append("g").attr("class", "nv-areaWrap"), w.append("g").attr("class", "nv-scatterWrap"), t.attr("transform", "translate(" + d.left + "," + d.top + ")"), p.width(k).height(r).x(i).y(function (a) {
                return a.display.y + a.display.y0
            }).forceY([0]).color(a.map(function (a, b) {
                return a.color || g(a, b)
            }).filter(function (b, c) {
                return !a[c].disabled
            }));
            var y = x.select(".nv-scatterWrap").datum(a.filter(function (a) {
                return !a.disabled
            }));
            d3.transition(y).call(p), v.append("clipPath").attr("id", "nv-edge-clip-" + h).append("rect"), t.select("#nv-edge-clip-" + h + " rect").attr("width", k).attr("height", r), x.attr("clip-path", o ? "url(#nv-edge-clip-" + h + ")" : "");
            var z = d3.svg.area().x(function (a, c) {
                return b(i(a, c))
            }).y0(function (a) {
                return c(a.display.y0)
            }).y1(function (a) {
                return c(a.display.y + a.display.y0)
            }).interpolate(n), A = d3.svg.area().x(function (a, c) {
                return b(i(a, c))
            }).y0(function (a) {
                return c(a.display.y0)
            }).y1(function (a) {
                return c(a.display.y0)
            }), B = x.select(".nv-areaWrap").selectAll("path.nv-area").data(function (a) {
                return a
            });
            B.enter().append("path").attr("class", function (a, b) {
                return "nv-area nv-area-" + b
            }).on("mouseover", function (a, b) {
                d3.select(this).classed("hover", !0), q.areaMouseover({
                    point: a,
                    series: a.key,
                    pos: [d3.event.pageX, d3.event.pageY],
                    seriesIndex: b
                })
            }).on("mouseout", function (a, b) {
                d3.select(this).classed("hover", !1), q.areaMouseout({
                    point: a,
                    series: a.key,
                    pos: [d3.event.pageX, d3.event.pageY],
                    seriesIndex: b
                })
            }).on("click", function (a, b) {
                d3.select(this).classed("hover", !1), q.areaClick({
                    point: a,
                    series: a.key,
                    pos: [d3.event.pageX, d3.event.pageY],
                    seriesIndex: b
                })
            }), d3.transition(B.exit()).attr("d", function (a, b) {
                return A(a.values, b)
            }).remove(), B.style("fill", function (a, b) {
                return a.color || g(a, b)
            }).style("stroke", function (a, b) {
                return a.color || g(a, b)
            }), d3.transition(B).attr("d", function (a, b) {
                return z(a.values, b)
            }), p.dispatch.on("elementMouseover.area", function (a) {
                x.select(".nv-chart-" + h + " .nv-area-" + a.seriesIndex).classed("hover", !0)
            }), p.dispatch.on("elementMouseout.area", function (a) {
                x.select(".nv-chart-" + h + " .nv-area-" + a.seriesIndex).classed("hover", !1)
            })
        }), a
    }

    var b, c, d = {top: 0, right: 0, bottom: 0, left: 0}, e = 960, f = 500, g = nv.utils.defaultColor(),
        h = Math.floor(1e5 * Math.random()), i = function (a) {
            return a.x
        }, j = function (a) {
            return a.y
        }, k = "stack", l = "zero", m = "default", n = "linear", o = !1, p = nv.models.scatter(),
        q = d3.dispatch("tooltipShow", "tooltipHide", "areaClick", "areaMouseover", "areaMouseout");
    return p.size(2.2).sizeDomain([2.2]), p.dispatch.on("elementClick.area", function (a) {
        q.areaClick(a)
    }), p.dispatch.on("elementMouseover.tooltip", function (a) {
        a.pos = [a.pos[0] + d.left, a.pos[1] + d.top], q.tooltipShow(a)
    }), p.dispatch.on("elementMouseout.tooltip", function (a) {
        q.tooltipHide(a)
    }), a.dispatch = q, a.scatter = p, d3.rebind(a, p, "interactive", "size", "xScale", "yScale", "zScale", "xDomain", "yDomain", "sizeDomain", "forceX", "forceY", "forceSize", "clipVoronoi", "clipRadius"), a.x = function (b) {
        return arguments.length ? (i = d3.functor(b), a) : i
    }, a.y = function (b) {
        return arguments.length ? (j = d3.functor(b), a) : j
    }, a.margin = function (b) {
        return arguments.length ? (d.top = "undefined" != typeof b.top ? b.top : d.top, d.right = "undefined" != typeof b.right ? b.right : d.right, d.bottom = "undefined" != typeof b.bottom ? b.bottom : d.bottom, d.left = "undefined" != typeof b.left ? b.left : d.left, a) : d
    }, a.width = function (b) {
        return arguments.length ? (e = b, a) : e
    }, a.height = function (b) {
        return arguments.length ? (f = b, a) : f
    }, a.clipEdge = function (b) {
        return arguments.length ? (o = b, a) : o
    }, a.color = function (b) {
        return arguments.length ? (g = nv.utils.getColor(b), a) : g
    }, a.offset = function (b) {
        return arguments.length ? (l = b, a) : l
    }, a.order = function (b) {
        return arguments.length ? (m = b, a) : m
    }, a.style = function (b) {
        if (!arguments.length) return k;
        switch (k = b) {
            case"stack":
                a.offset("zero"), a.order("default");
                break;
            case"stream":
                a.offset("wiggle"), a.order("inside-out");
                break;
            case"stream-center":
                a.offset("silhouette"), a.order("inside-out");
                break;
            case"expand":
                a.offset("expand"), a.order("default")
        }
        return a
    }, a.interpolate = function (a) {
        return arguments.length ? n = a : n
    }, a
};