<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="{{ public_path('css/style.css') }}" />
</head>

<body style="padding: 2em;">

    <h1>{{ $event->event_name }}</h1>
    <h4>{{ $event->date }}</h4>

    <table width="100%" class="table mt-20">
        <thead>
            <tr style="padding: 5px;">
                <th>Rank</th>
                <th>Number</th>
                <th>Full Name</th>
                <?php foreach ($criteria as $row) : ?>
                    <th><?= $row->criteria; ?>/ <?= $row->percentage; ?>%</th>
                <?php endforeach; ?>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($participants as $row )
            <tr style="padding: 5px;">
                <td>{{$loop->index + 1}}</td>
                <td>{{ $row['number'] }}</td>
                <td>{{ $row['full_name'] }}</td>
                @foreach ($criteria as $cri)
                @foreach ($row['percent_score'] as $scr)
                @if ($scr['criteria_id'] == $cri->id)
                <td>{{$scr['percent_score']}}%</td>
                @endif
                @endforeach
                @endforeach
                <td><strong>{{$row['percent_score'][0]['total_percent_score']}}%</strong> </td>
            </tr>

            @endforeach
        </tbody>
    </table>
    <div>
        @foreach ($users as $user)
        <h4 class="mt-10 ">{{ $user->full_name }}</h4>
        <h6>{{ $user->role->role }}</h6>
        <br>
        @endforeach
    </div>

</body>

</html>