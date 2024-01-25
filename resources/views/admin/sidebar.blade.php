<nav id="sidebar">
    <!-- Sidebar Header-->
    {{-- ... Sidebar Header content ... --}}

    <!-- Sidebar Navigation Menus -->
    <span class="heading">Main</span>
    <ul class="list-unstyled">
        <li class="{{ Request::is('home') ? 'active' : '' }}">
            <a href="/home"> <i class="icon-home"></i>Home </a>
        </li>
        <li class="{{ Request::is('postPage') ? 'active' : '' }}">
            <a href="{{ url('postPage') }}"> <i class="icon-new-file"></i>Add Post </a>
        </li>
        <li class="{{ Request::is('show_post') ? 'active' : '' }}">
            <a href="{{ url('show_post') }}"> <i class="icon-grid"></i>Show All Posts</a>
        </li>
        <li class="{{ Request::is('pending_post') ? 'active' : '' }}">
            <a href="{{ url('pending_post') }}"> <i class="icon-list"></i>Show Pending Posts</a>
        </li>
    </ul>
</nav>
