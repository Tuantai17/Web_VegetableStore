<x-layout-admin>
<div class="content-wrapper min-h-screen relative overflow-hidden bg-gradient-to-tr from-indigo-100 to-green-100 p-10">

    <!-- Liquid Gauge -->
    <div class="moving-box absolute top-10 left-10 w-[220px] h-[220px] bg-white/30 backdrop-blur-md rounded-3xl shadow-xl border border-white/50 flex flex-col items-center justify-center text-center">
        <svg id="liquidFillGauge" viewBox="0 0 200 200" class="drop-shadow-lg w-full h-full"></svg>
        <div class="absolute bottom-2 text-sm font-medium text-indigo-500">Tỉ lệ hoàn thành</div>
    </div>

    <!-- Counter Box -->
    <div class="moving-box absolute top-60 right-20 w-[200px] h-[200px] bg-white/30 backdrop-blur-md rounded-3xl shadow-xl border border-white/50 flex flex-col items-center justify-center text-center">
        <div class="text-5xl font-bold text-indigo-600" id="counter">0</div>
        <div class="mt-2 text-sm font-medium text-gray-600">Tổng đơn hàng</div>
    </div>

    <!-- Circular Progress -->
    <div class="moving-box absolute bottom-20 left-1/2 transform -translate-x-1/2 w-[220px] h-[220px] bg-white/30 backdrop-blur-md rounded-full shadow-xl border border-white/50 flex flex-col items-center justify-center text-center">
        <svg class="progress-ring" width="160" height="160">
            <circle class="progress-ring__circle" stroke="#D1D5DB" stroke-width="10" fill="transparent" r="70" cx="80" cy="80"/>
            <circle class="progress-ring__circle2" stroke="#8B5CF6" stroke-width="10" fill="transparent" r="70" cx="80" cy="80"
                stroke-dasharray="440" stroke-dashoffset="440" />
        </svg>
        <div class="absolute bottom-3 text-sm text-purple-600 font-medium" id="progressValue">0%</div>
        <div class="absolute top-2 text-xs text-gray-500">Tiến độ xử lý</div>
    </div>

    <!-- Particles nền -->
    <div id="particles-js" class="particles"></div>

</div>

<!-- Scripts -->
<script src="https://d3js.org/d3.v5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>

<script>
    // Liquid Gauge
    function liquidFillGauge(elementId, value) {
        var gauge = d3.select("#" + elementId);
        var width = 200, height = 200;
        var radius = Math.min(width, height) / 2;

        gauge.append("circle")
            .attr("cx", width / 2)
            .attr("cy", height / 2)
            .attr("r", radius)
            .style("fill", "#E5E7EB")
            .style("stroke", "#8B5CF6")
            .style("stroke-width", "5px");

        var text = gauge.append("text")
            .attr("text-anchor", "middle")
            .attr("dy", ".35em")
            .attr("x", width / 2)
            .attr("y", height / 2)
            .attr("font-size", "36px")
            .attr("fill", "#8B5CF6")
            .text("0%");

        var defs = gauge.append("defs");
        var wave = defs.append("path")
            .datum({ y: 0 })
            .attr("id", "wave")
            .attr("d", d3.line()
                .x((d, i) => i * 4)
                .y((d, i) => 100 + Math.sin(i * 0.2) * 5)
                .curve(d3.curveBasis)
                (d3.range(0, 200)));

        var fill = gauge.append("clipPath")
            .attr("id", "clipWave")
            .append("use")
            .attr("xlink:href", "#wave");

        gauge.append("circle")
            .attr("cx", width / 2)
            .attr("cy", height / 2)
            .attr("r", radius - 5)
            .style("fill", "#8B5CF6")
            .attr("clip-path", "url(#clipWave)");

        fill.transition()
            .duration(2000)
            .attrTween("transform", () => {
                var i = d3.interpolate(100, 100 - value);
                return t => "translate(0," + i(t) + ")";
            });

        var i = d3.interpolate(0, value);
        d3.transition().duration(2000).tween("text", () => {
            return t => text.text(Math.round(i(t)) + "%");
        });
    }

    liquidFillGauge("liquidFillGauge", 82);

    // Counter
    let counter = document.getElementById("counter");
    let count = 0, target = 2360;
    let counterInterval = setInterval(() => {
        count += 20;
        counter.textContent = count.toLocaleString();
        if (count >= target) clearInterval(counterInterval);
    }, 10);

    // Circular Progress
    const circle = document.querySelector('.progress-ring__circle2');
    const valueDisplay = document.getElementById("progressValue");
    let progressValue = 0, endValue = 67;
    let progress = setInterval(() => {
        progressValue++;
        let offset = 440 - (440 * progressValue) / 100;
        circle.style.strokeDashoffset = offset;
        valueDisplay.textContent = progressValue + "%";
        if (progressValue >= endValue) clearInterval(progress);
    }, 20);

    // Particles
    particlesJS("particles-js", {
        "particles": {
            "number": { "value": 60 },
            "size": { "value": 10 },
            "move": { "speed": 1.2 },
            "shape": { "type": "circle" },
            "opacity": { "value": 0.6, "random": true }
        }
    });

    // Di chuyển các box
    function randomMove(el) {
    setInterval(() => {
        let maxX = 400 - el.offsetWidth;  // Giới hạn bên phải
        let maxY = 400 - el.offsetHeight; // Giới hạn bên dưới
        let x = Math.random() * maxX;
        let y = Math.random() * maxY;
        el.style.transform = `translate(${x}px, ${y}px)`;
    }, 3000);
}


    document.querySelectorAll(".moving-box").forEach(el => {
        el.style.transition = "transform 2.5s ease-in-out";
        randomMove(el);
    });
</script>

<style>
    .particles {
        position: fixed;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        z-index: -1;
    }
</style>
</x-layout-admin>
