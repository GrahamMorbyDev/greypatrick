New website quote request

Name: {{ $data['name'] }}
Email: {{ $data['email'] }}
Business / Project: {{ $data['project_name'] ?? 'Not provided' }}
Website: {{ $data['website'] ?? 'Not provided' }}
Project Type: {{ $data['project_type'] }}
Budget: {{ $data['budget'] ?? 'Not provided' }}
Timeframe: {{ $data['timeframe'] ?? 'Not provided' }}

Message:
{{ $data['message'] }}
