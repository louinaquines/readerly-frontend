<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; font-size: 13px; color: #333; }
        h1 { color: #1d4ed8; }
        table { width: 100%; border-collapse: collapse; margin-top: 16px; }
        th { background: #1d4ed8; color: white; padding: 8px; text-align: left; }
        td { padding: 8px; border-bottom: 1px solid #e5e7eb; }
    </style>
</head>
<body>
    <h1>Readerly — Student Report</h1>
    <p><strong>Pangalan:</strong> {{ $student['name'] }}</p>
    <p><strong>Grade:</strong> {{ $student['grade'] }}</p>
    <p><strong>Reading Level:</strong> {{ $student['reading_level'] }}</p>
    <p><strong>Petsa:</strong> {{ now()->format('F d, Y') }}</p>

    <table>
        <thead>
            <tr>
                <th>Session</th>
                <th>Accuracy</th>
                <th>Status</th>
                <th>Error Patterns</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sessions as $session)
                <tr>
                    <td>#{{ $session['id'] }}</td>
                    <td>{{ $session['accuracy_score'] ?? '—' }}%</td>
                    <td>{{ ucfirst($session['status']) }}</td>
                    <td>{{ implode(', ', $session['error_patterns'] ?? []) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>