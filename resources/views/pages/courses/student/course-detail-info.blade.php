<div class="card card-primary card-outline">
    <div class="card-header">
        <h3 class="card-title font-weight-bold" style="font-size: 2rem;">
            {{ $classroom->course->name }}
        </h3>
    </div>
    <div class="card-body">
        <h5 class="card-title mb-3">{{ $classroom->name }} - {{ $classroom->code }}</h5>
        <p class="card-text mb-0 border-top py-2 font-weight-bold">Teacher</p>
        <div class="row mb-2 border-bottom">
            @foreach ($teacherClassroom as $item)
                <a href="{{ route('teacher-profile', $item->teacher->user->id) }}" class="col-md-3 mb-2 ">
                    <div class="d-flex align-items-center ">
                        <img class="img-circle img-bordered-sm"
                            src="{{ asset('assets') }}/images/profile/{{ $item->teacher->user->image }}"
                            alt="user image" width="50" height="50">
                        <div class="ml-1 text-truncate">
                            <span>{{ $item->teacher->user->name }}</span> <br>
                            <span style="font-size: 0.8rem;">{{ $item->teacher->user->email }}</span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
        @php
            $date_now = new DateTime();
            $progressbarPercent = '0%';
            $totalSession = count($sessions);
            $sessionDone = 0;
            if ($totalSession) {
                foreach ($sessions as $value) {
                    if ($value->end_time < $date_now) {
                        $sessionDone++;
                    }
                }
                $progressbarPercent = sprintf('%.0f', ($sessionDone * 100) / $totalSession) . '%';
            }
        @endphp
        <p class="card-text mb-0 py-2 font-weight-bold">Progress</p>
        <div class="d-flex justify-content-between align-items-center">
            <div class="progress progress-xs rounded w-100" style="height: 12px;">
                <div class="progress-bar {{ $progressbarPercent === '100%' ? 'bg-success' : 'bg-warning' }} progress-bar-striped progress-bar-animated"
                    role="progressbar" style="width: {{ $progressbarPercent }}" aria-valuemax="100">
                </div>
            </div>
            <span class="ml-2">{{ $progressbarPercent }}</span>
        </div>
        <p class="card-subtitle text-muted pb-2 mb-2 border-bottom"> {{ $sessionDone }} out of {{ $totalSession }}
            sessions completed</span>
        <div class="group-btn row mt-4">
            <a href="{{ route('student-course-detail', $classroom->id) }}"
                class="btn {{ request()->is('student/course/' . $classroom->id) ? 'btn-primary' : 'btn-secondary' }} mr-2 mb-2">Sessions</a>
            <a href="{{ route('student-course-detail-assignment', $classroom->id) }}"
                class="btn {{ request()->is('student/course/' . $classroom->id . '/assignment') ? 'btn-primary' : 'btn-secondary' }} mr-2 mb-2">Task</a>
            <a href="{{ route('student-course-detail-people', $classroom->id) }}"
                class="btn {{ request()->is('student/course/' . $classroom->id . '/people') ? 'btn-primary' : 'btn-secondary' }} mr-2 mb-2">People</a>
            <a href="{{ route('student-course-detail-attendance', $classroom->id) }}"
                class="btn {{ request()->is('student/course/' . $classroom->id . '/attendance') ? 'btn-primary' : 'btn-secondary' }} mr-2 mb-2">Attendance</a>
            <a href="{{ route('student-course-detail-score', $classroom->id) }}"
                class="btn {{ request()->is('student/course/' . $classroom->id . '/score') ? 'btn-primary' : 'btn-secondary' }} mr-2 mb-2">Score</a>
        </div>
    </div>
</div>
