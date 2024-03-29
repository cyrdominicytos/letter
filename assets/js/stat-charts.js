/*! light-blue - v3.1.0 - 2014-12-06 */
$(function () {
    function a() {
        function a(a) {
            a.disabled = !a.disabled, d3.select(this).classed("disabled", a.disabled), d.pie.values()(f).filter(function (a) {
                return !a.disabled
            }).length || (d.pie.values()(f).map(function (a) {
                return a.disabled = !1, a
            }), h.selectAll(".control").classed("disabled", !1)), d3.select("#sources-chart-pie svg").transition().call(d)
        }

        var dataSet = [
            {key:'Lolo', values:[{series:0,x:1563002049432,y:59}, {series:0,x:1563002049432,y:59}, {series:0,x:1563002049432,y:59}]},
            {key:'Referral', values:[{series:1,x:1563002049432,y:59}, {series:1,x:1563002049432,y:59}, {series:1,x:1563002049432,y:59}]},
            {key:'Direct', values:[{series:2,x:1563002049432,y:59}, {series:2,x:1563002049432,y:59}, {series:2,x:1563002049432,y:59}]},
            {key:'Organic', values:[{series:3,x:1563002049432,y:59}, {series:3,x:1563002049432,y:59}, {series:3,x:1563002049432,y:59}]},
        ];

        //console.info(window.testData(["Lolo", "Referral", "Direct", "Organic"], 25));


        //console.info(dataSet);
        //var b, c, d, e, f = window.testData(["Lolo", "Referral", "Direct", "Organic"], 25),
        var b, c, d, e, f = dataSet,
            g = d3.select("#sources-chart-pie"), h = d3.select("#data-chart-footer");

        nv.addGraph(function () {

            for (var g = 0; g < f.length; g++) f[g].y = Math.floor(d3.sum(f[g].values, function (a) {
                return a.y
            }));

            var i = nv.models.pieChartTotal().x(function (a) {
                return a.key
            }).margin({top: 0, right: 20, bottom: 20, left: 20}).values(function (a) {
                return a
            }).color(COLOR_VALUES).showLabels(!1).showLegend(!1).tooltipContent(function (a, b) {
                return "<h4>" + a + "</h4><p>" + b + "</p>"
            }).total(function (a) {
                return "<div class='visits'>" + a + "<br/> F </div>"
            }).donut(!0);
            i.pie.margin({top: 10, bottom: -20});
            var j = d3.sum(f, function (a) {
                return a.y
            });
            return h.append("div").classed("controls", !0).selectAll("div").data(f).enter().append("div").classed("control", !0).style("border-top", function (a, b) {
                return "3px solid " + COLOR_VALUES[b]
            }).html(function (a) {
                return "<div class='key'>" + a.key + "</div><div class='value'>" + Math.floor(100 * a.y / j) + "%</div>"
            }).on("click", function (d) {
                a.apply(this, [d]), setTimeout(function () {
                    //b.update(),
                        c.update(),
                            e.update()
                }, 100)
            }), d3.select("#sources-chart-pie svg").datum([f]).transition(500).call(i),
                //PjaxApp.onResize(i.update),
                d = i, i
        }), nv.addGraph(function () {
            var a = nv.models.multiBarChart().margin({
                left: 30,
                bottom: 20,
                right: 0
            }).color(keyColor).controlsColor([$white, $white, $white]).showLegend(!1);
            return a.yAxis.showMaxMin(!1).ticks(0).tickFormat(d3.format(",.f")), a.xAxis.showMaxMin(!1).tickFormat(function (a) {
                return d3.time.format("%b %d")(new Date(a))
            }), d3.select("#sources-chart-bar svg").datum(f).transition().duration(500).call(a),
                //PjaxApp.onResize(a.update),
                e = a, a
        }), nv.addGraph(function () {
            var a = nv.models.stackedAreaChart().margin({left: 0}).color(keyColor).showControls(!1).showLegend(!1).style("stream").controlsColor([$textColor, $textColor, $textColor]);
            return a.yAxis.showMaxMin(!1).tickFormat(d3.format(",f")), a.xAxis.showMaxMin(!1).tickFormat(function (a) {
                return d3.time.format("%b %d")(new Date(a))
            }), //d3.select("#sources-chart-stacked svg").datum(f).transition().duration(500).call(a),
                //PjaxApp.onResize(a.update),
                a.stacked.dispatch.on("areaClick.updateExamples", function () {
                setTimeout(function () {
                    c.update(), d.update(), e.update(), g.selectAll(".control").classed("disabled", function (a) {
                        return a.disabled
                    })
                }, 100)
            }), b = a, a
        }), nv.addGraph(function () {
            var a = nv.models.lineChart().margin({
                top: 0,
                bottom: 25,
                left: 30,
                right: 0
            }).showLegend(!1).color(keyColor);
            return a.yAxis.showMaxMin(!1).tickFormat(d3.format(",.f")), a.xAxis.showMaxMin(!1).tickFormat(function (a) {
                return d3.time.format("%b %d")(new Date(a))
            }), f[0].area = !0,
                //f[3].area = !0,
                d3.select("#sources-chart-line svg").datum(f).transition().duration(500).call(a),
                //PjaxApp.onResize(a.update),
            c = a, a
        })
    }

    a()
        //PjaxApp.onPageLoad(a)
});
