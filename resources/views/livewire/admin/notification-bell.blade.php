<li class="dropdown dropdown-list-toggle position-relative"><a href="#"
        data-toggle="dropdown" id="notification"
        class="nav-link notification-toggle nav-link-lg {{ check_new_notifications() ? 'beep' : '' }}"><i
            class="far fa-bell"></i></a>
    <div class="dropdown-menu dropdown-list dropdown-menu-right">
        <div class="dropdown-header">Notifications({{ $notifications->where('status', 'unread')->count() }} new)
            <div class="float-right">
                <a href="#"  onclick="markAsAllRead()" >Mark All As Read</a>
            </div>
        </div>
        <div class="dropdown-list-content dropdown-list-icons">
            @foreach ($notifications as $n)
                @if ($n->notifiable_type === 'App\Models\Order')
                    <a href="{{ route('order.list') }}" class="dropdown-item">
                        <div class="dropdown-item-icon bg-success text-white">

                            @if ($n->notifiable_type === 'Contact')
                                <i class="fa-solid fa-message"></i>
                            @else
                                <i class="fas fa-check"></i>
                            @endif
                        </div>
                        <div class="dropdown-item-desc">
                            {{ $n->title }}
                            <div class="time @if ($n->status == 'unread') text-primary @endif">
                                {{ $n->created_at->diffForHumans() }}</div>
                        </div>
                    </a>
                @elseif($n->notifiable_type === 'App\Models\Product')
                    <a href="{{ route('product.list') }}" class="dropdown-item">
                        <div class="dropdown-item-icon bg-success text-white">

                            @if ($n->notifiable_type === 'Contact')
                                <i class="fa-solid fa-message"></i>
                            @else
                                <i class="fas fa-check"></i>
                            @endif
                        </div>
                        <div class="dropdown-item-desc">
                            {{ $n->title }}
                            <div class="time @if ($n->status == 'unread') text-primary @endif">
                                {{ $n->created_at->diffForHumans() }}</div>
                        </div>
                    </a>
                @elseif($n->notifiable_type === 'App\Models\Category')
                    <a href="{{ route('category.list') }}" class="dropdown-item">
                        <div class="dropdown-item-icon bg-success text-white">

                            @if ($n->notifiable_type === 'Contact')
                                <i class="fa-solid fa-message"></i>
                            @else
                                <i class="fas fa-check"></i>
                            @endif
                        </div>
                        <div class="dropdown-item-desc">
                            {{ $n->title }}
                            <div class="time @if ($n->status == 'unread') text-primary @endif">
                                {{ $n->created_at->diffForHumans() }}</div>
                        </div>
                    </a>
                @else
                <a href="#" class="dropdown-item">
                    <div class="dropdown-item-icon bg-success text-white">

                        @if ($n->notifiable_type === 'Contact')
                            <i class="fa-solid fa-message"></i>
                        @else
                            <i class="fas fa-check"></i>
                        @endif
                    </div>
                    <div class="dropdown-item-desc">
                        {{ $n->title }}
                        <div class="time @if ($n->status == 'unread') text-primary @endif">
                            {{ $n->created_at->diffForHumans() }}</div>
                    </div>
                </a>
                @endif
            @endforeach
            <a href="#" class="dropdown-item ">
                <div class="dropdown-item-icon bg-info text-white">
                    <i class="far fa-user"></i>
                </div>
                <div class="dropdown-item-desc">
                    <b>You</b> and <b>Dedik Sugiharto</b> are now friends
                    <div class="time">10 Hours Ago</div>
                </div>
            </a>
            <a href="#" class="dropdown-item">
                <div class="dropdown-item-icon bg-success text-white">
                    <i class="fas fa-check"></i>
                </div>
                <div class="dropdown-item-desc">
                    <b>Kusnaedi</b> has moved task <b>Fix bug header</b> to <b>Done</b>
                    <div class="time">12 Hours Ago</div>
                </div>
            </a>
            <a href="#" class="dropdown-item">
                <div class="dropdown-item-icon bg-danger text-white">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="dropdown-item-desc">
                    Low disk space. Let's clean it!
                    <div class="time">17 Hours Ago</div>
                </div>
            </a>
            <a href="#" class="dropdown-item">
                <div class="dropdown-item-icon bg-info text-white">
                    <i class="fas fa-bell"></i>
                </div>
                <div class="dropdown-item-desc">
                    Welcome to Stisla template!
                    <div class="time">Yesterday</div>
                </div>
            </a>
        </div>
        <div class="dropdown-footer text-center">
            <a href="#">View All <i class="fas fa-chevron-right"></i></a>
        </div>
    </div>
</li>
