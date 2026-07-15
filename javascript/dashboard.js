// ==========================================
// ROOM OCCUPANCY CHART
// ==========================================

const roomChart = document.getElementById("roomChart");

if(roomChart){

new Chart(roomChart,{

    type:"doughnut",

    data:{

        labels:[
            "Occupied Rooms",
            "Vacant Rooms"
        ],

        datasets:[{

            data:[
                occupiedRooms,
                vacantRooms
            ],

            backgroundColor:[
                "#0d3b66",
                "#ff7a00"
            ],

            borderColor:[
                "#ffffff",
                "#ffffff"
            ],

            borderWidth:3

        }]

    },

    options:{

        responsive:true,

        maintainAspectRatio:false,

        plugins:{

            legend:{

                position:"bottom",

                labels:{

                    font:{

                        size:14

                    }

                }

            }

        }

    }

});

}

// ==========================================
// COMPLAINT STATUS CHART
// ==========================================

const complaintChart = document.getElementById("complaintChart");

if (complaintChart) {

    new Chart(complaintChart, {

        type: "doughnut",

        data: {

            labels: [

                "Open",

                "In Progress",

                "Resolved"

            ],

            datasets: [{

                data: [

                    openComplaints,

                    progressComplaints,

                    resolvedComplaints

                ],

                backgroundColor: [

                    "#0d6efd",

                    "#6f42c1",

                    "#dc3545"

                ],

                borderColor: [

                    "#ffffff",

                    "#ffffff",

                    "#ffffff"

                ],

                borderWidth: 3

            }]

        },

        options: {

            responsive: true,

            maintainAspectRatio: false,

            plugins: {

                legend: {

                    position: "bottom"

                }

            }

        }

    });

}

// ===============================
// Monthly Payments Bar Chart
// ===============================

const paymentCtx = document.getElementById("paymentChart");

if(paymentCtx){

new Chart(paymentCtx, {

type: "bar",

data: {

labels: paymentMonths,

datasets: [{

label: "Payments (GH₵)",

data: paymentTotals,

backgroundColor: "#ff8c42",

borderRadius: 8

}]

},

options: {

responsive: true,

plugins: {

legend: {

display: false

}

}

}

});

}

// ==========================================
// VISITORS PER MONTH LINE CHART
// ==========================================

const visitorChart = document.getElementById("visitorChart");

if(visitorChart){

new Chart(visitorChart,{

    type:"line",

    data:{

        labels: visitorMonths,

        datasets:[{

            label:"Visitors",

            data: visitorTotals,

            borderColor:"#0d6efd",

            backgroundColor:"rgba(13,110,253,0.15)",

            fill:true,

            tension:0.4,

            pointRadius:5,

            pointHoverRadius:7,

            pointBackgroundColor:"#0d6efd",

            borderWidth:3

        }]

    },

    options:{

        responsive:true,

        maintainAspectRatio:false,

        plugins:{

            legend:{

                display:false

            }

        },

        scales:{

            y:{

                beginAtZero:true,

                ticks:{

                    precision:0

                }

            }

        }

    }

});

}