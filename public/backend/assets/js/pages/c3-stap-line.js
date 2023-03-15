//[c3 charts Javascript]

/**
 * Developer Information:
 *
 * Name: Kamruzzaman Polash
 * Email: kzaman3055@gmail.com
 *
 * Company Information:
 *
 * Name: The Riser IT
 * Email: info@theriserit.com
 * Phone: +880 1701 621575
 * Address: H#16, R# 22, Sector# 14, Uttara, Dhaka 1230, Bangladesh
 *
 * © 2023 The Riser IT. All rights reserved.
 */


$(function() {
    var t = c3.generate({
        bindto: "#step-chart",
        size: { height: 350 },
        color: { pattern: ["#2962FF", "#4fc3f7"] },
        data: {
            columns: [
                ['data1', 300, 350, 300, 0, 0, 100],
            	['data2', 130, 100, 140, 200, 150, 50]
            ],
            types: { data1: "step", data2: "area-step" }
        },
        grid: { y: { show: !0 } }
    });
});