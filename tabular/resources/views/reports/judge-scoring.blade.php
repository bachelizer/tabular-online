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
    <div class="mt-20">
        @foreach ($users as $user)

        @if($user->role->id != 2)
        <h4>{{$user->full_name}} {{ $user->role_id }}</h4>
        <table width="100%" class="table mt-10 mb-10">
            <thead>
                <tr>
                    <th>Number</th>
                    <th>Screen Name</th>
                    <th>Full Name</th>
                    <th>Criteria/%</th>
                    <th>Raw score</th>
                    <th>Percent Score</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($scores as $score)
                @if ($user->id == $score->user_id)
                <tr>
                    <td>{{$score->number}}</td>
                    <td>{{$score->screen_name}}</td>
                    <td>{{$score->full_name}}</td>
                    <td>{{$score->criteria}} / {{$score->percentage}}</td>
                    <td>{{$score->score}}</td>
                    <td>
                        {{$score->percent_score}}
                    </td>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
        @endif
        @endforeach
    </div>
</body>

</html>