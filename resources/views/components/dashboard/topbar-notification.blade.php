<li class="nav-item dropdown no-arrow mx-1">
    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-bell fa-fw"></i>
        <!-- Counter - Alerts -->
        <span class="badge badge-danger badge-counter">{{ Auth::user()->notifications->count() }}+</span>
    </a>

    <!-- Dropdown - Alerts -->
    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
        aria-labelledby="alertsDropdown">
        <h6 class="dropdown-header">
            Alerts Center
        </h6>

        @forelse (Auth::user()->notifications as $notification)
            <a class="dropdown-item d-flex align-items-center" href="{{ $notification->data['url'] }}?notification=read"
                style="{{ $notification->unRead() ? 'background-color: #eaecf4;' : '' }}">
                <div class="mr-3">
                    <div class="icon-circle {{ $notification->data['icon']['background'] }}">
                        <i
                            class="{{ $notification->data['icon']['src'] }} {{ $notification->data['icon']['color'] }}"></i>
                    </div>
                </div>
                <div>
                    <div class="small text-gray-500">{{ $notification->created_at->diffForHumans() }}</div>
                    {{ $notification->data['content'] }}
                </div>
            </a>
        @empty
            <a class="dropdown-item d-flex align-items-center" href="javascript:void()">
                <div class="mr-3">
                    <div class="icon-circle bg-secondary">
                        <i class="fas fa-file-alt text-white"></i>
                    </div>
                </div>
                <div>
                    There's no notifications
                </div>
            </a>
        @endforelse

        <a class="dropdown-item text-center small text-gray-500" href="#">Show All
            Alerts</a>
    </div>
</li>
