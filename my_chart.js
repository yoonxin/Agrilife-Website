var ctx = document.getElementById('myChart').getContext('2d');
var Posting = document.getElementById('Posting').getContext('2d');

var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['8am', '12pm', '4pm', '8pm', '12am', '4am'],
        datasets: [{
            label: 'Registeration',
            data: [1200,1346,1235,1435,1554,1564],
            //point colour
            pointBackgroundColor: [
                'rgba(230, 255, 0, 1)',
            ],

            //point fill color
            pointBorderColor: [
                'rgba(1, 1, 1, 1)',
            ],
            
            //line fill colour
            backgroundColor: [
                'rgba(255, 0, 0, 1)',

            ],
            //line color
            borderColor: [
                'rgba(255, 0, 0, 1)',
            ],

            //line weight
            borderWidth: 0.5,
        }]
    },
    options: {
        responsive: true,
    }
  });

  //another graph

  var myChart = new Chart(Posting, {
    type: 'bar',
    data: {
        labels: ['January', 'Feburary', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
        datasets: [{
            label: 'Posts',
            data: [12, 19, 3, 5, 2, 3, 4, 8,9,10,17,6],
            backgroundColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options:  {
        responsive: true,
    }
});