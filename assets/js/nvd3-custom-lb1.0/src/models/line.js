/*! light-blue - v3.1.0 - 2014-12-06 */
nv.models.line = function () {
    function a(q) {
        return q.each(function (a) {
            var q = f - e.left - e.right, r = g - e.top - e.bottom, s = d3.select(this);
            b = d.xScale(), c = d.yScale(), o = o || b, p = p || c;
            var t = s.selectAll("g.nv-wrap.nv-line").data([a]),
                u = t.enter().append("g").attr("class", "nvd3 nv-wrap nv-line"), v = u.append("defs"),
                w = u.append("g"), x = t.select("g");
            w.append("g").attr("class", "nv-groups"), w.append("g").attr("class", "nv-scatterWrap"), t.attr("transform", "translate(" + e.left + "," + e.top + ")"), d.width(q).height(r);
            var y = t.select(".nv-scatterWrap");
            d3.transition(y).call(d), v.append("clipPath").attr("id", "nv-edge-clip-" + d.id()).append("rect"), t.select("#nv-edge-clip-" + d.id() + " rect").attr("width", q).attr("height", r), x.attr("clip-path", m ? "url(#nv-edge-clip-" + d.id() + ")" : ""), y.attr("clip-path", m ? "url(#nv-edge-clip-" + d.id() + ")" : "");
            var z = t.select(".nv-groups").selectAll(".nv-group").data(function (a) {
                return a
            }, function (a) {
                return a.key
            });
            z.enter().append("g").style("stroke-opacity", 1e-6).style("fill-opacity", 1e-6), d3.transition(z.exit()).style("stroke-opacity", 1e-6).style("fill-opacity", 1e-6).remove(), z.attr("class", function (a, b) {
                return "nv-group nv-series-" + b
            }).classed("hover", function (a) {
                return a.hover
            }).style("fill", function (a, b) {
                return h(a, b)
            }).style("stroke", function (a, b) {
                return h(a, b)
            }), d3.transition(z).style("stroke-opacity", 1).style("fill-opacity", .5);
            var A = z.selectAll("path.nv-area").data(function (a) {
                return l(a) ? [a] : []
            });
            A.enter().append("path").attr("class", "nv-area").attr("d", function (a) {
                return d3.svg.area().interpolate(n).defined(k).x(function (a, b) {
                    return o(i(a, b))
                }).y0(function (a, b) {
                    return p(j(a, b))
                }).y1(function () {
                    return p(c.domain()[0] <= 0 ? c.domain()[1] >= 0 ? 0 : c.domain()[1] : c.domain()[0])
                }).apply(this, [a.values])
            }), d3.transition(z.exit().selectAll("path.nv-area")).attr("d", function (a) {
                return d3.svg.area().interpolate(n).defined(k).x(function (a, b) {
                    return o(i(a, b))
                }).y0(function (a, b) {
                    return p(j(a, b))
                }).y1(function () {
                    return p(c.domain()[0] <= 0 ? c.domain()[1] >= 0 ? 0 : c.domain()[1] : c.domain()[0])
                }).apply(this, [a.values])
            }), d3.transition(A).attr("d", function (a) {
                return d3.svg.area().interpolate(n).defined(k).x(function (a, b) {
                    return o(i(a, b))
                }).y0(function (a, b) {
                    return p(j(a, b))
                }).y1(function () {
                    return p(c.domain()[0] <= 0 ? c.domain()[1] >= 0 ? 0 : c.domain()[1] : c.domain()[0])
                }).apply(this, [a.values])
            });
            var B = z.selectAll("path.nv-line").data(function (a) {
                return [a.values]
            });
            B.enter().append("path").attr("class", "nv-line").attr("d", d3.svg.line().interpolate(n).defined(k).x(function (a, b) {
                return o(i(a, b))
            }).y(function (a, b) {
                return p(j(a, b))
            })), d3.transition(z.exit().selectAll("path.nv-line")).attr("d", d3.svg.line().interpolate(n).defined(k).x(function (a, c) {
                return b(i(a, c))
            }).y(function (a, b) {
                return c(j(a, b))
            })), d3.transition(B).attr("d", d3.svg.line().interpolate(n).defined(k).x(function (a, c) {
                return b(i(a, c))
            }).y(function (a, b) {
                return c(j(a, b))
            })), o = b.copy(), p = c.copy()
        }), a
    }

    var b, c, d = nv.models.scatter(), e = {top: 0, right: 0, bottom: 0, left: 0}, f = 960, g = 500,
        h = nv.utils.defaultColor(), i = function (a) {
            return a.x
        }, j = function (a) {
            return a.y
        }, k = function (a, b) {
            return !isNaN(j(a, b)) && null !== j(a, b)
        }, l = function (a) {
            return a.area
        }, m = !1, n = "linear";
    d.size(16).sizeDomain([16, 256]);
    var o, p;
    return a.dispatch = d.dispatch, a.scatter = d, d3.rebind(a, d, "id", "interactive", "size", "xScale", "yScale", "zScale", "xDomain", "yDomain", "sizeDomain", "forceX", "forceY", "forceSize", "clipVoronoi", "clipRadius", "padData"), a.margin = function (b) {
        return arguments.length ? (e.top = "undefined" != typeof b.top ? b.top : e.top, e.right = "undefined" != typeof b.right ? b.right : e.right, e.bottom = "undefined" != typeof b.bottom ? b.bottom : e.bottom, e.left = "undefined" != typeof b.left ? b.left : e.left, a) : e
    }, a.width = function (b) {
        return arguments.length ? (f = b, a) : f
    }, a.height = function (b) {
        return arguments.length ? (g = b, a) : g
    }, a.x = function (b) {
        return arguments.length ? (i = b, d.x(b), a) : i
    }, a.y = function (b) {
        return arguments.length ? (j = b, d.y(b), a) : j
    }, a.clipEdge = function (b) {
        return arguments.length ? (m = b, a) : m
    }, a.color = function (b) {
        return arguments.length ? (h = nv.utils.getColor(b), d.color(h), a) : h
    }, a.interpolate = function (b) {
        return arguments.length ? (n = b, a) : n
    }, a.defined = function (b) {
        return arguments.length ? (k = b, a) : k
    }, a.isArea = function (b) {
        return arguments.length ? (l = d3.functor(b), a) : l
    }, a
};