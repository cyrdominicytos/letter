/*! light-blue - v3.1.0 - 2014-12-06 */
nv.models.axis = function () {
    function a(e) {
        return e.each(function (a) {
            var e = d3.select(this), p = e.selectAll("g.nv-wrap.nv-axis").data([a]),
                q = p.enter().append("g").attr("class", "nvd3 nv-wrap nv-axis"), r = (q.append("g"), p.select("g"));
            null !== n ? b.ticks(n) : ("top" == b.orient() || "bottom" == b.orient()) && b.ticks(Math.abs(f.range()[1] - f.range()[0]) / 100), d3.transition(r).call(b), o = o || b.scale();
            var s = b.tickFormat();
            null == s && (s = o.tickFormat());
            var t = r.selectAll("text.nv-axislabel").data([g || null]);
            switch (t.exit().remove(), b.orient()) {
                case"top":
                    t.enter().append("text").attr("class", "nv-axislabel");
                    var u = 2 == f.range().length ? f.range()[1] : f.range()[f.range().length - 1] + (f.range()[1] - f.range()[0]);
                    if (t.attr("text-anchor", "middle").attr("y", 0).attr("x", u / 2), h) {
                        var v = p.selectAll("g.nv-axisMaxMin").data(f.domain());
                        v.enter().append("g").attr("class", "nv-axisMaxMin").append("text"), v.exit().remove(), v.attr("transform", function (a) {
                            return "translate(" + f(a) + ",0)"
                        }).select("text").attr("dy", "0em").attr("y", -b.tickPadding()).attr("text-anchor", "middle").text(function (a) {
                            var b = s(a);
                            return ("" + b).match("NaN") ? "" : b
                        }), d3.transition(v).attr("transform", function (a, b) {
                            return "translate(" + f.range()[b] + ",0)"
                        })
                    }
                    break;
                case"bottom":
                    var w = 36, x = 30, y = r.selectAll("g").select("text");
                    if (j % 360) {
                        y.each(function () {
                            var a = this.getBBox().width;
                            a > x && (x = a)
                        });
                        var z = Math.abs(Math.sin(j * Math.PI / 180)), w = (z ? z * x : x) + 30;
                        y.attr("transform", function () {
                            return "rotate(" + j + " 0,0)"
                        }).attr("text-anchor", j % 360 > 0 ? "start" : "end")
                    }
                    t.enter().append("text").attr("class", "nv-axislabel");
                    var u = 2 == f.range().length ? f.range()[1] : f.range()[f.range().length - 1] + (f.range()[1] - f.range()[0]);
                    if (t.attr("text-anchor", "middle").attr("y", w).attr("x", u / 2), h) {
                        var v = p.selectAll("g.nv-axisMaxMin").data([f.domain()[0], f.domain()[f.domain().length - 1]]);
                        v.enter().append("g").attr("class", "nv-axisMaxMin").append("text"), v.exit().remove(), v.attr("transform", function (a) {
                            return "translate(" + (f(a) + (m ? f.rangeBand() / 2 : 0)) + ",0)"
                        }).select("text").attr("dy", ".71em").attr("y", b.tickPadding()).attr("transform", function () {
                            return "rotate(" + j + " 0,0)"
                        }).attr("text-anchor", j ? j % 360 > 0 ? "start" : "end" : "middle").text(function (a) {
                            var b = s(a);
                            return ("" + b).match("NaN") ? "" : b
                        }), d3.transition(v).attr("transform", function (a) {
                            return "translate(" + (f(a) + (m ? f.rangeBand() / 2 : 0)) + ",0)"
                        })
                    }
                    l && y.attr("transform", function (a, b) {
                        return "translate(0," + (b % 2 == 0 ? "0" : "12") + ")"
                    });
                    break;
                case"right":
                    if (t.enter().append("text").attr("class", "nv-axislabel"), t.attr("text-anchor", k ? "middle" : "begin").attr("transform", k ? "rotate(90)" : "").attr("y", k ? -Math.max(c.right, d) + 12 : -10).attr("x", k ? f.range()[0] / 2 : b.tickPadding()), h) {
                        var v = p.selectAll("g.nv-axisMaxMin").data(f.domain());
                        v.enter().append("g").attr("class", "nv-axisMaxMin").append("text").style("opacity", 0), v.exit().remove(), v.attr("transform", function (a) {
                            return "translate(0," + f(a) + ")"
                        }).select("text").attr("dy", ".32em").attr("y", 0).attr("x", b.tickPadding()).attr("text-anchor", "start").text(function (a) {
                            var b = s(a);
                            return ("" + b).match("NaN") ? "" : b
                        }), d3.transition(v).attr("transform", function (a, b) {
                            return "translate(0," + f.range()[b] + ")"
                        }).select("text").style("opacity", 1)
                    }
                    break;
                case"left":
                    if (t.enter().append("text").attr("class", "nv-axislabel"), t.attr("text-anchor", k ? "middle" : "end").attr("transform", k ? "rotate(-90)" : "").attr("y", k ? -Math.max(c.left, d) + 12 : -10).attr("x", k ? -f.range()[0] / 2 : -b.tickPadding()), h) {
                        var v = p.selectAll("g.nv-axisMaxMin").data(f.domain());
                        v.enter().append("g").attr("class", "nv-axisMaxMin").append("text").style("opacity", 0), v.exit().remove(), v.attr("transform", function (a) {
                            return "translate(0," + o(a) + ")"
                        }).select("text").attr("dy", ".32em").attr("y", 0).attr("x", -b.tickPadding()).attr("text-anchor", "end").text(function (a) {
                            var b = s(a);
                            return ("" + b).match("NaN") ? "" : b
                        }), d3.transition(v).attr("transform", function (a, b) {
                            return "translate(0," + f.range()[b] + ")"
                        }).select("text").style("opacity", 1)
                    }
            }
            if (t.text(function (a) {
                return a
            }), !h || "left" !== b.orient() && "right" !== b.orient() || (r.selectAll("g").each(function (a) {
                d3.select(this).select("text").attr("opacity", 1), (f(a) < f.range()[1] + 10 || f(a) > f.range()[0] - 10) && ((a > 1e-10 || -1e-10 > a) && d3.select(this).attr("opacity", 0), d3.select(this).select("text").attr("opacity", 0))
            }), f.domain()[0] == f.domain()[1] && 0 == f.domain()[0] && p.selectAll("g.nv-axisMaxMin").style("opacity", function (a, b) {
                return b ? 0 : 1
            })), h && ("top" === b.orient() || "bottom" === b.orient())) {
                var A = [];
                p.selectAll("g.nv-axisMaxMin").each(function (a, b) {
                    try {
                        A.push(b ? f(a) - this.getBBox().width - 4 : f(a) + this.getBBox().width + 4)
                    } catch (c) {
                        A.push(b ? f(a) - 4 : f(a) + 4)
                    }
                }), r.selectAll("g").each(function (a) {
                    (f(a) < A[0] || f(a) > A[1]) && (a > 1e-10 || -1e-10 > a ? d3.select(this).remove() : d3.select(this).select("text").remove())
                })
            }
            i && r.selectAll("line.tick").filter(function (a) {
                return !parseFloat(Math.round(1e5 * a) / 1e6)
            }).classed("zero", !0), o = f.copy()
        }), a
    }

    var b = d3.svg.axis(), c = {top: 0, right: 0, bottom: 0, left: 0}, d = 75, e = 60, f = d3.scale.linear(), g = null,
        h = !0, i = !0, j = 0, k = !0, l = !1, m = !1, n = null;
    b.scale(f).orient("bottom").tickFormat(function (a) {
        return a
    });
    var o;
    return a.axis = b, d3.rebind(a, b, "orient", "tickValues", "tickSubdivide", "tickSize", "tickPadding", "tickFormat"), d3.rebind(a, f, "domain", "range", "rangeBand", "rangeBands"), a.margin = function (b) {
        return arguments.length ? (c.top = "undefined" != typeof b.top ? b.top : c.top, c.right = "undefined" != typeof b.right ? b.right : c.right, c.bottom = "undefined" != typeof b.bottom ? b.bottom : c.bottom, c.left = "undefined" != typeof b.left ? b.left : c.left, a) : c
    }, a.width = function (b) {
        return arguments.length ? (d = b, a) : d
    }, a.ticks = function (b) {
        return arguments.length ? (n = b, a) : n
    }, a.height = function (b) {
        return arguments.length ? (e = b, a) : e
    }, a.axisLabel = function (b) {
        return arguments.length ? (g = b, a) : g
    }, a.showMaxMin = function (b) {
        return arguments.length ? (h = b, a) : h
    }, a.highlightZero = function (b) {
        return arguments.length ? (i = b, a) : i
    }, a.scale = function (c) {
        return arguments.length ? (f = c, b.scale(f), m = "function" == typeof f.rangeBands, d3.rebind(a, f, "domain", "range", "rangeBand", "rangeBands"), a) : f
    }, a.rotateYLabel = function (b) {
        return arguments.length ? (k = b, a) : k
    }, a.rotateLabels = function (b) {
        return arguments.length ? (j = b, a) : j
    }, a.staggerLabels = function (b) {
        return arguments.length ? (l = b, a) : l
    }, a
};