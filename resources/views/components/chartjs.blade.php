

<div {{$attributes}} >
    <canvas id="myChart"

    x-data="{
         data: {
            labels:  {{  json_encode($labels) }},
            datasets: [{
                    label: '{{$title}}',
                    data: {{json_encode($data)}},
                    backgroundColor: 'hsl(191, 82.9%, 67.8%)',
                    borderColor: 'hsl(191, 82.9%, 67.8%)',

{{--                    backgroundColor: [--}}
{{--                        'rgba(255, 99, 132, 0.2)',--}}
{{--                        'rgba(255, 159, 64, 0.2)',--}}
{{--                        'rgba(255, 205, 86, 0.2)',--}}
{{--                        'rgba(75, 192, 192, 0.2)',--}}
{{--                        'rgba(54, 162, 235, 0.2)',--}}
{{--                        'rgba(153, 102, 255, 0.2)',--}}
{{--                        'rgba(201, 203, 207, 0.2)'--}}
{{--                    ],--}}
{{--                    borderColor: [--}}
{{--                        'rgb(255, 99, 132)',--}}
{{--                        'rgb(255, 159, 64)',--}}
{{--                        'rgb(255, 205, 86)',--}}
{{--                        'rgb(75, 192, 192)',--}}
{{--                        'rgb(54, 162, 235)',--}}
{{--                        'rgb(153, 102, 255)',--}}
{{--                        'rgb(201, 203, 207)'--}}
{{--                    ],--}}
                    borderWidth: 1
            }]
        }

    }"
    x-init="() => {
         var myChart = new Chart($el,{
            type: 'bar',
            data: data,
            options: {
                scales: {
                    y: { beginAtZero: true}
                }
            },
         });
     }"

    ></canvas>
</div>


