<ul class="nav flex-column flex-grow-1">
    <li class="nav-item mb-2">
        <a href="{{ route('school.index') }}" class="nav-link text-light px-3 py-2 d-flex align-items-center {{ request()->routeIs('school.*') ? 'active' : '' }}">
            <i class="fa-solid fa-school me-3" style="width: 20px;"></i> Sekolah
        </a>
    </li>
    <li class="nav-item mb-2">
        <a href="{{ route('lab.index') }}" class="nav-link text-light px-3 py-2 d-flex align-items-center {{ request()->routeIs('lab.*') ? 'active' : '' }}">
            <i class="fa-solid fa-flask me-3" style="width: 20px;"></i> Lab
        </a>
    </li>
    <li class="nav-item mb-2">
        <a href="{{ route('student.index') }}" class="nav-link text-light px-3 py-2 d-flex align-items-center {{ request()->routeIs('student.*') ? 'active' : '' }}">
            <i class="fa-solid fa-users me-3" style="width: 20px;"></i> Siswa
        </a>
    </li>
    <li class="nav-item mb-2">
        <a href="{{ route('task.index') }}" class="nav-link text-light px-3 py-2 d-flex align-items-center {{ request()->routeIs('task.*') ? 'active' : '' }}">
            <i class="fa-solid fa-list-check me-3" style="width: 20px;"></i> Penugasan
        </a>
    </li>
</ul>

<div class="mt-auto pt-3 border-top border-secondary">
    <form action="{{ route('logout') }}" method="POST" class="m-0">
        @csrf
        <button type="submit" class="btn btn-outline-danger w-100 d-flex align-items-center justify-content-center gap-2">
            <i class="fa-solid fa-right-from-bracket"></i> Logout
        </button>
    </form>
</div>
