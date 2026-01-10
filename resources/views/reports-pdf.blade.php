<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Analytics Report - CollaboTask</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 14px;
            line-height: 1.6;
            color: #374151;
            background: white;
            margin: 0;
            padding: 30px;
        }

        .header {
            text-align: center;
            border-bottom: 3px solid #2563eb;
            padding-bottom: 25px;
            margin-bottom: 35px;
            position: relative;
        }

        .header::after {
            content: '';
            position: absolute;
            bottom: -3px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 3px;
            background: linear-gradient(90deg, #2563eb, #3b82f6);
        }

        .logo-section {
            margin-bottom: 15px;
        }

        .logo {
            font-size: 32px;
            font-weight: bold;
            color: #2563eb;
            letter-spacing: -1px;
        }

        .subtitle {
            font-size: 16px;
            color: #6b7280;
            margin-top: 5px;
        }

        .header h1 {
            font-size: 28px;
            font-weight: 700;
            color: #1f2937;
            margin: 15px 0 10px 0;
        }

        .header-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
            padding: 15px;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            border-radius: 8px;
            border: 1px solid #e5e7eb;
        }

        .user-info {
            font-weight: 600;
            color: #2563eb;
        }

        .generated-info {
            color: #6b7280;
            font-size: 13px;
        }

        .stats-section {
            margin: 35px 0;
        }

        .stats-title {
            font-size: 20px;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #e5e7eb;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 25px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s ease;
        }

        .stat-card:hover {
            transform: translateY(-2px);
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #2563eb, #3b82f6);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px auto;
            color: white;
            font-size: 20px;
            font-weight: bold;
        }

        .stat-number {
            font-size: 36px;
            font-weight: 700;
            color: #2563eb;
            margin-bottom: 8px;
            line-height: 1;
        }

        .stat-label {
            font-size: 14px;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 500;
        }

        .projects-section {
            margin-top: 40px;
        }

        .section-title {
            font-size: 22px;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 2px solid #2563eb;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-icon {
            width: 24px;
            height: 24px;
            background: #2563eb;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 12px;
            font-weight: bold;
        }

        .projects-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .projects-table thead {
            background: linear-gradient(135deg, #2563eb, #3b82f6);
            color: white;
        }

        .projects-table th {
            padding: 15px 12px;
            text-align: left;
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .projects-table td {
            padding: 15px 12px;
            border-bottom: 1px solid #e5e7eb;
            background: white;
        }

        .projects-table tbody tr:hover {
            background: #f8fafc;
        }

        .progress-container {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .progress-bar {
            flex: 1;
            height: 10px;
            background: #e5e7eb;
            border-radius: 5px;
            overflow: hidden;
            position: relative;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #2563eb, #10b981);
            border-radius: 5px;
            transition: width 0.3s ease;
        }

        .progress-text {
            font-weight: 600;
            color: #2563eb;
            font-size: 13px;
            min-width: 35px;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-active {
            background: linear-gradient(135deg, #dcfce7, #bbf7d0);
            color: #166534;
        }

        .status-completed {
            background: linear-gradient(135deg, #dbeafe, #bfdbfe);
            color: #1e40af;
        }

        .status-on-hold {
            background: linear-gradient(135deg, #fef3c7, #fde68a);
            color: #92400e;
        }

        .status-stalled {
            background: linear-gradient(135deg, #fee2e2, #fecaca);
            color: #991b1b;
        }

        .deadline-text {
            font-weight: 500;
            color: #374151;
        }

        .no-data {
            text-align: center;
            padding: 40px;
            color: #6b7280;
            font-style: italic;
        }

        .footer {
            margin-top: 50px;
            padding-top: 25px;
            border-top: 2px solid #e5e7eb;
            text-align: center;
            color: #6b7280;
            font-size: 12px;
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .footer-logo {
            font-weight: 600;
            color: #2563eb;
        }

        .footer-note {
            background: #f8fafc;
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            margin-top: 20px;
        }

        @media print {
            body {
                margin: 0;
                padding: 20px;
            }
            .stat-card:hover {
                transform: none;
            }
            .projects-table tbody tr:hover {
                background: white;
            }
        }

        @page {
            margin: 1cm;
            size: A4;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo-section">
            <div class="logo">CollaboTask</div>
            <div class="subtitle">Project Management System</div>
        </div>
        <h1>Project Analytics Report</h1>
        <div class="header-info">
            <div class="user-info">Generated for: {{ $user->name }}</div>
            <div class="generated-info">Report Date: {{ $generated_at }}</div>
        </div>
    </div>

    <div class="stats-section">
        <h2 class="stats-title">📊 Performance Overview</h2>
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">✓</div>
                <div class="stat-number">{{ $completed }}</div>
                <div class="stat-label">Tasks Completed</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">📈</div>
                <div class="stat-number">{{ $efficiency }}%</div>
                <div class="stat-label">Efficiency Rate</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">🎯</div>
                <div class="stat-number">{{ $activeProjects }}</div>
                <div class="stat-label">Active Projects</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">⚠️</div>
                <div class="stat-number">{{ $overdue }}</div>
                <div class="stat-label">Overdue Tasks</div>
            </div>
        </div>
    </div>

    <div class="projects-section">
        <h2 class="section-title">
            <span class="section-icon">📋</span>
            Project Health Overview
        </h2>

        @if($projectsHealth->count() > 0)
        <table class="projects-table">
            <thead>
                <tr>
                    <th>Project Name</th>
                    <th>Progress Status</th>
                    <th>Current Status</th>
                    <th>Deadline</th>
                </tr>
            </thead>
            <tbody>
                @foreach($projectsHealth as $project)
                <tr>
                    <td>
                        <strong>{{ $project->name }}</strong>
                    </td>
                    <td>
                        <div class="progress-container">
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: {{ $project->progress }}%"></div>
                            </div>
                            <span class="progress-text">{{ $project->progress }}%</span>
                        </div>
                    </td>
                    <td>
                        <span class="status-badge status-{{ strtolower(str_replace(' ', '-', $project->status)) }}">
                            {{ $project->status }}
                        </span>
                    </td>
                    <td>
                        <span class="deadline-text">
                            {{ $project->deadline ? \Carbon\Carbon::parse($project->deadline)->format('d M Y') : 'No deadline set' }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="no-data">
            No active projects to display in this report.
        </div>
        @endif
    </div>

    <div class="footer">
        <div class="footer-content">
            <div class="footer-logo">CollaboTask</div>
            <div>Professional Project Management</div>
        </div>
        <div class="footer-note">
            <strong>Report Information:</strong> This analytics report provides insights into your project performance and task completion metrics.
            Generated automatically by the CollaboTask system for performance tracking and project management purposes.
        </div>
    </div>
</body>
</html>