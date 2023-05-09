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
        <span style="font-size: 12px;">Individual Judge Scoring</span>
    </div>

    @if (count($male) > 0)
    <div class="mt-20">
        <h5>Male</h5>
        <table width="100%" class="table" style="font-size: 11px;">
            <thead>
                <tr>
                    <th rowspan="2">Participant No.</th>
                    <th rowspan="2">Participants Name</th>
                    <th colspan="{{ count($criteria) }}" style="text-align: center;"><strong>Criteria</strong></th>
                    <th rowspan="2">Total Percentage Score</th>
                    <th rowspan="2">Rank</th>
                </tr>
                <tr style="padding: 5px;">
                    <?php foreach ($criteria as $row) : ?>
                        <th><?= $row->criteria; ?>/ <?= $row->percentage; ?>%</th>
                    <?php endforeach; ?>
                </tr>

            </thead>
            <tbody>
                @foreach ($male as $row )
                <tr style="padding: 5px;">
                    <td>{{ $row['number'] }}</td>
                    <td>{{ $row['participant_name'] }}</td>
                    @foreach ($criteria as $cri)
                    @foreach ($row['scores'] as $scr)
                    @if ($scr['criteria_id'] == $cri->id)
                    <td>{{$scr['score']}}%</td>
                    @endif
                    @endforeach
                    @endforeach
                    <td style="text-align: center;"><strong>{{ $row['total_score']}} %</strong></td>
                    <td style="text-align: center;"><strong style="color: red;">{{$loop->index + 1}}</strong></td>
                </tr>

                @endforeach
            </tbody>
        </table>
    </div>
    @endif

    @if (count($female) > 0)
    <div class="mt-20">
        <h5>Female</h5>
        <table width="100%" class="table" style="font-size: 11px;">
            <thead>
                <tr>
                    <th rowspan="2">Participant No.</th>
                    <th rowspan="2">Participants Name</th>
                    <th colspan="{{ count($criteria) }}" style="text-align: center;"><strong>Criteria</strong></th>
                    <th rowspan="2">Total Percentage Score</th>
                    <th rowspan="2">Rank</th>
                </tr>
                <tr style="padding: 5px;">
                    <?php foreach ($criteria as $row) : ?>
                        <th><?= $row->criteria; ?>/ <?= $row->percentage; ?>%</th>
                    <?php endforeach; ?>
                </tr>

            </thead>
            <tbody>
                @foreach ($female as $row )
                <tr style="padding: 5px;">
                    <td>{{ $row['number'] }}</td>
                    <td>{{ $row['participant_name'] }}</td>
                    @foreach ($criteria as $cri)
                    @foreach ($row['scores'] as $scr)
                    @if ($scr['criteria_id'] == $cri->id)
                    <td>{{$scr['score']}}%</td>
                    @endif
                    @endforeach
                    @endforeach
                    <td style="text-align: center;"><strong>{{ $row['total_score']}} %</strong></td>
                    <td style="text-align: center;"><strong style="color: red;">{{$loop->index + 1}}</strong></td>
                </tr>

                @endforeach
            </tbody>
        </table>
    </div>
    @endif

    <div>
        <table width="100%" class="mt-40">
            <tr style="font-size: 12px;">
                <td width="50%">
                    <u>{{ $user->full_name}}</u>
                    <br>
                    Judge
                </td>
                <td width="50%">
                    ____________________
                    <br>
                    Event Coordinator
                </td>
            </tr>
        </table>
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