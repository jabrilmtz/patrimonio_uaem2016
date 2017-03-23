$(function() {
    Morris.Bar({
        element: 'morris-bar-chart',
        data: [{
            y: 'Agosto',
            a: 100,
        }, {
            y: 'Septiembre',
            a: 75,
        }, {
            y: 'Noviembre',
            a: 50,
        }, {
            y: 'Diciemnbre',
            a: 75,
        }, {
            y: '2017',
            a: 0,
        }],
        xkey: 'y',
        ykeys: ['a'],
        labels: ['Series A'],
        hideHover: 'auto',
        resize: true
    });

    Morris.Donut({
        element: 'morris-donut-chart',
        data: [{
            label: "Normales",
            value: 2
        }, {
            label: "Pre-registrados",
            value: 0
        }, {
            label: "Sobrantes",
            value: 2
        }],
        resize: true
    });

    Morris.Area({
        element: 'morris-area-chart',
        data: [{
            period: '2012 Q1',
            iphone: 10687,
            ipad: 4460,
            itouch: 2028
        }, {
            period: '2012 Q2',
            iphone: 8432,
            ipad: 5713,
            itouch: 1791
        }],
        xkey: 'period',
        ykeys: ['iphone', 'ipad', 'itouch'],
        labels: ['iPhone', 'iPad', 'iPod Touch'],
        pointSize: 2,
        hideHover: 'auto',
        resize: true
    });
});
