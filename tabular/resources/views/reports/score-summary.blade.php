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
    <div class="row">
        <table width="100%">
            <tr>
                <td width="6%"><span class="head-logo">
                        <img src="{{ public_path('images/logo.png') }}" alt="logo" />
                    </span></td>
                <td>
                    <span>
                        <div class="head-title">
                            Agusan del Sur State College of Agriculture and
                            Technology
                        </div>
                        <div>
                            <div>Bunawan, Agusan del Sur</div>
                            <div>website: https://asscat.edu.ph</div>
                            <div>
                                email address: op@asscat.edu.ph; mobile no.:
                                +639486379266
                            </div>
                        </div>
                    </span>
                </td>
            </tr>
        </table>
        <hr class="mt-10 mb-10">
    </div>
    <div style="text-align: center;">
        <h4>{{ $event->event_name }}</h4>
        <span style="font-size: 12px;">Score Summary</span>
    </div>

    <div class="mt-10">
        @if (count($male) > 0)
        <h5>Male</h5>
        <table width="100%" class="table mt-5" style="font-size: 11px;">
            <thead>
                <tr>
                    <th rowspan="2">Participant No.</th>
                    <th rowspan="2">Participants Name</th>
                    <th colspan="{{ count($subEvents) }}" style="text-align: center;"><strong>Sub Events</strong></th>
                    <th rowspan="2">Total Average Score</th>
                    <th rowspan="2">Rank</th>
                </tr>
                <tr style="padding: 5px;">
                    <?php foreach ($subEvents as $sub) : ?>
                        <th><?= $sub->sub_event_name; ?> | <?= $sub->percentage; ?>%</th>
                    <?php endforeach; ?>
                </tr>

            </thead>
            <tbody>
                @foreach ($male as $row )
                <tr style="padding: 5px;">
                    <td>{{ $row['number'] }}</td>
                    <td>{{ $row['participant_name'] }}</td>
                    @foreach ($subEvents as $sub)
                    @foreach ($row['scores'] as $scr)
                    @if ($scr['sub_event_id'] == $sub->id)
                    <td>{{$scr['sub_event_score']}}%</td>
                    @endif
                    @endforeach
                    @endforeach
                    <td style="text-align: center;"><strong>{{ $row['over_all_total']}} % </strong></td>
                    <td style="text-align: center;"><strong style="color: red;">{{ $row['rank'] }}</strong></td>
                </tr>

                @endforeach
            </tbody>
        </table>
        @endif

        @if (count($female) > 0)
        <h5 class="mt-10">Female</h5>
        <table width="100%" class="table mt-5" style="font-size: 11px;">
            <thead>
                <tr>
                    <th rowspan="2">Participant No.</th>
                    <th rowspan="2">Participants Name</th>
                    <th colspan="{{ count($subEvents) }}" style="text-align: center;"><strong>Sub Events</strong></th>
                    <th rowspan="2">Total Average Score</th>
                    <th rowspan="2">Rank</th>
                </tr>
                <tr style="padding: 5px;">
                    <?php foreach ($subEvents as $sub) : ?>
                        <th><?= $sub->sub_event_name; ?> | <?= $sub->percentage; ?>%</th>
                    <?php endforeach; ?>
                </tr>

            </thead>
            <tbody>
                @foreach ($female as $row )
                <tr style="padding: 5px;">
                    <td>{{ $row['number'] }}</td>
                    <td>{{ $row['participant_name'] }}</td>
                    @foreach ($subEvents as $sub)
                    @foreach ($row['scores'] as $scr)
                    @if ($scr['sub_event_id'] == $sub->id)
                    <td>{{$scr['sub_event_score']}}%</td>
                    @endif
                    @endforeach
                    @endforeach
                    <td style="text-align: center;"><strong>{{ $row['over_all_total']}} % </strong></td>
                    <td style="text-align: center;"><strong style="color: red;">{{ $row['rank'] }}</strong></td>
                </tr>

                @endforeach
            </tbody>
        </table>
        @endif
    </div>
    <div>
        <table width="100%" class="mt-40 mt-20">
            <tbody>
                @foreach ($users as $key => $value)
                @if ($key % 3 == 0)
                <tr class="mt-20">
                    @endif
                    <td><u> {{ $value->full_name }}</u>
                        <br>
                        Judge
                    </td>
                    @if (($key + 1) % 3 == 0 || $loop->last)
                </tr>
                @endif
                @endforeach
            </tbody>

        </table>
    </div>
    <div class="mt-40" style="text-align: center;">
        ____________________
        <br>
        Event Coordinator
    </div>

    <footer>
        <hr>
        <span style="font-size: 13px; font-weight: bold;">ASSCAT at its BEST</span> <br>
        <i style="font-size: 10px; font-weight: bold;">Balance / Empowered / Selfless / Trustworthy</i>

        <div class="iso-logo">
            <img src="{{ public_path('images/iso_logo.png') }}" alt="ISO logo" />
        </div>
    </footer>

</body>

</html>