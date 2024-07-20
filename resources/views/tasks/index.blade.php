<!DOCTYPE html>
<html>
<head>
    <title>Task Planner</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-3">Task Planner</h2>

    @foreach ($developers as $developer)
        <h3>{{ $developer['name'] }}</h3>
        <table class="table table-bordered text-center table-sm">
            <thead>
            <tr>
                <th>Week</th>
                <th>Task ID</th>
                <th>Duration (hours)</th>
                <th>Provider</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($developer['assignments'] as $assignment)
                <tr>
                    <td>{{ $assignment['week'] }}</td>
                    <td>{{ $assignment['task']['external_id'] }}</td>
                    <td>{{ $assignment['duration'] }} hours</td>
                    <td>{{ $assignment['task']['provider'] }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endforeach
</div>
</body>
</html>
