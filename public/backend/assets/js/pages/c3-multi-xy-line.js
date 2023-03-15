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
        bindto: "#multiple-xy",
        size: { height: 350 },
        point: { r: 4 },
        color: { pattern: ["#3e8ef7", "#ff4c52"] },
        data: {
            xs: { data1: "x1", data2: "x2" },
            columns: [
                ['x1', 10, 30, 45, 50, 70, 100],
				['x2', 30, 50, 75, 100, 120],
				['data1', 30, 200, 100, 400, 150, 250],
				['data2', 20, 180, 240, 100, 190]
            ]
        },
        grid: { y: { show: !0 } }
    });
});