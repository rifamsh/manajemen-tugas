@extends('layouts.app')

@section('title', 'Kalender Tugas')

@section('content')
<style>
    /* Custom CSS khusus Calendar agar rapi */
    .calendar-table { table-layout: fixed; width: 100%; }
    .calendar-table th { text-align: center; padding: 10px; background: #f8f9fa; }
    .calendar-table td { height: 120px; vertical-align: top; padding: 5px; position: relative; }
    .calendar-table td:hover { background-color: #f8f9fa; }
    .calendar-day-number { font-weight: bold; margin-bottom: 5px; display: block; }
    .calendar-task { 
        font-size: 0.8rem; 
        padding: 2px 5px; 
        margin-bottom: 2px; 
        border-radius: 3px; 
        cursor: pointer; 
        white-space: nowrap; 
        overflow: hidden; 
        text-overflow: ellipsis; 
        display: block;
        text-decoration: none;
    }
    .calendar-task:hover { opacity: 0.8; color: white;}
    .bg-task-high { background-color: #dc3545; color: white; }
    .bg-task-med { background-color: #ffc107; color: black; }
    .bg-task-low { background-color: #198754; color: white; }
    .other-month { background-color: #fdfdfd; color: #ccc; }
    .today { background-color: #e8f4ff; }
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold">Desember 2024</h3>
    <div class="btn-group">
        <button class="btn btn-outline-secondary"><i class="fas fa-chevron-left"></i></button>
        <button class="btn btn-outline-secondary">Today</button>
        <button class="btn btn-outline-secondary"><i class="fas fa-chevron-right"></i></button>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <table class="table table-bordered calendar-table mb-0">
            <thead>
                <tr>
                    <th class="text-danger">Minggu</th>
                    <th>Senin</th>
                    <th>Selasa</th>
                    <th>Rabu</th>
                    <th>Kamis</th>
                    <th>Jumat</th>
                    <th>Sabtu</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="other-month"><span class="calendar-day-number">30</span></td> <td>
                        <span class="calendar-day-number">1</span>
                        <a href="#" class="calendar-task bg-task-low">Rapat Awal Tim</a>
                    </td>
                    <td><span class="calendar-day-number">2</span></td>
                    <td><span class="calendar-day-number">3</span></td>
                    <td><span class="calendar-day-number">4</span></td>
                    <td>
                        <span class="calendar-day-number">5</span>
                        <a href="#" class="calendar-task bg-task-high">Deadline Proposal</a>
                    </td>
                    <td><span class="calendar-day-number">6</span></td>
                </tr>

                <tr>
                    <td><span class="calendar-day-number">7</span></td>
                    <td><span class="calendar-day-number">8</span></td>
                    <td><span class="calendar-day-number">9</span></td>
                    <td>
                        <span class="calendar-day-number">10</span>
                        <a href="#" class="calendar-task bg-task-med">Revisi UI/UX</a>
                        <a href="#" class="calendar-task bg-task-low">Update Laporan</a>
                    </td>
                    <td><span class="calendar-day-number">11</span></td>
                    <td><span class="calendar-day-number">12</span></td>
                    <td><span class="calendar-day-number">13</span></td>
                </tr>

                <tr>
                    <td><span class="calendar-day-number">14</span></td>
                    <td><span class="calendar-day-number">15</span></td>
                    <td><span class="calendar-day-number">16</span></td>
                    <td><span class="calendar-day-number">17</span></td>
                    <td class="today">
                        <span class="calendar-day-number">18 <span class="badge bg-primary text-white ms-1" style="font-size:0.6rem">Hari Ini</span></span>
                        <a href="#" class="calendar-task bg-task-high">Coding Backend Auth</a>
                    </td>
                    <td><span class="calendar-day-number">19</span></td>
                    <td><span class="calendar-day-number">20</span></td>
                </tr>

                <tr>
                    <td><span class="calendar-day-number">21</span></td>
                    <td><span class="calendar-day-number">22</span></td>
                    <td><span class="calendar-day-number">23</span></td>
                    <td><span class="calendar-day-number">24</span></td>
                    <td>
                        <span class="calendar-day-number">25</span>
                        <a href="#" class="calendar-task bg-info text-white">Presentasi Progress</a>
                    </td>
                    <td><span class="calendar-day-number">26</span></td>
                    <td><span class="calendar-day-number">27</span></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection