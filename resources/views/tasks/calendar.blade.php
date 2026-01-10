@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold">Calendar</h4>
    <a href="{{ route('tasks.create') }}" class="btn btn-primary rounded-pill"><i class="fas fa-plus me-2"></i>New Task</a>
</div>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-4">
        <div class="calendar-container">
            <div class="calendar-header d-flex justify-content-between align-items-center mb-4">
                <h5 class="mb-0">{{ now()->format('F Y') }}</h5>
                <div class="btn-group">
                    <button class="btn btn-outline-secondary btn-sm" onclick="prevMonth()">«</button>
                    <button class="btn btn-outline-secondary btn-sm" onclick="nextMonth()">»</button>
                </div>
            </div>

            <div class="calendar-grid">
                <div class="calendar-weekdays d-flex">
                    <div class="weekday">Sun</div>
                    <div class="weekday">Mon</div>
                    <div class="weekday">Tue</div>
                    <div class="weekday">Wed</div>
                    <div class="weekday">Thu</div>
                    <div class="weekday">Fri</div>
                    <div class="weekday">Sat</div>
                </div>

                <div class="calendar-days">
                    <!-- Days will be populated by JavaScript -->
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.calendar-container {
    max-width: 800px;
    margin: 0 auto;
}

.calendar-weekdays {
    margin-bottom: 10px;
}

.weekday {
    flex: 1;
    text-align: center;
    font-weight: bold;
    color: #6c757d;
    padding: 10px 0;
}

.calendar-days {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 5px;
}

.calendar-day {
    aspect-ratio: 1;
    border: 1px solid #e9ecef;
    border-radius: 8px;
    padding: 8px;
    cursor: pointer;
    transition: all 0.2s;
    position: relative;
}

.calendar-day:hover {
    background-color: #f8f9fa;
    border-color: #0d6efd;
}

.calendar-day.today {
    background-color: #e7f3ff;
    border-color: #0d6efd;
    font-weight: bold;
}

.calendar-day.other-month {
    color: #adb5bd;
    background-color: #f8f9fa;
}

.task-indicator {
    position: absolute;
    bottom: 2px;
    left: 50%;
    transform: translateX(-50%);
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background-color: #0d6efd;
}

.task-indicator.high {
    background-color: #dc3545;
}

.task-indicator.medium {
    background-color: #ffc107;
}

.task-indicator.low {
    background-color: #28a745;
}
</style>

<script>
let currentDate = new Date();

function renderCalendar() {
    const year = currentDate.getFullYear();
    const month = currentDate.getMonth();

    // Update header
    document.querySelector('.calendar-header h5').textContent =
        currentDate.toLocaleDateString('en-US', { year: 'numeric', month: 'long' });

    // Get first day of month and last day
    const firstDay = new Date(year, month, 1);
    const lastDay = new Date(year, month + 1, 0);
    const startDate = new Date(firstDay);
    startDate.setDate(startDate.getDate() - firstDay.getDay());

    const endDate = new Date(lastDay);
    endDate.setDate(endDate.getDate() + (6 - lastDay.getDay()));

    // Clear existing days
    const daysContainer = document.querySelector('.calendar-days');
    daysContainer.innerHTML = '';

    // Generate days
    let currentDay = new Date(startDate);
    while (currentDay <= endDate) {
        const dayElement = document.createElement('div');
        dayElement.className = 'calendar-day';

        const dayNumber = currentDay.getDate();
        const isCurrentMonth = currentDay.getMonth() === month;
        const isToday = currentDay.toDateString() === new Date().toDateString();

        if (!isCurrentMonth) {
            dayElement.classList.add('other-month');
        }

        if (isToday) {
            dayElement.classList.add('today');
        }

        dayElement.innerHTML = `<span class="day-number">${dayNumber}</span>`;

        // Add task indicators (you can enhance this with actual task data)
        const tasksForDay = {{ Js::from($tasks) }}.filter(task => {
            if (!task.deadline) return false;
            const taskDate = new Date(task.deadline);
            return taskDate.toDateString() === currentDay.toDateString();
        });

        if (tasksForDay.length > 0) {
            const indicator = document.createElement('div');
            indicator.className = `task-indicator ${tasksForDay[0].priority.toLowerCase()}`;
            dayElement.appendChild(indicator);
        }

        daysContainer.appendChild(dayElement);
        currentDay.setDate(currentDay.getDate() + 1);
    }
}

function prevMonth() {
    currentDate.setMonth(currentDate.getMonth() - 1);
    renderCalendar();
}

function nextMonth() {
    currentDate.setMonth(currentDate.getMonth() + 1);
    renderCalendar();
}

// Initial render
renderCalendar();
</script>